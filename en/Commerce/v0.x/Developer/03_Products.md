Products (`comProduct` class) are the internal representation of the products you sell. This may not be your actual (front-end) catalog, which might be built from resources, a custom database table or an xml feed, but it only contains the information that Commerce needs to process the "add to cart" action and order.

It's an really quite simple object, so you will typically use an extended object such as `comResourceProduct` to tie it to a more extended catalog front-end product. By keeping the Product object simple and not dictating how you manage your catalog, we believe this allows more flexible and complete ecommerce solutions. You can also have different types of product classes in the database at the same time.

The goal of the `comProduct` object is to provide the necessary information to add an Item to a Cart. The information it provides is the `sku` (product code), `name`, `description`, `price`, front-end `link` and an `edit_link` for editing the product in the back-end.
 
Most everything else is presentational and does not belong in the Product object, but in your Catalog.

If you have multiple options for a product, each variation would typically be implemented as unique `comProduct` records with their own SKUs, names and prices. In your user-facing interface, those can still be part of a same product page.

**1.0 Alpha Note**: We're considering baking in product variations into products as well. If that happens, we'll update this page. 

## comProduct

The following values are stored in the `comProduct` object:

- `sku`: the product code. Use `$product->getSku()` to get this value.
- `name`: the name of the product as it would appear in the cart, order and invoice. Use `$product->getName()` to get this value.
- `description`: the description of the product as it would appear in the cart, order and invoice. Use `$product->getDescription()` to get this value.
- `price`: the price for one quantity of this product, as defined in cents (e.g. `€12,34` would be stored as `1234`). Use `$product->getPrice()` to get this value, or `$product->get('price_formatted')` to get the formatted price.
- `target`: an integer reference to another object that represents the product in the catalog, for use in extended product types primarily. For example when using the `comResourceProduct` derivative (discussed below) this will contain the resource ID. The target can be loaded by the `$product->getTarget()` method, but this may return false, null or an empty array depending on the derivative, so validate the return value. Products may not have a target at all.
- `properties`: an array of extended information. Don't interact with it directly, instead use the `$product->getProperty($key, $default = null)` and `$product->setProperty($key, $value)` methods.

Important: because the comProduct derivatives may use other logic for getting the needed information (e.g. loading from a third party API on demand, or being imported nightly) it is important to **always** use the `getSku`, `getName`, `getDescription` and `getPrice` methods when interacting with products, instead of grabbing those fields via `$product->get()` directly. If you fail to do this, you may encounter stale data.

The following methods are available on the base `comProduct` object:

- `getSku()`
- `getName()`
- `getDescription()`
- `getPrice()`
- `getTarget()`
- `getLink()`: returns `false` or a link where the product can be seen by the site visitors.
- `getEditLink()`: returns `false` or a link in the manager where the product can be edited.

## comResourceProduct

The `comResourceProduct` product type provides a reference to a resource-based product catalog. Each product is tied to a specific resource by its target attribute and the related resource can be loaded via `$product->getTarget()`.

The `comResourceProduct` automatically loads the `sku`, `name`, `description` and `price` from the indicated resource. It also writes these values to the Product table, using those "cached" values by default. The resource fields that are used can be configured via system settings. Loading information from template variables is supported by using a `tv.` prefix before the name of the TV. 

The following system settings are used for the `comResourceProducts`:

- `commerce.resourceproduct.sku_field`: defaults to `alias`, used for the sku.
- `commerce.resourceproduct.name_field`: defaults to `pagetitle`, used for the product name.
- `commerce.resourceproduct.description_field`: defaults to `description`, used for the product description.
- `commerce.resourceproduct.price_field`: defaults to `tv.price` (a TV with the key of price), used for filling the product price. Remember this needs to be defined in cents!

Aside from the methods available on the `comProduct` object, the `comResourceProduct` also exposes the following methods:

- `getTargetField($target, $field)`: provided the target from `$product->getTarget()`, this will get the proper resource field or template variable (when `$field` is prefixed with `tv.`).

## Custom Product Types

Do you need to integrate with a third party API for your product details, or want to load it from another table? All that Commerce cares about is that you provide it a `comProduct` derivative which exposes the `getSku`, `getName`, `getDescription` and `getPrice` methods. Look at the `comResourceProduct` class for inspiration on how you might do that.

If you need to load data from a slow third party api or have a ton of data to sift through, it might be better to use a cron job to update the data nightly. You could still create a custom product type as way of namespacing (so you could do `$adapter->getCollection('comImportedProduct')` in your import script to only update products that were imported, and not those that were manually created), but in that case you likely don't have to override any methods on the class.
