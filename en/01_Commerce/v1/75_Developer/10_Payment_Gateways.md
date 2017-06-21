Commerce uses the PHP OmniPay library (v2) to integrate with payment gateways, without reinventing the wheel for every gateway individually. Commerce requires a small wrapper class, example included below, to be made aware of a payment gateway and to know what configuration to ask from the merchant when setting up the gateway.


## Example Gateway Classes

Once you've installed Commerce, you can find the source code to each gateway under `core/components/commerce/src/Gateways`. Some gateways also require some custom templates, which can be found under `core/components/commerce/templates/default/frontend/gateways` (see [Front-end Theming](../Front-end_Theming.md) for instructions on overriding those in a way that it isn't reset on every upgrade).

Here's a very basic gateway example:

```` php
<?php

namespace modmore\Commerce\Gateways;

use modmore\Commerce\Admin\Widgets\Form\PasswordField;
use modmore\Commerce\Admin\Widgets\Form\TextField;

/**
 * @package modmore\Commerce\Gateways
 */
class GatewayName extends BaseGateway {
    protected $omnipayGateway = 'Omnipay_Gateway_Reference';

    public function getGatewayProperties(\comPaymentMethod $method)
    {
        $fields = [];

        $fields[] = new TextField($this->commerce, [
            'name' => 'properties[username]',
            'label' => 'Username',
            'description' => 'The API Key username for the gateway.',
            'value' => $method->getProperty('username'),
        ]);

        $fields[] = new PasswordField($this->commerce, [
            'name' => 'properties[password]',
            'label' => 'Password',
            'description' => 'The API Key password for the gateway.',
            'value' => $method->getProperty('password'),
        ]);
        
        // ... more fields ...
        return $fields;
    }
}
````

Basically:

- Set `$omnipayGateway` to the name of the gateway that needs to be instantiated. This assumes it's already downloaded and available via an autoloader.
- Return an array of [form fields](Admin/Form_Fields) in `getGatewayProperties` that should be shown when creating a payment method with this provider.
- Note that the namespace should NOT be the modmore one, however you DO need to extend `\modmore\Commerce\Gateways\BaseGateway`. 

Additional class methods are available to override for specific use cases, for example `getPaymentForm` can be used to add gateway-specific markup to the page, and `handleNotification` can be used to catch webhook notifications.

Depending on the type of gateway, you might find the following samples interesting:

- For gateways that depend on an (async) webhook to mark an order as paid, look at the Mollie gateway. Most notably, the `handleNotification` method should be set to call the `completePurchase` method. Commerce automatically sets the webhookUrl to `assets/components/commerce/notify.php` with a transaction reference, handling finding and verifying the transaction.
- For gateways that go off-site, you don't have to do much. The PayPal gateway is a good example. 
- For gateways that need to write additional markup to the page (a custom form with javascript for example), look at Stripe, Paymill or Braintree. There's a small set of JavaScript utilities loaded automatically as `CommercePayments` that you should use to add cross-browser event listeners, onReady callbacks etc.

## Registering the gateway

It's not yet possible in v0.7 to register a custom gateway. This will be implemented using a [Module](Modules) soon.