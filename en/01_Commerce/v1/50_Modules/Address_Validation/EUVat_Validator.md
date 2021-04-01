The EU VAT Validator module can be used to accept and validate EU VAT Registration Numbers as well as VAT Registration Numbers in the United Kingdom. This talks directly to the official [VIES Web Service from the European Union](http://ec.europa.eu/taxation_customs/vies/). As of Commerce v1.2.0-rc3, United Kingdom registration numbers are validated against the [HMRC VAT Registration API](https://developer.service.hmrc.gov.uk/api-documentation/docs/api/service/vat-registered-companies-api/1.0) and validation against VIES will no longer work.

When combined with the [EUVat module](../Taxes/EUVat) this can be used for the _Reverse Charge_ mechanism. See the EUVat documention for more information about that.

[TOC]

## Properties

For validation of VAT numbers in the European Union, no properties are needed.

For validation of VAT numbers in the United Kingdom, Commerce 1.2.0-rc3 required authentication with the [HMRC Developer Hub](https://developer.service.hmrc.gov.uk/api-documentation), while v1.2.0-rc4 allows unauthenticated access to the HMRC API. It is strongly recommended to use at least v1.2.0-rc4 to avoid the need for authentication as described in the section at the bottom of this page.

## Template Changes

In order to use the EU VAT Validator module, you'll need a field to the address with the key `vat_registration`. That's already included for you by default in `frontend/checkout/partial/billing-address-fields.twig`:

````
<div class="c-field {% if error_billing_vat_registration %}error{% endif %}">
    <label for="address-billing-vat-registration">{{ lex('commerce.vat_registration') }} <small>{{ lex('commerce.address.optional') }}</small></label>
    <input type="text" name="address[billing][properties][vat_registration]" id="address-billing-vat-registration" value="{{ address_billing_properties.vat_registration }}">
    {% if error_billing_vat_registration %}<span class="c-field-error">{{ error_billing_vat_registration }}</span>{% endif %}
</div>
````

Technically the VAT Registration belongs to the billing address, but if you've adjusted things so that the customer only sees the shipping address and want to accept it there instead, you may add the following in `frontend/checkout/partial/shipping-address-fields.twig` instead:

````
<div class="c-field {% if error_shipping_vat_registration %}error{% endif %}">
    <label for="address-shipping-company">{{ lex('commerce.vat_registration') }} <small>{{ lex('commerce.address.optional') }}</small></label>
    <input type="text" name="address[shipping][properties][vat_registration]" id="address-shipping-vat-registration" value="{{ address_shipping_properties.vat_registration }}">
    {% if error_shipping_vat_registration %}<span class="c-field-error">{{ error_shipping_vat_registration }}</span>{% endif %}
</div>
````

## HMRC Application & Credentials (Commerce v1.2.0-rc3 only)

> Note: Authentication for the HMRC API is only required in v1.2.0-rc3. It's recommended to upgrade to v1.2.0-rc4, which allows unauthenticated access after HMRC opened the API.

HMRC requires VAT number verification requests to be authenticated, so you'll need to [start by registering a developer account or signing in to the HMRC Developer Hub](https://developer.service.hmrc.gov.uk/api-documentation).

[In your account](https://developer.service.hmrc.gov.uk/developer/applications), choose to either create a Sandbox or Production application. For testing purposes, the sandbox can be used immediately while the production usage requires HMRC approval.

For sandbox credentials:

1. Choose "[Add an application to the sandbox](https://developer.service.hmrc.gov.uk/developer/applications/add/sandbox)" in the menu. Enter a name.
2. When asked which APIs you want to use, find "Check a UK VAT Number" and enable 1.0(Beta). At the bottom click Add your application.
3. Click "View application credentials" and continue through the next step. C
4. Copy the Client ID when shown, storing it somewhere safe or directly copying it into the Commerce module. Click continue.
5. Click "Generate a client secret". The secret is only provided once. Copy it and store it somewhere safe. Paste it into the Commerce module.
6. In the module configuration, make sure to enable the **Use Sandbox** checkbox.
7. Use [mock VAT registration numbers provided by HMRC on GitHub](https://github.com/hmrc/vat-registered-companies-api/blob/master/public/api/conf/1.0/test-data/vrn.csv) in your testing.

For production credentials:

1. Choose "[Get production credentials](https://developer.service.hmrc.gov.uk/developer/applications/add/production)" in the menu. Enter a name.
2. You're presented with a checklist of things to do. Go through each of the steps:
    a. In "Confirm the APIs your application uses", enable "Check a UK VAT number" version 1.0.
    b. In "Who to contact about your application" and "Tell us your team members" enter the requested contact information.
    c. In "Confirm the name of your software", you can change your application name if you'd like. Confirm it otherwise.
    d. In the "Your responsibilities" section, answer the questions. It is not necessary to have a dedicated privacy policy and Terms of Conditions (and all validations stay local on your own server), but you may choose to link to the terms of your shop.
    e. Agree to the terms of use.
3. Click "Check Your Answers" to get a summary of what you've provided, and continue to request approval.
4. Once your application has been approved, you'll be provided with the Client ID and Client Secret to use. Paste those into the Commerce module, and make sure Use Sandbox is unchecked.
