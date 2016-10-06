The scOrders chunk is used by the [scGetOrders Snippet](../Snippets/scGetOrders) to display a list of orders.

## Default scOrders chunk

```` html
<div id="simplecart">
  
  <table>
    <tr>
      <th scope="col">[[%simplecart.orders.ordernr]]</th>
      <th scope="col">[[%simplecart.orders.total]]</th>
      <th scope="col">[[%simplecart.orders.deliverytype]]</th>
      <th scope="col">[[%simplecart.orders.paymenttype]]</th>
      <th scope="col">[[%simplecart.orders.status]]</th>
      <th scope="col">[[%simplecart.orders.date]]</th>
    </tr>
    
    [[+wrapper]]
    
  </table>

</div>
```` 