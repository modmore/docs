The MerchantUrlGatewayInterface should be implemented by gateways that can provide a link to view a specific payment in the payment provider's merchant dashboard.

This is an **opt-in** interface, similar to [WebhookGatewayInterface](WebhookGatewayInterface). It is not part of [GatewayInterface](GatewayInterface), so existing gateways remain backward compatible until they choose to implement it.

When implemented, Commerce automatically shows the link in the merchant dashboard:

- On the **transaction overview** modal, below the payment reference
- As a **View in payment provider dashboard** action on the order transactions grid

[TOC]

## The interface

````php
<?php

namespace modmore\Commerce\Gateways\Interfaces;

use comTransaction;

interface MerchantUrlGatewayInterface extends GatewayInterface
{
    /**
     * Return a URL to view this transaction in the payment provider's dashboard,
     * or null if unavailable (e.g. missing reference).
     *
     * @param comTransaction $transaction
     * @return string|null
     */
    public function getMerchantUrl(comTransaction $transaction): ?string;
}
````

The method should return a fully qualified URL when the transaction can be looked up in the provider dashboard, or `null` when no link is available. Typical reasons to return `null`:

- The transaction has no `reference` yet (payment not submitted or still processing)
- Required gateway-specific identifiers are missing from the transaction or its properties
- The provider does not offer a stable deep link for the transaction type

Use `$transaction->get('reference')` for the primary provider ID, and `$transaction->getProperty(...)` for any additional identifiers stored during payment processing. Use `$transaction->commerce->isTestMode()` when the provider uses different dashboard hosts or URL paths for sandbox vs live.

## Resolving the URL

You can call `getMerchantUrl()` directly on your gateway instance, or use the helper:

````php
use modmore\Commerce\Gateways\Helpers\GatewayHelper;

$url = GatewayHelper::getMerchantUrl($transaction);
````

`GatewayHelper::getMerchantUrl()` returns `null` when the transaction has no payment method, or when the gateway does not implement `MerchantUrlGatewayInterface`.

[More about GatewayHelper >](GatewayHelper)

## Example

````php
<?php

namespace ThirdParty\MyGateway\Gateways;

use comTransaction;
use modmore\Commerce\Gateways\Interfaces\GatewayInterface;
use modmore\Commerce\Gateways\Interfaces\MerchantUrlGatewayInterface;

class MyGateway implements GatewayInterface, MerchantUrlGatewayInterface
{
    // ... other GatewayInterface methods ...

    public function getMerchantUrl(comTransaction $transaction): ?string
    {
        $reference = (string)$transaction->get('reference');
        if ($reference === '') {
            return null;
        }

        $host = $transaction->commerce->isTestMode()
            ? 'sandbox.myprovider.example'
            : 'myprovider.example';

        return 'https://' . $host . '/transactions/' . rawurlencode($reference);
    }
}
````

## Built-in implementations

The following core gateways implement `MerchantUrlGatewayInterface`:

| Gateway | URL basis |
|---------|-----------|
| Stripe | Stripe Dashboard payment page |
| PayPal Checkout | PayPal activity URL (capture or authorization), or order details fallback |
| Mollie | Mollie Dashboard payment page |
| Braintree | Braintree Control Panel transaction page |
| Authorize.net | Authorize.net transaction detail page |
| MultiSafePay | MultiSafePay merchant portal transaction page |

Other built-in gateways (such as Manual, legacy PayPal, and SagePay) do not implement this interface.

## Notes

- Do **not** add `getMerchantUrl()` to `GatewayInterface`. Use the opt-in interface so third-party gateways are not forced to implement it.
- Do **not** store merchant dashboard URLs in `getExtraInformation()`. Those URLs are derived from the reference and gateway configuration, and provider URL patterns may change over time.
- Third-party modules can also add custom admin actions via the `\Commerce::EVENT_DASHBOARD_TRANSACTION_ACTIONS` event, but implementing `MerchantUrlGatewayInterface` is the recommended approach for a consistent experience.
