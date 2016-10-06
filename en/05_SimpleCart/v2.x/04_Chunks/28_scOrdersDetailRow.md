The scOrdersDetailRow chunk is used by the [scGetOrders Snippet](../Snippets/scGetOrders) to show the products in a specific order. 

## Default scOrdersDetailRow chunk

```` html
<tr class="[[+order.product.rowclass]]">
    <td class="desc">
        [[+order.product.title]]
        [[+order.product.options:notempty=`<br />[[+order.product.options]]`]]
        [[+order.product.fields:notempty=`<br />[[+order.product.fields]]`]]
    </td>
    <td class="code">[[+order.product.productcode]]</td>
    <td class="quantity">[[+order.product.quantity]]</td>
    <td class="price">[[+order.product.price:notempty=`[[+order.product.price_formatted]]`:isempty=`[[%simplecart.orders.products.free]]`]]</td>
    <td class="subtotal">[[+order.product.subtotal:notempty=`[[+order.product.subtotal_formatted]]`:isempty=`[[%simplecart.orders.products.free]]`]]</td>
</tr>
````