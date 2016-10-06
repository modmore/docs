The Payment Method chunk is being used by the [scGetCart Snippet](../Snippets/scGetCart) 

## Default scPaymentMethod chunk

```` html
<div class="payment-item">
  <input type="radio" name="[[+method.paymentKey]]" value="[[+method.id]]" id="payment-[[+method.id]]" [[+method.selected:notempty=`checked="checked"`]] />
  <label for="payment-[[+method.id]]">[[+method.title]]</label>
  <ul>
    [[+method.description:notempty=`<li class="name">[[+method.description]]</li>`]]
	[[+method.addContent:notempty=`<li class="addContent">[[+method.addContent]]</li>`]]
    [[+method.price_add:notempty=`<li class="contribution">[[%simplecart.methods.yourcontribution? &price=`[[+method.price_add_formatted]]`]]</li>`]]
    <li class="total">[[%simplecart.methods.total? &price=`[[+method.total_formatted]]`]]</li>
  </ul>
</div>
````