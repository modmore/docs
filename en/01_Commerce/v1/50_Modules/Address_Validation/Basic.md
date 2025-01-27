---
title: Basic Address Validation
---

Generic address validation for the checkout. It's strongly recommended to enable this module (or another address validation module more specific to your needs) to make sure customer addresses are validated. Without any enabled validation modules Commerce does not do ANY validation on the address.

For every specified field the module will make sure that its value is not empty. For the following fields the module also handle more specific validation:

- `email`: the module will make sure the email follows valid syntax according to PHP's filter_var validation.
- `country`: the module will make sure the provided country code is a valid one.

## Properties

- Required Fields (`required_fields`): Provide a comma separated list of fields that need to be validated. Each field will be checked if it is not empty, and for specific fields (like email and country) it will also run additional validations. Available fields: `fullname, firstname, lastname, company, address1, address2, address3, zip, city, state, country, phone, mobile, email, notes`.

> Commerce **ALWAYS** requires a **country** value to work with an order. You can hide the country field from the address template in the checkout if you only sell locally, but it must still be passed as a hidden input and we recommend keeping validation for the country enabled.

## Testing additional properties (v1.3+)

If you're specifying any additional fields that get stored into the address properties, for example like this:

```html
<div class="c-field {% if error_shipping_email2 %}error{% endif %}">
    <label for="address-shipping-email2">Email #2</label>
    <input type="text" name="address[shipping][properties][email2]" id="address-shipping-email2" value="{{ address_shipping_properties.email2 }}">
    {% if error_shipping_email2 %}<span class="c-field-error">{{ error_shipping_email2 }}</span>{% endif %}
</div>
```

then you can also ensure it is filled by adding `properties.email2` to the required_fields module configuration.

The error if it is not provided will be in `error_shipping_email2` or `error_billing_email2` (without the properties prefix), while the submitted value will be made available in case of invalid validation in `address_shipping_properties.email2` or `address_billing_properties.email2`.

This was added in Commerce 1.3.0.
