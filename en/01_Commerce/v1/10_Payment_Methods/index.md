Commerce integrates with a wide, and growing, variety of payment providers. Most of these payment providers are included in the default installation, but additional gateway packs are also available.

## Creating a Payment Method

Payment methods are managed through the merchant dashboard, under Configuration > Payment Methods. After you choose a payment gateway and save the payment method, you will be presented with the specific configuration options for the gateway.

This may include options such as API Keys or other security references used to connect to the payment provider. 

For each payment method you can also set when it's available, based on order prices and test or live mode. The transaction fee can be set as a fixed price, or as a percentage of the order total. Of course it can also be left as 0.

You can create multiple payment methods all using the same payment gateway but with different options, however it's possible that some gateways use shared javascript (or shared variables) where multiple active methods of the same gateway do not work. This currently affects PayMill. 

## Available Payment Gateways

The table below contains a list of gateways that are currently available for Commerce. 

- On/off-site will summarize the integration. When an integration is "on-site", the customer doesn't leave the site. When it is "Off-site", they are redirected to either a hosted payment page (where they can select a payment option and fill in their payment details), or for "direct" integrations they are sent directly to the payment source (e.g. iDeal/Sofort integrations redirect directly to the bank login screen)
- Distributed with indicates where the gateway can be found. Gateways marked "Commerce" are available in each install. Gateway Packs and third party packages must be installed separately.

| Gateway | Payment options | On/off-site | Distributed with |
|---|---|---|---|
| [Adyen](Adyen_hpp) | Lots of global, regional, and local payments | Off-site (hosted payment page) | [Gateway Pack 1](../Modules/Payments/GatewayPack1) |
| [Authorize.net](Authorize.net) | Credit Cards | On-site (JavaScript) | Commerce |
| [Braintree](Braintree) | Credit Cards, PayPal | On-site (JavaScript)  | Commerce |
| [Manual](Manual) | None; marks all transactions as successful. | On-site (server-side) | Commerce |
| [Mollie](Mollie) | Many, including iDeal, Sofort, Bancontact, Credit Card, and others. | Off-site (direct or hosted payment page) | Commerce |
| [MultiSafePay](MultiSafePay) | Many, including iDeal, Sofort, Bancontact, credit card (hosted form), and others. | Off-site (direct or hosted payment page) | Commerce |
| [Paymill](Paymill) | Credit Cards | On-site (JavaScript frame) | Commerce |
| [PayPal](PayPal) | PayPal account, credit cards | Off-site (direct) | Commerce |
| [SagePay](SagePay) | Credit Cards | Off-site (hosted payment page) | Commerce |
| [Stripe (Legacy)](Stripe) | Credit Cards | On-site (JavaScript v2 tokenisation) | Commerce |
| [Stripe - Card](Stripe_Card) | Credit Cards | On-site (JavaScript v3 Payment Intents) | Commerce v1.1 |

Need another gateway that isn't yet available? Send an email to support@modmore.com to let us know which one you need (and when). 

## Implementing other Payment Gateways

To build your own integration, take a look at our [developer documentation on Payment Gateways](../Developer/Payment_Gateways) to see how that works.
