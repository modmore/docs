When talking about _Products_ in the context of Commerce, we're talking about the actual product records with the SKU, name, description, price, stock and weight. 

The front-end representation of these products may be wildly different, containing image galleries, reviews, [variations](Variations), product specifications and custom attributes, etc. Together, we refer to this as the catalog. 

Products are managed under Extras > Commerce > Products. 

## Product Variations

Commerce does not (natively) support different variations of the same product, for example "red" or "blue" shirts. This is by design. Each variation is considered a unique product, with its own SKU, name, stock, price and other information. 

That does not mean that your _catalog_ can't support product variations. You just need to set up your catalog so that a single page in your catalog will list the different products that are associated with it. 

[Read more about Product Variations](Variations). 

## Product Storage Types

There are custom product types, such as the [Resource Products](Resource_Products), where the product information is actually managed elsewhere. When you edit or create such a product in Commerce it only lets you edit the target that holds the information. 

These product storage types are useful in cases where you already have a catalog built, and you want to easily integrate Commerce with it. In cases where as a result you don't need the Products tab in teh dashboard at all, the [Hide Products Module](../Modules/Admin/HideProducts) can be useful to remove the tab. 

As a general rule of thumb, only use custom product storage types when you're linking with an existing catalog. 

## Product Behavioural Types

Another type of custom products are those that have special behaviour. An example of this is the [Product Bundle](Bundles) type. Product bundles allow the merchant to select other existing products, and to sell those in a bundle. The price is set per bundle, but stock and weight is automatically calculated