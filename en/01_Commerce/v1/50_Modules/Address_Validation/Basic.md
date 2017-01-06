---
title: Basic Address Validation
---

Generic address validation for the checkout. It's strongly recommended to enable this module (or another address validation module more specific to your needs) to make sure customer addresses are validated. Without any enabled validation modules Commerce does not do ANY validation on the address.

For every specified field the module will make sure that its value is not empty. For the following fields the module also handle more specific validation:

- `email`: the module will make sure the email follows valid syntax according to PHP's filter_var validation. 
- `country`: the module will make sure the provided country code is a valid one. 

## Properties

- Required Fields (`required_fields`): Provide a comma separated list of fields that need to be validated. Each field will be checked if it is not empty, and for specific fields (like email and country) it will also run additional validations. Available fields: `fullname, firstname, lastname, company, address1, address2, address3, zip, city, state, country, phone, mobile, email, notes`.
