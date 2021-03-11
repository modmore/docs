When talking about _Products_ in the context of Commerce, we're talking about the actual product records with the SKU, name, description, price, stock and weight. 

The front-end representation of these products may be wildly different, containing image galleries, reviews, [variations](Variations), product specifications and custom attributes, etc. Together, we refer to this as the catalog. 

Products are managed under Extras > Commerce > Products or through template variables on resources.

## Available fields/placeholders

You may use product data in a variety of places, from your product listing to the checkout.

The available fields/placeholders are usually the same, no matter where they are used. 

Note that in MODX templates, you should use `[[+field]]`, whereas in Twig templates you should use `{{ field }}`. In some cases there's an extra prefix, like `[[+product.field]]` or `{{ item.product.field }}`. 

As of 1.0.0-rc2, here is what fields are available on a standard product:

### Generic

- `id`: the internal ID of a product
- `class_key`: the name of the class of the product
- `properties`: an array of additional properties for the product; used by certain modules/extensions to add more information to a product. 
- `sku`
- `barcode`
- `name`
- `description`
- `stock`
- `stock_infinite`
- `weight`, `weight_unit`, `weight_formatted`: the weight for a product; you'd typically use `weight_formatted` which combines the decimal `weight` and the `unit` and then formats it nicely.
- `image`: primary image, if set
- `tax_group`: ID of the tax group this product is assigned to.
- `delivery_type`: ID of the delivery type this product is assigned to.

### Price-related

- `price`: the current best price (i.e. the sale price, if set) for a product, in the current currency, in cents
- `price_formatted`: `price` but formatted in the currency
- `price_valid_until`: when set, this indicates that the current best price has an expiration date (e.g. it's from a Sale price type). The `price_valid_until` contains a unix timestamp for when that date is.
- `regular_price`: the regular price for the product in the current currency.
- `regular_price_formatted`: `regular_price`, but formatted by the currency rules.
- `price_rendered`: a html string based on the `frontend/price.twig` template showing the formatted "before/after" price. By default this includes microdata for the currency and expiration date for a sale price. 

- `pricing`: serialized version of price types. Do not interact with this directly; instead use the PHP APIs if you want to get more information out of this.
- `price_legacy`: the old pre-1.0 price field for a product, not currency aware. 
- `price_legacy_formatted`: `price_legacy` formatted by current currency

### Miscellanious

- `target`: the resource ID for Resource Products. 
- `matrix`: ID of the product matrix this belongs to, if it is a product matrix product.
- `row` and `column`: ID of the row/column respectively if this product is part of a matrix.
- `removed`, `removed_on`, `removed_on_formatted`, `removed_by`: data related to a product being soft-removed. In most cases, you cannot load a product that is removed. 
- `link`: when defined by the product type, this will be the link to the product in the front-end. Only available for resource and product matrix products. 
- `edit_link`: the link to edit this product in the manager.

## Product Variations

Commerce does not (natively) support different variations of the same product, for example "red" or "blue" shirts. This is by design. Each variation is considered a unique product, with its own SKU, name, stock, price and other information. 

That does not mean that your _catalog_ can't support product variations. You just need to set up your catalog so that a single page in your catalog will list the different products that are associated with it. 

[Read more about Product Variations](Variations). 

## Product Storage Types

There are custom product types, such as the [Resource Products](Resource_Products), where the product information is actually managed elsewhere. When you edit or create such a product in Commerce it only lets you edit the target that holds the information. 

These product storage types are useful in cases where you already have a catalog built, and you want to easily integrate Commerce with it. In cases where as a result you don't need the Products tab in the dashboard at all, the [Hide Products Module](../Modules/Admin/HideProducts) can be useful to remove the tab. 

As a general rule of thumb, only use custom product storage types when you're linking with an existing catalog. 

## Product Behavioural Types

Other types of custom products are those that have special behaviour. An example of this is the [Product Bundle](Bundles) type. Product bundles allow the merchant to select other existing products, and to sell those in a bundle. The price is set per bundle, but stock and weight is automatically calculated
