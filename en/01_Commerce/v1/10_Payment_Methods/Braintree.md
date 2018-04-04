The Braintree payment gateway is included in the Commerce core, and does not need a module to be enabled. It does need to be configured as a payment method.

[Braintree](https://www.braintreepayments.com/) is a PayPal subsidiary that allows you to accept payments with Credit/Debit Cards and digital wallets such as PayPal, Apple Pay, Android Pay and others. It has no monthly fees, just transaction fees. 

Commerce uses the so called _Drop In_ v2 integration, which embeds the payment form into your page with JavaScript and an iframe, allowing you to sidestep PCI compliance horrors. Control over the design of the payment form is fairly limited. 

Note that at the moment the Commerce integration only supports credit cards and PayPal. we intend to update to the newer Drop-In to also support Apple Pay, Google Pay, and others. 

[TOC]

## Creating the Payment Method

In the Commerce dashboard, to go Configuration > Payment Methods. Click the Add a Payment Method button and choose Braintree in the Gateway dropdown. Fill in the other fields and save. 

After having saved the payment method, you'll get access to the Gateway Options for Braintree. These are:

- Public Key
- Secret Key
- Sandbox
- Merchant ID

You'll likely need to create two payment methods; one for testing using your sandbox credentials, and one for live with the live credentials. Set the availability appropriately.

## Locating your Credentials

1. [Login to your Braintree account](https://www.braintreegateway.com/login) or [the sandbox](https://sandbox.braintreegateway.com/login)
2. Navigate to Account > My User in the top navigation
3. Click _View Authorizations_ towards the end of the page, under the _API Keys, Tokenization Keys, Encryption Keys_ heading. 
4. Under _API Keys_, click _Generate New API Key_. 
5. Click View in the _Private Key_ column. This gives you all the keys you need to copy to the Payment Method in Commerce. 


