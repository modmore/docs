## The Delivery Resource

```` html   
[[!FormItRetriever?
    &placeholderPrefix=`order.`
    &storeLocation=`session`
    &redirectToOnNotFound=`[[*parent]]`
]]
<ol class="breadcrumb bc-checkout">
    <li><a href="[[~15]]"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>
    <li class="active"><i class="fa fa-truck" aria-hidden="true"></i> Delivery</li>
    <li><i class="fa fa-money" aria-hidden="true"></i> Payment</li>
    <li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Review</li>
    <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> Finished</li>
</ol>
<div class="legend">Payment- and Delivery Address</div>
<p class="lead">
    Ihre Rechnungs- und Lieferadresse wurde bereits aus Ihrem Kundenprofil übernommen. Sie können 
    jedoch die Adressdaten für den aktuellen Bestellvorgang anpassen. Die hier vorgenommenen Änderungen 
    werden nicht in Ihrem Kundeprofil gespeichert!
</p>
<div class="row">
    <div class="col-md-6 margin-bottom20">
        <div class="checkout-address-label">
            <strong>Rechnungsadresse</strong>
            <span>
                [[!+order.firstname]] [[!+order.lastname]], [[!+order.street]] [[!+order.nr]], [[!+order.zip]] [[!+order.city]], [[!+order.country]]
            </span>
            <a href="#order-payment-address" role="button" class="btn btn-default btn-xs checkout-address-edit" data-toggle="modal" data-target="#order-payment-address">Rechnungsadresse anpassen</a>
        </div>
    </div>
    <div class="col-md-6 margin-bottom40">
        <div class="checkout-address-label">
            <strong>Lieferadresse</strong>
            <span>
                [[!+order.firstname2]] [[!+order.lastname2]], [[!+order.street2]] [[!+order.nr2]], [[!+order.zip2]] [[!+order.city2]], [[!+order.country2]]
            </span>
            <a href="#order-delivery-address" role="button" class="btn btn-default btn-xs checkout-address-edit" data-toggle="modal" data-target="#order-delivery-address">Lieferadresse anspassen</a>
        </div>
    </div>
</div>

<!-- Modal: edit payment address -->
[[!FormIt?
    &submitVar=`changePaymentaddress`
    &clearFieldsOnSuccess=`0`
    &store=`1`
    &storeTime=`1500`
    &storeLocation=`session`
    &validate=`
        gender:required,
        firstname:required,
        lastname:required,
        street:required,
        nr:required,
        city:required,
        zip:required,
        country:required,
        email:email:required`
    &placeholderPrefix=`order.`
]]
<div class="modal fade" id="order-payment-address" tabindex="-1" role="dialog" aria-labelledby="order-payment-address-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="[[~[[*id]]]]" method="post" class="form-horizontal">
                <input type="hidden" name="changePaymentaddress" value="1">
                <input type="hidden" name="checkoutprogress" value="1">

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

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="order-payment-address-label">Rechnungsadresse bearbeiten</h4>
                </div>
                <div class="modal-body">
                    <!--
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <p class="bg-danger text-danger msg-box">Fehlende oder falsche Eingabe. Bitte überprüfen Sie die hervorgehobenen Formularfelder.</p>
                        </div>
                    </div>
                    -->
                    <fieldset>                                        
                        <div class="form-group[[!+order.error.gender:notempty=` has-error`]]">
                            <label for="gender" class="col-sm-3 control-label">
                                Anrede
                            </label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-2 col-sm-3 col-xs-4">
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="0" [[!+order.gender:is=`0`:then=`selected="selected"`]]>Firma</option>
                                            <option value="1" [[!+order.gender:is=`1`:then=`selected="selected"`]]>Herr</option>
                                            <option value="2" [[!+order.gender:is=`2`:or:is=``:then=`selected="selected"`]]>Frau</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.firstname:notempty=` has-error`]]">
                            <label for="firstname" class="col-sm-3 control-label">
                                Vorname[[!+order.error.firstname:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.firstname]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="firstname" id="firstname" value="[[!+order.firstname]]" placeholder="Vorname" required="required">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.lastname:notempty=` has-error`]]">
                            <label for="lastname" class="col-sm-3 control-label">
                                Nachname[[!+order.error.lastname:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.lastname]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lastname" id="lastname" value="[[!+order.lastname]]" placeholder="Nachname" required="required">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.company:notempty=` has-error`]]">
                            <label for="company" class="col-sm-3 control-label">
                                Firmenname <small>(Optional)</small>[[!+order.error.company:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.company]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="company" id="company" value="[[!+order.company]]" placeholder="Firmenname">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.street:notempty=` has-error`]]">
                            <label for="street" class="col-sm-3 control-label">
                                Adresse[[!+order.error.street:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.street]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" name="street" id="street" value="[[!+order.street]]" placeholder="Straße" required="required">
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" name="nr" id="nr" value="[[!+order.nr]]" placeholder="Stock/Tür/Nr." required="required">
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.city:notempty=` has-error`]]">
                            <label for="city" class="col-sm-3 control-label">
                                Stadt[[!+order.error.city:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.city]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="city" id="city" value="[[!+order.city]]" placeholder="Stadt" required="required">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.zip:notempty=` has-error`]]">
                            <label for="zip" class="col-sm-3 control-label">
                                PLZ[[!+order.error.zip:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.zip]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="zip" id="zip" value="[[!+order.zip]]" placeholder="Postleitzahl" required="required">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.country:notempty=` has-error`]]">
                            <label for="country" class="col-sm-3 control-label">
                                Land</small>[[!+order.error.country:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.country]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="country" id="country">
                                    <option value="" [[!+order.country:is=``:then=`selected="selected"`]]>Land wählen</option>
                                    <optgroup label="Zulässige Länder">
                                        <option value="AT" [[!+order.country:is=`AT`:then=`selected="selected"`]]>Österreich</option>
                                        <option value="DE" [[!+order.country:is=`DE`:then=`selected="selected"`]]>Deutschland</option>
                                        <option value="CH" [[!+order.country:is=`CH`:then=`selected="selected"`]]>Schweiz</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.phone:notempty=` has-error`]]">
                            <label for="phone" class="col-sm-3 control-label">
                                Telefonnummer <small>(Optional)</small>[[!+order.error.phone:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.phone]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" id="phone" value="[[!+order.phone]]" placeholder="Telefonnummer" aria-describedby="phoneHelpBlock">                        
                                <small id="phoneHelpBlock" class="help-block">Wird für eventuelle Rückfragen benötigt.</small>
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.email:notempty=` has-error`]]">
                            <label for="email" class="col-sm-3 control-label">
                                Email Adresse[[!+order.error.email:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.email]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email" value="[[!+order.email]]" placeholder="Email Adresse" required="required">
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.vatid:notempty=` has-error`]]">
                            <label for="vatid" class="col-sm-3 control-label">
                                UID Nummer <small>(Optional)</small>[[!+order.error.vatid:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.vatid]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="vatid" id="vatid" value="[[!+order.vatid]]" placeholder="UID Nummer" aria-describedby="vatidHelpBlock">                        
                                <small id="vatidHelpBlock" class="help-block">Falls vorhanden, die Umsatzsteuer-Identifikations-Nummer Ihres Unternehmens (UID). Wird auf Rechnungen angeführt.</small>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-round btn-primary">Änderungen speichern</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /Modal: edit payment address -->

<!-- Modal: edit delivery address -->
[[!FormIt?
    &submitVar=`changeDeliveryAddress`
    &store=`1`
    &storeTime=`1500`
    &storeLocation=`session`
    &clearFieldsOnSuccess=`0`
    &validate=`
        gender2:required,
        firstname2:required,
        lastname2:required,
        street2:required,
        nr2:required,
        city2:required,
        zip2:required,
        country2:required,
        email2:email:required`
    &placeholderPrefix=`order.`
]]
<div class="modal fade" id="order-delivery-address" tabindex="-1" role="dialog" aria-labelledby="order-delivery-address-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="[[~[[*id]]]]" method="post" class="form-horizontal">
                <input type="hidden" name="changeDeliveryAddress" value="1">
                <input type="hidden" name="checkoutprogress" value="1">

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
        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="order-delivery-address-label">Lieferadresse bearbeiten</h4>
                </div>
                <div class="modal-body">
                    <!--
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <p class="bg-danger text-danger msg-box">Fehlende oder falsche Eingabe. Bitte überprüfen Sie die hervorgehobenen Formularfelder.</p>
                        </div>
                    </div>
                    -->
                    <fieldset>                                        
                        <div class="form-group[[!+order.error.gender2:notempty=` has-error`]]">
                            <label for="gender2" class="col-sm-3 control-label">
                                Anrede
                            </label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-2 col-sm-3 col-xs-4">
                                        <select class="form-control" name="gender2" id="gender2">
                                            <option value="0" [[!+order.gender2:is=`0`:then=`selected="selected"`]]>Firma</option>
                                            <option value="1" [[!+order.gender2:is=`1`:then=`selected="selected"`]]>Herr</option>
                                            <option value="2" [[!+order.gender2:is=`2`:or:is=``:then=`selected="selected"`]]>Frau</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.firstname2:notempty=` has-error`]]">
                            <label for="firstname2" class="col-sm-3 control-label">
                                Vorname[[!+order.error.firstname2:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.firstname2]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="firstname2" id="firstname2" value="[[!+order.firstname2]]" placeholder="Vorname" required="required">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.lastname2:notempty=` has-error`]]">
                            <label for="lastname2" class="col-sm-3 control-label">
                                Nachname[[!+order.error.lastname2:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.lastname2]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lastname2" id="lastname2" value="[[!+order.lastname2]]" placeholder="Nachname" required="required">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.company2:notempty=` has-error`]]">
                            <label for="company2" class="col-sm-3 control-label">
                                Firmenname <small>(Optional)</small>[[!+order.error.company2:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.company2]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="company2" id="company2" value="[[!+order.company2]]" placeholder="Firmenname">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.street2:notempty=` has-error`]]">
                            <label for="street2" class="col-sm-3 control-label">
                                Adresse[[!+order.error.street2:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.street2]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" name="street2" id="street2" value="[[!+order.street2]]" placeholder="Straße" required="required">
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" name="nr2" id="nr2" value="[[!+order.nr2]]" placeholder="Stock/Tür/Nr." required="required">
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.city2:notempty=` has-error`]]">
                            <label for="city2" class="col-sm-3 control-label">
                                Stadt[[!+order.error.city2:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.city2]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="city2" id="city2" value="[[!+order.city2]]" placeholder="Stadt" required="required">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.zip2:notempty=` has-error`]]">
                            <label for="zip2" class="col-sm-3 control-label">
                                PLZ[[!+order.error.zip2:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.zip2]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="zip2" id="zip2" value="[[!+order.zip2]]" placeholder="Postleitzahl" required="required">                        
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.country2:notempty=` has-error`]]">
                            <label for="country" class="col-sm-3 control-label">
                                Land</small>[[!+order.error.country2:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+checkout.error.country2]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="country2" id="country2">
                                    <option value="" [[!+order.country2:is=``:then=`selected="selected"`]]>Land wählen</option>
                                    <optgroup label="Zulässige Länder">
                                        <option value="AT" [[!+order.country2:is=`AT`:then=`selected="selected"`]]>Österreich</option>
                                        <option value="DE" [[!+order.country2:is=`DE`:then=`selected="selected"`]]>Deutschland</option>
                                        <option value="CH" [[!+order.country2:is=`CH`:then=`selected="selected"`]]>Schweiz</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.phone2:notempty=` has-error`]]">
                            <label for="phone2" class="col-sm-3 control-label">
                                Telefonnummer <small>(Optional)</small>[[!+order.error.phone2:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.phone2]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone2" id="phone2" value="[[!+order.phone2]]" placeholder="Telefonnummer" aria-describedby="phoneHelpBlock">                        
                                <small id="phoneHelpBlock" class="help-block">Wird für eventuelle Rückfragen benötigt.</small>
                            </div>
                        </div>
                        <div class="form-group[[!+order.error.email2:notempty=` has-error`]]">
                            <label for="email2" class="col-sm-3 control-label">
                                Email Adresse[[!+order.error.email2:notempty=` <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><small class="field-msg">[[!+order.error.email2]]</small>`]]
                            </label>
                            <div class="col-sm-9">
                                <input type="email2" class="form-control" name="email2" id="email2" value="[[!+order.email2]]" placeholder="Email Adresse" required="required">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-round" data-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-round btn-primary">Änderungen speichern</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /Modal: edit delivery address -->

[[!FormIt?
    &submitVar=`checkout`
    &store=`1`
    &storeTime=`1500`
    &storeLocation=`session`
    &hooks=`redirect`
    &redirectTo=`[[*id:scFirstChild]]`
]]
<form action="[[~[[*id]]]]" method="post" class="delivery-method">
    <input type="hidden" name="checkout" value="1">
    <input type="hidden" name="checkoutprogress" value="1">
    
    <!-- deliveryMethod value is set by scDeliveryMethods snippet -->
    <input type="hidden" name="paymentMethod" value="[[!+order.paymentMethod]]">

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
        <legend>Auswahl der Liefermethode</legend>
        [[!scDeliveryMethods?
            &tpl=`ShopDeliveryMethodRowChunk`
            &placeholderPrefix=`deliverymethod.`
            &zone=`[[!+order.country2]]`
            &selected=`[[!+order.deliveryMethod]]`
        ]]
        <div class="next-step">
            <a href="[[~[[*parent]]]]" role="button" class="btn btn-default btn-round btn-colored pull-left ns-prev"><i class="fa fa-arrow-left" aria-hidden="true"></i> Warenkorb</a>
            <button type="submit" class="btn btn-default btn-round btn-colored pull-right ns-next">Bezahlung <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
        </div>

    </fieldset>
</form>
````
