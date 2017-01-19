## The Finished Resource

```` html   
<ol class="breadcrumb bc-checkout">
    <li><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</li>
    <li><i class="fa fa-truck" aria-hidden="true"></i> Delivery</li>
    <li><i class="fa fa-money" aria-hidden="true"></i> Payment</li>
    <li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Review</li>
    <li class="finished"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Finished</li>
</ol>
[[!scFinishOrder?
    &redirectToOnNotFound=`24`
    &placeholderPrefix=`order.`
    &orderSuccess=`CheckoutOrderSuccessChunk`
    &orderFailed=`CheckoutOrderFailedChunk`
    &postHooks=`SimplePortOrderFinishedHook`
]]
````
