[Mollie](https://www.mollie.com/dashboard/signup/718037?lang=en) is a Dutch payment provider which operates across Europe. They offer off-site payments for a [wide range of payment options](https://www.mollie.com/en/payments).

## Creating a Mollie Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

Mollie requires an API Key, found in the Mollie dashboard under Settings > Website Profiles and then the "Live and Test API Keys" link under the appropriate profile.

Set the Payment Method to bypass the Mollie hosted payment screen to go directly to the relevant payment option.

- When using Mollie for iDeal, the Commerce integration shows the available banks automatically, and sends the user straight to their bank. 
- When setting it to another payment method, they are also redirected directly to that payment method or a hosted payment page (e.g. for credit card).
- When not setting a payment method, the user is redirected to Mollie's hosted payment screen. 

The hosted screen can be customised in the Mollie dashboard under Settings > Website Profiles > Personalize Checkout. 