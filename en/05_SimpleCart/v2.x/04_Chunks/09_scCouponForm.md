The Coupon Form chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) to process coupon codes

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