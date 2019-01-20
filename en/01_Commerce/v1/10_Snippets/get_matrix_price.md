The `commerce.get_matrix_price` snippet is used to fetch the minimum and/or maximum price of products that are available in a [product matrix](../Product_Catalog/Product_Matrix). 

Alternatively: 
- Use [commerce.get_matrix](get_matrix) for outputting the full range of products your matrix contains.
- Use [commerce.get_matrix_first_product](get_matrix_first_product) if you want to display more information about a first/default product, like images or stock.

Added in 0.12.0-pl.

## Usage

```` html
[[!commerce.get_matrix_price? 
    &matrix=`[[+tv.product_matrix]]`
    &getMin=`1`
    &getMax=`1` 
    &inStockOnly=`1`
]]
````

Replace `[[+tv.product_matrix]]` with the ID of the matrix or `[[*product_matrix]]` when using the snippet on the page that holds the Matrix TV itself.

The above, with `getMin`, `getMax`, and `inStockOnly` all enabled, will return the minimum and maximum price for products in your matrix, separated by an n-dash.

If the minimum and the maximum price are the same, or you only provide getMin OR getMax, only the single price is shown. For example:

> **€123.00&ndash;€159.00** 
> 
> **€123.00**

Products that are in rows or columns that have been deactivated are ignored. You can also ignore products that are not in stock by specifying `&inStockOnly`. 

If no product with stock can be found, the snippet returns the `commerce.not_in_stock` lexicon, or what you provide in `&noPriceAvailable`. 



## Properties

- `&matrix`: the ID of the product matrix to load products from. 
- `&getMin`: get the lowest price from the matrix, defaults to `1`, set to `0` to disable.
- `&getMax`: get the highest price from the matrix, defaults to `0`, set to `1` to enable.
- `&inStockOnly`: only look for prices for products that have stock available. Defaults to `0`, set to `1` to enable.
- `&separator`: the string to use between the minimum and maximum price (if getMin and getMax are both provided, and they return different prices). Defaults to an n-dash (`&ndash;`). 
- `&noPriceAvailable`: the string to return when no price at all was found; defaults to `[[%commerce.out_of_stock]]`. 

## Returning information

This snippet does not have any templating. You can only specify if you want the min/max price, the separator, and what to return when no price was found.
