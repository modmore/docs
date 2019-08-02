Perhaps you would like to show a confirmation page with all order details before the customer is sent to the payment provider. This way the complete calculation including taxes and shipping costs can be shown properly. SimpleCart does not do this by default, but in a nutshell here's how to set this up:

1. Add a new resource "Confirmation" which contains a form with hidden inputs containing all of the order information.
2. On the Checkout resource, update the FormIt call to have the &store=`1` parameter and redirect to the Confirmation page.

## Checkout page

On the checkout page, which by default asks for the customer address and the preferred payment method, take out the scCreateOrder hook from the FormIt call. This makes sure that SimpleCart doesn't create the order right away.

Also add the &store parameter to get FormIt to temporarily store the form information until it is retrieved. This will allow the confirmation page to read the form information.

Finally, if you didn't have it yet, make sure the redirect hook is set and that it redirects to the confirmation page.

```` html   
[[!FormItRetriever? &redirectToOnNotFound=`[[*parent]]`]]

[[!FormIt?
    &submitVar=`checkout`
    &hooks=`spam,redirect`
    &redirectTo=`[[*id:scFirstChild]]`
    &store=`1`
    &storeTime=`1200`
    &validate=`nospam:blank,
        firstname:required,
        lastname:required,
        street:required,
        number:required,
        zip:required,
        city:required,
        country:required,
        email:email:required`
]]
````

## Confirmation Page

On the confirmation page you'll need to load the information from the checkout page with the FormItRetriever snippet, and add all that information to hidden input fields inside the form. You'll also need a FormIt call with the scCreateOrder hook which will send the user to the desired payment gateway, and/oor the thank you page.

Basically you're creating a [one-page checkout](https://modmore.com/simplecart/documentation/tutorials/one-page-checkout/) here, by collecting all information and then sending it to SimpleCart in one sweep.

Here's an example of what the confirmation page might look like.

```` html
[[!FormItRetriever? &redirectToOnNotFound=`[[*parent]]`]]

[[!FormIt?
    &submitVar=`doOrder`
    &hooks=`spam,scCreateOrder,redirect`
    &redirectTo=`[[*id:scFirstChild]]`
    &store=`1`
    
    &orderAddress=`address1:street,address2:number`
]]
<table >
  <thead>
    <tr>
        <th>Order Address</th>
        <th>Delivery Address</th>
    </tr>
  </thead>
  <tbody>
    <tr> 
        <td>
            [[!+fi.firstname]] [[!+fi.lastname]]<br>
            [[!+fi.street]] [[!+fi.number]]<br>
            [[!+fi.zip]] [[!+fi.city]]<br>
            [[!+fi.country]]
        </td>
        <td>
            Same as the order address
        </td>
    </tr>
  </tbody>
</table>

[[!scGetCart?
    &tpl=`cartOuterView`
    &rowTpl=`cartRowView`
]]

<form action="[[~[[*id]]]]" method="post" id="simplecartCheckout">
    <input type="hidden" name="nospam" value="" />
    <input type="hidden" name="doOrder" value="true" />
    <input type="hidden" name="deliveryMethod" value="[[!+fi.deliveryMethod]]" />
    <input type="hidden" name="paymentMethod" value="[[!+fi.paymentMethod]]" />
    
    <input type="hidden" name="firstname" value="[[!+fi.firstname]]" />
    <input type="hidden" name="lastname" value="[[!+fi.lastname]]" />
    <input type="hidden" name="street" value="[[!+fi.street]]" />
    <input type="hidden" name="number" value="[[!+fi.number]]" />
    <input type="hidden" name="zip" value="[[!+fi.zip]]" />
    <input type="hidden" name="city" value="[[!+fi.city]]" />
    <input type="hidden" name="country" value="[[!+fi.country]]" />
    <input type="hidden" name="email" value="[[!+fi.email]]" />
    <input type="hidden" name="vatnr" value="[[!+fi.vatnr]]" />
    
    <a href="[[~[[*parent]]]]">Previous step</a>
    <button type="submit">
        Place Order
    </button>
</form>
````