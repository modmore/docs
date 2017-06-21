Commerce integrates with a wide, and growing, variety of payment providers. Most of these payment providers are included in the default installation, so no additional installations are necessary. 

## Creating a Payment Method

Payment methods are managed through the merchant dashboard, under Configuration > Payment Methods. After you choose a payment gateway and save the payment method, you will be presented with the specific configuration options for the gateway.

This may include options such as API Keys or other security references used to connect to the payment provider. 

For each payment method you can also set when it's available, based on order prices and test or live mode. The transaction fee can be set as a fixed price, or as a percentage of the order total. Of course it can also be left as 0.

You can create multiple payment methods all using the same payment gateway but with different options, however it's possible that some gateways use shared javascript (or shared variables) where multiple active methods of the same gateway do not work. This currently affects PayMill. 

## Available Payment Gateways

- [Authorize.net](Authorize.net) (Credit Cards, on-site JavaScript implementation)
- [Braintree](Braintree) (Credit Cards and PayPal via popup, on-site JavaScript implementation)
- [Manual](Manual) (Dummy gateway that marks an order as paid)
- [Mollie](Mollie) (Provider offering various off-site payment options including iDeal, Sofort, Bancontact, credit card (hosted form), and more)
- [MultiSafePay](MultiSafePay) (Provider offering various off-site payment options, including iDeal, Sofort, Bancontact, credit card (hosted form), and more)
- [Paymill](Paymill) (Credit Cards, on-site JavaScript framed implementation)
- [PayPal](PayPal) (Credit Cards, PayPal account, off-site redirect)
- [Stripe](Stripe) (Credit Cards, on-site JavaScript implementation)

Need another one that isn't yet available? Send an email to support@modmore.com to let us know which one you need (and when).

## Implementing other Payment Gateways

To build your own integration, take a look at our [developer documentation on Payment Gateways](../Developer/Payment_Gateways) to see how that works.
