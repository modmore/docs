SimpleCart has 2 custom plugin events. These can be used to listen to newly created orders and status changes with a standard MODX Plugin. 

## OnSimpleCartOrderCreate

This event is fired before the payment is processed during checkout, but after the order object is created. Can be used to manipulate the order before payment. 

The created order is available with `$order`, which allows you to get the products and other information from the order. 

If you need to process something when an order is paid and confirmed, you need a [Finished Order Hook](Frontend/Checkout/Finished_order_hooks). 

## OnSimpleCartOrderStatusUpdate

Fired when an admin updates the status on an order in the manager. The following variables are available with this plugin event:

- `$id` - the order ID (which is not the same as the order number)
- `$order` - the simpleCartOrder object that was updated
- `$emailed` - `true` or `false` to indicate if the merchant chose to send an email to the customer when changing the status. 
- `$status_changed` - `true` or `false` saying if the status was actually changed, or if the admin selected the same status. 
- `$status_old` - the old status string the order was in
- `$status_new` - the new status string the order was changed to 