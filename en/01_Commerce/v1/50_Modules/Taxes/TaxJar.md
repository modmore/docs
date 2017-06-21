Added in Commerce 0.3, the TaxJar module provides an integration with the [TaxJar SmartCalcs API](https://www.taxjar.com/smartcalcs/) for fully automated and highly accurate US Sales Tax calculations. 

TaxJar requires a subscription starting at $19 USD per month. In return, you don't have to worry about figuring out appropriate destination and sender based sales tax rates. 

When enabling the TaxJar module, it will be available as a Rate Provider for your [Tax Rules](../../Taxes).

## Properties

The taxjar properties are managed as system settings. Go to System > System Settings, choose commerce as namespace, and TaxJar as area, to find all the below options.

- **TaxJar API Token** (`commerce.taxjar.api_key`): this is provided by TaxJar under [Account > SmartCalcs API](https://app.taxjar.com/account#api-access). 
- **Nexus State** (`commerce.taxjar.nexus_country`): the country from where you sell or ship your products, defaults to US.
- **Nexus State** (`commerce.taxjar.nexus_state`): the state from where you sell or ship your products. 
- **Nexus Zip** (`commerce.taxjar.nexus_zip`): the zipcode from where you sell or ship your products.

If you have more than one Nexus, you can [add those to your TaxJar account](https://app.taxjar.com/account#api-access) and they'll be taken into consideration as well.

