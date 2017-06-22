Resource products allow you to manage product information with resources representing products. This can consolidate products and the catalog in a single place, but has the downside of only having a single product per page. 

## Pros 

- Easy to setup and integrate. 
- Flexible 
- Easy to add to an existing site that already has resources
- Can also be used with Collections

## Cons

- One resource = one product with no variations
- Having tons of resources is not ideal if they don't also serve an existing function for browsing products. 

## Setup

You'll need to set up either existing resource fields, or template variables, to hold the product information. This includes the SKU, name, description and price. You'll also need to tell Commerce where you're storing this information. 

Set up the following MODX System Settings to point to a resource field or template variable:

- `commerce.resourceproduct.sku_field`
- `commerce.resourceproduct.name_field`
- `commerce.resourceproduct.description_field`
- `commerce.resourceproduct.price_field`
- `commerce.resourceproduct.stock_field`
- `commerce.resourceproduct.weight_field`
- `commerce.resourceproduct.weight_unit_field`

The values of each setting should be the name of a resource field (e.g. `pagetitle`, `alias`, or `introtext`), or the name of a TV prefixed with `tv.` (e.g. `tv.price` or `tv.product_sku`). 

Once setup, product information is synchronised when a product is added to the cart, or when the product record is saved in the Commerce merchant dashboard.

## Add to Cart form

You can use any of the [add to cart forms](../Product_Catalog/Add_to_Cart_Form) with resource products as well. It's recommended to use the [commerce.get_resource_product_id snippet](../Snippets/get_resource_product_id) to get the product ID to use in the form, as well as to create the resource products automatically if they don't already exist. 
