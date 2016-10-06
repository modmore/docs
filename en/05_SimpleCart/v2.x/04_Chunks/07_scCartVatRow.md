The scCartVatRow chunk is used by the [scGetCart Snippet](../Snippets/scGetCart)  in the `&vatRowTpl` property.

## Default scCartVatRow chunk

```` html
<tr class="total vat">
    <td colspan="3">&nbsp;</td>
    <td class="label">[[+vat.label]]</td>
    <td class="value">[[+vat.price_formatted]]</td>
    <td class="extra">&nbsp;</td>
</tr>
````