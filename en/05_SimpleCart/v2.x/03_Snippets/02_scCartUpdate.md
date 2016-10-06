The scCartUpdate snippet is used in the [scCart Chunk](../Chunks/scCart) and handles making changes to the cart, such as changing the quantity or removing a product from the cart completely. For adding products to the cart the [scAddProduct snippet](scAddProduct) is used. 

[TOC]

## Standard Usage

````
[[!scCartUpdate]]
````

## Properties

The following properties are available on the snippet. 

### submitVar

Default: `updatecart`

The name of a POST parameter that needs to be present for the snippet to execute and update the cart.

### quantityVar

Default: `quantity`

The name of a POST parameter that contains the (updated) number of items for a product.

### removeVar

Default: `remove`

The name of a POST parameter that indicates the product should be removed from the cart.

### redirectTo

Default: none

The ID of a resource to redirect to after the cart is updated. Typically not set, so the cart redirects back to itself.

### redirectScheme

Default: http

The scheme to use when generating the link to the resource specified in `&redirectTo`.
