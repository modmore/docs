---
title: Accept Terms & Conditions
---

With the AcceptTerms module a checkbox at the payment step has to be submitted before a transaction can be initiated. This module was added in v0.11.1.

You only have to enable the module and set the resource ID of your terms & conditions resource in the module configuration.

By default, as of Commerce v1.3, you can choose which step to add the terms and conditions checkbo to. Each of the `cart.twig`, `address.twig`, `shipping-method-twig`, and `payment-method.twig` templates in the `frontend/checkout/` template directory include the necessary partial with a `step` parameter that determines if it shows anything:


```` twig
{% include 'frontend/checkout/partial/modules/accept-terms.twig' with {step: 'cart'} %}
{% include 'frontend/checkout/partial/modules/accept-terms.twig' with {step: 'address'} %}
{% include 'frontend/checkout/partial/modules/accept-terms.twig' with {step: 'shipping'} %}
{% include 'frontend/checkout/partial/modules/accept-terms.twig' with {step: 'payment'} %}
````

The `frontend/checkout/partial/modules/accept-terms.twig` template contains the markup itself, which is only rendered if the provided `step` matches the step the module is activated on:

````twig
{% if module_accept_terms_enabled and module_accept_terms_step == step %}
    <label class="c-accept-terms">
        <input type="checkbox" name="accept_terms" value="1" required {% if module_accept_terms_accepted %}checked{% endif %}>
        {{ lex('commerce.module.acceptterms.text', {url: module_accept_terms_url}) }}
    </label>
{% endif %}
````

If you decide to use different markup, make sure that the name of your field is `accept_terms` and that you implement some sort of client-side required check (in the default, that's the HTML5 `required` attribute) so that customers do not have to needlessly re-enter their payment information for on-site payment gateways if they forget to check the box.

> Important: if you configure the module to be displayed on the Address step, client-side validation is extra important. If the user is able to submit their information without accepting the terms, the address information provided will be discarded.

To change the text that is shown, go to System > Lexicon Management in MODX. Select the `commerce` namespace and `modules` topic, select the language to update, and then enter `acceptterms` in the search box. Double-click the value for the `commerce.module.acceptterms.text` key and change it as you see fit. Lexicon changes made this way are safe from upgrades.

## Properties

- **Terms & Conditions Resource**: the ID of the resource that holds your terms and conditions, which will automatically be linked for you.
- **Displayed on Step**: the step in the checkout that the accept terms checkbox should be shown on. The module will prevent the user from progressing past this step if they haven't accepted the terms.

## Before 1.3

Prior to Commerce 1.3, only the `frontend/checkout/payment-method.twig` template was enabled to support the module, with the following markup:

```` twig
{% if module_accept_terms_enabled %}
    <label class="c-accept-terms">
        <input type="checkbox" name="accept_terms" value="1" required>
        {{ lex('commerce.module.acceptterms.text', {url: module_accept_terms_url}) }}
    </label>
{% endif %}
````
