## The Verify Resource

```` html   
[[!FormItRetriever?
    &placeholderPrefix=`order.`
    &storeLocation=`session`
    &redirectToOnNotFound=`[[*parent]]`
]]
<ol class="breadcrumb bc-checkout">
    <li><a href="[[~15]]"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>
    <li><a href="[[~133119]]"><i class="fa fa-truck" aria-hidden="true"></i> Delivery</a></li>
    <li><a href="[[~16]]"><i class="fa fa-money" aria-hidden="true"></i> Payment</a></li>
    <li class="active"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Review</li>
    <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> Finished</li>
</ol>
<div class="row">
    <div class="col-md-6 margin-bottom20">
        <div class="checkout-address-label">
            <strong>Rechnungsadresse</strong>
            <span>
                [[!+order.firstname]] [[!+order.lastname]], [[!+order.street]] [[!+order.nr]], [[!+order.zip]] [[!+order.city]], [[!+order.country]]
            </span>
        </div>
    </div>
    <div class="col-md-6 margin-bottom40">
        <div class="checkout-address-label">
            <strong>Lieferadresse</strong>
            <span>
                [[!+order.firstname2]] [[!+order.lastname2]], [[!+order.street2]] [[!+order.nr2]], [[!+order.zip2]] [[!+order.city2]], [[!+order.country2]]
            </span>
        </div>
    </div>
</div>
[[!scGetCart?
    &tpl=`CartViewChunk`
    &emptyTpl=`CartViewEmptyChunk`
    &rowTpl=`CartViewRowChunk`
    &vatRowTpl=`CartViewVatRowChunk`
    &loadProducts=`1`
    &cartPrefix=`cartview.`
]]
[[!FormIt?
    &submitVar=`checkout`
    &store=`1`
    &storeTime=`1500`
    &storeLocation=`session`
    &hooks=`scCreateOrder,redirect`
    &redirectTo=`[[*id:scFirstChild]]`
    &orderAddress=`
        salutation:order_salutation,
        firstname:order_firstname,
        lastname:order_lastname,
        address1:order_address1,
        address2:order_address2,
        city:order_city,
        zip:order_zip,
        country:order_country,
        phone:order_phone,
        email:order_email`
    &deliveryAddress=`
        salutation:delivery_salutation,
        firstname:delivery_firstname,
        lastname:delivery_lastname,
        address1:delivery_address1,
        address2:delivery_address2,
        city:delivery_city,
        zip:delivery_zip,
        country:delivery_country,
        phone:delivery_phone,
        email:delivery_email`
    &zone=`[[!+order.country2]]`
    &excludeFields=`checkout,checkoutprogress`
    &placeholderPrefix=`order.`
]]
<form action="[[~[[*id]]]]" method="post">
    <input type="hidden" name="checkout" value="1">
    <input type="hidden" name="checkoutprogress" value="1">
    
    <input type="hidden" name="deliveryMethod" value="[[!+order.deliveryMethod]]">
    <input type="hidden" name="paymentMethod" value="[[!+order.paymentMethod]]">

    <input type="hidden" name="order_salutation" value="[[!+order.gender]]">
    <input type="hidden" name="order_firstname" value="[[!+order.firstname]]">
    <input type="hidden" name="order_lastname" value="[[!+order.lastname]]">
    <input type="hidden" name="order_address1" value="[[!+order.street]]">
    <input type="hidden" name="order_address2" value="[[!+order.nr]]">
    <input type="hidden" name="order_city" value="[[!+order.city]]">
    <input type="hidden" name="order_zip" value="[[!+order.zip]]">
    <input type="hidden" name="order_country" value="[[!+order.country]]">
    <input type="hidden" name="order_phone" value="[[!+order.phone]]">
    <input type="hidden" name="order_email" value="[[!+order.email]]">
    <input type="hidden" name="vatid" value="[[!+order.vatid]]">
    
    <input type="hidden" name="delivery_salutation" value="[[!+order.gender2]]">
    <input type="hidden" name="delivery_firstname" value="[[!+order.firstname2]]">
    <input type="hidden" name="delivery_lastname" value="[[!+order.lastname2]]">
    <input type="hidden" name="delivery_address1" value="[[!+order.street2]]">
    <input type="hidden" name="delivery_address2" value="[[!+order.nr2]]">
    <input type="hidden" name="delivery_city" value="[[!+order.city2]]">
    <input type="hidden" name="delivery_zip" value="[[!+order.zip2]]">
    <input type="hidden" name="delivery_country" value="[[!+order.country2]]">
    <input type="hidden" name="delivery_phone" value="[[!+order.phone2]]">
    <input type="hidden" name="delivery_email" value="[[!+order.email2]]">

    <div class="form-group">
        <label for="order_comment">Ihre zusätzlichen Anmerkungen zur Bestellung</label>
        <textarea name="order_comment" id="order_comment" class="form-control" rows="3" aria-describedby="order_commentHelp"></textarea>
        <span id="order_commentHelp" class="help-block">Tragen Sie hier Informationen zu dieser Bestellung ein, die Sie uns gerne zukommen 
        lassen möchten! Bitte beachten Sie, dass es dadurch gegebenenfalls zu Verzögerungen im Versand der bestellten
        Artikel kommen kann.</span>
    </div>
    <div class="next-step">
        <a href="[[~[[*parent]]]]" class="btn btn-default btn-round btn-colored pull-left ns-prev" role="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Bezahlung</a>
        <button type="submit" class="btn btn-default btn-round btn-colored pull-right ns-next">Jetzt bestellen!</button>
    </div>
</form>
````
