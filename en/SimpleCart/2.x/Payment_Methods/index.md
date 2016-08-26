---
title: Configuring Payment Methods
---

There are several Payment Methods (or Gateways) available for SimpleCart. These include:

- Bank Transfer (`default`): ships with the core SimpleCart package. This method doesn't actually do any payment handling, instead it simply marks the order as finished. It is the show owners' responsibility to make sure the payment was received before fulfilling the order.
- PayPal (`paypal`): available as free installable package from the modmore.com package provider. This allows customers to immediately pay their order via PayPal. Requires a PayPal business account.
- Mollie (`mollie`): available as free installable package from the modmore.com package provider. This allows customers to pay [via all payment gateways supported by Mollie](https://www.mollie.com/en/pricing), including iDeal, SOFORT banking and SEPA Bank Transfers. Requires a Mollie account and the various gateways enabled. The Mollie payment gateway sends users to the Mollie landing page to select the specific payment method they want to use.
- Stripe (`stripe`): available as free package from our package provider. With Stripe, your users never leave your site as it uses a JavaScript bridge to collect the Credit Card details, turn it into a non-sensitive token, which is then used to charge the credit card. This significantly lowers the PCI compliance requirements, which Stripe can inform you about in more detail.
- Authorize.net (`authorizenet`): available as free package from our package provider. With Authorize.net you can accept credit card transactions through a hosted checkout form. Billing and shipping details are collected by SimpleCart on your site, and the user is the briefly sent to the Authorize.net hosted checkout form to enter their credit card.

After installing the payment method packages, you will typically need to configure them with API Keys or other options dependant on the gateway. You will be prompted for these during the package install, but you can always edit them later from the Payment Methods tab. For more detailed instructions about that, please refer to their specific sections.

- [PayPal Gateway](PayPal)
- [Mollie Gateway](Mollie)
- [Stripe Gateway](Stripe)
- [Authorize.net Gateway](Authorize.net)