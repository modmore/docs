The SharedWebhookGatewayInterface is a specialised version of the [WebhookGatewayInterface](WebhookGatewayInterface) that defines an `identifyWebhookTransaction` method. This must be implemented by gateways that **do not** offer transaction-specific notification/webhook URLs, but instead have a single defined endpoint that will receive notifications for all transactions.

[TOC]

## The interface

```php
<?php

namespace modmore\Commerce\Gateways\Interfaces;

use modmore\Commerce\Gateways\Stripe\StripeCard;

interface SharedWebhookGatewayInterface extends WebhookGatewayInterface {
    /**
     * Used for gateways that use a single pre-defined webhook endpoint (which does not include the ?transaction=ID
     * parameter in the per-transaction URL) to identify the transaction from other information.
     *
     * This method should *not* submit/act on the transaction by itself; it should only return the appropriate
     * comTransaction record that the webhook belongs to.
     *
     * If no transaction can be found, the method should return false.
     *
     * For an example {@see StripeCard::identifyWebhookTransaction}
     *
     * @return \comTransaction|false
     */
    public function identifyWebhookTransaction();
}
```

The `identifyWebhookTransaction()` method will probably use `$_GET` or `$_POST` data to figure out the webhook event, and if applicable, it should return the relevant `comTransaction` object. 

Note the `identifyWebhookTransaction()` method should **not** perform any actions on the transaction; it should just find the right one. The webhook handler in Commerce will then call your `webhook(comTransaction $transaction, array $data)` method (defined by the `WebhookGatewayInterface`) which expects a `\modmore\Commerce\Gateways\Interfaces\WebhookTransactionInterface` implementation to be returned. 


