Order Items are, as the name implies, items placed within a [order](Orders). It's a fairly simple object extending `comSimpleObject`, but it comes with a few tricks up its sleeve too.

[TOC]

## Values

The following values are available on the comOrderItem object through `$item->get(key)`:

- `order`: the ID of the `comOrderobject` this item belongs to. This should not be set manually, and may be `0` if the `comSessionOrder` is used for carts, as that does not persist the objects to the database. [Read more about orders here](Orders).

- `product`: the ID of the comProduct object that was added to the cart. [Read more about products here](Products).

- `idx`: a numeric index determining the order of the Order Item in the Cart. These numbers are not expected to be sequential, instead it is by default multiplied by 10 (the first item has idx 10, the second 20, the third 30 and so on) to allow inserting items before/after a specific item in the cart. Typically there's no need to interact with this directly, it's managed automatically.

- `sku`: the product its SKU or product code (or perhaps a SKU based on selected options?) as retrieved from the `$product->getSku()` method when the item was added to the cart.

- `name`: the product its name as retrieved from the `$product->getName()` method when the item was added to the cart.

- `link`: a link to the product as retrieved from `$product->getLink()`, if available. This link would go to a front-end product page of sorts.

- `description`: the product its description as retrieved from the `$product->getDescription()` method when the item was added to the cart.

- `price`: the product its per-item-price as retrieved from the `$product->getPrice()` method when the item was added to the cart. When changing the price, the `$item->calculate()` method is automatically called.

- `price_formatted`: a formatted value of the price (financial formatter).

- `quantity`: the number of this specific product added to the cart. When changing the quantity, the `$item->calculate()` method is automatically called.

- `subtotal`: price times quantity, as calculated by `$item->getSubtotal()`. In standard order items, this is simply the price times the quantity.

- `subtotal_formatted`: a formatted value of the subtotal (financial formatter).

- `tax`: the total tax applied to this item (so not per-quantity, but for the full order item) as calculated by `$item->getTax()`.

- `tax_formatted`: a formatted value of the tax (financial formatter).

- `shipping`: the total shipping applied to this item (for the full order item) as calculated by `$item->getShipping()`.

- `shipping_formatted`: a formatted value of the shipping costs (financial formatter)

- `total`: the grand total for this order item. Basically subtotal + tax + shipping, calculated in the `$item->calculate()` method.

- `total_formatted`: a formatted value of the total costs (financial formatter).

- `properties`: an array of optional properties for the Order Item. Can be used by extended objects for storing other information. Do not interact with this directly, instead use the `$item->getProperty()` and `$item->setProperty()` methods.

By appending `_formatted` to one of the following keys, it will return a nicely formatted value with currency and decimals instead of the raw numbers: `price`, `subtotal`, `tax`, `shipping`, `total`.

The following public methods are available on the base comOrderItem object.

- `calculate()`: recalculates the subtotal, tax, shipping and total values. This calls the methods `$item->getSubtotal`, `$item->getTax` and `$item->getShipping` to get to the total, which is then returned unformatted.
- `getProperty($key, $default = null)`: grabs a property from the properties field specified by `$key`. If the key doesn't exist in the properties, it will return `$default`.
- `setProperty($key, $value = null)`: sets a property in the properties field specified by `$key`. Will overwrite properties with the same key.

The `comSessionCartItem` derivative has no additional functionality or methods, except that it prevents the `$item->save()` method from persisting it to the database, and it is dynamically created/cached internally instead. Typically this method is not called on a `comSessionCartItem`, but was overridden just in case.

## Price Adjustments
Should you have module that makes changes to product prices, you should **not** update the `price` or `subtotal` directly as that would just get recalculated. Instead you can add a Price Adjustment using a `comOrderItemShippingAdjustment` or `comOrderItemDiscountAdjustment` object. 

For dealing with taxes, see the section on taxes further on this page.

Price Adjustment records contain the following values:

- `item`: the OrderItem the adjustment applies to; set automatically for you (see below).

- `key`: a unique (for the item) key that can be used to update instead of duplicate an adjustment should the module be executed multiple times.

- `name`: a name that will be shown to the merchant in the back-end, and potentially to the customer on the front-end depending on the templates.

- `description`: a description to clarify the price adjustment, why is it there and at that amount?

- `sortorder`: for use in the back-end and if added to the front-end templates in the cart.

- `show_on_order`: while the front-end templates need to be updated from the default to show price adjustments, this flag can be set to true or false to indicate if it should be a public or private price change.

- `price_change`: the amount (in cents) that the item should be adjusted by. This can be both negative (lowering the price) and positive (increasing the price).

To add a price adjustment, first create a new `comOrderItemShippingAdjustment` or `comOrderItemDiscountAdjustment` instance (don't save it yet!), and call `$item->addPriceAdjustment($adjustmentObject)`. The `addPriceAdjustment` method will set the item and sortorder. It will also use the specified key to see if a price adjustment with the same key was already set, in which case the old one is removed and your new one will take its place.

## Applying Taxes to Order Items

In Commerce, taxes are always applied to order items - not the order object. This makes sure the calculations are sound, and also helps in preparing your tax reports if you have different tax rates to consider. 

Tax rates are specified as percentages, and the Commerce core handles the actual calculations.

The following two objects exist related to taxes in Commerce.

- `comTaxRate`: the standalone object that contains the actual percentage that needs to be applied. These may be manually configured, or they are automatically generated by modules on the fly when a new tax rate needs to be applied. On each order item, a specific `comTaxRate` can only be applied once (based on its key). If you have compound taxes (for example in the United States you might have a separate state and country tax that both need to be applied), those need to be split up into two separate comTaxRate objects with their own unique keys.

- `comOrderItemTax`: the relation between the order item and the tax rate item. This keeps its local cache of the percentage for historic/accounting purposes, and also contains the `taxed_amount` (the price before taxes) and the `tax_amount` (the amount of taxes added to the price). 

In the future it may be possible to define taxes as being inclusive in the price, but in the current situation it is always added on top.

Internally, the `comOrderItem` object will call `$item->getTax()`, which gets all `comOrderItemTax` objects and tallies the total, which is then cached into the `tax` value. The `comOrderItemTax` objects are also used up the chain in the `comOrder` object to provide the tax totals for the entire order, and these items are also retrieved when tax related reports are generated.

The actual available tax rates, and determining which one(s) apply to a specific items, are not handled in the commerce core. Instead this responsibility is passed onto modules firing on the `comOrderItem::EVENT_BEFORE_CALCULATE_TAX` event and creating the applicable tax objects.
