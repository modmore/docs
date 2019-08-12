Commerce supports different use cases for setting product prices. 

All products support a basic retail price. This is the price that's normally charged for the product in a certain currency. You edit it by editing your product, and filling in the "Price" field. This is a base price.

Most (but not all) ways of integration with Commerce also supports more advanced price types. These are a bit more complex, and also much more powerful. 

We'll discuss a few of those use cases below. They can be combined.

If you don't see where you can set up these price types in your shop, or if you do not see the result of setting up price types in your shop, please contact your development partner for assistance.

[TOC]

## Price Types

First, navigate to where you usually manage products. Depending on how your shop was set up, that may be in the resource tree on the left-hand side of the manager or via Extras > Commerce > Products. 

(If you manage your products elsewhere, for example in a different application or a custom solution, price types may not be supported. Contact your development partner for assistance.)

Edit the product you want to manage prices for. On the _Pricing_ tab you should see the _Price_ sections, one for each enabled currency.

(Contact your development partner to enable additional currencies.)

### Multiple Currencies

To set a retail price in different currencies, simply set the single price field shown to you. 

### Time-based Sale Prices

To set a sale price that automatically starts and/or expires, add a **Sale Price** or **Percentage Sale Price**. It will ask you for the date the sale will start, the date it ends, and the price or percentage discount respectively. 

The start and expiration dates are both optional, so if you have a sale that's already running you can leave out the start date, and if you don't want to automatically expire the sale, you can leave the expiration date empty as well.

It is possible that sale prices starting or expiring is not immediately visible on the product page, as this information might be cached. The right price is still automatically used when a customer adds the product to their cart, which may be confusing to your customers. If this happens, using the Site > Clear Cache option in the manager can help, but if you regularly run sale prices you should contact your development partner to make sure a manual clear of the cache is not needed for your price page to be updated.

### Quantity Based Prices (aka bulk discounts)

If you want to charge a lower price when customers buy more products, quantity based prices are what you need. Add a **Quantity Price** to the currency of your choosing.

Note that only one instance of the quantity price is accepted per currency. 

The fields that appear will let you define different prices for different brackets. For example: 

- Your retail price is €10
- From 2 to 4 items, your quantity price is €9
- From 5 to 9 items, your quantity price is €8
- From 10 to infinite items, your quantity price is €7

The minimum is always required. The maximum is optional, and treated as infinite when left empty. 

Both the minimum and the maximum are inclusive, but the cheapest price is always applied. That means that if you set a price that's valid from 2 to 5 items, and another price from 5 to 10, that both of those brackets will be valid for an order with a quantity of 5. The first one because the maximum (5) is inclusive, and the second because the minimum (5) is inclusive. When multiple brackets match, Commerce selects the cheapest price automatically, but you may want to consider configuring prices 2 to 4 and 5 to 9 instead, to be clearer about the intent. 

### Other types

You may have access to other types, too. User and User Group prices are also available, and Price Types can be extended, for example to support prices for different users. 

## Combining multiple Price Types in one product

These use cases are not mutually exclusive, and can be combined in a single product. 

For example you can have a per-currency retail price, and also add the **Sale** or **Quantity** price types to it as well.

When a customer orders a product, Commerce will evaluate all your rules for the currency, and will charge the customer the **cheapest price** that's available for their product.

To give an example, let's say you have the following price types on a product:

- Retail Price is €50
- There's a Sale price currently available for €35
- Quantity based price brackets are set to:
    - For 5-9 products, the price is €40 each
    - For 10-19 products, the price is €30 each
    - For 20+ products, the price is €25 each

Here's how that would work when a customer orders a certain number of products: 

- When a customer orders 2 products, they are charged €35 each. The quantity prices start at 5, and the sale price is cheaper than the retail price.
- When a customer orders 7 products, they are still charged €35 each. While the quantity based price is now eligible, the sale price of €35 is still cheaper than the first bracket in the quantity based pricing (€40). 
- When a customer orders 10 products, they are charged €30 each. The second quantity bracket for 10-19 products is now cheaper than the sale price of €35.

When using multiple currencies, only the prices for the currency the customer is using (which is usually based on what site/domain/URL they are using) are evaluated. So if your customer is in the EUR site which charges €35 for the sale, even if you have USD pricing that's cheaper (e.g. $25 each), the EUR customer will be charged the €35 price. 
