The scOrdersDetailCommentsForm chunk is used by the [scGetOrders Snippet](../Snippets/scGetOrders) to show a form for adding a comment to a specific order. It is processed by the [scCreateComment snippet as FormIt hook](../Snippets/scCreateComment). 

## Default scOrdersDetailCommentsForm chunk

```` html
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