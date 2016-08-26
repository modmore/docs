The cart is probably the most important page of your webshop. 

## Resources structure 

It's best to set up your cart and checkout resources like this:

- Cart 
    - Checkout
        - Thank you

 [ ![Basic shopping cart tree setup](https://assets.modmore.com/uploads/2015/12/tree_structure_setup.png)](https://assets.modmore.com/uploads/2015/12/tree_structure_setup.png "Basic shopping cart tree setup")

It's also possible to [add a confirmation page](../Checkout/Confirmation_Page) between the Checkout and Thank you page. 

## Setting up the Shopping Cart page

In your Cart template you will need to call the [scGetCart Snippet](../../Snippets/scGetCart) to show the cart. 
   
```` html   
[[!scGetCart]]
````   

There are a number of properties you can set on the cart snippet. Below you can find a few useful ones to template the cart. 

**Note**: You should always duplicate the defaults and refer to those. Any changes made to the core chunks **will be overwritten** on upgrade. 

- tpl: the chunk name for the entire cart. Defaults to `scCart`
- rowTpl: the chunk for every product added to the cart. Defaults to `scCartRow`
- rowOptionTpl: the chunk to wrap product options in that were chosen for a product added to the cart. Defaults to `scCartRowOptions`
- rowFieldTpl: the chunk for custom product fields that were added to a product. Defaults to `scCartRowField`
- vatRowTpl: the chunk for every VAT/Tax row in the cart. Defaults to `scCartVatRow`
- freeProductTpl: the chunk uses for free products that were added to the cart. Defaults to `scCartFreeProduct`
- emptyTpl: the chunk used when the cart is empty, prompting the users to add products to their cart. Defaults to `scCartEmpty`

For all properties visit the [scGetCart Snippet documentation](../../Snippets/scGetCart)