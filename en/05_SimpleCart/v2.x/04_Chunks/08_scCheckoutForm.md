The Checkout Form is used for the [Checkout page](../Frontend/Checkout).

## Default scCheckoutForm chunk

```` html
[[!FormItRetriever? &redirectToOnNotFound=`[[*parent]]`]]

[[!FormIt?
    &store=`1`
    &storeTime=`1200`
    &hooks=`spam,scCreateOrder,redirect`
    &submitVar=`doOrder`
    &redirectTo=`[[*id:scFirstChild]]`
    &validate=`nospam:blank,
        firstname:required,
        lastname:required,
        street:required,
        number:required,
        zip:required,
        city:required,
        country:required,
        email:email:required`
    &orderAddress=`address1:street,address2:number`
]]

<form action="[[~[[*id]]]]" method="post" id="simplecartCheckout">
    <input type="hidden" name="nospam" value="" />
    <input type="hidden" name="doOrder" value="true" />
    <input type="hidden" name="deliveryMethod" value="[[+fi.deliveryMethod]]" />

    <div>
        <label for="checkout_firstname">[[%simplecart.orderdetails.address.firstname? &namespace=`simplecart`]]: <span>*</span></label>
        <input type="text" name="firstname" id="checkout_firstname" value="[[+fi.firstname]]" />
        <label class="error">[[+fi.error.firstname]]</label>
    </div>

    <div>
        <label for="checkout_lastname">[[%simplecart.orderdetails.address.lastname]]: <span>*</span></label>
        <input type="text" name="lastname" id="checkout_lastname" value="[[+fi.lastname]]" />
        <label class="error">[[+fi.error.lastname]]</label>
    </div>

    <div>
        <label for="checkout_street">[[%simplecart.orderdetails.address.street]]: <span>*</span></label>
        <input type="text" name="street" id="checkout_street" value="[[+fi.street]]" />
        <label class="error">[[+fi.error.street]]</label>
    </div>

    <div>
        <label for="checkout_number">[[%simplecart.orderdetails.address.number]]: <span>*</span></label>
        <input type="number" name="number" id="checkout_number" value="[[+fi.number]]" />
        <label class="error">[[+fi.error.number]]</label>
    </div>

    <div>
        <label for="checkout_zip">[[%simplecart.orderdetails.address.zip]]: <span>*</span></label>
        <input type="text" name="zip" id="checkout_zip" value="[[+fi.zip]]" />
        <label class="error">[[+fi.error.zip]]</label>
    </div>

    <div>
        <label for="checkout_city">[[%simplecart.orderdetails.address.city]]: <span>*</span></label>
        <input type="text" name="city" id="checkout_city" value="[[+fi.city]]" />
        <label class="error">[[+fi.error.city]]</label>
    </div>

    <div>
        <label for="checkout_country">[[%simplecart.orderdetails.address.country]]: <span>*</span></label>
        <input type="text" name="country" id="checkout_country" value="[[+fi.country]]" />
        <label class="error">[[+fi.error.country]]</label>
    </div>

    <div>
        <label for="checkout_email">[[%simplecart.orderdetails.address.email]]: <span>*</span></label>
        <input type="email" name="email" id="checkout_email" value="[[+fi.email]]" />
        <label class="error">[[+fi.error.email]]</label>
    </div>

    [[!scPaymentMethods? &delivery=`[[+fi.deliveryMethod]]`]]

    <div class="submit">
        <input type="submit" value="[[%simplecart.cart.checkout? &namespace=`simplecart` &topic=`cart`]]" />
    </div>

</form>

````