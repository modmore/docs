The scOrdersDetailRowOptions chunk is used by the [scGetOrders Snippet](../Snippets/scGetOrders) to show the chosen product options, on a product row, in a specific order. 

## Default scOrdersDetailRowOptions chunk

```` html
<em>[[+caption]]: [[+value]][[+price:notempty=` (+ [[+price_formatted]])`:isempty=``]][[+last:ne=`1`:then=`,&nbsp;`:else=``]]</em>
```` 