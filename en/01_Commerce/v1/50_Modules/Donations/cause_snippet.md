---
title: commerce_donation.cause
---

The `commerce_donation.cause` snippet is used to render a project/cause.

Properties:

- `&cause`: the ID of the cause. To make this easily selectable, you can use a dropdown TV with `@SELECT` input options: ``@SELECT `name`, `id` FROM `[[+PREFIX]]commerce_donation_cause` WHERE `removed` = 0 ORDER BY `name` ASC``
- `&activeTpl`: the template used for rendering an active project. Defaults to `donations/cause/active.twig`.
- `&inactiveTpl`: the template used for rendering an active project. Defaults to `donations/cause/inactive.twig`.

Some more information on the templates, including available values, can [be found here](https://github.com/modmore/Commerce_Donations/#showing-the-donation-widget).

