---
title: Minimum Order Amount
---

With the Minimum Order Amount, customers cannot checkout until their order total is at least a configured amount. In many webshops you do not want this restriction, but perhaps you run a pizza delivery that only starts delivering at €15. 

Added in v0.6.

## Properties

- `minimum_amount` The minimum order total to allow the order. This is the "final" total, which may or may not include taxes, shipping, payment method fees, or discounts. 

## Template changes

The module prevents continuing into the checkout, but does not automatically change the checkout button. You can implement such a check, to show a notice when the minimum isn't reached, in the `frontend/checkout/cart.twig` template. 

For example, this would only show the checkout button if at least €15 is in the cart:

```
{% if order.total >= 1500 %}
    <form method="POST" action="{{ current_url }}" class="c-submit">
        <input type="hidden" name="checkout" value="1">
        <button class="c-button c-primary-button" type="submit">{{ lex('commerce.checkout') }}</button>
    </form>
{% else %}
    <p class="not-enough">Please order at least €15 worth of products.</p>
{% endif %}
```
