The scDeliveryMethod chunk is used by the [scDeliveryMethods Snippet](../Snippets/scDeliveryMethods) in its `&tpl` property. 

## Default scDeliveryMethod chunk

```` html
<div class="delivery-item">
  <input type="radio" name="[[+method.deliveryKey]]" value="[[+method.id]]" id="delivery-[[+method.id]]" [[+method.selected:notempty=`checked="checked"`]] />
  <label for="delivery-[[+method.id]]">[[+method.title]]</label>
  <ul>
    [[+method.description:notempty=`<li class="description">[[+method.description]]</li>`]]
    [[+method.addContent:notempty=`<li class="additional_content">[[+method.addContent]]</li>`]]
    [[+method.price_add:notempty=`<li class="distribution">[[%simplecart.methods.yourcontribution? &price=`[[+method.price_add_formatted]]`]]</li>`]]
    <li class="total">[[%simplecart.methods.total? &price=`[[+method.total_formatted]]`]]</li>
  </ul>
</div>
```` 