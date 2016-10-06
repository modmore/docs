The scOrdersRow chunk is used by the [scGetOrders Snippet](../Snippets/scGetOrders) to show an order in the list. 

## Default scOrdersRow chunk

```` html
<tr class="[[+order.rowclass]]">
    <td class="number">
        <a href="[[+order.detailUrl]]">
            [[+order.ordernr]]
        </a>
        [[+order.hasNewComments:notempty=`<label>[[%simplecart.orders.comments.unread]]</label>`]]
    </td>
    <td class="amount">[[+order.total_formatted]]</td>
    <td class="delivery">[[+order.delivery_method:isempty=`<em>[[%simplecart.orders.unknown]]</em>`]]</td>
    <td class="paymnt">[[+order.payment_method:isempty=`<em>[[%simplecart.orders.unknown]]</em>`]]</td>
    <td class="status">[[+order.status:isempty=`<em>[[%simplecart.orders.unknown]]</em>`]]</td>
    <td class="created">[[+order.created:strtotime:date=`%d-%m-%Y / %H:%M`]]</td>
</tr>
````