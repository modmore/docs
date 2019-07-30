Shipping Methods are used to define the price and method of delivering a product to a customer. 

Even if you don't physically "ship" products, shipping methods are still required.

Shipping methods are grouped by [Delivery Type](Delivery_Types), meaning that each unique delivery type has its own set of shipping methods that will be offered to the customer in the checkout. This makes it possible to have different ways of delivering products (for example ebooks are delivered digitally, while actual books are packed and handed off to a shipping carrier for delivery). 

In the order, each product is added to an [Order Shipment](Orders/Shipments), based on the products' configured delivery type.

[TOC]

## Configuring Shipping Methods

Shipping Methods are configured through the merchant dashboard, under Configuration > Shipping Methods. 

### General

The **Name** of the shipping method is both how it will be shown to the customer in the checkout, and how the method is identified in the dashboard. 

With the **Type** you can choose the shipping method type, each of which has their own logic for calculating the shipping price. Commerce ships with a couple of options out of the box, and others can be installed as both free and premium extensions. 

The **Description** is shown in the checkout. 

The **Order** defines the sorting order of the shipping method in the checkout. 

### Pricing 

Basic prices can be entered on the **Pricing** tab. That includes a fixed-fee shipping cost, and a percentage-based shipping cost. You can use either or both of these, or leave them empty for free shipping.

When shipping methods use different logic to get to a price, such as live rates or other calculations, the fields on the pricing tab may be ignored. Consult the documentation for the relevant shipping method.

### Availability

Each shipping method can be configured to be available in different circumstances in the **Availability** tab.

- By checking **Enabled in Test Mode** and/or **Enabled in Live Mode**, you can configure what mode the shipping method should be available in. This can be useful when you use real-time shipping calculations with different credentials for test and live. 
- The **Countries** option lets you define the **Shipping Countries** that the method should be available for. This is configured by providing the 2-character country codes in a comma separated list. Excluding countries and using a short-hand for the entire European Union is possible as of v1.1. [Learn more about defining country restrictions](Miscellaneous/Country_Restrictions),
- With the **Min. Order Total** and **Max. Order Total** you can define what orders a shipping method should be available for. For example, you may offer a standard shipping rate for orders with a max order total of €20, and a separate shipping method that is free for orders with a min order total of €20. Or perhaps you want to offer additional shipping services over a larger order total. The order total for this configuration is by default the `total` field (which includes taxes, transaction fees, and the shipping fee), minus the shipping fee. If desired, you can change the `commerce.shipping_total_field` to another field, such as `total_before_tax` or `subtotal`, but keep in mind the shipping fee will still be taken off the total which may lead to unexpected results or race conditions when using other fields. 

## Automatic selection

Commerce (since v0.11) will automatically select the first available shipping method when a customer adds products to their cart. Make sure to set the sortorder on your shipping methods accordingly.

If your shipping method costs or availability depend on where the customer is from, make sure to use modules like [Default Address](Modules/Cart/DefaultAddress) or [Autofill GeoIP](Modules/Cart/AutoFillGeoIP) to provide Commerce with an address to use for the initial selection. 

Some shipping methods may require the customer to submit certain information, such as a preferred delivery date, which is not available with automatic selection. 

## Available Shipping Method Types

Commerce ships with a couple of different shipping method types out of the box, and there are also [extensions](https://www.modmore.com/commerce/extensions/) available.

### Standard Shipping Method

The standard shipping method defines costs as either a fixed price in cents, a percentage of the order total, or both. 

### Country-Specific Shipping Method

For shops that sell internationally, the country-based shipping method will allow you to set fixed shipping prices for specific countries. Specify comma-separated country codes for each row. 

When creating a country-based shipping method (`comShippingMethodByCountry`), you can specify as many countries as you'd like. There are always 5 empty rows, if you need more just save the shipping method and it will add another 5 empty rows.

[Learn more about defining countries](Miscellaneous/Country_Restrictions)

![Example of Shipping Methods interface to provide country-specific prices.](../images/shipping/shipping-country-specific.jpg)

### Weight-Specific Shipping Method

The weight-specific shipping method calculates the total order weight. This relies on the products defining their weight and the relevant weight unit to allow for automatic conversions. 

The shipping method defines its own weight unit which is used in the conversion and for matching the specified weight brackets.
 
![](../images/shipping/shipping-weight-specific.jpg)

### TableRates Shipping Method

Installable as a separate (free) module, the [TableRates shipping method](Modules/Shipping/TableRates) allows you to manage more complex customer-location-plus-weight rules as CSV, inspired by the Magento feature with the same name.

### Third-party shipping methods

The following shipping methods have been developed by third party developers.  

**These are not covered by the standard modmore support**, but as they may still be useful, they are mentioned for your convenience.

- [Formula Shipping for Commerce](https://modx.com/extras/package/formulashippingforcommerce), by Tony Klapatch

## Custom Shipping Methods

If the provided shipping methods don't provide sufficient flexibility, for example if it has to be integrated with a shipping partner API, it's possible to develop custom shipping methods. [The developer documentation on this topic](Developer/Custom_Shipping_Methods) has instructions and example code. 

## Showing or hiding the Shipping step in the checkout

Depending on your use case, you may need to always show, conditionally show, or never show the shipping step in the checkout. This can be configured on the [delivery type](Delivery_Types) that shipping methods are added to. 

When choosing to never show the shipping step, it is **crucial** that you always have a shipping method available. Make sure that all order totals and countries you accept orders from can be automatically assigned to a shipping method. 

