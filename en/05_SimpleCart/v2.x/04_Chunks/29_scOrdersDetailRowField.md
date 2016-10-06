The Orders Detail Row Field chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) 

## Default scOrdersDetailRowField chunk

```` html
- <strong>[[+label:isempty=`[[+key]]`]]</strong>: [[+value:nl2br]]
[[+last:notempty=``:isempty=`<br />`]]
````