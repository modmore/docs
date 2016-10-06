The scOption-Checks chunk is used for formatting [Product Options](../Frontend/Products/Options) with a select box. 

## Default scOption-Select chunk

```` html
[[+first:notempty=`<select name="[[+option_name]]">`]]
<option value="[[+value]]" [[+selected:eq=`1`:then=`selected="selected"`]]>
    [[+label]][[+price:notempty=`, [[%simplecartoption.price? &namespace=`simplecart` &topic=`tvrenders`]]: [[+price_formatted]]`]][[+percentage:notempty=` ([[+percentage]]%)`]]
</option>
[[+last:notempty=`</select>`]]
```` html



