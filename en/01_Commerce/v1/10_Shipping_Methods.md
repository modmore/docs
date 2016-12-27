Shipping Methods are configured through the merchant dashboard, under Configuration > Shipping Methods. 

Each shipping method can be configured to be available on specific order totals by specifying minimum or maximum totals. For example you might charge a small shipping fee until an order total of €20, and offer free shipping after that. Or perhaps you want to provide insured or expedited shipping options over €100. 

## Standard Shipping Method

The standard shipping method defines costs as either a fixed price in cents, a percentage of the order total, or both. 

## Country-Specific Shipping Method

For shops that sell internationally, the country-based shipping method will allow you to set fixed shipping prices for specific countries. 

When creating a country-based shipping method (`comShippingMethodByCountry`), you can specify as many countries as you'd like. If countries share the same shipping price, you can combine them into a single row by separating them with a comma. 

## Custom Shipping Methods

If the provided shipping methods don't provide sufficient flexibility, for example because you'd like it to be based on product information like weight or size or it has to be integrated with a shipping partner API, it's possible to develop custom shipping methods. [The developer documentation on this topic](Developer/Custom_Shipping_Methods) has instructions and example code. 
