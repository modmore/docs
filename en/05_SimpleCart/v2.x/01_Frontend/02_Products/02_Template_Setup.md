To add an Add to Cart form, you only need to add a simple form and the [scAddProduct snippet](../../Snippets/scAddProduct).

```` html
[[!scAddProduct]]
<form action="[[~[[*id]]]]" method="post">
    <div>
        <input type="text" name="quantity" value="1" />
        <input type="submit" name="addcart" value="Add to Cart" />
    </div>
</form>
````

If the product you want to add is not the same as the current resource (for example on [product category listings](../Categories/Template_Setup)), you can add a hidden input type with the name `productid` that contains the right ID, like so.

```` html
[[!scAddProduct]]
<form action="[[~[[*id]]]]" method="post">
    <div>
        <input type="hidden" name="productid" value="1234" />
        <input type="text" name="quantity" value="1" />
        <input type="submit" name="addcart" value="Add to Cart" />
    </div>
</form>
````
