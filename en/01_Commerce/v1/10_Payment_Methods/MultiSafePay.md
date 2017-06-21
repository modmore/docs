[MultiSafePay](https://www.multisafepay.com/) is a Dutch-based, internationally operating payment provider that offers a [wide range of payment options](https://www.multisafepay.com/solutions/payment-methods/). 

## Creating a MultiSafePay Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

MultiSafePay requires a couple of configuration options:

- API Key: The API Key for MultiSafePay can be found in the merchant dashboard, by navigating to Settings > Website Settings.
- Locale: The ISO 639-1 language code to use for the payment page. Defaults to en for English.
- Gateway: The gateway to use. If "Any" is selected, the customer will be redirected to a hosted MultiSafePay page where they can choose how to pay. 
- Test Mode: Enable to use the sandbox environment for testing. Also set the availability on the payment method accordingly.

After you've added your API Key and saved the payment method, the different gateways will be available from the gateway dropdown. Generally speaking MultiSafePay redirects the user off-site, but where possible (based on the chosen gateway), the customer will be sent directly to their payment source (e.g. bank login) instead of a hosted checkout page. 

When the gateway is set to iDeal, the available banks will be shown on the checkout page. 
