---
title: commerce_donation.donations
---

The `commerce_donation.donations` snippet is used to list donations for a specific cause.

Properties:

- `&cause`: the ID of the cause. To make this easily selectable, you can use a dropdown TV with `@SELECT` input options: ``@SELECT `name`, `id` FROM `[[+PREFIX]]commerce_donation_cause` WHERE `removed` = 0 ORDER BY `name` ASC``
- `&sortby`: the field to sort donations by, defaulting to the `donated_on` column. Could be ``
- `&sortdir`: the order to sort donations by, defaulting to `DESC`.
- `&tpl`: the twig template used to render, defaults to `donations/cause/donations.twig`

Some more information on the templates, including available values, can [be found here](https://github.com/modmore/Commerce_Donations/#showing-the-donation-widget).
