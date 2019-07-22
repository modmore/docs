[Stripe](https://stripe.com/) offers on-site credit card payments with a JavScript client. 

In Commerce 1.0 and before, the Stripe Gateway uses the v2 API to tokenise a credit card from a custom form, with no suppport for 3D Secure.

In Commerce 1.1 and later, the Stripe Gateway uses the v3 Payment Intents API with support for 3D Secure/Secure Customer Authentication. It also assigns payments to a customer (no recurring/single click billing) and adds metadata to easier connect Commerce orders from the Stripe dashboard. 

[TOC]

## Creating a Stripe Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

The Stripe gateway has 3 properties:

- **Secret Key**, which is used in server-side communication. Found under [Account Settings > API Keys](https://dashboard.stripe.com/account/apikeys) in the Stripe dashboard
- **Publishable Key**, which is used for the front-end/client-side integration rendering the Payment Intents form. Found under [Account Settings > API Keys](https://dashboard.stripe.com/account/apikeys) in the Stripe dashboard.
- **Webhook Secret**, which is the secret key used to validate incoming webhooks. Will be filled automatically when left empty - see Webhook section below. 

You'll likely need to create two payment methods; one for testing using your test credentials, and one for live with the live credentials. Set the availability appropriately.

## Testing on a local development environment

Due to the renewed reliance on webhooks in Commerce 1.1, testing on a local environment is not quite as straightforward. 

The easiest way is to [make your local environment available publicly with ngrok](https://ngrok.com/) (or a similar tool). That will give you a unique, web-accessible, URL to use for testing.

## Setting up Webhooks

As of Commerce 1.1, payments made via Stripe are asynchronously validated through webhooks. 

You can manually create the webhook [in the Stripe dashboard](https://dashboard.stripe.com/webhooks) ([or sandbox](https://dashboard.stripe.com/test/webhooks)), but Commerce will gladly create it for you.

To automatically create the webhook, **leave the Webhook Secret field empty** when adding or editing the payment method. If you provide the Secret Key but not a Webhook Secret, the webhook is created through the API and the webhook secret will be filled automatically.

You can check the webhook configuration [in the Stripe dashboard](https://dashboard.stripe.com/webhooks) ([in test mode](https://dashboard.stripe.com/test/webhooks)). Make sure that:

- The URL is HTTPS. If your shop is not yet running on HTTPS, make sure to adjust this later.
- That the `method` url parameter is set to the right payment method ID. You can find the ID in the payment list, next to the name.
- That the webhook details shows `payment_intent.succeeded` and `payment_intent.payment_failed` event types selected.

### Webhook not working?

If your webhook isn't working correctly, check the details in the previous section. Make sure the webhook is enabled. Make sure that the URL it uses is web-accessible and does not redirect. 

To recreate the webhook automatically, empty the Webhook Secret property on the payment method. 

The transaction log may also be a useful source for debugging transactions that aren't working. Navigate to the order in the dashboard (it might be under Draft) and in the transactions grid choose Actions > View transaction log. In the log that's shown, you'll see details of the payment and 

### Moving to production

When you've migrated the shop to the live domain, and updated the Secret Key with your live key, you'll also need to adjust the webhook. Either login to the Stripe dashboard, and update the webhook URL, or empty the webhook secret to create a new webhook with the right URL.


