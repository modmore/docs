The `commerce.get_products` snippet is used to iterate over a list of products, based on the provided product IDs. Use [get_product](get_product) for getting information about a single product.

Added in 0.4.

## Usage

```` html
[[!commerce.get_products? 
    &products=`123, 321, 213, 231`
    &tpl=`product-item`
]]
````

It's possible to call this snippet both cached and uncached. The benefit of calling it uncached is that automatic sale prices are reflected in the output; but that does come at a small performance penalty.

## Properties

- `&products`: the IDs of the products to iterate over. This can be comma separated (`123,321`) or separated by two pipes (`123||321`) like template variables store listbox values.
- `&tpl`: can be set to the name of a chunk. The product information (without prefix) will be parsed through that chunk. If not provided, the product information will be dumped to screen in a `<pre>`. Placeholders include all product fields, as well as `[[+total_products]]` and `[[+idx]]` (0-based). 
- `&sortby`: name of a field to sort the products by. For example `name` or `price`. By default, this will use the same order as the products were provided in. (**Note**: due to a bug in 2.5.2, the default may not return products unless you specify a different `&sortby`. Update to 2.5.4.)
- `&separator`: string to use to join the product records together, defaults to a newline character. (new in 0.11)

## Showing product variations

If you select one or more products on a resource, you can use this snippet in your [add to cart form](../Product_Catalog/Add_to_Cart_Form). For example if you want to show radio boxes if there were multiple, but a hidden input if there was just one result, use something like this:

```` html
[[commerce.get_products? 
    &products=`[[+tv.products]]`
    &tpl=`products.product_option` 
]]
````

`product_option` chunk:

```` html
[[+total_products:eq=`1`:then=`
  <input type="hidden" name="product" value="[[+id]]">
`:else=`
  <label>
    <input type="radio" name="product" value="[[+id]]" [[+idx:eq=`0`:then=`checked="checked"`:else=``]]>
    [[+name]] ([[+price_formatted]])
  </label>
`]]
````

