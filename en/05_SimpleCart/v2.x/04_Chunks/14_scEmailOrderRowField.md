The Email Order Row Field chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) 

## Default scEmailOrderRowField chunk

```` html
- <strong>[[+label:isempty=`[[+key]]`]]</strong>: [[+value:nl2br]]
[[+last:notempty=``:isempty=`<br />`]]

````