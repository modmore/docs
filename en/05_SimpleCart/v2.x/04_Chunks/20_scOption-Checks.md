The scOption-Checks chunk is used for formatting [Product Options](../Frontend/Products/Options) with checkboxes. 

## Default scOption-Checks chunk

```` html
<input type="checkbox" name="[[+option_name]][]" value="[[+value]]" id="scopt[[+id]][[+value]]" [[+selected:eq=`1`:then=` checked="checked"`]] />
<label for="scopt[[+id]][[+value]]">
    [[+label]][[+price:notempty=`, [[%simplecartoption.price? &namespace=`simplecart` &topic=`tvrenders`]]: [[+price_formatted]]`]][[+percentage:notempty=` ([[+percentage]]%)`]]
</label><br />
```` 