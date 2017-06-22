In Commerce you'll find that the Products are rather simple. This is by design (for the technically inclined, [read more here](../Developer/Products)).

The distinction that we make is that there are _Products_, and there is a _Catalog_. To Commerce, Products are simple objects with a name, SKU (product code), a price and a few other values. The catalog is how your products are managed, and displayed, to the customer browsing your shop.

By viewing this as separate, we allow you the flexibility to build your catalog using different tools. We'll give a few suggestions here.

[TOC]

## Recommended: Products TV + Collections

For most shops, a catalog based on [Collections](https://modx.com/extras/package/collections), optionally with [Tagger](https://modx.com/extras/package/tagger) for tags and more complex hierarchies, combined with the Commerce Products template variable, is the recommended approach. 

Collections gives you the ability to manage lots of products without overloading the resource tree, and can also be customised heavily. You can do one Collections container for the entire shop, or different collections for different categories. 

Tagger allows you to manage tags and filterable taxonomies. Compared to standard tag TVs, Tagger is more optimised to search and filter in the front-end, and also super flexible to set up.

To connect it with the products stored in Commerce, you would then use the Products Template Variable. This is a TV input type provided by Commerce, which allows you to link products to your catalog pages. This can be configured to allow a single product per resource, but also to hold many products, so you can easily add different variations of a product to the same page in your catalog. The TV provides a comma separated list of product IDs, which you can feed directly into the [commerce.get_products snippet](../Snippets/get_products).

## Minimal Catalog

For super basic shops, you might not even need resources. You can use the get_product and get_products snippet to show product information directly. This is useful for testing, and small webshops with just one or two products. 

[Read more about a Minimal Catalog](Minimal)

## Resource-based Catalog

It's also possible to create a resource-based catalog. Compared to the recommended solution with the Products TV listed above, a resource-based catalog is limited to one product per resource. The product information, like SKU, name, price and weight, are stored in individual template variables and synchronised with a special [Resource Product type](../Products/Resource_Products).

Because Commerce does not currently support different variations within a product (instead each variation is expected to be a different product record), this is a fairly limited approach. It's most useful for when you want to turn existing resources into products, rather than a new build.

[Read more about a Resource-based Catalog](Resource) and the [Resource Product type](../Products/Resource_Products.md). 

## SimpleCart-based Catalog

SimpleCart provides a custom resource type for both products and categories. Where the Products TV and resource-based catalog requires you to build most of the catalog yourself, SimpleCart already offers an ecommerce-centric resource interface that can be useful.
 
With the SimpleCart based catalog, you do run into the same limits as the resource-based catalog, where only a single product exists on a resource at a time. 

**Beta Note**: We're planning to release a separate package/module prior to the 1.0 release that integrates SimpleCart with Commerce. This will be, together with some documentation, be an easy way to migrate from SimpleCart to Commerce. 

## Custom Catalog

If your products come from an external system or API, Commerce will let you integrate that system with custom product classes. 

Maybe you'll read out an XML feed, request product information on demand from an API, have a separate manager component where your products are managed, or you deal with unique products built to customer spec. 

The sky is the limit, [reading up on the technical details of products is the start](../Developer/Products). 

**Beta Note**: be advised that we're still regularly making changes to underlying APIs in Commerce. Most of this will be backwards compatible, but when you build a custom product class, keep in mind that you may need to add additional features to it when they are added. 
