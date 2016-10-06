The Option Radio is being used by the [scGetCart Snippet](../Snippets/scGetCart) for option inputtype Radio

## Default scOption-Radio chunk

```` html
<input type="radio" name="[[+option_name]]" value="[[+value]]" id="scopt[[+id]][[+value]]" [[+selected:eq=`1`:then=`checked="checked"`]] />
<label for="scopt[[+id]][[+value]]">
    [[+label]][[+price:notempty=`, [[%simplecartoption.price? &namespace=`simplecart` &topic=`tvrenders`]]: [[+price_formatted]]`]][[+percentage:notempty=` ([[+percentage]]%)`]]
</label><br />
````