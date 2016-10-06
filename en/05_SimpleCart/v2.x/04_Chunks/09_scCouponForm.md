The scCouponForm chunk is used by the [scCouponCode Snippet](../Snippets/scCouponCode) snippet to enter and validate coupon codes. 

## Default coupon form chunk

```` html
<div id="sccoupon" class="form">
  [[+coupon.error.activate:notempty=`<p class="error">[[+coupon.error.activate]]</p>`]]
  <form action="[[~[[*id]]]]" method="post" id="form_activatecoupon">
    <div>
      <label for="couponcode">[[%simplecart.coupon.code]]</label>
      <input type="text" id="couponcode" name="couponcode" />
    </div>
    <div class="submit">
      <input type="submit" value="[[%simplecart.coupon.activate]]" />
    </div>
  </form>
</div>
````