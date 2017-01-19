## The Cart Resource

```` html   
[[!FormItRetriever?
    &placeholderPrefix=`order.`
    &storeLocation=`session`
]]
<ol class="breadcrumb bc-checkout">
    <li class="active"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a></li>
    <li><i class="fa fa-truck" aria-hidden="true"></i> Delivery</li>
    <li><i class="fa fa-money" aria-hidden="true"></i> Payment</li>
    <li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Review</li>
    <li><i class="fa fa-check-circle-o" aria-hidden="true"></i> Finished</li>
</ol>
[[!FormIt?
    &submitVar=`checkout`
    &store=`1`
    &storeTime=`1500`
    &storeLocation=`session`
    &placeholderPrefix=`order.`
    &hooks=`redirect`
    &redirectTo=`[[!*id:scFirstChild]]`
]]
[[!scGetCart?
    &tpl=`CartChunk`
    &emptyTpl=`CartEmptyChunk`
    &rowTpl=`CartRowChunk`
    &vatRowTpl=`CartVatRowChunk`
    &loadProducts=`1`
    &cartPrefix=`cart.`
]]
````

### The CartChunk Template

```` html
<div class="legend">Your Cart</div>
<div class="shopping-cart">
    <form action="[[~[[*id]]]]" method="post">
        <input type="hidden" name="updatecart" value="1">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="sch-thumb">Image</th>
                        <th>Article Name</th>
                        <th class="sch-price">Single Price</th>
                        <th class="sch-quantity">Quantity</th>
                        <th class="sch-price">Price</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tfoot>
                    [[+cart.vat_rates]]
                    [[+cart.total.discount:notempty=`
                        <tr class="scf">
                            <td class="scf-info" colspan="4">
                                [[+cart.total.discount_percent_formatted]] discount (excl. VAT)
                            </td>
                            <td class="scf-sum">-&nbsp;[[+cart.total.discount_formatted]]</td>
                            <td>&nbsp;</td>
                        </tr>
                    `:isempty=``]]
                    [[+cart.total.coupons:notempty=`
                        <tr class="scf">
                            <td class="scf-info" colspan="4">
                                less coupon value
                            </td>
                            <td class="scf-sum">-&nbsp;&euro;&nbsp;[[+cart.total.price_ex_coupon:subtract=`[[+cart.total.price]]`:scNumberFormat=`d=2&ds=,&ts=.`]]</td>
                            <td>&nbsp;</td>
                        </tr>
                    `:isempty=``]]
                    <tr class="scf">
                        <td class="scf-info" colspan="4">
                            Total [[+cart.total.discount_percent:notempty=`<span class="text-success">([[+cart.total.discount_percent]]% discount)</span> `:isempty=``]]
                        </td>
                        <td class="scf-sum">[[+cart.total.price_formatted]]</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
                <tbody>
                    [[+cart.wrapper]]
                </tbody>
            </table>
        </div>
        <div class="pull-left">
             <small>All prices incl. VAT.</small>
        </div>
        <button type="submit" class="btn btn-default btn-round pull-right">Update Cart</button>
    </form>
</div>
[[!scCouponCode?
    &formTpl=`CouponFormChunk`
    &resultTpl=`CouponResultchunk`
    &redirectScheme=`https`
]]
<form action="[[~[[*id]]]]" method="post">
    <input type="hidden" name="checkout" value="1">
    <input type="hidden" name="checkoutprogress" value="1">
    [[!+order.checkoutprogress:is=`1`:then=`
        <input type="hidden" name="deliveryMethod" value="[[!+order.deliveryMethod]]">
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
        <input type="hidden" name="phone2" value="[[!+order.phone]]">
        <input type="hidden" name="email2" value="[[!+order.email]]">
    `:else=`
        <input type="hidden" name="gender" value="[[!+customer.gender]]">
        <input type="hidden" name="firstname" value="[[!+customer.firstname]]">
        <input type="hidden" name="lastname" value="[[!+customer.lastname]]">
        <input type="hidden" name="street" value="[[!+customer.street]]">
        <input type="hidden" name="nr" value="[[!+customer.nr]]">
        <input type="hidden" name="city" value="[[!+customer.city]]">
        <input type="hidden" name="zip" value="[[!+customer.zip]]">
        <input type="hidden" name="country" value="[[!+customer.country]]">
        <input type="hidden" name="phone" value="[[!+customer.phone]]">
        <input type="hidden" name="email" value="[[!+customer.email]]">
        <input type="hidden" name="vatid" value="[[!+customer.vatid]]">
            
        <input type="hidden" name="gender2" value="[[!+customer.gender2]]">
        <input type="hidden" name="firstname2" value="[[!+customer.firstname2]]">
        <input type="hidden" name="lastname2" value="[[!+customer.lastname2]]">
        <input type="hidden" name="street2" value="[[!+customer.street2]]">
        <input type="hidden" name="nr2" value="[[!+customer.nr2]]">
        <input type="hidden" name="city2" value="[[!+customer.city2]]">
        <input type="hidden" name="zip2" value="[[!+customer.zip2]]">
        <input type="hidden" name="country2" value="[[!+customer.country2]]">
        <input type="hidden" name="phone2" value="[[!+customer.phone]]">
        <input type="hidden" name="email2" value="[[!+customer.email]]">
    `]]
    <div class="next-step">
        [[!+cart.minimum_order_amount_reached:notempty=`
            <button type="submit" class="btn btn-default btn-round btn-colored pull-right ns-next">Address & Delivery <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
        `:isempty=`
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <b>Minimum order amount of [[!+cart.minimum_order_amount_formatted]] not reached!</b> 
            </div>
            <button type="button" class="btn btn-default btn-round btn-colored pull-right ns-next" disabled="disabled">Address & Delivery <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
        `]]        
    </div>
</form>
````


### The CartEmptyChunk Template

```` html   
<div class="shopping-cart">
    <form action="[[~[[*id]]]]" method="post">
        <input type="hidden" name="updatecart" value="true">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="sch-thumb">Image</th>
                        <th>Article Name</th>
                        <th class="sch-price">Single Price</th>
                        <th class="sch-quantity">Quantity</th>
                        <th class="sch-price">Price</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="sci-empty text-muted">
                            There are no articles in your cart.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="pull-left">
             <small>All prices incl. VAT.</small>
        </div>
        <button type="submit" class="btn btn-default btn-round btn-colored pull-right" disabled="disabled">Update Cart</button>
    </form>
</div>
````


### The CartRowChunk Template

```` html   
<tr class="sci">
    <td class="sci-thumb"><img src="[[+product.product_image:empty=`[[++shop_product_missing_img_placeholder]]`]]" alt="[[+product.pagetitle]]"></td>
    <td class="sci-name">
        <a href="[[~[[+product.id]]]]">
            [[+product.pagetitle]]<br>
            <small>Article-Number: [[+product.product_code]]</small>
        </a>
    </td>
    <td class="sci-price">[[+product.totals.price_formatted]]</td>
    <td class="sci-quantity">
		<div class="input-group product-quantity">
			<span class="input-group-btn" aria-hidden="true">
				<button type="button" class="btn btn-default btn-round" data-dir="dwn"><i class="fa fa-minus"></i></button>
			</span>
			<label for="quantity" class="sr-only">Quantity</label>
            <input type="text" class="form-control text-center" name="quantity&#91;[[+product.key]]&#93;" value="[[+product.totals.quantity]]">
			<span class="input-group-btn" aria-hidden="true">
				<button type="button" class="btn btn-default btn-round" data-dir="up"><i class="fa fa-plus"></i></button>
			</span>
		</div>                                        
    </td>
    <td class="sci-price">[[+product.totals.subtotal_formatted]]</td>
    <td class="sci-remove"><button type="submit" name="remove&#91;[[+product.key]]&#93;" value="true" class="shopping-cart-button pull-right"><i class="fa fa-trash-o" aria-hidden="true"></i><span class="sr-only">Remove</span></button></td>
</tr>
````


### The CartVatRowChunk Template

```` html   
<tr class="scf">
    <td class="scf-info" colspan="4">
        contains MWSt [[+vat.rate]]%
    </td>
    <td class="scf-sum">[[+vat.price_formatted]]</td>
    <td>&nbsp;</td>
</tr>
````


### The CouponFormChunk Template

```` html   
<form action="[[~[[*id]]]]" method="post" class="coupon-code">
    <fieldset>
        <legend>Redeem Counpons and Discount Codes</legend>
        [[+coupon.error.activate:notempty=`
            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Schlie&uuml;en"><span aria-hidden="true">×</span></button>
                [[+coupon.error.activate]]
            </div>
        `]]
        <div class="row">
            <div class="col-sm-6">
                <p>
                    If you own a coupon- or discount code, you can enter it here! You can only redeem on code per order!
                </p>
            </div>
            <div class="col-sm-6">
                <label for="couponcode">Counpons or Discount Codes</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="couponcode" name="couponcode">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-round">Redeem</button>
                    </span>
                </div>
            </div>
        </div>
    </fieldset>
</form>
````


### The CouponResultChunk Template

```` html   
<form action="[[~[[*id]]]]" method="post" class="coupon-code">
    <input type="hidden" name="coupon" value="remove">
    <fieldset>
        <legend>Coupon activated</legend>
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Schlie&uuml;en"><span aria-hidden="true">×</span></button>
            Your coupon- or discount code was activated successfully! 
        </div>
        <p class="cc-info pull-left">Couponcode [[+coupon.code]], [[+coupon.expires:notempty=`Valid through [[+coupon.expires:date=`%A %e %B %Y`]],`]] Value <span class="price">[[+coupon.discount_formatted]]</span></p>
        <button type="submit" class="btn btn-default btn-round pull-right">Remove</button>
    </fieldset>
</form>
````
