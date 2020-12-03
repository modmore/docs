With the **commerce.render_quantity_price** snippet you can render a pricing table for the Quantity-based [Price Type](../05_Products/Price_Types.md) introduced in Commerce 1.0.

[TOC]

## Example

For the Products List TV:

```html
[[commerce.render_quantity_price? &product=`[[*products]]`]]
```

With resource products:

```html
[[commerce.render_quantity_price? &product=`[[commerce.get_resource_product_id]]`]]
```

## Properties

- `&product`: the ID of the product to get the quantity prices for. This can be a comma or double-pipe (`||`) separated list, in which case the prices for the first existing product will be shown.
- `&tpl`: the path/name of a Twig template to use for the actual rendering. Defaults to `frontend/pricetypes/quantity.twig`, see below.


## Templating

The default template outputs a table if at least 1 quantity bracket is set, and an empty result if not. 

```html
{% if prices|length > 0 %}
    <table class="table c-quantity-price__container">
        <thead>
        <tr>
            <th class="c-quantity-price__header c-quantity-price__header_quantity">{{ lex('commerce.quantity') }}</th>
            <th class="c-quantity-price__header c-quantity-price__header_price">{{ lex('commerce.price') }}</th>
            <th class="c-quantity-price__header c-quantity-price__header_savings">{# Savings #}</th>
        </tr>
        </thead>
        <tbody>
        {% for price in prices %}
        <tr>
            <td class="c-quantity-price c-quantity-price__quantity">
                {{ price.min }}
                {%- if price.max > 0 -%}
                    &ndash;{{ price.max }}
                {%- else -%}
                    &plus;
                {%- endif -%}
            </td>
            <td class="c-quantity-price c-quantity-price_price">{{ price.price_formatted }}</td>
            <td class="c-quantity-price c-quantity-price_percentage">&dash;{{ price.discount_percentage }}%</td>
        </tr>
        {% endfor %}
        </tbody>
    </table>
{% endif %}
```

The following placeholders are available for each quantity bracket (the example values assume a £12.50 regular price):

- `min` => int 2
- `max` => int 5
- `amount` => int 1150
- `price` => int 1150
- `price_formatted` => string `£11.50` 
- `discount` => int 100
- `discount_formatted` => string `£1.00` 
- `discount_percentage` => string `8`

The product information is also available through `{{ product.FIELD }}`.

New to templating with Twig? [Start here with theming.](../03_Front-end_Theming.md)
