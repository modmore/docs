Each product in the cart will be displayed using the `scCartRow` chunk, as defined in the  [scGetCart Snippet](../Snippets/scGetCart). The chunk is configured with the `&rowTpl` property.
 
All default MODX Resource fields are available to you as a placeholder, and also a number of placeholders provided by SimpleCart.

## Available placeholders

Not all default MODX Resource placeholders are listed here. [You can find a more complete list in the MODX Documentation](http://rtfm.modx.com/revolution/2.x/making-sites-with-modx/structuring-your-site/resources#Resources-ResourceFields). 

- `[[+pagetitle]]` The title of the product resource
- `[[+introtext]]` The summary introtext of the product resource
- `[[+product.tv.name_of_tv]]` The value of the TV `name_of_tv` 
- `[[+product_code]]` The product/code SKU as defined in the product meta information
- `[[+product_price]]` An unformatted price
- `[[+product_special_price]]` Added in v2.5, the special discount price if it is active.
- `[[+product_image]]` The main image url for the product
- `[[+product_stock]]` The number of items in stock for the product  

If tax is configured on your site and can be applied to the cart item, the following placeholders may also be useful. 

- `[[+product_tax_ex]]` The product price excluding VAT
- `[[+product_tax_in]]` The product price including VAT
- `[[+product_tax_price]]` The VAT price without the product price
- `[[+product_tax_rate]]` The VAT rate (percentage)

Note: if you have configured multiple VAT records, these placeholders are only for the one which is configured to be the default for the current working context unless the user is logged in. 

Some other placeholders you might find useful:

- `[[+idx]]` An incrementing index number, starting with 1, increases for every item in the cart.
- `[[+rowclass]]` Some standard classes for the row, including `first`, `last`, `odd` and `even`.

## Price Formatting

All placeholders in the lists above that deal with prices can also be returned as a formatted value, based on the configured currency. For this just append the `_formatted` suffix to the placeholder name. 

## Default scCartRow Chunk

```` html
<tr class="[[+product.rowclass]]">
    <td class="title">
        <strong>[[+product.pagetitle]]</strong>
        [[+product.options:notempty=`<br /><span class="options">[[+product.options]]</span>`:isempty=``]]
        [[+product.fields:notempty=`<br /><span class="fields"><em>[[%simplecart.cart.fields]]:</em> [[+product.fields]]</span>`:isempty=``]]
    </td>
    <td class="price">
        [[+product.totals.special_offer:notempty=`
            <span style="text-decoration:line-through;">[[+product.totals.default_price_ex_vat_formatted]]</span><br>
        `]]
        [[+product.totals.price_ex_vat_formatted]]
    </td>
    <td class="quantity">
        <input type="number" name="quantity&#91;[[+product.key]]&#93;" min="0" value="[[+product.totals.quantity]]" />
    </td>

    [[+product.totals.vat_price:notempty=`
    <td class="vat">
        [[+product.totals.vat_subtotal_formatted]] ([[+product.totals.vat_rate_formatted]])
    </td>`:isempty=``]]

    <td class="subtotal">
        [[+product.totals.special_offer:notempty=`
            <span style="text-decoration:line-through;">[[+product.totals.default_subtotal_ex_vat_formatted]]</span><br>
        `]]
        [[+product.totals.subtotal_ex_vat_formatted]]
        [[+product.totals.discount:notempty=`([[%simplecart.cart.discount]] [[+product.totals.discount_percent_formatted]])`:isempty=``]]
    </td>
    <td class="actions">
        <input type="submit" name="remove&#91;[[+product.key]]&#93;" value="[[%remove]]" />
    </td>
</tr>
````
 