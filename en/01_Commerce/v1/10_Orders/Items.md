Order items are pretty self-explanatory. When adding a product to the cart, that is turned into an order item which holds a copy of the product information at that time (sku, name, price, etc) as well as the whole calculation of an item including extra fees, discounts, and taxes.

This document will go into some specifics of the item representation and the calculation, which is useful background when customising the cart templates or looking to import/export order data. 

[TOC]

## Catalog links

When using a resource product, the item link is automatically set to the associated resource. The same is true when using a product matrix.

For catalogs using the Product List TV, that relation is not automatically available. To still allow your cart to link back to the appropriate place:

1. Add a hidden input to your add to cart form with a name of `link` and the resource ID to link to as the value. For example: `<input type="hidden" name="link" value="[[*id]]">` or in getResources/pdoResources template chunks: `<input type="hidden" name="link" value="[[+id]]">` 
2. Enable the **ItemData** module, and add `link` to its list of allowed fields. The module will now add the 

Make sure to repeat step 1 for any add to cart form you have, which may include quick add to cart forms on category pages or upsell/related product blocks.

## Calculation

How hard can calculating an item price be? Well, when you factor in sales, discounts, extra fees, and taxes, it starts getting more confusing.

The calculating of a specific item is performed in the following order:

1. First, the per-item `price` is determined. [Based on configured Price Types](../Products/Price_Types) the price may already be one thing or another based on currencies, available sales, item quantity, logged-in user, etc. If you're using a custom add-to-cart script that enables `is_manual_price`, this is skipped.

2. The `price` is multiplied by the `quantity` which gives the `subtotal_before_extra`. This is sort of the "raw" subtotal based on the current going rate for the product. 

3. Any extra price adjustments are calculated and added. The total extra fees are saved to `extra`, and the subtotal including extra fees is saved to the `subtotal` value. 

4. While not used by the core and not recommended, items may have an integer `shipping` value that is now added to the subtotal. Implementing this would require an extension to provide an extended comOrderItem object that extends `getShipping` - not recommended.

5. The discount for an item is now calculated by loading all discount price adjustments. Coupons and user(group) discounts for example will set these adjustments. The total discount is set to the `discount` field. Note that discounts coming from a price type (eg sale or quantity prices) are not reflected in the discount.

6. The `total_before_tax` field is set to the `subtotal` (see #3) plus `shipping` (see #4) minus `discount` (see #5). This field holds the "true subtotal", and is best to use for display, because it is what the customer will have to pay for this item before any taxes are applied. 

7. Next, we'll calculate taxes. The actual inner workings of that with tax rates and rows is worth a closer look some other day, but what you need to know is that `comOrderItemTax` records will be created and/or updated and/or removed to ensure each unique tax rate applied to an item is properly accounted for, with its percentage, wether the before price was inclusive/exclusive, the taxed amount, and the total `tax_amount` that results in. Typically, each item has a single `comOrderItemTax` but it may be 0 if you don't have tax rules configured, or more than 1 if you use a tax integration that provides a breakdown of country/state taxes.

8. The total of the final `comOrderItemTax` records is calculated, and saved to the `tax` column. 

9. 
    1. If taxes are **exclusive** (taxes are added to the product price), the `total_ex_tax` is now set to the same value as `total_before_tax`. 
    2. If taxes are **inclusive** (taxes are already included in the product price), `total_ex_tax` is set to `total_before_tax` minus `tax`. 
    
10. The `total` is set to `total_ex_tax` + `tax`. 

When rendering any of these fields in the front-end, remember suffixing `_formatted` (e.g. `total_formatted`) will render the price according to the currency configuration used for the order. 

All calculations happen with whole numbers (integers) representing the smallest denominator per the number of subunits configured on the currency. If any step of the calculation results in a floating value (especially in taxes or percentage adjustments), it is rounded ["half up"](https://www.php.net/manual/en/function.round.php) meaning 3.45 becomes 3, but 3.55 becomes 4. 

For the vast majority of currencies (but not all!) the integer value stored in a field represents a cent, or 1/100th of the currency single value. 

## Price Adjustments

Price adjustments are created by modules and indicate a change to the **subtotal** (`subtotal_before_extra`, technically speaking). 

There are 2 types of adjustments.

- The **Extra** price adjustment means a surcharge is added to the item. These are non-optional (the user can't opt out or remove them from the cart) extra fees. For example a mandatory insurance or gift wrapping (with some other way to add/remove it) would be a great use case for this. This is represented by the `comOrderItemDiscountAdjustment` class internally.

- The **Discount** price adjustment indicates a reduction in price, for example because the customer entered a coupon code or another discount was applied. 

**Important: discounts that come from a Price Type are NOT reflected with a price adjustment.** Those are applied instead directly to the price field before the rest of the calculation takes place. 

### Price change options

Regardless of the type of price change, the adjustment can be created to be calculated in one of the following ways:

1. A fixed-price adjustment regardless of the quantity has an integer `price_change` and `price_change_per_quantity` is disabled (default).
2. A fixed-price adjustment that is multiplied by the quantity has an integer `price_change` and `price_change_per_quantity` is enabled.
3. A percentage adjustment is set with a float `price_change_percentage`. 

(Prior to 1.2.0-rc3, only the first option was available and the module setting the price adjustment had to account for quantity or percentages.)