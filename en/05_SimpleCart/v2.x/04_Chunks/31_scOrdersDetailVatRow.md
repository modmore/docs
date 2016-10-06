The scOrdersDetailVatRow chunk is used by the [scGetOrders Snippet](../Snippets/scGetOrders) to show the VAT totals on a specific order. 

## Default scOrdersDetailVatRow chunk

```` html
<tr>
    <td>&nbsp;</td>
    <td>[[+vat.label]]</td>
    <td class="costs">[[+vat.price_formatted]]</td>
</tr>
```` 