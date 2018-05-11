The `commerce.get_cart` snippet is used to list cart information outside the actual cart, for example as a sidebar widget or a "You have X items in your cart" link in a header. 

To display the fully functional cart to allow the customer to checkout, use the [`commerce.cart`](cart) snippet.

Added in v0.7.

[TOC]

## Usage

```` html
[[!commerce.get_cart? &tpl=`name-of-a-chunk`]]
[[!commerce.get_cart? &tpl=`name-of-a-chunk` &emptyTpl=`other-chunk`]]
[[!commerce.get_cart? &toPlaceholders=`cart.`]]
[[!commerce.get_cart? &field=`total_formatted`]]
````

## Properties

- `&tpl`: the name of a chunk (_not_ a twig template file) to show the cart with, only used if the cart has at least one item in it.
- `&itemTpl`: the name of a chunk (_not_ a twig template file) used to process each item in the cart. Skip if you don't need to display individual products.
- `&emptyTpl`: the name of a chunk (_not_ a twig template file) used when the cart is empty.
- `&toPlaceholders`: prefix to use for setting placeholders with all cart information.
- `&field`: specify an order field to return only that field.
- `&separator`: string to use to join the product records together, defaults to a newline character. (new in 0.11)

## Returning information

Depending on which properties you've provided to the snippet (`&toPlaceholders`, `&tpl`/`&emptyTpl`, or `&field` in that order), the snippet will return the product information as follows:

1. `&toPlaceholders` will set placeholders with the prefix provided. For example ```&toPlaceholders=`cart` ``` will set placeholders like `[[!+cart.total_quantity]]`, `[[!+cart.total_formatted]]`, etc.
2. `&tpl` can be set to the name of a chunk. The cart information (without prefix) will be parsed through that chunk. When you also provide `&itemTpl` with a chunk name, the items in the cart will be parsed through that chunk, with the results placed in the `[[+items]]` placeholder in `&tpl`.
3. `&field` allows to immediately return a single order field. For example ```&field=`total_formatted` ``` to return just the formatted total order price.
4. If none of the above are provided, all available cart information is dumped to screen in a `<pre>` tag. Useful for debugging. 

## Available placeholders

All cart/order information is made available. If you provide none of the properties discussed above, you will see a dump of the available data, similar to the one below.

```` json
Array
(
    [id] => 226
    [class_key] => comCartOrder
    [properties] => Array
        (
            [expected_address] => Array
                (
                    [state] => Noord-Holland
                    [country] => NL
                )

            [logs] => Array
                (
                    [0] => Array
                        (
                            [created_on] => 1496069083
                            [public] => 
                            [message] => commerce.log.item_added
                            [properties] => Array
                                (
                                    [id] => 397
                                    [name] => Product Name
                                    [quantity] => 1
                                )

                        )

                )

        )

    [test] => 1
    [status] => 1
    [currency] => EUR
    [subtotal] => 2000
    [discount] => 0
    [shipping] => 0
    [transaction] => 0
    [total_before_tax] => 2000
    [total_ex_tax] => 2000
    [tax] => 420
    [total] => 2420
    [total_due] => 2420
    [total_quantity] => 1
    [created_on] => 1496069083
    [last_updated_on] => 1496069413
    [status_updated_on] => 0
    [created_by] => 1
    [last_updated_by] => 1
    [status_updated_by] => 0
    [shipping_method] => 0
    [parent] => 0
    [user] => 1
    [subtotal_formatted] => €20.00
    [discount_formatted] => €0.00
    [shipping_formatted] => €0.00
    [transaction_formatted] => €0.00
    [total_before_tax_formatted] => €20.00
    [total_ex_tax_formatted] => €20.00
    [tax_formatted] => €4.20
    [total_formatted] => €24.20
    [total_due_formatted] => €24.20
    [created_on_formatted] => 2017-05-29 at 16:44:43 CEST
    [last_updated_on_formatted] => 2017-05-29 at 16:50:13 CEST
    [status_updated_on_formatted] => 
    [items] => Array
        (
            [0] => Array
                (
                    [id] => 398
                    [class_key] => comOrderItem
                    [properties] => 
                    [order] => 226
                    [product] => Array
                        (
                            [id] => 1
                            [class_key] => comProduct
                            [properties] => 
                            [sku] => awesome-product
                            [name] => Product Name
                            [description] => 
                            [price] => 2000
                            [stock] => 9
                            [weight] => 3
                            [weight_unit] => kg
                            [tax_group] => 1
                            [target] => 0
                            [removed] => 
                            [removed_on] => 0
                            [removed_by] => 
                            [price_formatted] => €20.00
                            [removed_on_formatted] => 
                            [link] => 
                            [edit_link] => /manager/?namespace=commerce&a=index&ca=product/update&id=1
                        )

                    [idx] => 20
                    [currency] => EUR
                    [status] => 0
                    [allow_update] => 1
                    [sku] => awesome-product
                    [name] => Product Name
                    [link] => 
                    [description] => 
                    [price] => 2000
                    [quantity] => 1
                    [subtotal] => 2000
                    [discount] => 0
                    [shipping] => 0
                    [total_before_tax] => 2000
                    [total_ex_tax] => 2000
                    [tax] => 420
                    [total] => 2420
                    [price_formatted] => €20.00
                    [subtotal_formatted] => €20.00
                    [discount_formatted] => €0.00
                    [shipping_formatted] => €0.00
                    [total_before_tax_formatted] => €20.00
                    [total_ex_tax_formatted] => €20.00
                    [tax_formatted] => €4.20
                    [total_formatted] => €24.20
                )

        )

)
````

## Showing cart in the header?

MODX processes snippets from top to bottom, so if you place a cart  summary in the header of the page, on the cart and checkout pages it may show old data. 

One way around this is to add the `get_cart` snippet below the content (so the cart/checkout snippets are executed first), and to use the `&toPlaceholders` property to set placeholders, which you can then add into the header of the page.

For example with 
```` html
[[!commerce.get_cart? &toPlaceholders=`cart`]]
````
below the content, you can use `[[!+cart.total_quantity]]` and `[[!+cart.total_formatted]]` in the header of your page.
