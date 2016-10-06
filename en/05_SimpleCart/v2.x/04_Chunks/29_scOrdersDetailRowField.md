The scOrdersDetailRowField chunk is used by the [scGetOrders Snippet](../Snippets/scGetOrders) to show the custom product fields, on a product row, in a specific order. 

## Default scOrdersDetailRowField chunk

```` html
- <strong>[[+label:isempty=`[[+key]]`]]</strong>: [[+value:nl2br]]
[[+last:notempty=``:isempty=`<br />`]]
````