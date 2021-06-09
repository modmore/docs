The User & Usergroup Discounts module ships with the Commerce core as of v0.12. Enable it in Configuration > Modules. 

Once enabled, you can manage user and usergroup discounts from the new "Discounts" top menu. 

User(group) discounts are always a percentage of the order total, applied to each individual order item. 

User and user group discounts can be restricted to:

- Specific products
- Date/time-based availability
- Min/max order totals

When a user(group) discount is available to the logged in user, it is automatically applied to the items in their cart. 

If multiple user(group) discounts are valid, they will all be applied. 

## Template Values

There may be times when you would like to display the applied discount to the customer in different ways.

User based discounts apply to order items as **adjustments**. You can access these adjustments when editing
a template that has access to the individual order items. A prime contender is `frontend/checkout/partial/summary.twig`.

As an example, if your discount is percentage based, you could display **10% discount** with the following:

```
{%  for adjustment in item.adjustments %}
    {% if adjustment.price_change_percentage_formatted %}
        {{ adjustment.price_change_percentage_formatted }} discount
    {% endif %}
{% endfor %}
```

Here we are looping through each adjustment for the current order item. If the `price_change_percentage_formatted` field has a value
then we know there is a percentage based discount applied, so we display it.

As always, if you set the `commerce.debug` system setting to `1`, then you can use `{{ dump(item) }}` to see
all the fields available to you. You can find more information at the bottom of [this page](https://docs.modmore.com/en/Commerce/v1/Front-end_Theming.html).
