The scFinishOrder snippet is used on the [Thank You Page](../Frontend/Checkout/Thank_You). It is responsible for making orders are complete when the customer returns from the payment method. 

[TOC]

## Standard Usage

````
[[!scFinishOrder]]
````

## Properties

The following properties are available on the snippet. The email related properties should be configured in the [email section of the SimpleCart backend](../Manager/Administration/Emails), but can be overridden on the snippet if needed. 

### preHooks

A comma separated list of hooks to execute before the order is marked as finished. See [Finished Order Hooks](../Frontend/Checkout/Finished_Order_Hooks).

### postHooks

A comma separated list of hooks to execute after the order is marked as finished. See [Finished Order Hooks](../Frontend/Checkout/Finished_Order_Hooks).

### failHooks

A comma separated list of hooks to execute when a payment failed. See [Finished Order Hooks](../Frontend/Checkout/Finished_Order_Hooks).

### redirectToOnNotFound

Default: the `site_start` setting value

A resource ID to redirect the user to if the order could not be found based on the session, or could not be found.

### orderSuccess

Name of a chunk, or `@INLINE:` or `@FILE:` prefixed value that's used as an inline chunk, or file that's loaded. This will be shown when the order was created and paid properly. [Read more](../Frontend/Checkout/Thank_You).

### orderFailed

Name of a chunk, or `@INLINE:` or `@FILE:` prefixed value that's used as an inline chunk, or file that's loaded. This will be shown when the order was created and paid properly. [Read more](../Frontend/Checkout/Thank_You).

### orderPending

Name of a chunk, or `@INLINE:` or `@FILE:` prefixed value for an inline chunk or file, which will be shown when an asynchronous payment is still pending confirmation. Defaults to the `scFinishOrderPending` chunk, which automatically refreshes the page every 5 seconds. 

### placeholderPrefix

Default: `order.`
