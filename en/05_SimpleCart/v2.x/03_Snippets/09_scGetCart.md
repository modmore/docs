The scGetCart snippet is used for the [Cart page](../Frontend/Cart). It lists the cart contents through various chunk templates. 

The primary chunk used by scGetCart is the [scCart chunk](../Chunks/scCart) which contains calls to other snippets, like [scCartUpdate](scCartUpdate), [scCouponCode](scCouponCode) and [scDeliveryMethods](scDeliveryMethods). 

[TOC]

## Standard Usage

````
[[!scGetCart]]
````

## Properties

Most properties for the scGetCart snippet relate to the chunks used. These can be 

### tpl

Default: [scCart](../Chunks/scCart)

The name for a chunk used for the entire cart (wrapper). 

### vatRowTpl

Default: [scCartVatRow](../Chunks/scCartVatRow)

### rowTpl

Default: [scCartRow](../Chunks/scCartRow)

### rowOptionTpl

Default: [scCartRowOptions](../Chunks/scCartRowOptions)

### rowFieldTpl

Default: [scCartRowField](../Chunks/scCartRowField)

### freeProductTpl

Default: [scCartRow](../Chunks/scCartRow)

### emptyTpl

Default: [scCartRow](../Chunks/scCartRow)

### outputSeparator

Default: `\n`

### viewProducts

Default: `true`

Set to `0` to not load the different products. Useful for [mini carts](../Tutorials/Small_Cart_View) that need to be as performant as possible. 

### includeTVs

Default: `true`

When enabled the snippet will load TVs for the product resources so you can access those in the row template. 

### includeTVList

When a comma separated list is specified, only those TVs will be loaded with includeTVs enabled. 

### processTVs

Default: `true`

when enabled the snippet will process TVs before assuming its value. Useful for certain TV types or values, like images. 

### processTVList

A comma separated list of TV names that need to be processed. 

### startIdx

Default: `1`

The start of the idx placeholder. 
