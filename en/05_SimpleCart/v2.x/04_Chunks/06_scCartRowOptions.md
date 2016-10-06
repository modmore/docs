The scCartRowOptions chunk is used by the [scGetCart Snippet](../Snippets/scGetCart) in the `&rowOptionTpl` property.

## Default scCartRowOptions chunk

```` html
<em>
    [[+caption]]: 
    [[+value]][[+price:notempty=` (+ [[+price_formatted]])`:isempty=``]][[+last:ne=`1`:then=`,&nbsp;`:else=``]]
</em>
````
