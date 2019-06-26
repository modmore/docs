The `\modmore\Commerce\Gateways\Interfaces\TransactionInterface` defines the status of a payment at a specific point in time. The transaction itself does not perform any actions, but your `view`, `submit`, `returned` or `webhook` gateway methods may perform actions before turning the status into a `TransactionInterface` instance.

It's not to be confused with a `comTransaction`, which is the xPDO model name for a transaction. Where your `TransactionInterface` implementation is only in-memory, a current snapshot, the `comTransaction` is the persisted data.

[TOC]

## The interface

Think of a `TransactionInterface` instance as a value object that defines a current payment attempt. Most methods are geared towards indicating status. 

```php
<?php

namespace modmore\Commerce\Gateways\Interfaces;

interface TransactionInterface
{
    /**
     * Indicate if the transaction was paid
     *
     * @return bool
     */
    public function isPaid();

    /**
     * Indicate if a transaction is waiting for confirmation/cancellation/failure. This is the case when a payment
     * is handled off-site, offline, or asynchronously in another why.
     *
     * When a transaction is marked as awaiting confirmation, a special page is shown when the customer returns
     * to the checkout.
     *
     * If the payment is a redirect (@see WebhookTransactionInterface), the payment pending page will offer the
     * customer to return to the redirectUrl.
     *
     * @return bool
     */
    public function isAwaitingConfirmation();

    /**
     * Indicate if the payment has failed.
     *
     * @return bool
     * @see TransactionInterface::getExtraInformation()
     */
    public function isFailed();

    /**
     * Indicate if the payment was cancelled by the user (or possibly merchant); which is a separate scenario
     * from a payment that failed.
     *
     * @return bool
     */
    public function isCancelled();

    /**
     * If an error happened, return the error message.
     *
     * @return string
     */
    public function getErrorMessage();

    /**
     * Return the (payment providers') reference for this order. Treated as a string.
     *
     * @return string
     */
    public function getPaymentReference();

    /**
     * Return a key => value array of transaction information that should be made available to merchant users
     * in the dashboard.
     *
     * @return array
     */
    public function getExtraInformation();

    /**
     * Return an array of all (raw) transaction data, for debugging purposes.
     *
     * @return array
     */
    public function getData();
}
```

Note that there is no constructor defined; take advantage of that to define a `__construct` method that takes in a client object or API response and have the remaining methods read from that. When done correctly, you can typically use a single gateway-specific transaction object per gateway implementation. (That's the same way the `\modmore\Commerce\Gateways\Omnipay2\Transaction` object can be used for most [Omnipay-based integrations](Omnipay2Gateway).)

## ManualTransaction Example

Arguably the simplest possible example is a transaction that is always paid. Not very useful for production, but here you go. In this case the transaction reference is generated elsewhere (in the `GatewayInterface` implementation), and passed into the `ManualTransaction` to be returned in the `getPaymentReference()` method.

```php
<?php

namespace modmore\Commerce\Gateways\Manual;

use modmore\Commerce\Gateways\Interfaces\TransactionInterface;

class ManualTransaction implements TransactionInterface
{
    private $reference;

    public function __construct($reference)
    {
        $this->reference = $reference;
    }

    public function isPaid()
    {
        return true;
    }

    public function isAwaitingConfirmation()
    {
        return false;
    }

    public function isRedirect()
    {
        return false;
    }

    public function isFailed()
    {
        return false;
    }

    public function isCancelled()
    {
        return false;
    }

    public function getErrorMessage()
    {
        return '';
    }

    public function getPaymentReference()
    {
        return $this->reference;
    }

    public function getExtraInformation()
    {
        return [];
    }

    public function getData()
    {
        return [];
    }
}
```
