The `\modmore\Commerce\Gateways\Interfaces\WebhookTransactionInterface` interface is a specialised `\modmore\Commerce\Gateways\Interfaces\TransactionInterface` with two additional defined methods that explain how the webhook handler should respond to a notification.

Your gateway's `webhook()` method (from the [WebhookGatewayInterface](20_WebhookGatewayInterface.md)) should return an object of this type.  

If your transaction class does not implement the `WebhookTransactionInterface` interface, a generic response string `<h1>OK</h1><p>Notification received.</p>` with response code `200` will be returned to valid webhook requests.

[TOC]

## The interface

```php
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
```

