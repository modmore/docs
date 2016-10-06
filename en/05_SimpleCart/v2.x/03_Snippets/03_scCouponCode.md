The scCouponCode snippet is used in the [scCart Chunk](../Chunks/scCart) and handles validating and showing a coupon code that has been applied. 

[TOC]

## Standard Usage

````
[[!scCouponCode]]
````

## Properties

### submitVar

Default: `couponcode`

The name of a POST parameter that needs to be present for the snippet to validate a coupon code. 

### actionKey

Default: `coupon`

The key of a URL parameter. When its value is `remove`, the applied coupon code will be removed from the cart. The actionKey may also have a value that indicates an error (`notexists`, `totaltoolow`, `expired` or `failed`) in which case an error is available in the formTpl. 

### formTpl

Default: `scCouponForm`

The name of a chunk to use as the form for the coupons. This form allows the user to enter and validate a coupon code. [See the default scCouponForm Chunk](../Chunks/scCouponForm).
available placehold

The available placeholders in this chunk are:

- `[[+coupon.error.activate]]`: contains a (translated) error message for when there was an issue with validating the coupon code. 


### resultTpl

Default: `scCouponResult`

The name of a chunk that shows a valid, applied coupon code. [See the default scCouponResult Chunk](../Chunks/scCouponResult). 

The available placeholders in this chunk are:

- `[[+coupon.actionKey]]`: the value of the &actionKey property, which is used for creating a remove link for the coupon code.
- `[[+coupon.code]]`: the coupon code itself. 
- `[[+coupon.expires]]`: a unix time stamp for when the applied coupon code is set to expire. 
- `[[+coupon.discount]]`: the discount attributed to the cart by the coupon code. 
- `[[+coupon.discount_formatted]]`: the formatted value of the applied discount. 
- `[[+coupon.percent]]`: the discount as a percentage of the cart total.

### redirectTo

A resource ID to redirect the user to after applying a coupon code. Leave empty to redirect back to the cart. 

### redirectScheme

Default: `http`

The scheme to use when generating the URL for the redirectTo resource. 

### placeholderPrefix

Default: `coupon.`

A prefix for the placeholders set by this snippet. 

### outputSeparator

Default: `\n` (linebreak)