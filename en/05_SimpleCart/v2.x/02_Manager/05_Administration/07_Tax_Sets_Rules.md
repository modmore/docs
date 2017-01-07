---
title: Tax Sets & Rules
---

To restrict your [Tax rate](Tax_Rates) to be applied only in certain circumstances you can set up sets and rules. Right click the tax rate and choose _Tax Sets and Rules_ to manage the sets and rules. 

[ ![Tax Sets & Rules window (when nothing configured yet)](https://assets.modmore.com/uploads/2015/12/taxes_sets_rules_win.png)](https://assets.modmore.com/uploads/2015/12/taxes_sets_rules_win.png "Tax Sets & Rules window (when nothing configured yet)")

In the next paragraphs we're going to use a Dutch setup to illustrate you how you can configure your Sets & Rules. We want to achieve the next rules;

1. All Dutch customers have to pay the Tax rate
2. All European customers without a VAT registration number have to pay the Tax rate

Note: we assume that you have a custom field in your checkout where you require your customers to enter their VAT registration number and that you validate it, before you reach the checkout. 

## Adding your first set of rules

On the left bottom you will find the "Add new set" button. Once you click it, you will be prompted for a set description. This can be anything for you to identify the set of rules.

In our example, as we described above, we first want to have all Dutch people to pay the Tax. Let's say we're going to add a new set called "All Dutch people". Once added, you will find your first set immediately in your Sets & Rules window, like this;

[ ![Creating a first set will be added instantly to your window](https://assets.modmore.com/uploads/2015/12/taxes_sets_rules_first_set_win.png)](https://assets.modmore.com/uploads/2015/12/taxes_sets_rules_first_set_win.png "Creating a first set will be added instantly to your window")

Now we have our first set added, we can add some rules. You can add as many rules you want, but try to use the rules as efficiently as possible.

## The first rule is required...

In our example we know that we have a "country" field in our checkout form. This field is also a user-profile field, which contains the two-letter code of the user's country. Where all Ducth people have to pay Tax, we can easily setup this one, by adding a rule for country "Netherlands".

[ ![](https://assets.modmore.com/uploads/2015/12/taxes_sets_rules_NL_rule.png)](https://assets.modmore.com/uploads/2015/12/taxes_sets_rules_NL_rule.png)

Once you clicked on one of the constrains in the a value window will popup right away. It's not possible to enter values directly in the field, because there is some logic required when you have multiple values. We assume the value window will explain that clearly to you.

## Adding more sets with more rules

Next in our example we want all other European users without a VAT registration number to pay Tax too.

Below you can see how to achieve that. Again we compare the user's country against multiple European countries (not all here, because it's just for showing you how it looks like) and also a "is empty" check on the "vatnr" field in our checkout form. Because when not empty, the registration number is known a customer doesn't have to pay VAT by then.

[ ![](https://assets.modmore.com/uploads/2015/12/taxes_sets_rules_EU_rule.png)](https://assets.modmore.com/uploads/2015/12/taxes_sets_rules_EU_rule.png)

## The cart is not showing taxes. Why not?

You should know that SimpleCart only can apply Tax Rules when fields used inside your Sets & Rules configuration are available. This means that fields you're using should be anywhere in a users profile (when logged-in) and otherwise it should be available in your checkout form. If not, you won't see any Tax be applied on your frontend.

When no Sets & Rules configured, SimpleCart always applies it. You can use this together with the rank on the tax rate to manage default tax rates. 