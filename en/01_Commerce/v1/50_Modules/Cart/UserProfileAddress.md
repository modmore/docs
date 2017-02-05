---
title: User Profile Address
---

The User Profile Address will pre-fill the customer address on the checkout from the currently logged in user's profile. It also adds a checkbox to the checkout, which will allow the user to specify that their address on file should be updated.

Added in v0.4.

## Properties

- Prefill Address Types: Comma separated list of the address types to prefill with information from the user profile. Can include billing and shipping out of the box. Default: `shipping, billing`
- Update Profile Address: When enabled and a non-empty form input with the name `address[shipping][properties][update_profile]` or `address[billing][properties][update_profile]` is submitted with the address, the shipping or billing address will be stored back in the user profile when it passes validation. Note that you can only store the billing OR the shipping address this way, because there is only one set of fields on the user profile.

