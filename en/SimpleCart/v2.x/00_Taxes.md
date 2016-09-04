---
title: Dealing with Taxes
---

SimpleCart offers a flexible way of defining taxes, however it does have its limitations. In this document, we will try to explain what is possible and how the different options are connected since 2.3.0.

## Rates, Sets & Rules

Taxes are managed via the SimpleCart Administration component, on the Tax Rates & Rules tab. In the table, you will see a list of your **Tax Rates**. A Tax Rate has a tax percentage (the actual rate), a name and active state. For each different tax percentage you need to charge, you would create a new Tax Rate record.

By right clicking the tax rate and choosing Tax Sets & Rules, a window pops up where you can manage **Sets** and **Rules**. A Set is a collection of Rules that need to evaluate to a true statement. When adding multiple Rules, you have the possibility to define wether it is an "OR" or "AND" comparison: does only one of the two statements need to be true, or all of them. When a Set of Rules checks out, that Tax Rate is considered applicable, and can be used for a purchase.

It is also possible to define multiple Sets in a single Tax Rate. In that case, you can also configure it to require all sets to be applicable before using the Tax Rate. This is useful for complex conditions.

## Applying Tax Rates to Products

There are a few important considerations to make when it comes to specifying which Tax Rate is applied to a product purchase.

1. **Tax Rates that have Rules with data that is not yet available** (like as a country or state, which is only filled in _after_ choosing to checkout) **will always be considered not applicable until that data is available!** So any tax rate that depends on the country to be known, will not be used until the user entered their country and submitted.
2. Product prices are always considered to be **excluding tax**. [SimpleCart does not currently support merchants adding prices including tax](https://forum.modmore.com/t/calculate-vat-is-by-default-ex-vat/58). Tax is applied on top of the listed price.

To configure a product to use a certain tax rate, edit the product resource and open the _Settings_ tab. In the _Tax Setup_ vertical tab, you can choose one of the configured tax rates. This rate will then be used by default, which means that as long as the Sets and Rules in that Rate are considered to be true, that is the one and only tax rate that will apply. If the Tax Rate has rules that cannot yet be evaluated, no taxes will be applied.

If a product does not have a configured tax rate, SimpleCart will look at the category. Again when editing the category resource on the Settings tab, under Tax Setup, you can define a Tax Rate to use. This uses the same logic as the product-specific tax rate.

Next, if neither a product or category tax is configured, SimpleCart will look at the default tax rate. The default tax rate is set by double clicking the "Default" column in the table on the Tax Rates & Rules component tab, and setting it to yes. This value is can also be stored in a system or context setting called simplecart.default\_tax. This again uses the same logic as the product-specific and category-specific tax rate: its sets and rules need to be considered true, and it is ignored if the rules cannot be evaluated yet.

Finally, if none of the three levels above can be applied, SimpleCart will go over all active tax rates. In this scenario, it will use the **first applicable tax rate**. The order in which these tax rates are sorted is the _Rank_ field as of 2.3.0-rc7 (lowest first, highest number last). Before that release, it would sort the tax rates in an ascending order based on the tax percentage (lowest tax percentage first, highest tax percentage last). When different tax rates have the same rank (such as in the default situation), it still falls back to this existing behaviour.

## More about Taxes

- [Tax Rates](Manager/Taxes)
- [Sets & Rules](Manager/Tax_Sets_and_Rules)

