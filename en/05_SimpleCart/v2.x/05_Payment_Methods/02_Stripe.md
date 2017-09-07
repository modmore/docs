_This document is about the Stripe Gateway for SimpleCart version 1. [Information about version 2 is here](StripeV2)_.

The Stripe Gateway for SimpleCart is free to install from the modmore.com package provider. Its source code can be found on [GitHub](https://github.com/modmore/SimpleCart_Stripe).

After installing the gateway, it will show up in the Payment Methods tab in the SimpleCart > Administer component.

 [ ![](https://assets.modmore.com/uploads/2015/06/stripegateway.png)](https://assets.modmore.com/uploads/2015/06/stripegateway.png)

## Managing Gateway Configuration

To manage the properties for Stripe, including the API Keys and what chunks are used for adding the credit card fields and the client-side logic, simply hit the Cog icon next to the name, or right click the row in the grid and choose Configuration.

 [ ![](https://assets.modmore.com/uploads/2015/06/stripeproperties.png)](https://assets.modmore.com/uploads/2015/06/stripeproperties.png)

Here's what each of the properties are for:

- Stripe Footer Tpl: this contains the name of a chunk that contains some necessary javascript code for making the Stripe payment gateway work. The default chunk, scStripeFooter, is added as a static chunk during the package install. If you've done heavy customisation of the cart or checkout, you may need to make some changes here as well. Please don't hesitate to contact us at support@modmore.com if you have questions about this.
- Stripe Cart Tpl: this contains the name of a chunk that contains various input fields that are used to collect the credit card information. When customising this, **do not add name attributes to the input fields!** These are left out on purpose to make sure the credit card details never actually hit your server, making sure your PCI compliance requirements are limited to a yearly questionnaire. The Stripe.js library, loaded in the Stripe Footer Tpl chunk, takes care of turning the card details into a safe token.
- Currency: the currency for Stripe.
- Publishable Key: the publishable key for your Stripe account can be found in the Stripe Dashboard, under [Account Settings > API Keys](https://dashboard.stripe.com/account/apikeys). This can be both the live and test Publishable Key.
- Secret Key: the secret key for your Stripe account. Can also be both the live or test key.

## Changing the Title, Description and Price

To manage the title, description and transaction fee for the Stripe gateway, you right click the gateway in the list and choose _Update Method_. In the popup, you can then edit those values.

The name cannot be changed, as that is tied in with loading and identifying the gateway.

 [ ![](https://assets.modmore.com/uploads/2015/06/stripeupdate.png)](https://assets.modmore.com/uploads/2015/06/stripeupdate.png)