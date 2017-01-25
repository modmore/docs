The EU VAT Validator module can be used to accept and validate EU VAT Registration Numbers. This talks directly to the official [VIES Web Service from the European Union](http://ec.europa.eu/taxation_customs/vies/). 

When combined with the [EUVat module](../Taxes/EUVat) this can be used for the _Reverse Charge_ mechanism. See the EUVat documention for more information about that.

## Properties

None.

## Template Changes

In order to use the EU VAT Validator module, you'll need to provide an extra field to the address with the key `vat_registration`. The default `frontend/checkout/address.twig` template contains the following, commented out by default, that you can use. 

In the shipping address fieldset:
```` twig
<div class="c-field {% if error_shipping_vat_registration %}error{% endif %}">
    <label for="address-shipping-company">{{ lex('commerce.vat_registration') }} <small>{{ lex('commerce.address.optional') }}</small></label>
    <input type="text" name="address[shipping][properties][vat_registration]" id="address-shipping-vat-registration" value="{{ address_shipping_properties.vat_registration }}">
    {% if error_shipping_vat_registration %}<span class="c-field-error">{{ error_shipping_vat_registration }}</span>{% endif %}
</div>
````
or in the billing address fieldset:

```` twig
<div class="c-field {% if error_billing_vat_registration %}error{% endif %}">
    <label for="address-billing-company">{{ lex('commerce.vat_registration') }} <small>{{ lex('commerce.address.optional') }}</small></label>
    <input type="text" name="address[billing][properties][vat_registration]" id="address-billing-vat-registration" value="{{ address_billing_properties.vat_registration }}">
    {% if error_billing_vat_registration %}<span class="c-field-error">{{ error_billing_vat_registration }}</span>{% endif %}
</div>
````

Technically the VAT Registration belongs to the billing address, but it can be useful to add it to the shipping address form if that's the one that is primarily visible to the customer. 