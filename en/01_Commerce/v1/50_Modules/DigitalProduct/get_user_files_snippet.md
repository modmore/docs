---
title: 'get_user_files snippet'
---

The `commerce_digitalproduct.get_user_files` snippet is used for listing digital products a user has previously accessed, as part of a "my account" section.

If the user is not logged in, they will be sent to the unauthorized page.

Supported properties:

- `&tpl`: the name of a twig template to use for rendering the digital products. Defaults to `digitalproduct/user_files.twig`; you can either override that file in your twig theme or provide a different file entirely.
  The placeholders available in the template are the same as those on the [thank you page and email templates](ThankYou); i.e. a root `digitalProducts` key containing an array for each product, containing the different files associated with the product under all/files/resources keys.
