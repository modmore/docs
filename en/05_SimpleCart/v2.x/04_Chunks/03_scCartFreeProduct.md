The Cart free Product chunk is used by the [scGetCart Snippet](../Snippets/scGetCart) in the `&freeProductTpl` property. 

## Default scCartFree Product chunk

```` html
<tr class="[[+product.rowclass]]">
  <td class="title" colspan="5">
    <strong>[[%simplecart.cart.free]]</strong> [[+product.pagetitle]]<br />
    [[%simplecart.cart.worthof? &price=`[[+product.product_price_formatted]]`]]
  </td>
</tr>
````