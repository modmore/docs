The scCreateComment snippet is called as a FormIt hook in the [scOrdersDetailCommentsForm Chunk](../Chunks/scOrdersDetailCommentsForm). This chunk is inserted into the [scOrdersDetail chunk](../Chunks/scOrdersDetail) through the `[[+order.commentsform]]` placeholder, called by the [scGetOrders snippet](scGetOrders) when viewing a specific order. 


[TOC]

## Standard Usage

This is how the hook is called in the [scOrdersDetailCommentsForm Chunk](../Chunks/scOrdersDetailCommentsForm). 

````
[[!FormIt?
    &submitVar=`addComment`
    &hooks=`spam,scCreateComment,redirect`
    &redirectTo=`[[*id]]`
    &redirectParams=`{"[[+detailKey]]":"[[+ordernr]]"}`
    &validate=`nospam:blank,
        addComment:required,
        comment:required`
]]

<form action="[[~[[*id]]? &[[+detailKey]]=`[[+ordernr]]`]]" method="post" id="simplecartComment">
    <input type="hidden" name="nospam" value="" />
    <input type="hidden" name="addComment" value="true" />

    <p>
        <textarea name="comment" rows="4" cols="60" id="fld-comment">[[+fi.comment]]</textarea>
        [[+fi.error.comment]]
    </p>

    <p class="submit">
        <input type="submit" value="[[%simplecart.orders.comments.add]]" />
    </p>

</form>
````

## Properties

Additional properties on the [scGetOrders snippet](scGetOrders) may affect this snippet.

### detailKey

Default: `order`

The URL parameter containing the order number for which comments are created. 
