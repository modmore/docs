The scAddProduct snippet is used for the [cart](../Frontend/Cart). It handles a form submission from a [product page](../Frontend/Products/Template_Setup) or [category page](../Frontend/Categories/Template_Setup).

[TOC]

## Standard Usage

````
[[!scAddProduct]]
````

## Properties

The following properties are available. 

### submitVar

Default: `addcart`

The name of a POST parameter that triggers the snippet to process the cart. 

### productIdVar

Default: `productid`

The name of a POST parameter that holds the product ID that needs to be added to the cart.

### quantityVar

Default: `quantity`

The name of a POST parameter that holds the quantity to be added. 

### multipleVar

Default: `products`

The name of a POST parameter for when multiple products are added in the same submit. 

### redirectTo

Default: none

Contains the ID of a resource to redirect the user to. Typically, this would be your cart page so the user is redirected to the cart after adding a product to it. 

### redirectScheme

Default: `http`

The scheme for generating the URL to a resource in `&redirectTo`. 

### clearOnAdd

Default: `0`

When set to `1`, the cart will be emptied before adding the product. This way only a single product is in the cart at one time. 

### optionKeyPrefix

Default: `simplecart_option_`

The prefix for [product options](../Frontend/Products/Options) submitted with the product. 
