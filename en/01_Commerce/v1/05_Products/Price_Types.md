Price Types allow you to define prices in different currencies while covering different use cases, including temporary sale and bulk discount pricing.

This document explains these concepts and implementation for **developers and agencies who are implementing Commerce**.

- If you're a **shop owner looking to learn more about how to prices**, [read the Product Prices user guide](../User_Guide/Product_Pricing)
- If you're a **developer looking for more technical background** of how these prices are implemented, [read the developer guide on Product Pricing](../Developer/Products/Pricing).

On this page:

[TOC]

## (Retail) Prices & Price Types

In Commerce each product has a standard/retail price for each enabled currency. This is the primary price that you set when managing products, and is available with all different types of [managing your product catalog](../Product_Catalog). Historically this was the only price you could set for a product.

Price Types, first introduced in v1.0, give you a lot more power and flexibility. Price Types are only available for the [Product List TV](../Product_Catalog/Products_TV) and [Product Matrix TV](../Product_Catalog/Product_Matrix), or for products managed manually from the dashboard. This indeed means that [Resource Products](../Product_Catalog/Resource) do not support price types at the moment. 

Custom product types can support price types, but that depends on their implementation. As a rule of thumb, if editing the product information looks like a normal product in the dashboard, it likely supports price types automatically, too. If it's managed in a different component, additional development effort is needed to support price types. ([If you're a developer, you can learn more about how to integrate price types in a custom product in the developer documentation.](../Developer/Products/Pricing))

## Supported Price Types

Commerce ships with the following price types out of the box:

- Sale: a single price that is only used between two date/times. 
- Sale Percentage: a percentage discount price that is only used between two date/times. THe percentage price is useful for in a Matrix, as it will cascade from the matrix/row/column to each individual product.
- Quantity: lets you set multiple prices where the returned price is based on the quantity on the order item.

They are not shown right away; you first need to enable their respective modules at Configuration > Modules. 

## Template integration

The `[[+price]]` and `[[+price_formatted]]` placeholders (and twig equivalent) contain the current best price for a product in the current currency.

To render a "From/until"-style date, you can use the `[[+price_rendered]]` placeholder which uses the `frontend/price.twig` [twig template](../Front-end_Theming). 

For date-based price types, like the Sale/Percentage Sale, which also have an expiration date set, you can also use the `[[+price_valid_until]]` placeholder. That contains a unix timestamp which can be rendered to a human-readable timestamp with the `date` output filter.

We'll add a snippet that lets you render a quantity-based price type to your product pages in mid-end April. The other core price types are automatically taken into account in the `[[+price]]` and `[[+price_rendered]]` placeholders. 
