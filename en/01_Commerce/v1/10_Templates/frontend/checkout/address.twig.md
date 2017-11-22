The address.twig template is used by the checkout. It's shown in the address step.

[TOC]

## Key pieces

The address step requires a hidden input field with the name `add_address` and value of `1` to trigger the address processing.

As of Commerce 0.10, the `shipping_address` and `billing_address` POST fields must contain either the ID of a previously used address (for a logged in user), or the string `new`. `billing_address` can also be set to `same`, to use the same billing and shipping address. For compatibility with pre-0.10 templates, a POST field with name `add_billing_address` and a true-ish value (like `1`) acts the same as if `billing_address` was set to `new`.

Submitting address fields uses nested (array-like) field names. The top level is `address`, the next level is either `shipping` or `billing`, and then there's the actual address field. For example, the `company` field on a `billing` address should be submitted with a field named `address[billing][company]`. 

The following field names are supported on addresses. 

- fullname
- firstname
- lastname
- company
- address1
- address2
- address3
- zip
- city
- state
- country
- phone
- mobile
- email
- notes

Additional fields can be submitted to a generic `properties` field. For example the VAT registration is submitted to `address[billing][properties][vat_registration]`.

To remember a new address for future checkouts, provide a `remember` value of `1`, for example with a field like `<input type="checkbox" name="address[billing][remember]" id="address-billing-remember" value="1" checked="checked">`

## Default

The default template is as follows, as of Commerce v0.10.

```` twig
<div class="c-checkout c-checkout-step c-checkout-address">
    <h2>{{ lex('commerce.checkout_address_header') }}</h2>

    {% include 'frontend/response-messages.twig' %}

    <form method="POST" action="{{ current_url }}">
        <input type="hidden" name="add_address" value="1">

        <h3>{{ lex('commerce.shipping_address') }}</h3>

        {% if previously_used_shipping|length > 0 %}
            <div class="c-checkout-previous-address-list">
                {% for address in previously_used_shipping %}
                    {% include "frontend/checkout/partial/previous-address.twig" with {
                        address: address,
                        type: 'shipping',
                        current_address: address_shipping_id
                    } %}
                {% endfor %}

                <div class="c-method-wrapper c-shipping-address-wrapper">
                    <input type="radio"
                           name="shipping_address"
                           class="c-method-radio c-shipping-address-radio"
                           id="shipping-address-new"
                           value="1"
                           {% if address_shipping_id == 'new' %}checked="checked"{% endif %}
                    >
                    <div class="c-method-section c-shipping-address-section">
                        <label for="shipping-address-new">
                            {{ lex('commerce.add_new_address') }}
                        </label>
                        <div class="c-method-details">
        {% endif %}

        {% include 'frontend/checkout/partial/shipping-address-fields.twig' %}

        {% if previously_used_shipping|length > 0 %}
                        </div>
                    </div>
                </div>
            </div>
        {% endif %}


        <h3>{{ lex('commerce.billing_address') }}</h3>

        <div class="c-method-wrapper c-billing-address-wrapper">
            <input type="radio"
                   name="billing_address"
                   class="c-method-radio c-billing-address-radio"
                   id="billing-address-same"
                   value="same"
                   {% if address_billing_id == 'same' %}checked="checked"{% endif %}
            >
            <div class="c-method-section c-shipping-address-section">
                <label for="billing-address-same">{{ lex('commerce.same_as_shipping') }}</label>
            </div>
        </div>

        {% if previously_used_shipping|length > 0 %}
        <div class="c-checkout-previous-address-list">
            {% for address in previously_used_shipping %}
                {% include "frontend/checkout/partial/previous-address.twig" with {
                    address: address,
                    type: 'billing',
                    current_address: address_billing_id
                } %}
            {% endfor %}
        </div>
        {% endif %}

        <div class="c-method-wrapper c-billing-address-wrapper">
            <input type="radio"
                   name="billing_address"
                   class="c-method-radio c-billing-address-radio"
                   id="billing-address-new"
                   value="new"
                   {% if address_billing_id == 'new' %}checked="checked"{% endif %}
            >
            <div class="c-method-section c-shipping-address-section">
                <label for="billing-address-new">{{ lex('commerce.add_new_address') }}</label>
                <div class="c-method-details">
                    {% include 'frontend/checkout/partial/billing-address-fields.twig' %}
                </div>
            </div>
        </div>

        <div class="c-submit">
            <button class="c-button c-primary-button">{{ lex('commerce.checkout_address_confirm') }}</button>
        </div>
    </form>
</div>
<div class="c-checkout-summary">
    {% include 'frontend/checkout/partial/summary.twig' %}
</div>
````

This template will offer previous addresses (if there are any), and another option to add a new address. The address fields themselves are in a different template that is included here.