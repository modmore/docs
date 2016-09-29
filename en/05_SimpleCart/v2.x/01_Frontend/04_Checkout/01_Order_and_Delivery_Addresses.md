Within SimpleCart you have the ability to use multiple addresses for the order itself and the delivery.

## Checkout form setup

To request the additional delivery address, you'll need to add some fields to the same checkout form. These fields typically use a prefix `delivery_`, so you get `delivery_firstname`, `delivery_lastname`, `delivery_street`, `delivery_number` and so on. 

As SimpleCart doesn't know what these fields are out of the box, you need to add them to the field mapping on the FormIt call. 

## Mapping the address fields

Without mapping the address fields, SimpleCart will treat new fields as [custom order fields](Custom_Order_Fields). 

In the default checkout form ([discussed here](../Checkout)), it uses two address fields which are mapped to a different field already. These are `street` and `number`, and the mapping for that looks like this:

```` html   
[[!FormIt?
    ...
    &orderAddress=`address1:street,address2:number`
    ...
]]
````  
 
As you can see, in this mapping parameter the fields "street" and "number" are mapped to SimpleCarts "address1" and "address2" fields. Multiple form fields can be separated by a comma. 

Mapping multiple checkout form fields into one SimpleCart field is also possible by adding additional fields after a colon, for example `address1:street:number`. Each field will be added separated by a space.

The mapping key for the delivery address is done the same way, but with `&deliveryAddress`. For example:


```` html   
[[!FormIt?
    ...
    &orderAddress=`address1:street,address2:number`
    &deliverAddress=`firstname:delivery_firstname,lastname:delivery_lastname,address1:delivery_street,address2:delivery_number,...`
    ...
]]
````   

In this delivery mapping you need to map every single delivery field. 

## Available address fields

Below a list of all available address fields in SimpleCart which can be used in your checkout form.

- `salutation` Used to store the salutation of the customer
- `name` Used to store a fullname of the customer (required if not using firstname and lastname)
- `firstname` Used to store the firstname of the customer (required if not using fullname) 
- `lastname` Can be used to store the lastname of the customer
- `company` Can be used to store the company name in
- `address1` A mixed field for the first address line of the customer (required)
- `address2` A mixed field for the second address line of the customer
- `address3` A mixed field for the second address line of the customer
- `zip` Use this field to store the zip/postal code of the customer (required)
- `city` Use this field to store the city name of the customer (required)
- `state` Can be used to store the customers state or province name
- `country` Use this field to store the customers country name (or code) in
- `phone` The general phone number field
- `mobile` An optional mobile phone number field
- `email` The customers email address field (required)

## Conditional validation

For use cases where you have a checkbox to allow a user to enter a different delivery address, you'll need a conditional validator. [You can find a custom requiredIf validator here](https://gist.github.com/bertoost/4000623), to use that add it to MODX as a snippet. 

Here's an example of how you would use the requiredIf validator to only validate delivery fields if a checkbox `use_delivery_address` has a non-empty value. 

```` html   
[[!FormIt?
    ...
    &customValidators=`requiredIf`
    &validate=`...
        delivery_firstname:requiredIf=^use_delivery_address^
        delivery_lastname:requiredIf=^use_delivery_address^
        delivery_street:requiredIf=^use_delivery_address^
        ...`
    ...
]]
````   
