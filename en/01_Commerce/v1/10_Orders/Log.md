Commerce automatically logs important events related to an order to the Order Log. This log can be found by going to Commerce > Orders and on the overview page for an order browsing to the _Log_ tab. 

It's important to note that the order log only starts collecting once the order is persisted to the database. If you're using a session-based order object for the cart, that means the log wont start filling up until someone heads to the checkout, and their session-bsaed order is converted into a database object.

## Logged Actions

Among others, the following will be logged:

- Status changes
- When the order was created
- Selecting guest checkout
- [Order Messages](Messages) being sent
- Adding/changing quantity/removing items in the cart (if the order has been persisted to the database)
- Selecting a shipping method
- Initiating a transaction for a specific payment method, as well as when a transaction fails, is cancelled, or the payment is confirmed.

## Public Logs

Most log entries are private, meaning they're mostly for debugging or analysis purposes for the merchant. Logs that may also be important for the customer are marked as public, which can be used to show the customer a filtered log.

