Commerce supports a [number of built-in and third party payment method](../../Payment_Methods). This section of the developer documentation explains how you can build your own payment gateways.

> Note: this documentation deals with **Commerce 1.1+**; in 1.0 and before a [different implementation is needed](../Payment_Gateways). At the moment, both the 1.0 (recognised by the usage of the "BaseGateway") and 1.1 (recognised by "GatewayInterface" or "Omnipay2Gateway") solutions are supported, but it is strongly encouraged to [upgrade to the new interfaces](Migrate_BaseGateway_to_Omnipay2Gateway).

On this page you'll find a high-level overview of the different interfaces and classes that are involved with payment gateways. You'll need a `GatewayInterface` implementation and at least one `TransactionInterface` implementation. 

[TOC]

## High-level overview

Gateways consists of Gateway instances, and related Transaction instances. 

Various interfaces are available that determine available functionality on a given gateway or transaction, and as developer you get to choose which one(s) to support depending on both user and technical requirements. Commerce automatically infers available functions based on the implemented interfaces.

### Gateways

In Commerce, payment gateways implement the `\modmore\Commerce\Gateways\Interfaces\GatewayInterface` interface, which provides the following contract:

- `public function view(comOrder $order): string`
- `public function submit(comTransaction $transaction, array $data): TransactionInterface`
- `public function returned(comTransaction $transaction, array $data): TransactionInterface`
- `public function getGatewayProperties(comPaymentMethod $method): Field[]`

The `submit` and `returned` methods need to return an instance of the [TransactionInterface](TransactionInterface).

[More about the GatewayInterface >](GatewayInterface)

For gateways that take server-to-server webhook notifications for payment confirmations, the `\modmore\Commerce\Gateways\Interfaces\WebhookGatewayInterface` interface adds the following method:

- `public function webhook(\comTransaction $transaction, array $data): TransactionInterface`

The `webhook` method needs to return an instance of the [WebhookTransactionInterface](WebhookTransactionInterface).

[More about the WebhookGatewayInterface >](WebhookGatewayInterface)

For gateways that require server-to-server webhook notifications, but which do not support unique URLs per transaction but rather have a single configurable webhook URL, the `\modmore\Commerce\Gateways\Interfaces\SharedWebhookGatewayInterface` interface adds:

- `public function identifyWebhookTransaction();`

The `identifyWebhookTransaction` method returns a `\comTransaction` instance - notably **not** a `TransactionInterface` implementation.

[More about the SharedWebhookGatewayInterface >](SharedWebhookGatewayInterface)

### Transactions

The `\modmore\Commerce\Gateways\Interfaces\TransactionInterface` interface defines a payment attempt, making it clear what is/has happened with the attempt. It defines the following methods:

- `public function isPaid(): bool`
- `public function isAwaitingConfirmation(): bool`
- `public function isFailed(): bool`
- `public function isCancelled(): bool`
- `public function getErrorMessage(): string`
- `public function getPaymentReference(): string`
- `public function getExtraInformation(): array`
- `public function getData(): array`

[More about the TransactionInterface >](TransactionInterface)

For transactions that (may) cause an off-site redirect, the `\modmore\Commerce\Gateways\Interfaces\RedirectTransactionInterface` interface adds the following methods:

- `public function isRedirect(): bool`
- `public function getRedirectMethod(): string` (either `GET` or `POST)
- `public function getRedirectUrl(): string` 
- `public function getRedirectData(): array` 

[More about the RedirectTransactionInterface >](RedirectTransactionInterface)

For transactions that (may) receive updates via a webhook, the `\modmore\Commerce\Gateways\Interfaces\WebhookTransactionInterface` interface adds the following methods to determine how to respond to webhook requests:

- `public function getWebhookResponse(): string`
- `public function getWebhookResponseCode(): int`

To support both off-site redirects and webhooks, make sure to implement both interfaces. Also note that Commerce checks the **implemented interfaces**, and not if methods are present, so always include the proper interfaces in the class definition.

## Registering a Gateway

To tell Commerce about your gateway, you will need to create a [Module](../Modules). In this module you will provide the class name and the label to show for it in the back-end. 

Here's an example module that loads a gateway. 

```` php
<?php

namespace ThirdParty\MyGateway\Modules;

use modmore\Commerce\Events\Gateways;
use modmore\Commerce\Modules\BaseModule;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

class MyGateway extends BaseModule
{
    public function getName()
    {
        return 'MyGateway';
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
        if (!$event->addGateway(\ThirdParty\MyGateway\Gateways\GatewayName::class, 'GatewayName')) {
            $this->adapter->log(1, 'Could not add GatewayName - the class was probably not found');
        }
    }
}
````

[Learn more about modules here](../Modules) and [start here if you haven't built a module before](../Guides/Bootstrapping_a_Module).

**Important: the module's registerGateways method will only run when an admin user adds or edits a payment method**, so don't use that to initiate gateway state. 

After the gateway is selected, the class name is stored on the payment method, and Commerce will load that gateway class when showing payment methods to the customer. That's why you need to include the logic to load your gateway class (which can be an autoloader, like Composer, or a simple `require_once` call) in your `initialize()` method, and not in the `registerGateways` method. In the example module above, the composer autoloader is required which will know about the gateway class. 

**Do not** use the `modmore\Commerce\Gateways` namespace in custom gateways, or extend directly from core-provided gateways, to prevent future conflicts or breaking changes.

## GatewayHelper

The [GatewayHelper](GatewayHelper) class contains useful (static) utility methods for gateways. Most notably, you should use it to generate (customer) return/cancel and (webhook) notification URLs, and the transaction description. 

## Omnipay2Gateway

Looking to build an integration for which a suitable Omnipay driver is available? The [Omnipay2Gateway abstract class](Omnipay2Gateway) implements immediately confirmed and redirect transactions. 

## Pre-1.1: BaseGateway

Prior to Commerce 1.1, all gateways extended from a `BaseGateway`, providing the protected `$omnipayGateway` property to indicate an Omnipay 2 driver to use. As of Commerce 1.1, Omnipay is no longer a requirement, and has been replaced with the above interfaces instead. 

If you're familiar with how Omnipay works, you may recognise the general concept of splitting up the logic between gateways (`AbstractGateway` in Omnipay, `GatewayInterface` in Commerce) and transactions (`AbstractRequest`/`AbstractResponse` in Omnipay, `TransactionInterface` in Commerce). 

The biggest difference is that Omnipay gateways are focused on the payment provider interactions (i.e. `purchase()` to start a payment and `completePurchase()` to finish it). They typically don't generate forms or JS implementations (tokenisation) and not all drivers are quite as consistent in naming or when certain methods should (or should not) be used. While immensely useful when it works, it can also get in the way of using more powerful provider-specific functionality. 

The Commerce interfaces are more geared around the different touch points for transactions. These are viewing the payment method selection page (`view()`), choosing the method (`submit()`), returning from an off-site gateway or checking the status (`returned()`), and optionally receiving a webhook notification (`webhook()`). The latter 3 return `TransactionInterface` implementations that contain information about the current payment status.
 
To migrate a pre-1.1 gateway (`... extends BaseGateway`) to the new classes, see [Migrate BaseGateway to Omnipay2Gateway](Migrate_BaseGateway_to_Omnipay2Gateway).
