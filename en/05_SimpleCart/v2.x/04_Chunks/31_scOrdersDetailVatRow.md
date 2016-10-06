The Orders Detail Vat Row is being used by the [scGetCart Snippet](../Snippets/scGetCart)  to display the VAT for an order

## Default scOrdersDetailVatRow chunk

```` html
<tr>
    <td>&nbsp;</td>
    <td>[[+vat.label]]</td>
    <td class="costs">[[+vat.price_formatted]]</td>
</tr>
```` 