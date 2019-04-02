The `commerce.get_product` snippet is used to get product information for a single product. Use [get_products](get_products) for listing multiple products. 

Added in 0.4.

## Usage

```` html
[[!commerce.get_product? &product=`123`]]
````

It's possible to call this snippet both cached and uncached. The benefit of calling it uncached is that automatic sale prices are reflected in the output; but that does come at a small performance penalty.

## Properties

- `&product`: the ID of the product to load. If this is a comma or double-pipe separated value, only the first (< v0.12) or the first existing (v0.12+) product will be used. 
- `&toPlaceholders`: Prefix to set product information to placeholders; see below
- `&tpl`: Name of a chunk to return the output with; see below
- `&field`: Name of a product field to return; see below

## Returning information

Depending on which property you've provided to the snippet (`&toPlaceholders`, `&tpl` or `&field` in that order), the snippet will return the product information as follows:

1. `&toPlaceholders` will set placeholders with the prefix provided. For example ```&toPlaceholders=`product` ``` will set placeholders like `[[+product.sku]]`, `[[+product.price_formatted]]`, `[[+product.name]]` etc.
2. `&tpl` can be set to the name of a chunk. The product information (without prefix) will be parsed through that chunk. 
3. `&field` allows to immediately return a single product field. For example ```&field=`price_formatted` ``` to return just the formatted product price.
4. If none of the above are provided, all available product information is dumped to screen in a `<pre>` tag. Useful for debugging. 
