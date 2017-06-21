The Coupons module ships with the Commerce core. Enable it in Configuration > Modules. The current version of the Coupons module supports the following features:

- Fixed-price coupons which are added as discounted, uneditable items on the cart.
- Percentage-based coupons which calculate the percentage discount on all items in the cart. 
- Setting the maximum amount of uses on a unique coupon
- Setting specific timeframe during which a coupon can be used
- Enabling/disabling a coupon
- Allowing the order only for specific order totals (minimum/maximum)

Features such as limiting a coupon to specific products, multiple coupons per order, bulk creating unique coupons, or exporting a list of coupons, are not currently supported. If you're interested in those or other features, please let us know so we can properly prioritise it for a future release. 

## Coupon Management

After the Coupons module has been enabled, a new top menu item _Coupons_ will be available. From there the menu offers you three distinct views:

- **Active Coupons** shows all coupons that have an expiry date in the future, or no expiry date at all. 
- **Expired Coupons** shows coupon codes with a set expiry date that is in the past.
- **Coupon Usage** shows a chronological list of when coupon codes were used, and how much the total calculated discount was for that order. 

When viewing either of the Coupon grids, the actions dropdown on the right can be used to update coupons or to view the chronological usage specific to that coupon. 

![Screenshot of the Coupons management screen](../../../images/modules/coupons.jpg)

![Screenshot of the Coupons Usage management screen](../../../images/modules/coupons-usage.jpg)

## Cart integration

When the module is enabled, a coupon form will automatically show up on your cart. This markup is located in the default `frontend/checkout/cart/aside.twig` template. 

If you're using the provided checkout CSS, the form will be shown as a label that will be replaced with the coupon form when clicked. This uses the checkbox trick to work without javascript, and is also keyboard accessible. 

The `{{ coupons_enabled }}` placeholder will be available throughout the checkout if the coupons module is running. This can be used with a conditional like `{% if coupons_enabled %}`. 

When a coupon code has been applied, it will get added to the cart contents. 

- Fixed-price coupons are added as an uneditable cart item for the coupon total
- Percentage coupons are applied to each individual item and show up in the "total" column of the cart. 

Applied coupon information is available through the `coupon` placeholder, including the following:

- `{{ coupon.code }}`: the entered code
- `{{ coupon.discount_formatted }}`: the formatted discount price for the coupon
- `{{ coupon.discount_percentage_formatted }}`: the formatted percentage discount price. 
- `{{ coupon.available_from_formatted }}`: the date/time from when the coupon was available
- `{{ coupon.available_until_formatted }}`: the date/time until the coupon is available (expiry time)
