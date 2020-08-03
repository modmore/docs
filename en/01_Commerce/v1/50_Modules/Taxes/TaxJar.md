Added in Commerce 0.3, the TaxJar module provides an integration with the [TaxJar API](https://www.taxjar.com/) for fully automated and highly accurate US Sales Tax calculations. 

To access the TaxJar API, [a _Professional_ account](https://www.taxjar.com/pricing/) is needed starting at $99 per month. In return, you don't have to worry about figuring out appropriate destination and sender based sales tax rates. 

When enabling the TaxJar module, it will be available as a Rate Provider for your [Tax Rules](../../Taxes).

## Properties

The taxjar properties are managed as system settings. Go to System > System Settings, choose commerce as namespace, and TaxJar as area, to find all the below options.

- **TaxJar API Token** (`commerce.taxjar.api_key`): this is provided by TaxJar under [Account > Data sources > TaxJar API](https://app.taxjar.com/account#api-access). 
- **Nexus Country** (`commerce.taxjar.nexus_country`): the country from where you sell or ship your products, defaults to US.
- **Nexus State** (`commerce.taxjar.nexus_state`): the state from where you sell or ship your products. 
- **Nexus Zip** (`commerce.taxjar.nexus_zip`): the zipcode from where you sell or ship your products.
- **Nexus City** (`commerce.taxjar.nexus_city`, added in v1.2): the city from which you sell or ship
- **Nexus Street** (`commerce.taxjar.nexus_street`, added in v1.2): the street (address line) from which you sell or ship

If you have more than one Nexus, you can [add those to your TaxJar account](https://app.taxjar.com/account#api-access) and they'll be taken into consideration as well.

As of Commerce v1.2, the TaxJar will use rooftop-level accuracy for sales tax rates, based on the street and city provided by the customer. 
