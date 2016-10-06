The scEmailOrderRowField chunk is used by the [Email Configuration](../Manager/Administration/Emails) for formatting custom product fields. 

## Default scEmailOrderRowField chunk

```` html
- <strong>[[+label:isempty=`[[+key]]`]]</strong>: [[+value:nl2br]]
[[+last:notempty=``:isempty=`<br />`]]

````