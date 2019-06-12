> Important: the gateway classes described here have been replaced in Commerce 1.1 with new interfaces and classes, that removes the strict dependence on Omnipay 2. 
> 
> [Read more about building Gateways for Commerce 1.1+](Payment_Gateways/index)


Commerce uses the PHP OmniPay library (v2) to integrate with payment gateways, without reinventing the wheel for every gateway individually. Commerce requires a small wrapper class, example included below, to be made aware of a payment gateway and to know what configuration to ask from the merchant when setting up the gateway.

Note the difference between a Payment Gateway (discussed here, the code that handles talking to payment providers) and [Payment Methods](../Payment_Methods) (admin-configured instances of a gateway, each with their own configuration). Technically speaking, gateways are an instance of `\modmore\Commerce\Gateways\BaseGateway`, while payment methods are xPDO objects of type `\comPaymentMethod`. 

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

To tell Commerce about your gateway, you will need to create a [Module](Modules). In this module you will provide the class name and the label to show for it in the back-end. 

(Note: this requires at least Commerce v0.10.)

Here's an example module that loads a "MultiSafePay" gateway. 

```` php
<?php

namespace modmore\Commerce\Modules\Gateways;

use modmore\Commerce\Events\Gateways;
use modmore\Commerce\Modules\BaseModule;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GatewayName extends BaseModule
{
    public function getName()
    {
        return 'GatewayName';
    }

    public function getAuthor()
    {
        return 'My Name';
    }

    public function getDescription()
    {
        return 'Description of GatewayName';
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        // Listen to the event
        $dispatcher->addListener(\Commerce::EVENT_GET_PAYMENT_GATEWAYS, array($this, 'registerGateways'));
        
        // Also include your autoloader, or do a `require_once` to make your gateway class available in memory
        // While you could also do it at the top of the module file, doing it in the initialize method
        // allows finer control over when it is included.
    }

    public function registerGateways(Gateways $event)
    {
        // Add the GatewayName gateway, and log an error if the class couldn't be found.
        if (!$event->addGateway('modmore\Commerce\Gateways\GatewayName', 'GatewayName')) {
            $this->adapter->log(1, 'Could not add GatewayName - the class was probably not found');
        }
    }
}

````

[Learn more about modules here](Modules).

**Important: the module's registerGateways method will only run when an admin user adds or edits a payment method**. 

After the gateway is selected, the class name is stored on the payment method, and Commerce will load that gateway class when showing payment methods to the customer. That's why you need to include the logic to load your gateway class (which can be an autoloader, like Composer, or a simple `require_once` call) in your `initialize()` method, and not in the `registerGateways` method. 

Also, you should not be using the `modmore\Commerce\Gateways` namespace in custom code, to prevent future conflicts. Make it `YourCompany\CommerceGatewayName` or something instead. 
