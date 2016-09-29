The _Thank You_ page is used as confirmation that the order was created and payment was received. It's also responsible for sending out confirmation emails, and is where you can hook into the order creation process to perform additional actions. 

If the payment failed, the thank you page shows an error to the customer. 

## Template setup

The basic code to add to your template or resource content is the following:

```` html   
[[!scFinishOrder? &redirectToOnNotFound=`[[++site_start]]`]]
````

That should be sufficient to be able of confirming orders. 

The `&redirectToOnNotFound` property will send the customer to the home page if no unfinished order was found in the users' session. You can change this to another page if you'd like. 

## Success and failure messages

To show the customer what happened with their order, you can add the `&orderSuccess` and `&orderFailed` properties to the snippet call. Here's an example of what you might add, using an inline chunk. 

```` html   
[[!scFinishOrder?
    ...
    &orderSuccess=`@INLINE:<p>Dear [[+order.firstname]] [[+order.lastname]], thanks for your order. We have send you an e-mail at [[+order.email]] with the order details.</p>`
    &orderFailed=`@INLINE:<p>Unfortunately we couldn't finish your order. Something is went wrong. Please contact us[[+order.ordernr:notempty=` and report your order number: [[+order.ordernr]]`]].</p>`
]]
````

If your message gets more complex than a single line of text, you'll most likely want to create separate chunks and just add the chunk name to the properties. 

```` html   
[[!scFinishOrder?
    ...
    &orderSuccess=`orderSuccessChunk`
    &orderFailed=`orderFailedChunk`
]]
````

## Hooks

The [scFinishOrder snippet](../../Snippets/scFinishOrder) also allows you to add hooks for completed orders. [Read more about finished order hooks here](Finished_Order_Hooks).
