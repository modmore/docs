The scDeliveryMethods snippet is used for listing the different delivery methods that are available for an order. It is included in the [scCart](../Chunks/scCart) chunk, called by the [scGetCart Snippet](scGetCart).

[TOC]

## Standard Usage

````
[[!scDeliveryMethods]]
````

## Properties

The following properties are available on this snippet.

### deliveryKey

Default: `deliveryMethod`

The name of the POST parameter that contains the delivery method ID.

### paymentKey

Default: `paymentMethod`

### tpl 

Default: `scDeliveryMethod`

The name of a chunk to display each of the delivery methods with. [See the default chunk here](../Chunks/scDeliveryMethod). 

The available placeholders include:

- `[[+method.id]]` the ID of the method.
- `[[+method.name]]` the name of the delivery method, not to be confused with...
- `[[+method.title]]` the translated title of the delivery method.
- `[[+method.idx]]` the order of the delivery method (in the database, not necessarily the current result set).
- `[[+method.description]]` the translated description for the methos.
- `[[+method.selected]]` either empty or the string `selected` to indicate the current item should be selected. This is based on the `&selected` or `&selectedFirst` properties. 
- `[[+method.deliveryKey]]` contains the value of the `&deliveryKey` property.
- `[[+method.addContent]]` may contain additional content as dictated by the method. 
- `[[+method.price_add]]` contains the additional costs involved with the method. 

### filterMethod

Comma separated list of method IDs to limit the results to. 

### selected

The ID of a method to mark as selected. 

### selectedFirst

Default: `true`

Indicates if the first item should be selected by default. 

### outputSeparator

Default: `\n`

### placeholderPrefix

Default: `method.`
