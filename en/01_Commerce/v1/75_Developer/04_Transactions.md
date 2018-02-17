The `comTransaction` object contains information about payments that are made to or from your shop (refunds). 

This includes **all payment attempts**, so not just completed transactions, but also new transactions that may still be processing, failed, or that are prepared for the customer to complete or authorise off-site.

The transaction object contains the following fields/properties available via `$transaction->get()` and `$transaction->toArray()`.

- `test`: `true` or `false` depending on if this was a transaction is test mode.

- `order`: the ID of the order this transaction was for. Use `$transaction->getOrder()` to easily get the order object.

- `status`: the status of the transaction. Can be one of `comTransaction::STATUS_UNKNOWN`, `comTransaction::STATUS_FAILED`, `comTransaction::STATUS_CANCELLED`, `comTransaction::STATUS_NEW`, `comTransaction::STATUS_PROCESSING` or `comTransaction::STATUS_COMPLETED`.

- `method`: the ID of the payment method that was/will be used for the transaction. Use `$transaction->getMethod()` to return the `comPaymentMethod` object.

- `reference`: the (gateway-)unique reference for the transaction. Depending on the gateway this may be available after completing the payment, or before a redirect/charge.

- `amount`: the amount (in cents) which was paid (or paid out in case of a negative value) for this order. `amount_formatted` contains a formatted value.

- `fee`: the amount (in cents) that was added to the order in the transaction column for using the chosen payment method, as defined by the payment method configuration.

- `created_on`: a UNIX timestamp containing when the transaction was created. `created_on_formatted` contains a formatted value.

- `completed_on`: a UNIX timestamp containing when the transaction was set to status `comTransaction::STATUS_COMPLETED`. `completed_on_formatted` contains a formatted value.

Transactions are created by the `comPaymentMethod` object in `$method->initiateTransaction(comOrder $order, $amount)` where the amount defaults to the total amount due. If the call was successful that will return the transaction object.

The transaction fees are added to the order if the transaction status is `STATUS_NEW` or higher (`comTransaction::STATUS_PROCESSING`, `comTransaction::STATUS_COMPLETED`). For that reason, it's important for payment methods/gateway implementations to properly mark a transaction as failed or cancelled if that happened. That way, customers are not charged double if they initiate another transaction.
