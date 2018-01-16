_This document is about the Stripe Gateway for SimpleCart version 2. [Information about version 1 is here](Stripe)_.

The Stripe Gateway for SimpleCart is free to install from the modmore.com package provider. Its source code can be found on [GitHub](https://github.com/modmore/SimpleCart_Stripe).

After installing the package, three new gateways will show up in the Payment Methods tab in the SimpleCart > Administrer component. These three gateways are:

- Stripe, for accepting credit cards, including 3D Secure protected cards
- Bancontact, for accepting payments from customers in Belgium using the Bancontact payment system
- iDeal, for accepting payments from customers in the Netherlands using iDeal.

All of these gateways are part of the Stripe suite, so require you to have an active account.

[TOC]

## Setting up the Gateway

Compared to version 1, version 2 of the gateways require a bit more set up. This is because where version 1 only supported basic credit cards, with no 3D Secure validation, version 2 uses Stripe's newer APIs to support a wider range of payments. 

Here's what you need to do.

1. First, install the package from the modmore.com [package provider](https://www.modmore.com/about/package-provider/). 
2. [Create a webhook in the Stripe dashboard](https://dashboard.stripe.com/account/webhooks), pointing it to `https://yoursite.com/assets/components/simplecart_stripe/connector.php?action=webhook`.
3. Open the webhook in the dashboard, and copy the *Signing Secret* into the `simplecart_stripe.webhook_secret` system setting, located under the `simplecart_stripe` namespace.
4. Back in the Stripe Dashboard in the API >  Webhooks section, click on your endpoint. Test the webhook  by clicking the `Send test webhook` button in the top right corner. Leave it on the default event type, and click on _Send test webhook_ button. Make sure the response looks like JSON, and has a message of `Unsupported event type, ignoring request`. If you get a different response, that means you might not have copied the webhook secret properly, and you wont be able of accepting payments.
5. Head back to the Payment Methods tab in the SimpleCart > Administer component. Click the cog icon next to each of the gateways and make sure that the _Secret Key_ is filled with your [Stripe Secret Key](https://dashboard.stripe.com/account/apikeys).
6. Activate the gateways you'd like to use.

## Managing Gateway Configuration

To manage the properties for the Stripe gateways, including the API Keys and what chunks are used, simply hit the Cog icon next to the name, or right click the row in the grid and choose Configuration.

[ ![](https://assets.modmore.com/uploads/2015/06/stripeproperties.png)](https://assets.modmore.com/uploads/2015/06/stripeproperties.png)

### Stripe Gateway (credit cards)

These properties are available for the standard Stripe gateway, which is used to accept credit card and 3D Secure credit card payments.

- Stripe Footer Tpl: this contains the name of a chunk that contains some necessary javascript code for making the Stripe payment gateway work. The default chunk, scStripeFooter, is added during the package install and will work out of the box. If you've done heavy customisation of the cart or checkout, you may need to make some changes here as well. Please don't hesitate to contact us at support@modmore.com if you have questions about this.
- Stripe Cart Tpl: this contains the name of a chunk that contains the html that is added into the checkout form. This contains an empty div where a "card" element is inserted. Previously, in v1, this included actual input fields but that meant additional PCI requirements. 
- Currency: the currency for Stripe.
- Publishable Key: the publishable key for your Stripe account can be found in the Stripe Dashboard, under [Account Settings > API Keys](https://dashboard.stripe.com/account/apikeys). This can be either the live and test Publishable Key.
- Secret Key: the secret key for your Stripe account. Can also be either the live or test key.
- Use 3DS if optional: when set to 1, the default, the gateway will attempt to use 3D Secure whenever possible, including if 3DS is optional for the provided card. When set to 0, optional cards will be charged directly without 3D Secure validation.

### Stripe Bancontact Gateway

For Bancontact you only have the Currency (which should be EUR) and Secret Key property, just like the Stripe gateway.

### iDeal Gateway

For iDeal you have a Currency, Secret Key, and Cart Tpl property, just like the Stripe gateway. The iDeal gateway keeps a list of banks in its scStripeIdealCart chunk, which you may need to update once every few years. 

## Changing the Title, Description and Price

To manage the title, description and transaction fee for the gateways, you right click the gateway in the list and choose _Update Method_. In the popup, you can then edit those values, which are stored into lexicons.

The name cannot be changed, as that is tied in with loading and identifying the gateway.

[ ![](https://assets.modmore.com/uploads/2015/06/stripeupdate.png)](https://assets.modmore.com/uploads/2015/06/stripeupdate.png)