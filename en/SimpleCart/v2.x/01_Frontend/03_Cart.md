The cart is probably the most important page of your webshop. For setting up your product pages to add products to the cart, see the [Products Template Setup documentation](Products/Template_Setup). 

## Resources structure 

It's easiest to set up your cart and checkout resources like this:

- Cart 
    - Checkout
        - Thank you

 [ ![Basic shopping cart tree setup](https://assets.modmore.com/uploads/2015/12/tree_structure_setup.png)](https://assets.modmore.com/uploads/2015/12/tree_structure_setup.png "Basic shopping cart tree setup")

It's also possible to [add a confirmation page](Checkout/Confirmation_Page) between the _Checkout_ and _Thank you_ page. 

## Setting up the Shopping Cart page

In your Cart template you will need to call the [scGetCart Snippet](../Snippets/scGetCart) to show the cart. This includes the functionality to update the cart, to enter a coupon code and to continue to the checkout by default. 
   
```` html   
[[!scGetCart]]
````   

There are a number of properties you can set on the cart snippet. Below you can find a few useful ones to template the cart. 

**Note**: You should always duplicate the defaults and refer to those. Any changes made to the core chunks **will be overwritten** on upgrade. 

- tpl: the chunk name for the entire cart. Defaults to `scCart`. [Read more about the scCart default chunk and available placeholders](../Chunks/scCart)
- rowTpl: the chunk for every product added to the cart. Defaults to `scCartRow`. [Read more about the scCartRow default chunk and available placeholders](../Chunks/scCartRow)
- rowOptionTpl: the chunk to wrap product options in that were chosen for a product added to the cart. Defaults to `scCartRowOptions` [Read more about the scCartRowOptions default chunk and available placeholders](../Chunks/scCartRowOptions)
- rowFieldTpl: the chunk for custom product fields that were added to a product. Defaults to `scCartRowField`. [Read more about the scCartRowField default chunk and available placeholders](../Chunks/scCartRowField)
- vatRowTpl: the chunk for every VAT/Tax row in the cart. Defaults to `scCartVatRow`. [Read more about the scCartVatRow default chunk and available placeholders](../Chunks/scCartVatRow)
- freeProductTpl: the chunk uses for free products that were added to the cart. Defaults to `scCartFreeProduct` [Read more about the scCartFreeProduct default chunk and available placeholders](../Chunks/scCartFreeProduct)
- emptyTpl: the chunk used when the cart is empty, prompting the users to add products to their cart. Defaults to `scCartEmpty`. [Read more about the scCartEmpty default chunk and available placeholders](../Chunks/scCartEmpty)

For all properties visit the [scGetCart Snippet documentation](../Snippets/scGetCart)