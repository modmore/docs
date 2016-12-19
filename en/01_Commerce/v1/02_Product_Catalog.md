In Commerce you'll find that the Products are rather simple. This is by design (for the technical inclined, [read more here](Developer/Products)).

The distinction that we make is that there are _Products_, and there is a _Catalog_. To Commerce, Products are simple objects with a name, SKU (product code), a price and a few other values. The catalog on the other hand is how your products are managed and displayed to the customer browsing your shop.

By viewing this as separate, we allow you the flexibility to build your catalog in lots of different ways for different use cases. We'll offer some suggestions in this document.

**Alpha Note**: We're still experimenting with ways to intuitively match the products and the catalog. If you've completed your shop, we would love to hear your feedback via support@modmore.com or [on our forum](https://forum.modmore.com/c/commerce). 

## Minimal Catalog

For the simplest catalogs, you can simply reuse the products defined in the Commerce admin on the front-end. This is best for small webshops with simple products that do not need product pages or different variations and prices. 

There are snippets available to help you create a minimal catalog. **Alpha Note**: These snippets will be made available prior to the 1.0 release but may not be out yet when you're reading this.

## Resource-based Catalog

The resource-based catalog is likely to be the most common. In this case, the front-end is built where every product has a resource in the tree. 

To create the link between the catalog and the product in Commerce, you can use an Add to Cart snippet that automatically creates a product record for the resource if it doesn't exist yet, or, you can use an approach where products are created in Commerce whenever you create the resource.
 
The resource-based catalog offers you more freedom to set up the products as you need them. For a larger number of products, this can be used with extras like Collections and Tagger to provide powerful categorization and tagging. 

## SimpleCart-based Catalog

SimpleCart provides a custom resource type for both products and categories. Where the resource-based catalog requires you to build most of the catalog yourself, SimpleCart already offers an ecommerce-centric resource interface. 

**Alpha Note**: We're planning to release a separate package prior to the 1.0 release that integrates SimpleCart with Commerce. This will be, together with some documentation, the recommended approach for migrating a SimpleCart webshop to Commerce.

## Minishop2-based Catalog

Minishop2 is an ecommerce solution developed by the Russian community. It also offers custom resource types like SimpleCart, but is more focused on categorization/filtering and product variations. Commerce is more focused on the merchant-side, these two platforms just might be a great match. We're planning to investigate a separate package to easily link Minishop2 products with Commerce after the 1.0 release. 

## Custom Catalog

If your products come from an external system or API, Commerce will let you integrate that system with custom product classes. Maybe you'll read out an XML feed, request product information on demand from an API, have a separate manager component where your products are managed, or you deal with unique products built to customer spec. The sky is the limit, [reading up on the technical details of products is the start](Developer/Products). 
