The scEmailOrderRowOptions chunk is used by the [Email Configuration](../Manager/Administration/Emails) for the [Product Options](../Frontend/Products/Options)

## Default scEmailOrderRowOptions chunk

```` html
[[+caption]]: [[+value]] [[+price:notempty=`(+ [[+price_formatted]])`:isempty=``]][[+last:ne=`1`:then=`,&nbsp;`:else=``]]

```` 