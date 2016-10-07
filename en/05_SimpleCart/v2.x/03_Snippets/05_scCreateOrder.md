The scCreateOrder snippet is called as FormIt hook in the [scCheckoutForm](../Chunks/scCheckoutForm) chunk. 

See [setting up the checkout](../Frontend/Checkout) for information about the available features through this (and other) snippets. 

[TOC]

## Standard Usage

See the [scCheckoutForm](../Chunks/scCheckoutForm) chunk. 

## Properties

Properties for the scCreateOrder snippet are provided to the FormIt snippet call. 

### fields

### submitVar

Default: `checkout`, provided as `doOrder` in the standard chunk.

The POST parameter that needs to be present for the snippet to do its thing.

### deliveryKey

Default: `deliveryMethod`

The name of a POST parameter that contains the ID of the chosen delivery method. 

### paymentKey

Default: `paymentMethod`

The name of a POST parameter that contains the ID of the chosen payment method. 

### orderAddress

[See Order & Delivery Addresses](../Frontend/Checkout/Order_and_Delivery_Addresses).

### deliverAddress

[See Order & Delivery Addresses](../Frontend/Checkout/Order_and_Delivery_Addresses).

### excludeFields

[See Custom Order Fields](../Frontend/Checkout/Custom_Order_Fields).

