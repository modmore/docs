To make the checkout faster for your customers, you can choose to have a one-page checkout. This can be done with SimpleCart by submitting all the right values in one form, which is handled by the FormIt with the `scCreateOrder` hook. 

Start by showing the cart with your chunks:

```` html   
[[!scGetCart?
    &tpl=`myCartView`
    &rowTpl=`myCartViewRow`
]]
````

The chunks should not contain editing capabilities for the cart, so remove the delete and update quantity parts.

Next add a form with FormIt and all the input fields usually on the [cart](../Frontend/Cart) and [checkout](../Frontend/Checkout) pages. 

```` html   
[[!FormItRetriever? &redirectToOnNotFound=`[[*parent]]`]]

[[!FormIt?
    &store=`1`
    &hooks=`spam,scCreateOrder,redirect`
    &submitVar=`checkout`
    &redirectTo=`[[*id:scFirstChild]]`
    &validate=`nospam:blank,
        deliveryMethod:required,
        paymentMethod:required,
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
    <input type="hidden" name="nospam" value="">
````

Followed by all detail fields, like the address fields and the delivery and payment methods. 

```` html   
    [[!scGetDeliveryMethods]]
    
    [[!scGetPaymentMethods]]
    
    <div class="submit">
        <input type="submit" name="checkout" value="[[%simplecart.cart.checkout? &namespace=`simplecart` &topic=`cart`]]" />
    </div>
</form>
````   