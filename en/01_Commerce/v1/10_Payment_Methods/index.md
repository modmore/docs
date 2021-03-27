Commerce integrates with a wide, and growing, variety of payment providers. Most integrations are included in the default installation, while some require an additional download.

[TOC]

## Configuring a Payment Method

Where we call the technical implementation of a payment provider a "payment _gateway_", a payment _method_ is an instance of it; a specific configuration.

Payment methods are managed through the merchant dashboard, under Configuration > Payment Methods. 

After you choose a payment gateway and save the payment method, you will be presented with the specific configuration options for the gateway in a new tab. This may include options such as API Keys or other security references used to connect to the payment provider. Their descriptions, and relevant documentation, should tell you where to find the right information.

For each payment method you can also set when it should be available, based on order prices and test/live mode. The transaction fee can be waived, set as a fixed price, or as a percentage of the order total.

You can create multiple payment methods all using the same payment gateway but with different options, however it's possible that some gateways use shared javascript (or shared variables) where multiple active methods of the same gateway do not work. This currently affects PayMill. Some gateways require different keys or tokens in different modes, in which case you'll need to create different methods for each mode and set the availability accordingly.

## Available Payment Gateways

The table below contains a list of gateways that are currently available for Commerce. 

**On/off-site** summarizes the integration. When an integration is "on-site", the customer doesn't leave the site but they enter their payment information in the checkout. When listed as "Off-site", customers are redirected to either a hosted payment page (where they can select a payment option and fill in their payment details), or for "direct" integrations they are sent directly to the payment source (e.g. iDeal/Sofort integrations redirect directly to the bank login screen). 

**SCA Ready** indicates if the payment gateway has been updated in accordance with _Strong Customer Authentication_ (SCA) regulation introduced in the _Revised Payment Services Directive_ (aka PSD2). These requirements went into effect for European customers on September 14, 2019. 

Unless otherwise noted, the gateways below are included in the standard Commerce package and covered by standard support. 

| Gateway | Payment options | On/off-site | SCA Ready? |
|---|---|---|---|
| [Adyen](Adyen_hpp) ([Gateway Pack 1](../Modules/Payments/GatewayPack1)) | Lots of global, regional, and local payments | Off-site (hosted payment page) | ✓ |
| [Authorize.net](Authorize.net) (core) | Credit Cards (primarily USA) | On-site (JavaScript) | ? (note 2) |
| [Braintree](Braintree) (core) | Credit Cards, PayPal | On-site (JavaScript)  | ✓ (v1.1+) |
| [Klarna](Klarna) (official extension) | Several, including "Pay Later", depending on country (primarily EU) | On-site (JavaScript) | ✓ |
| [Manual](Manual) (core) | None; marks all transactions as successful. | On-site (server-side) | Not applicable |
| [Mollie](Mollie) (core) | Many, including iDeal, Sofort, Bancontact, Credit Card, and others (primarily NL, EU) | Off-site (direct or hosted payment page) | ✓ (note 1) |
| [MultiSafePay](MultiSafePay) (core) | Many, including iDeal, Sofort, Bancontact, credit card (hosted form), and others (primarily NL, EU) | Off-site (direct or hosted payment page) | ✓ (note 1) |
| [Omise](https://modx.com/extras/package/omisepaymentgatewayforcommerce) (third-party extension) | Credit card, PromptPay, TrueMoney Wallet, internet banking (Asia) | see extension |
| [Paymill](Paymill) (core) | Credit Cards (primarily DE, EU) | On-site (JavaScript frame) | ✓ (note 3) |
| [PayPal](PayPal) (core) | Express, supporting PayPal account, credit cards | Off-site (direct) | ✓ (note 1) |
| [SagePay](SagePay) (core) | Credit Cards (primarily UK) | Off-site (hosted payment page) | ✓ (note 1) |
| [SplitIt](https://modx.com/extras/package/splititpaymentgatewayforcommerce) (third-party extension) | Multiple installments | see extension |
| [Stripe](Stripe) (core) | Credit Cards |  On-site (v1.1+: Payment Intents, v1.0: v2 tokenisation) | ✓ (v1.1+) |
| [WiPay](WiPay) (official extension) | Credit Cards (Caribbean) | Off-site (hosted payment page) | ✓ |

Notes:

1. Gateways with note 1 indicate hosted payment pages. In those cases, the payment provider is responsible for the SCA interaction. We've done a cursory review of hosted payment options and expect them all to be compliant by the deadline. Consult their documentation or merchant support to confirm.
2. Authorize.net has not yet published information on their path towards complying with SCA. [One third party source](https://www.paywithbolt.com/psd2-sca-3d-secure-2-eva/) suggests they do not intend to support the PSD2 regulation.
3. Paymill has confirmed in private communication that their existing integration will comply with PSD2/SCA, "with no or only minor changes in the integration". At this time we interpret that to mean our current integration is ready to go when Paymill finishes their systems. If changes end up being necessary, we'll update it in this list.

## What about PCI compliance?

Commerce does not ever touch any raw credit card information, regardless of the chosen payment gateway, to limit exposure to PCI. Any card integrations that uses on-site credit card forms (such as Braintree, Paymill or Stripe) typically use JavaScript and/or iframe-based solutions that removes much of the PCI compliance requirements.

It may still be needed to fill out (yearly) PCI-related paperwork, usually in the form of a _Self Assessment Questionnaire_ (SAQ) like `SAQ A` or `SAQ A-EP`. This is merchant-specific and typically part of the merchant acceptance process when signing up with a payment provider. 

## Is Commerce ready for PSD2 and Strong Customer Authentication?

Yes, please see the _SCA Ready_ column in the table above, and relevant notes, for details about the status for each of the available payment gateways.

## Need another payment provider?

With hundreds (if not thousands) of payment providers available, it is likely you'll eventually need an integration we don't have available just yet. You can [request and vote for payment gateways on our feature tracker](https://ideas.modmore.com/?tags=commerce-gateways).

To sponsor development of a payment integration, please contact support@modmore.com with details of the payment provider, and we'd be more than happy to provide you with a cost and time estimate. Typical gateway implementations cost in the €300-600 range. 

## Integrating Payment Gateways

To build an integration yourself, take a look at our [developer documentation on Payment Gateways](../Developer/Payment_Gateways). 
