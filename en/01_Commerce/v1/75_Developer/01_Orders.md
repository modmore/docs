An Order is a cart that has gone through the checkout.

[TOC]

## States of Orders

Orders always are a comOrder derivative, depending on the distinct state it is in. When an order changes state, it also changes the class it is in. The current state of an order is available via `$order->getState()`, which returns one of the `comOrder::STATE_* constants`.

Note that **a state is not the same as a status**. States contain the back-end logic (e.g. loading an order from a cart object, or marking it as completed), while a [Status ](../Statuses)is defined in the Commerce component as a store-specific workflow/business process.

These are the available order types, discussed in more detail below.

- `comCartOrder`: temporary order state, typically only while the cart is being turned into an order. Orders created manually via the Commerce back-end are also created in this state, until it is confirmed.
State: `comOrder::STATE_NEW`
Methods: `$order->fromCart(comCart $cart)`, `$order->fromOrder(comOrder $order, $credit = false)` and `$order->markProcessing()`

- `comProcessingOrder`: state for orders that have been placed by the user (or an admin via the Commerce back-end), but still needs to be processed. Processing includes accepting payment and shipping/delivery of the purchase. Most statuses are applied to the processing state.
State: `comOrder::STATE_PROCESSING`
Methods: `$order->markComplete()` and `$order->markCancelled()`

- `comCompletedOrder`: state for completed orders. Completed orders are read only (i.e. no changes to items or payments are allowed). The `markCancelled` method actually creates a new credit order.
State: `comOrder::STATE_COMPLETED`
Methods: `$order->markCancelled()`

- `comCancelledOrder`: state for orders that were cancelled **prior to processing**. Note that the Cancelled state does not determine wether an order was refunded, that is handled through transactions.
State: `comOrder::STATE_CANCELLED`
Methods: none.

These states are effectively hard-coded, but can be extended. Just create a new class that extends one of the above classes, and update the relevant setting (`commerce.classes.STATE_order`) to make sure it's used on new orders. If you need existing orders to also be an instance of that particular class, update the `class_key` values in the orders table. Often though there will be easier ways to accomplish what you're thinking of right now.

### comOrder
The base class is not to be used directly for orders (other than querying) - always use one of the stateful derivatives.

The `comOrder` class contains a bunch of helpful methods that can be used on any of the derivatives.

- `getItems ($loadFromCache = true, $updateCache = true)` - returns an array of `comOrderItem` instances that belong to the order. The result is cached (both in memory and persisted to the file cache), but by passing `$loadFromCache` as false that can be bypassed.

- `addItem (comOrderItem $orderItem)` - to add an item to the order, call this method. Don't use addOne/addMany.

- `addAddress (comOrderAddress $address)` - used to add an address to the order. Don't use addOne/addMany.

- `addTransaction (comOrderTransaction $transaction)` - used to add a transaction to the order. Don't use addOne/addMany.

- `[protected] setStatus($status)` - updates the status (not the state) on the order.

- `isPaid()` - checks if the order has a balance of zero. This means that orders where the customer is due for a refund is **not** considered paid to this method, as the balance would be negative.

- `isComplete()` - checks if each of the items in the order was marked as complete.

- `getState()` - returns one of `comOrder::STATE_NEW`, `comOrder::STATE_PROCESSING`, `comOrder::STATE_COMPLETED`, `comOrder::STATE_CANCELLED` or `comOrder::STATE_UNKNOWN`.

- `getDescendants()` - returns an array of comOrder objects that are descendants to the current object. Descendants are added when using `comCartOrder::fromOrder(comOrder $order, $credit = false)` to create a copy of an order. Descendants should only be used for orders directly related to one, for example for returns or refunds.

- `getParentOrder()` - if the current order is a descendant, this method will return the comOrder object of the parent.

These methods are available on derivative order classes.

### comCartOrder

The comCartOrder class is used as temporary object that deals with setting up the order to be ready for processing.

In the front-end checkout flow, the `$order->fromCart(comCart $cart)` method is used to turn the Cart object into an Order. The order basically copies the items from the cart. When that is done, the order is marked ready for processing with `$order->markProcessing()`. This happens within the same process, so an order doesn't spend much time in this stage.

When an admin creates a new order from the back-end component, it is also in the `comCartOrder` state/class. In this state, the admin can prepare a customer order, while the customer is not yet notified or able of seeing the order. When it is ready to go, hitting the place order button in the back-end will also call `$order->markProcessing()` to change it to the comProcessingOrder state. In this scenario, orders spend more time in the new state.

`$order->markProcessing()` checks if the order has at least one item associated with it. If it does, it updates the state and returns a `comProcessingOrder` object. If there are no items yet, the order does not change.

There is also the `$order->fromOrder(comOrder $order, $credit = false)` method which will create a copy of the order. When `$credit` is passed as true, it will negate the original order items as means of cancelling out the earlier order. Useful for refunds, also see `comCompletedOrder` below.

### comProcessingOrder
The `comProcessingOrder` state basically means the order needs to be handled. This handling can be by either the customer (the order needs to be paid), or the store (preparing the order for shipping), or both. The order states don't care about who needs to do it; instead [statuses](../Statuses) determine how things move along within the Processing state.

The primary function of the comProcessingOrder class is to call `$order->markComplete()`. When called, the order checks if it has a balance of zero and if all items in the order are marked as complete. If those conditions are met, the method updates the state and returns a new `comCompletedOrder` instance. If those conditions aren't true, the same order is returned.

It is also possible to cancel a processing order with `$order->markCancelled()`.

### comCompletedOrder
The `comCompletedOrder` is a read-only object. It is not possible to add new items or transactions to a completed order.

To make changes to a completed order (e.g. to process returns/refunds), the `$order->markCancelled()` method creates a new order object with the `comCartOrder`'s `fromOrder()` method. The newly created order that the method returns will have all items from the completed order, but then credited. So a purchase for one item will appear as minus one on the new order. Orders related to a completed order are available in an array from comOrder's `$order->getDescendantOrders()`.

### comCancelledOrder
Orders that were cancelled before processing happened.

## Order Origin (v1.3+)

New in Commerce v1.3 is the `origin` field on an order, which takes a value of `manual`, `checkout`, or `subscription`. This can be used to identify how an order was first created.
