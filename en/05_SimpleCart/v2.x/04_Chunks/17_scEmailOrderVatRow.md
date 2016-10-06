The scEmailOrderVatRow chunk is used by the [Email Configuration](../Manager/Administration/Emails) for showing total VAT prices. 

## Default scEmailOrderVatRow chunk

```` html

<tr>
    <th colspan="3" style="text-align:right;">[[+vat.label]]</th>
    <td style="text-align:right;">[[+vat.price_formatted]]</td>
</tr>
````