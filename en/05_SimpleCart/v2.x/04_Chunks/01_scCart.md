The scCart chunk is used by the [scGetCart Snippet](../Snippets/scGetCart) to wrap the cart in. It's configured in the `&tpl` property of the snippet.

## Available placeholders

- `[[+cart.wrapper]]` Contains the rendered output of the products in the cart
- `[[+cart.vat_rates]]` Contains the rendered output of all VAT rates / prices in the cart  
- `[[+cart.total.products]]` The total number of products in the cart. This includes the quantities per product  
- `[[+cart.total.freeproducts]]` The total number of free (give away) products in the cart  
- `[[+cart.total.price]]` The total price of the cart products  
- `[[+cart.total.price_ex_vat]]` The total price of the cart products, excluding the VAT price(s)  
- `[[+cart.total.absprice]]` The total price of the cart products, excluding any discount  
- `[[+cart.total.absprice_ex_vat]]` The total price of the cart products, ecluding any discount and VAT price(s)  
- `[[+cart.total.discount]]` The total amount of discount  
- `[[+cart.total.discount_percent]]` The total discount in a percentage of the cart total
- `[[+cart.total.delivery]]` The total amount of delivery costs  
- `[[+cart.total.payment]]` The total amount of payment costs  
- `[[+cart.total.vat_total]]` The total amount of VAT in the cart  
- `[[+cart.total.vat_prices]]` A list of VAT rates and their prices. 
- `[[+cart.total.product_added]]` Contains the ID of the product which has been added to the cart

## Price Formatting

All placeholders in the list above that deal with prices can also be returned as a formatted value, based on the configured currency. For this just append the `_formatted` suffix to the placeholder name. 

## Default scCart chunk

```` html
[[!FormIt?
    &store=`1`
    &hooks=`spam,redirect`
    &submitVar=`checkout`
    &redirectTo=`[[*id:scFirstChild]]`
]]

[[!scCartUpdate]]

<div id="simplecart">
    <form action="[[~[[*id]]]]" method="post" id="form_cartoverview">
        <input type="hidden" name="updatecart" value="true" />
        <table>
            <tr>
            <th class="desc">[[%simplecart.cart.description]]</th>
            <th class="price">[[%simplecart.cart.price]]</th>
            <th class="quantity">[[%simplecart.cart.quantity]]</th>
            [[+cart.total.vat_total:notempty=`
                <th class="quantity">[[%simplecart.cart.vat]]</th>
            `:isempty=``]]
            <th class="subtotal">[[%simplecart.cart.subtotal]]</th>
            <th>&nbsp;</th>
        </tr>
        
        [[+cart.wrapper]]
        
        [[+cart.total.discount:notempty=`
            <tr class="total first discount">
                <td colspan="[[+cart.total.vat_total:notempty=`3`:isempty=`2`]]">&nbsp;</td>
                <td class="label">[[%simplecart.cart.total]] [[%simplecart.cart.discount]] [[+cart.total.discount:notempty=`([[+cart.total.discount_percent_formatted]])`:isempty=``]]</td>
                <td class="value">- [[+cart.total.discount_formatted]]</td>
                <td class="extra">&nbsp;</td>
            </tr>
        `:isempty=``]]
        
        [[+cart.total.vat_total:notempty=`
            <tr class="total [[+cart.total.discount:notempty=`second`:isempty=`first`]]">
                <td colspan="3">&nbsp;</td>
                <td class="label">[[%simplecart.cart.total_ex_vat]]</td>
                <td class="value">[[+cart.total.price_ex_vat_formatted]]</td>
                <td class="extra">&nbsp;</td>
            </tr>
            
            [[+cart.vat_rates]]
            
            <tr class="total [[+cart.total.discount:notempty=`third`:isempty=`second`]]">
                <td colspan="3">&nbsp;</td>
                <td class="label">[[%simplecart.cart.total_vat]]</td>
                <td class="value">[[+cart.total.vat_total_formatted]]</td>
                <td class="extra">&nbsp;</td>
            </tr>
            <tr class="total [[+cart.total.discount:notempty=`fourth`:isempty=`third`]]">
                <td colspan="3">&nbsp;</td>
                <td class="label">[[%simplecart.cart.total_in_vat]]</td>
                <td class="value">[[+cart.total.price_formatted]]</td>
                <td class="extra">&nbsp;</td>
            </tr>
        `:isempty=`
            <tr class="total [[+cart.total.discount:notempty=`second`:isempty=`first`]]">
                <td colspan="2">&nbsp;</td>
                <td class="label">[[%simplecart.cart.total]]</td>
                <td class="value">[[+cart.total.price_formatted]]</td>
                <td class="extra">&nbsp;</td>
            </tr>
        `]]
        </table>
        <div class="submit">
            <input type="submit" value="[[%simplecart.cart.update]]" />
        </div>
    </form>
    
    [[!scCouponCode]]
    
    <h2>[[%simplecart.cart.delivery_method]]</h2>
    
    <form action="[[~[[*id]]]]" method="post" id="form_deliverymethod">
    
        [[!scDeliveryMethods]]
        
        <div class="submit">
            [[+cart.minimum_order_amount_reached:notempty=`
                <input type="submit" name="checkout" value="[[%simplecart.cart.checkout]]" />
            `:isempty=`
                [[%simplecart.cart.minimum_order_amount? &amount=`[[+cart.minimum_order_amount_formatted]]`]]
            `]]        
        </div>
    </form>
</div>
````