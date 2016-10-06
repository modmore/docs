You can add input types to the add to cart form, which will be automatically stored in the custom fields on a product. 

When calling the [scGetCart Snippet](../Snippets/scGetCart) snippet, custom fields are processed through the scCartRowField chunk as specified in the `&rowFieldTpl` property.

To provide cleaner labels, you can add lexicon entries to MODX based on the field name. 

## Available placeholders

- `[[+key]]` The key of the field. This the same as the `name` attribute of your input on the add to cart form.
- `[[+label]]` The label for the field, which will be loaded from a lexicon if possible.
- `[[+value]]` The value that was provided by the customer for the custom field.
- `[[+total]]` The number of field values that are set on this custom field.
- `[[+first]]` Set to 1 if this is the first field value, empty otherwise.
- `[[+last]]` Set to 1 if this is the last field value, empty otherwise.

## Custom Field Labels

The custom field labels are based on the field key (the name of the field). SimpleCart tries to find a MODX Lexicon with the name `simplecart.cart.custom.{key}`. 

If you'd like to provide a different label in the manager, you can create a lexicon with the key `simplecart.orderdetails.custom.{key}`.

**For example**: Let's say you have a field with the name `my_custom_field`. This will be seen as the key for your custom field. The lexicon key to create would then be `simplecart.cart.custom.my_custom_field`, and the value of that lexicon entry would be the shown label. For a different label in the manager, the lexicon key needs to be `simplecart.orderdetails.custom.my_custom_field`.

## Default scCartRowField chunk

```` html
[[+first:notempty=`<br />`]]
- <strong>[[+label:isempty=`[[+key]]`]]</strong>: [[+value:nl2br]]
[[+last:notempty=``:isempty=`<br />`]]
````