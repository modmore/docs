The Email order chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) 

## Default scEmailOrder chunk

```` html
[[%simplecart.email.salutation? &name=`[[+name]]` &firstname=`[[+firstname]]` &lastname=`[[+lastname]]`]]
<br /><br />
[[%simplecart.email.thanks? &ordernr=`[[+ordernr]]`]]
<br /><br />
<strong>[[%simplecart.email.address.order]]</strong><br />
[[+address.company:notempty=`[[+address.company]]<br />`]]
[[+address.fullname]]<br />
[[+address.address1]] [[+address.address2]] [[+address.address3]]<br />
[[+address.zip]] [[+address.city]]<br />
[[+address.country]]
<br /><br />
[[+deliveryAddress:notempty=`<strong>[[%simplecart.email.address.delivery]]</strong><br />
[[+address.delivery.company:notempty=`[[+address.delivery.company]]<br />`]]
[[+address.delivery.fullname]]<br />
[[+address.delivery.address1]] [[+address.delivery.address2]] [[+address.delivery.address3]]<br />
[[+address.delivery.zip]] [[+address.delivery.city]]<br />
[[+address.delivery.country]]
<br /><br />`]]
<strong>[[%simplecart.email.productlist]]</strong>
<br /><br />
<table style="width:550px;border-collapse:collapse;">
  <tr>
    <th>[[%simplecart.email.products.title]]</th>
    <th style="text-align:right;">[[%simplecart.email.products.price]]</th>
    <th style="text-align:center;">[[%simplecart.email.products.quantity]]</th>
    <th style="text-align:right;">[[%simplecart.email.products.subtotal]]</th>
  </tr>
  
  [[+productrows]]
  
  [[+delivery.costs:notempty=`<tr>
    <th colspan="3" style="text-align:right;">[[%simplecart.email.costs.delivery]]</th>
    <td style="text-align:right;"><strong>[[+delivery.costs_formatted]]</strong></td>
  </tr>`:isempty=``]]
  
  [[+payment.costs:notempty=`<tr>
    <th colspan="3" style="text-align:right;">[[%simplecart.email.costs.payment]]</th>
    <td style="text-align:right;"><strong>[[+payment.costs_formatted]]</strong></td>
  </tr>`:isempty=``]]
  
  [[+coupon.code:notempty=`<tr>
    <th colspan="3" style="text-align:right;">[[%simplecart.email.costs.discount]]</th>
    <td style="text-align:right;"><strong>[[+coupon.discount_formatted]]</strong></td>
  </tr>`:isempty=``]]

  [[+totals.vat_total:notempty=`
    <tr>
      <th colspan="3" style="text-align:right;">[[%simplecart.email.costs.total_ex_vat]]</th>
      <td style="text-align:right;"><strong>[[+totals.price_ex_vat_formatted]]</strong></td>
    </tr>
    [[+vat_rates]]
    <tr>
      <th colspan="3" style="text-align:right;">[[%simplecart.email.costs.total_vat]]</th>
      <td style="text-align:right;"><strong>[[+totals.vat_total_formatted]]</strong></td>
    </tr>
    <tr>
      <th colspan="3" style="text-align:right;">[[%simplecart.email.costs.total_in_vat]]</th>
      <td style="text-align:right;"><strong>[[+total_formatted]]</strong></td>
    </tr>
  `:isempty=`
    <tr>
      <th colspan="3" style="text-align:right;">[[%simplecart.email.costs.total]]</th>
      <td style="text-align:right;"><strong>[[+total_formatted]]</strong></td>
    </tr>
  `]]

</table>
<br />

[[+delivery.desc:notempty=`<strong>[[%simplecart.email.method.delivery]]</strong><br />[[+delivery.desc]]<br /><br />`]]

[[+payment.desc:notempty=`<strong>[[%simplecart.email.method.payment]]</strong><br />[[+payment.desc]]<br /><br />`]]

[[+coupon.code:notempty=`<strong>[[%simplecart.email.coupon]]</strong><br />

[[%simplecart.email.coupon.code? &code=`[[+coupon.code]]`]]<br />

[[%simplecart.email.coupon.worth? &discount=`[[+coupon.discount_formatted]]` &discount_percent=`[[+coupon.discount_percent]]`]]
<br /><br />`]]

[[%simplecart.email.closure]]

<br /><br />

[[%simplecart.email.regards]]

```` 