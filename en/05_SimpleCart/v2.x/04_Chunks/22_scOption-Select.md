The Option Select chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) for option inputtype Select

## Default scOption-Select chunk

```` html
[[+first:notempty=`<select name="[[+option_name]]">`]]
<option value="[[+value]]" [[+selected:eq=`1`:then=`selected="selected"`]]>
    [[+label]][[+price:notempty=`, [[%simplecartoption.price? &namespace=`simplecart` &topic=`tvrenders`]]: [[+price_formatted]]`]][[+percentage:notempty=` ([[+percentage]]%)`]]
</option>
[[+last:notempty=`</select>`]]
```` html



