The **commerce.render_taxed_price** snippet will render a products' price taking into account the customers' (expected) address, taxes, and global discounts.

If you only need a rendered product price, the `price_rendered` placeholder available on all products is typically sufficient. The render_taxed_price snippet would be used, for example, when you manage product prices exclusive of taxes, but need to show the price inclusive of taxes on the website.

Added in Commerce 1.0.0-rc4.

[TOC]

## Pre-amble

The `render_taxed_price` snippet loads the current order and prepares an order item for the provided product to ensure the calculation is exactly the same as it would be in the cart.

The snippet does not actually _add the product to the order_ however, so certain discounts/price types may not be 100% the same, especially things like quantity-pricing (see [render_quantity_price](render_quantity_price)) or restrictions based on order totals.

Because it does a lot of calculations and affects performance, we don't recommend using this in product listing pages, but only on the detail pages. If you do use it on product listings, it might be worth using some sort of AJAX solution to load in the product prices asynchronously.

## Example

This snippet should typically be called **uncached**, as its output is dependent on customer information and can be different between requests.

For the Products List TV:

```html
[[!commerce.render_taxed_price? &product=`[[*products]]`]]
```

With resource products:

```html
[[!commerce.render_taxed_price? &product=`[[commerce.get_resource_product_id]]`]]
```

## Properties

- `&product`: the ID of the product to get the quantity prices for. This can be a comma or double-pipe (`||`) separated list, in which case the price for the first existing product will be shown.
- `&field`: control which field to return as the price. Defaults to the taxed total (as the snippet name implies), but as of v1.10.1 this also supports other values: `total` (default), `total_ex_tax`, `total_before_tax`, `tax`, etc.

No other properties are currently available. The price is formatted by the current currency (`commerce.currency` system/context setting) and parsed through the `frontend/price.twig` twig template with only the current price.

