The Orders Detail Comments Fotm is being used by the [scGetCart Snippet](../Snippets/scGetCart) to generate a Form to add comments to an order

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