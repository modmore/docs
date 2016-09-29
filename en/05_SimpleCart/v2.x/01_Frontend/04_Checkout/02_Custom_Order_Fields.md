With custom order fields you can add arbitrary information to an order. SimpleCart will automatically store any submitted values it doesn't know as a custom order field. 

To give an example, you might add something like this to the [Checkout form](../Checkout): 

````
    <label>Your reference:</label>
    <input type="text" name="reference" value="[[!+fi.reference]]">
    [[!+fi.error.reference]]
````

When the customer checks out, they will fill in that value, and it will be stored with the order.

## Custom fields in Emails

In emails you can access the custom fields with the `[[+name_of_custom_field]]` placeholder, for example like this for the sample above:

```` html
[[+reference:notempty=`<p><strong>Your reference:</strong> [[+reference:htmlent]]`]]
````

## Custom fields on My Orders page

When you have a [My Orders page](My_Orders) page where the user can look back previous orders, you can access custom fields through the `[[+order.name_of_custom_field]]` placeholder, for example `[[+order.reference:htmlent]]`.

## Ignoring fields

All form fields that are submitted but not recognised as core or mapped fields will be stored as a custom order field. If there are fields you do not wish to store with the order, you can add it to the `&excludeFields` property on the FormIt snippet. This can be a comma separated list. For example:

```` html
[[!FormIt?
...
    &excludeFields=`agreed,otherfield,another_field,etc`
...
]]
````


