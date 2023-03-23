[Stripe](https://stripe.com/) offers on-site credit card payments and a wide range of other payment options, including many regional payments and wallets, from a single integration.

Historic implementations:

- Commerce 1.0 and before: Stripe v2 API to tokenise only credit cards, with no support for SCA.
- Commerce 1.1-1.2: Stripe v3 to tokenise credit cards with the Payment Intents API, supporting SCA and assigning payments to a customer.
- Commerce 1.3+: Stripe v3 with Payment Element offering all of Stripe's payment options from a single widget. Also support for Auth/Capture flows when the customer uses a Credit Card.

[TOC]

## Creating a Stripe Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

The Stripe gateway has a few properties:

- **Secret Key**, which is used in server-side communication. Found under [Account Settings > API Keys](https://dashboard.stripe.com/account/apikeys) in the Stripe dashboard
- **Publishable Key**, which is used for the front-end/client-side integration rendering the Payment Intents form. Found under [Account Settings > API Keys](https://dashboard.stripe.com/account/apikeys) in the Stripe dashboard.
- **Webhook Secret**, which is the secret key used to validate incoming webhooks. Will be filled automatically when left empty - see Webhook section below.
- **Request authorization instead of payment** will opt-in the gateway to the [Authorize/Capture payment flows](Authorize_Capture_Flow), which means a temporary hold on a customers' card is sufficient to complete  the order, and you will charge that amount within 7 days.

You'll likely need to create two payment methods; one for testing using your test credentials, and one for live with the live credentials. Set the availability appropriately.

## Testing on a local development environment

Due to the renewed reliance on webhooks in Commerce 1.1, testing on a local environment is not quite as straightforward.

The easiest way is to [make your local environment available publicly with ngrok](https://ngrok.com/) (or a similar tool). That will give you a unique, web-accessible, URL to use for testing. Use your ngrok domain as the webhook domain.

## Setting up Webhooks

As of Commerce 1.1, payments made via Stripe are asynchronously validated through webhooks.

You can manually create the webhook [in the Stripe dashboard](https://dashboard.stripe.com/webhooks) ([or sandbox](https://dashboard.stripe.com/test/webhooks)), but Commerce will gladly create it for you.

To automatically create the webhook, simply **leave the Webhook Secret field empty** when adding or editing the payment method. If you provide the Secret Key but not a Webhook Secret, the webhook is created through the API and the webhook secret will be filled automatically.

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

### Webhook errors with 3rd party systems

If your business uses different platforms with Stripe, it's possible to get notified of webhook errors. These occur because Commerce receives a webhook notification for a transaction created elsewhere, and as a result Commerce will indicate the webhook processing failed.

Getting this message does not mean there is a problem with the webhook configuration.

