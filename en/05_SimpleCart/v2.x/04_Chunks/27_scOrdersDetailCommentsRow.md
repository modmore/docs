The scOrdersDetailCommentsRow chunk is used by the [scGetOrders Snippet](../Snippets/scGetOrders) to show a specific comments on a specific order. 

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