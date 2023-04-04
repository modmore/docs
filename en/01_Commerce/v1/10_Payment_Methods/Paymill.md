> Sadly, Paymill has gone out of business and has been removed as of Commerce 1.3.

[Paymill](https://www.paymill.com/) is a Munich-based payment provider. They offer on-site credit card payments through a payment form, with limited PCI-DSS requirements. They also offer direct debit for German merchants, and a PayPal integration, however that functionality has not been tested yet with Commerce.

## Creating a Paymill Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

Paymill requires a Private Key and a Public Key to be set up. These can both be found in the Paymill Merchant Center under Development > Test/Live Keys.

**Note:** due to the way the Paymill form is loaded, it's not currently possible to have 2 different Paymill payment methods active at the same time (in the same mode), with different keys.
