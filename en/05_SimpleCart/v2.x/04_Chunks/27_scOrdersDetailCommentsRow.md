The Orders Detail Comments Row chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) 

## Default scOrdersDetailCommentsRow chunk

```` html
<div class="comment">

    <p>[[+comment.comment:nl2br]]</p>

    <div class="info">
        <em>
            [[%simplecart.orders.comments.postedby]] [[[[+comment.type:eq=`user`:then=`%simplecart.orders.postedby_you`:else=`++site_name`]]]]
            [[%simplecart.orders.comments.postedby_on]] [[+comment.created:strtotime:date=`%B %e, %Y @ %H:%M`]]
        </em>
    </div>
</div>
````