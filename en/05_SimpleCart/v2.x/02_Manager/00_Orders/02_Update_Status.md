Right click on an order and choose _Update Order Status_ to change the status of the order, optionally sending the customer an email notification. 

This can be useful with [custom order statuses](../Administration/Order_Statuses) (which may also have a default message) for marking na order as shipped or refunded. 

[ ![Update order status window](https://assets.modmore.com/uploads/2015/12/orders_update_status.png)](https://assets.modmore.com/uploads/2015/12/orders_update_status.png "Update order status window")

Within this window you're able to select the new status which should be applied to the selected order. You can also keep the same status, and just use this to email the customer. 

## Email customer

If you'd like to notify the customer, keep this checkbox ticked. For internal workflow purposes you may not want to send an email, so unchecking it makes sense there. 

## Ignore status check

If you only want to send an email without actually changing the status, you will need to tick this box. Otherwise SimpleCart will see the status did not in fact change, and it will not send the notification. 

## The update message

The message that you can fill in for the customer is a custom personalized message. This message can be used to send more details about the change to your customer. To make it more personal, you can use order placeholders. 

## Email chunk

The customer email is wrapped in a chunk. By default the chunk "scEmailOrderStatusUpdate" is used, but you can duplicate it to apply your own changes to it.

To use your custom chunk for this email, change the `simplecart.orderstatusupdate_emailtpl` system setting, providing it your chunk name.

## Default email example markup


```` html   
<p>[[%simplecart.email.salutation]]</p>
<p>[[%simplecart.email.orderupdated]]</p>

[[+status_changed:notempty=`<p>[[%simplecart.email.statuschanged]]</p>`]]

[[+message:notempty=`<p>[[+message:nl2br]]</p>`]]

<p>[[%simplecart.email.closure]]</p>
<p>[[%simplecart.email.regards]]</p>
````   
