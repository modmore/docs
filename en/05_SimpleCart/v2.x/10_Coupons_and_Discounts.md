SimpleCart 2.5 introduces more control over the way discounts and fixed price coupons are handled. 

By default, coupon codes are considered discounts. The value of coupon codes is added to the discounts total and reduced the price that way.

It's also possible to configure SimpleCart to treat fixed-price coupon codes as **credit**. This changes how the price reduction is applied to an order, also in regards to taxes.

## Default Situation

By default (including before 2.5), coupon codes are considered a discount. Discounts are calculated, and the total is reduced, **before taxes are calculated**. 

## Coupons as Credit

When setting the `simplecart.fixed_price_coupons_are_discounts` system setting to no, fixed-price coupons will be treated as pre-paid credit. Discounts are still calculated before the tax, but the coupon discount is applied after the taxes are added.

In this case the coupon is basically treated like a (partial) payment

## Discounts and Coupons

By default, you can't use coupons and other discounts (sale prices, user(group) discounts) together. Set `simplecart.allow_discounts_and_coupons` to yes to allow both coupons and other discounts at the same time.
