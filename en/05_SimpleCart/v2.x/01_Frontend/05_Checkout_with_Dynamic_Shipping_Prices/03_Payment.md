## The Payment Resource

```` html   
[[!FormItRetriever?
    &placeholderPrefix=`order.`
    &storeLocation=`session`
    &redirectToOnNotFound=`[[*parent]]`
]]
<ol class="breadcrumb bc-checkout">
    <li><a href="[[~15]]"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>
    <li><a href="[[~133119]]"><i class="fa fa-truck" aria-hidden="true"></i> Delivery</a></li>
    <li class="active"><i class="fa fa-money" aria-hidden="true"></i> Payment</li>
    <li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Verify</li>
    <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> Finished</li>
</ol>
[[!FormIt?
    &submitVar=`checkout`
    &store=`1`
    &storeTime=`1500`
    &storeLocation=`session`
    &placeholderPrefix=`order.`
    &hooks=`redirect`
    &redirectTo=`[[!*id:scFirstChild]]`
]]
<form action="[[~[[*id]]]]" method="post" class="payment-method">
    <input type="hidden" name="checkout" value="1">
    <input type="hidden" name="checkoutprogress" value="1">
    
    <input type="hidden" name="deliveryMethod" value="[[!+order.deliveryMethod]]">
    <!-- paymentMethod value is set by scPaymentMethods snippet -->

    <input type="hidden" name="gender" value="[[!+order.gender]]">
    <input type="hidden" name="firstname" value="[[!+order.firstname]]">
    <input type="hidden" name="lastname" value="[[!+order.lastname]]">
    <input type="hidden" name="street" value="[[!+order.street]]">
    <input type="hidden" name="nr" value="[[!+order.nr]]">
    <input type="hidden" name="city" value="[[!+order.city]]">
    <input type="hidden" name="zip" value="[[!+order.zip]]">
    <input type="hidden" name="country" value="[[!+order.country]]">
    <input type="hidden" name="phone" value="[[!+order.phone]]">
    <input type="hidden" name="email" value="[[!+order.email]]">
    <input type="hidden" name="vatid" value="[[!+order.vatid]]">
        
    <input type="hidden" name="gender2" value="[[!+order.gender2]]">
    <input type="hidden" name="firstname2" value="[[!+order.firstname2]]">
    <input type="hidden" name="lastname2" value="[[!+order.lastname2]]">
    <input type="hidden" name="street2" value="[[!+order.street2]]">
    <input type="hidden" name="nr2" value="[[!+order.nr2]]">
    <input type="hidden" name="city2" value="[[!+order.city2]]">
    <input type="hidden" name="zip2" value="[[!+order.zip2]]">
    <input type="hidden" name="country2" value="[[!+order.country2]]">
    <input type="hidden" name="phone2" value="[[!+order.phone2]]">
    <input type="hidden" name="email2" value="[[!+order.email2]]">

    <fieldset>
        <legend>Wie möchten Sie bezahlen?</legend>
        [[!scPaymentMethods?
            &tpl=`ShopPaymentMethodRowChunk`
            &placeholderPrefix=`paymentmethod.`
            &filterMethod=`[[!+customer.paymentmethod]]`
            &selected=`[[!+order.paymentMethod]]`
            &delivery=`[[!+order.deliveryMethod]]`
            &zone=`[[!+order.country2]]`
        ]]
        <div class="next-step">
            <a href="[[~[[*parent]]]]" class="btn btn-default btn-round btn-colored pull-left ns-prev" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Adresse & Lieferung</a>
            <button type="submit" class="btn btn-default btn-round btn-colored pull-right ns-next">Prüfen & Bestellen <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
        </div>
    </fieldset>
</form>
````
