The Braintree payment gateway is included in the Commerce core, and does not need a module to be enabled. It does need to be configured as a payment method.

[Braintree](https://www.braintreepayments.com/) is a PayPal subsidiary that allows you to accept payments with Credit/Debit Cards and digital wallets such as PayPal, Apple Pay, Android Pay and others. It has no monthly fees, just transaction fees. 

Commerce 1.0 used the Drop-in UI v2.

Commerce 1.1+ uses the Drop-in UI v3, which embeds the payment form into the page through an iframe and sidesteps PCI compliance horrors. This integration supports 3DS and is SCA-ready. 

As of v1.1 Commerce also associates MODX Users with a Braintree Customer, allowing you to "Vault" payment methods. This enables logged in repeat customers one-click payment for credit cards and PayPal. 

Note that at the moment the Commerce integration only supports credit cards and PayPal. we intend to update to the newer Drop-In to also support Apple Pay, Google Pay, and others. 

[TOC]

## Creating the Payment Method

In the Commerce dashboard, to go Configuration > Payment Methods. Click the Add a Payment Method button and choose Braintree in the Gateway dropdown. Fill in the other fields and save. 

After having saved the payment method, you'll get access to the Gateway Options for Braintree. These are:

- **Public Key**: the key used in the client-side integration to render the form.
- **Secret Key**: authentication used for server-side requests to confirm payments
- **Merchant ID**: your Braintree-assigned merchant ID.
- **Test Mode**: when enabled, the sandbox will be used. Be sure to match this to the mode in Commerce, so you only use the sandbox in the Commerce test mode.
- **Enable Vault Manager**: when enabled, logged in users will be able of managing stored ("Vaulted") payment instruments like their credit card or PayPal account from the payment page.

You'll likely need to create two payment methods; one for testing using sandbox credentials, and one for live with the live credentials. Set the availability appropriately.

## Locating your Credentials

1. [Login to your Braintree account](https://www.braintreegateway.com/login) or [the sandbox](https://sandbox.braintreegateway.com/login)
2. Navigate to Settings (cog icon) > API in the top right navigation
3. Under _API Keys_, click _Generate New API Key_.
4. Click View in the _Private Key_ column. This will give you all the keys you need to copy to the Payment Method in Commerce. 

