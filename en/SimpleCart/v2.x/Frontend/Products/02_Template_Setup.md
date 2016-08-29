To add an Add to Cart form, you only need to add a simple form and the [scAddProduct snippet](../../Snippets/scAddProduct).

## Markup example

```` html
[[!scAddProduct]]
<form action="[[~[[*id]]]]" method="post">
    <div>
        <input type="text" name="quantity" value="1" />
        <input type="submit" name="addcart" value="Add to Cart" />
    </div>
</form>
````