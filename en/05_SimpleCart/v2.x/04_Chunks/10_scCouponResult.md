The scCouponResult chunk is used by the [scCouponCode Snippet](../Snippets/scCouponCode) snippet when a coupon code was added to the order successfully.

## Default scCouponResult chunk

```` html
<div id="sccoupon" class="result">
    <h2>[[%simplecart.coupon.activated]]</h2>
    <ul>
        <li>[[%simplecart.coupon.code]]: [[+coupon.code]]</li>
        [[+coupon.expires:notempty=`<li>[[%simplecart.coupon.validto? &date=`[[+coupon.expires:date=`%A %e %B %Y`]]`]]</li>`]]
        <li>[[%simplecart.coupon.value]]: [[+coupon.discount_formatted]] [[+coupon.percent:notempty=`([[+coupon.percent]]%)`:isempty=``]]</li>
        <li><a href="[[~[[*id]]? &coupon=`remove`]]">[[%simplecart.coupon.remove]]</a></li>
    </ul>
</div>
````