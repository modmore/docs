[Stripe](https://stripe.com/) offers on-site credit card payments with a JavScript client. 

The `Stripe (Legacy)` gateway uses the v2 JS API to tokenise a credit card and to charge it. It does not support 3DS. For 3DS, use the [Stripe - Card gateway](Stripe_Card) 

## Creating a Stripe Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

Stripe requires a Secret Key and Publishable key to be configured, both of which can be found under [Account Settings > API Keys](https://dashboard.stripe.com/account/apikeys) in the Stripe dashboard.