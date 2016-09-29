Within SimpleCart you have the ability to use multiple addresses for the order itself and the delivery of the goods.

## Checkout form setup

To use a separated delivery address in your shop you should keep in mind that all fields in the checkout form are submitted at the same time. As you probably can imagine, the field names cannot be the same for both address fields because on submit they will overwrite each other. A good setup for this is to use field prefixes. Let's dive into that.

Let's say you already have your order address fields named like; "firstname", "lastname", "street", "number", "zipcode", "city" and "country".  
Now you want to have the same fields for the delivery, but you cannot use those names again... Prefix them, for example, with; "delivery\_". In that case, your delivery fields will get names like; "delivery\_firstname", "delivery\_lastname", "delivery\_street" and so on.  
SimpleCart doesn't know those fields, and that's why you need to map the fields in your checkout form processor to let SimpleCart know the fields.

## Mapping the address fields

When you use other field names than SimpleCart knows about, then you need to map those fields into SimpleCart fields. The most easy thing to use, is using the same field names as SimpleCart does, then a mapping isn't necessary anymore. This is only required, if your [checkout form](https://www.modmore.com/simplecart/documentation/frontend/checkout/) has fields that cannot be parsed by SimpleCart automatically.

In SimpleCarts default checkout form (provided to you in the [scCheckoutForm](https://www.modmore.com/simplecart/documentation/chunks/sccheckoutform/) chunk), there are two fields which are not default to SimpleCart. Those having the names "street" and "number". Which representing the street name and the house number for the customers addres. In the same default chunk, there is also a mapping for that. Let's take a look;


```` html   
[[!FormIt?
    ...
    &orderAddress=`address1:street,address2:number`
    ...
]]
````  
 
As you can see, in this mapping parameter the fields "street" and "number" are mapped to SimpleCarts "address1" and "address2" fields. Multiple form fields can be separated by a comma. 

Mapping multiple checkout form fields into one SimpleCart field is very easy, just continue writing colon signs after each form field, like "address1:street:number". Each field will be added separated by a space.

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

## Using extra validation on FormIt

When your checkout form has (for example) a checkbox to let your customers decide whether or not to enter another delivery address, it can be useful to make FormIts validation work with that option too.


Let's say that you have a checkbox with the name `use_delivery_address`. This checkbox is provided with some fancy javascript (jQuery) code to toggle the visibility of the delivery address fields. When the checkbox is enabled, and the delivery fields become required, then you should have this validator too. 

[Find the requiredIf custom validator here](https://gist.github.com/bertoost/4000623) to get custom validator for FormIt to achieve extra validation on delivery fields. Create it as a normal snippet in your MODX install.

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
