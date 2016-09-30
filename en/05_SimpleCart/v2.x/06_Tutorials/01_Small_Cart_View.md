If you'd like to create a small view of your cart, for example in the header of your site, you can use the [scGetCart snippet](../Snippets/scGetCart) with a few properties. 

For example use this snippet call to show a simple summary without product information:

```` html   
[[!scGetCart?
    &tpl=`cartHeader`
    &emptyTpl=`cartHeaderEmpty`
    &viewProducts=`0`
]]
````

That provides the `&tpl` and `&emptyTpl` properties with different chunks to make sure it doesn't place the entire cart there.

By passing `&viewProducts=0` it also doesn't load the product information. This makes it faster than a full cart view. 

## Example &tpl chunk: cartHeader

```` html   
<div id="simplecart-small">
    You have [[+cart.total.products]] products in your cart.<br>
    <a href="[[~{your cart page id here}]]">Click here</a> to view your cart.
</div>
````

## Example &emptyTpl chunk: cartHeaderEmpty

```` html 
<div id="simplecart-small">
    You don't have any products in your cart<br>
    Shop around and add some goods!
</div>
````   

If you have to use &viewProducts property or not, the total placeholders are always available.

```` html   
[[+cart.total.products]]
[[+cart.total.discount_formatted]]
[[+cart.total.price_formatted]]
````   
