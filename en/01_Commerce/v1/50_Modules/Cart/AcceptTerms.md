---
title: Accept Terms & Conditions
---

With the AcceptTerms module a checkbox at the payment step has to be submitted before a transaction can be initiated. This module was added in v0.11.1.

By default, the following markup is included in the `frontend/checkout/payment-method.twig` template so you only have to enable the module and set the resource ID of your terms & conditions resource in the module configuration.

```` twig
{% if module_accept_terms_enabled %}
    <label class="c-accept-terms">
        <input type="checkbox" name="accept_terms" value="1" required>
        {{ lex('commerce.module.acceptterms.text', {url: module_accept_terms_url}) }}
    </label>
{% endif %}
````

If you decide to use different markup, make sure that the name of your field is `accept_terms` and that you implement some sort of client-side required check (in the default, that's the HTML5 `required` attribute) so that customers do not have to needlessly re-enter their payment information for on-site payment gateways if they forget to check the box.

## Properties

- **Terms & Conditions Resource**: the ID of the resource that holds your terms and conditions, which will automatically be linked for you.