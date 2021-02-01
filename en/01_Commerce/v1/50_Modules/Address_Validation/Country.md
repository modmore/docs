Allows you to restrict orders to specific countries, or to blacklist some countries. This also validates the country, providing a field-specific error message if it does not exist. If the customer enters a country that is not allowed (it is either not on the list of allowed countries, or it is in the list of disallowed countries), then a message is shown at the top of the checkout.

Note: the [basic address validation](Basic) also validates if the country is valid. If you just want to make sure the provided country code is real, you don't need this Country Validation module. This module is meant whitelisting or blacklisting countries to accept orders from.

You should always use ISO-3166 country codes. Specifically, this means that the United Kingdom is represented as `GB` (not `UK`!), and Greece is `GR` (not `EL`!). The country selector in the default checkout provides the right codes for you automatically.

## Properties

- Allowed Countries (`allowed_countries`): a comma separated list of country codes that you accept orders from.
- Disallowed Countries (`disallowed_countries`): Only used when Allowed Countries is not set. Specify a comma separated list of countries to not accept orders from.

## Updating templates

Configuring allowed countries in this module does not automatically remove countries from your template (yet). 

You can do so by changing your `frontend/checkout/partial/billing-address-fields.twig` and `frontend/checkout/partial/shipping-address-fields.twig` templates, adjusting the list of country codes shown on the 6th lines in the samples below.

For `billing-address-fields.twig`:

```
  <div class="c-field {% if error_billing_country %}error{% endif %}">
      <label for="address-billing-country">{{ lex('commerce.address.country') }}</label>
      <select name="address[billing][country]" id="address-billing-country">
          <option value=""></option>
          {% for country in countries %}
              {% if country.iso in ["NL", "DE", "FR"] %}
                  <option value="{{ country.iso }}" {% if address_billing_country == country.iso %}selected="selected"{% endif %}>{{ country.shortname }}</option>
              {% endif %}
          {% endfor %}
      </select>
      {% if error_billing_country %}<span class="c-field-error">{{ error_billing_country }}</span>{% endif %}
  </div>
```

For `shipping-address-fields.twig`:

```
  <div class="c-field {% if error_shipping_country %}error{% endif %}">
      <label for="address-shipping-country">{{ lex('commerce.address.country') }}</label>
      <select name="address[shipping][country]" id="address-shipping-country">
          <option value=""></option>
          {% for country in countries %}
              {% if country.iso in ["NL", "DE", "FR"] %}
                  <option value="{{ country.iso }}" {% if address_shipping_country == country.iso %}selected="selected"{% endif %}>{{ country.shortname }}</option>
              {% endif %}
          {% endfor %}
      </select>
      {% if error_shipping_country %}<span class="c-field-error">{{ error_shipping_country }}</span>{% endif %}
  </div>
```
