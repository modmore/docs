[SagePay](https://www.sagepay.co.uk/) is a payment provider offering online, phone and face to face payment products, popular in the United Kingdom. Commerce uses the "Server integration", which redirects customers to a SagePay hosted payment page.

Added in v0.9.

## Creating a SagePay Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

SagePay requires a couple of configuration options:

- Vendor: the name of the SagePay username that you use to login to MySagePay.

Interestingly, SagePay does not require any additional API Keys or passwords to function with the used integration method. Instead transactions are accepted only based on your Vendor name, and the Server IP. You'll need to whitelist your server IP in MySagePay, under Settings > Valid IPs. Follow-up requests (e.g. transaction verifications or refunds) rely on secret per-transaction information.

