The Orders Detail chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) to parse order details

## Default scOrdersDetail chunk

```` html
<div id="simplecart" class="orderdetail">
    
    <p><a href="[[~[[*id]]]]">[[%simplecart.orders.backtooverview]]</a></p>
    
    <table class="details">
      <tr>
        <th>[[%simplecart.orders.ordernr]]</th>
        <td>[[+order.ordernr]]</td>
      </tr>
      <tr>
        <th>[[%simplecart.orders.total]]</th>
        <td>[[+order.total_formatted]]</td>
      </tr>
      [[+order.delivery_method:notempty=`<tr>
        <th>[[%simplecart.orders.deliverytype]]</th>
        <td>[[+order.delivery_method]]</td>
      </tr>`]]
      [[+order.payment_method:notempty=`<tr>
        <th>[[%simplecart.orders.paymenttype]]</th>
        <td>[[+order.payment_method]]</td>
      </tr>`]]
      <tr>
        <th>[[%simplecart.orders.date]]</th>
        <td>[[+order.created:strtotime:date=`%B %e, %Y @ %H:%M`]]</td>
      </tr>
      <tr>
        <th>[[%simplecart.orders.status]]</th>
        <td>[[+order.status]]</td>
      </tr>
    </table>
    
    <table class="addresses">
      <tr>
        <th>[[%simplecart.orders.orderaddress]]</th>
        <th>[[%simplecart.orders.deliveryaddress]]</th>
      </tr>
      <tr>
        <td>
        	[[+order.address.company:notempty=`<strong>[[+order.address.company]]</strong><br />`]]
        	[[+order.address.name:isempty=`[[+order.address.firstname]] [[+order.address.lastname]]`]]<br />
        	[[+order.address.address1]] [[+order.address.address2]] [[+order.address.address3]]<br />
        	[[+order.address.zip]] [[+order.address.city]]<br />
        	[[+order.address.state]] [[+order.address.country]]
        	[[+order.address.phone:notempty=`<br />[[+order.address.phone]]`]]
        	[[+order.address.mobile:notempty=`<br />[[+order.address.mobile]]`]]
        	[[+order.address.email:notempty=`<br /><a href="mailto:[[+order.address.email]]">[[+order.address.email]]</a>`]]
        </td>
        [[+order.address.delivery.same:ne=`1`:then=`<td>
            [[+order.address.delivery.company:notempty=`<strong>[[+order.address.delivery.company]]</strong><br />`]]
        	[[+order.address.delivery.name:isempty=`[[+order.address.delivery.firstname]] [[+order.address.delivery.lastname]]`]]<br />
        	[[+order.address.delivery.address1]] [[+order.address.delivery.address2]] [[+order.address.delivery.address3]]<br />
        	[[+order.address.delivery.zip]] [[+order.address.delivery.city]]<br />
        	[[+order.address.delivery.state]] [[+order.address.delivery.country]]
        	[[+order.address.delivery.phone:notempty=`<br />[[+order.address.delivery.phone]]`]]
        	[[+order.address.delivery.mobile:notempty=`<br />[[+order.address.delivery.mobile]]`]]
        	[[+order.address.delivery.email:notempty=`<br /><a href="mailto:[[+order.address.delivery.email]]">[[+order.address.delivery.email]]</a>`]]
        </td>`:else=`<td>
      	    [[%simplecart.orders.deliveryaddress.same]]
        </td>`]]
      </tr>
    </table>
    
    <table class="products">
      <tr>
        <th scope="col" class="desc">[[%simplecart.orders.products.desc]]</th>
        <th scope="col" class="code">[[%simplecart.orders.products.code]]</th>
        <th scope="col" class="quantity">[[%simplecart.orders.products.quantity]]</th>
        <th scope="col" class="price">[[%simplecart.orders.products.price]]</th>
        <th scope="col" class="subtotal">[[%simplecart.orders.products.subtotal]]</th>
      </tr>
      
      [[+wrapper]]
      
    </table>
    
    <table class="totals">

      [[+order.totals.discount:notempty=`<tr>
        <td>&nbsp;</td>
        <th>[[%simplecart.orders.discount]]</th>
        <td class="costs">- [[+order.totals.discount_formatted]]</td>
      </tr>`:isempty=``]]

      [[+order.totals.delivery:notempty=`<tr>
        <td>&nbsp;</td>
        <th>[[%simplecart.orders.deliverycosts]]</th>
        <td class="costs">[[+order.totals.delivery_formatted]]</td>
      </tr>`:isempty=``]]

      [[+order.totals.payment:notempty=`<tr>
        <td>&nbsp;</td>
        <th>[[%simplecart.orders.paymentcosts]]</th>
        <td class="costs">[[+order.totals.payment_formatted]]</td>
      </tr>`:isempty=``]]

    [[+order.totals.vat_total:notempty=`
      <tr>
        <td>&nbsp;</td>
        <th>[[%simplecart.orders.total_ex_vat]]</th>
        <td class="costs">[[+order.totals.price_ex_vat_formatted]]</td>
      </tr>
      [[+order.vat_rates]]
      <tr>
        <td>&nbsp;</td>
        <th>[[%simplecart.orders.total_vat]]</th>
        <td class="costs">[[+order.totals.vat_total_formatted]]</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <th>[[%simplecart.orders.total_in_vat]]</th>
        <td class="costs">[[+order.total_formatted]]</td>
      </tr>
    `:isempty=`
      <tr>
        <td>&nbsp;</td>
        <th>[[%simplecart.orders.total]]</th>
        <td class="costs">[[+order.total_formatted]]</td>
      </tr>
    `]]
    </table>

    [[+order.comments]]

    [[+order.commentsform]]
    
</div>
```` 