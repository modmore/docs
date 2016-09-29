If you're following the structure described [on the cart page](../Cart), you'll see we've now reached the middle resource: Checkout. 

On the checkout page, the user is asked to enter their personal billing and shipping information, as well as the payment method they wish to use. 

[ ![The recommended tree structur for your checkout process](https://assets.modmore.com/uploads/2015/12/tree_structure_setup_1.png)](https://assets.modmore.com/uploads/2015/12/tree_structure_setup_1.png "The recommended tree structur for your checkout process")

On the checkout page you can use the standard scCheckoutForm chunk, which contains a number of snippet calls and forms, or you can duplicate it if you would like to make changes. **The scCheckoutForm is overwritten on upgrade**, so don't edit it directly.  

```` html   
[[$scCheckoutForm]]
````

You can place the chunk call in a special checkout template, or directly in the content of the Checkout resource. 

## The scCheckoutForm chunk

Below is the standard content of the scCheckoutForm chunk. 

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

## FormIt

As you may notice, this chunk depends on FormIt. We're not currently planning to rewrite this to work independently (this was previously announced before modmore took over SimpleCart).

If needed you can add additional validation and hooks to the formIt call to suit your requirements. Most importantly, keep the `scCreateOrder` hook in the list. The scCreateOrder hook will typically handle redirecting the user to either the payment provider or the thank you page. 

Let's take a look at the FormIt call. 

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
````
 
First existing information is loaded from the [cart page](../Cart) with FormItRetriever.

When the page is submitted, FormIt is instructed to once again store the information temporarily for use on the Thank You page. A couple of hooks are executed, including the `scCreateOrder` hook that handles the creation of the order. 

The `&validate` allows you to control validation on the form. Different places in the world may have different requirements so you're in control of those. 

Another important property is `&orderAddress`. This is used to map form values to SimpleCart fields if they do not share the same name. As you can see in the example, we expect form fields with the names **street** and **number**, but SimpleCart uses **address1**, **address2** and **address3**. To tell SimpleCart which of the fields is belongs to which field, we should apply this mapping. The format is simple:

```` html   
&orderAddress=`simplecart_field:form_field,simplecart_field2:form_field2`
````   

## Using different addresses for billing / delivery

To add separate options for a billing or delivery address, you can add additional fields to the form. [Read more about order and delivery addresses here](Order_and_Delivery_Addresses).

## Exclude fields from custom order fields

Submitted fields that SimpleCart does not know and which are also not mapped to existing fields will be stored automatically as [custom order fields](Custom_Order_Fields). 

If you don't want this, you can exclude these fields with the `&excludeFields` property. 

```` html   
[[!FormIt?
    ...
    &excludeFields=`the_field_name1,the_field_name2...`
    ...
]]
````   
Multiple field names can be separated with a comma.

##  Payment method selection

The checkout form is also where the payment method is chosen. With the [scPaymentMethods snippet](../../Snippets/scPaymentMethods) you can show the configured payment methods to the user. 

```` html   
[[!scPaymentMethods]]
````   

If you only have a single payment method, or have a different way of determining how the user will checkout, just add a hidden input type to the form with the name `paymentMethod` and the ID of the payment method as its value. For example:

```` html   
<input type="hidden" name="paymentMethod" value="2">
````

You can [find out which payment methods are available for SimpleCart here](../../Payment_Methods).