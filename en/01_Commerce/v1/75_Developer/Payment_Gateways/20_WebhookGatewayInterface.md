The WebhookGatewayInterface should be implemented by gateways that (may) accept webhook notifications outside the customer checkout flow.

[TOC]

## The interface

````php
<?php

namespace modmore\Commerce\Gateways\Interfaces;

use modmore\Commerce\Gateways\TransactionException;

interface WebhookGatewayInterface extends GatewayInterface {
    /**
     * Handle an incoming webhook. Webhook URLs, and fetching the transaction in the webhook, happen transparently.
     *
     * $data contains unfiltered information from $_REQUEST.
     *
     * @param \comTransaction $transaction
     * @param array $data
     * @return WebhookTransactionInterface
     * @throws TransactionException
     */
    public function webhook(\comTransaction $transaction, array $data);
}
````

The `webhook()` method must return a `WebhookTransactionInterface` implementation (rather than the more basic `TransactionInterface` or `RedirectTransactionInterface`), which tells the webhook process how to respond to a notification.


````php
<?php

namespace modmore\Commerce\Gateways\Interfaces;

interface WebhookTransactionInterface extends TransactionInterface
{
    /**
     * Return the response that the webhook needs. Whether that indicates success or failure depends on the
     * transaction and the required logic, and typically relies on the webhook being handled or not.
     *
     * @return string
     */
    public function getWebhookResponse();

    /**
     * Return the integer response code (e.g. 200, 404) to use in the response to the webhook.
     *
     * @return int
     */
    public function getWebhookResponseCode();
}
````
