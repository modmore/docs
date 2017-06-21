---
title: Enforce Stock Levels
---

The EU Vat Module is shipped with the Commerce core. It needs to be enabled before use via Configuration > Modules. 

When enabled, the EU VAT Rate Provider is available to use in your [Tax Rules](../../Taxes).

The EU VAT Rate Provider is used to apply a VAT rate for the customer's country to all items in the cart. It retrieves the current VAT rates from [jsonvat.com](https://jsonvat.com/) and caches them for 3 days. 

## Properties

These properties are set on a tax rule, not on the module itself.

- **Applied Tax Rate**: which rate to use. For most types of products you'll need the _Standard Rate_, but exempted products may use a different rate. Not all countries have all of the rates available in the dropdown.
- **Use Reverse Charge Mechanism?**: check this to use the _Reverse Charge Mechanism_, see below.
- **Reverse Charge Exception Countries**: a comma separated list of country codes where the reverse charge mechanism should not be applied, usually the countries where the merchant has an office. 

## Reverse Charge Mechanism

Within the European Union there is regulation that allows the so-called _Reverse Charge_ when it comes to taxes. Usually this mechanism allows charging a 0% tax rate under the following conditions:

- The merchant and customer are not in the same country.
- The merchant and customer are both located in the European Union.
- The merchant and customer both have a valid VAT registration and pay VAT in their country. Use the [EU VAT Validator module](../Address_Validation/EUVat_Validator) to validate VAT registration numbers. 

**Please verify this information with your local tax office.** Specific rules on the type of goods/services that are allowed/exempted, and additional requirements may differ per country.
