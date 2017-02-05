When you're building a resource-based product catalog, each product record in Commerce is associated with a single resource in MODX.

The glue between the products and the resources are `comResourceProduct` objects, provided by the core Commerce package.

[TOC]

## Pros 

- Easy to setup and integrate. 
- Flexible 
- Easy to add to an existing site that already has resources
- Can also be used with Collections

## Cons

- One resource = one product with no variations
- Having tons of resources is not ideal if they don't also serve an existing function for browsing products. 

## Setup

You'll need to set up either an existing resource field, or a template variable, to hold the product information. This includes the SKU, name, description and price. You'll also need to tell Commerce where you're storing this information. 

Set up the following settings:

- `commerce.resourceproduct.sku_field`
- `commerce.resourceproduct.name_field`
- `commerce.resourceproduct.description_field`
- `commerce.resourceproduct.price_field`

The values of each setting should be the name of a resource field (e.g. `pagetitle`, `alias`, or `introtext`), or the name of a TV prefixed with `tv.` (e.g. `tv.price` or `tv.product_sku`). 

Once setup, product information is synchronised when a product is added to the cart, or when the product record is saved in the Commerce merchant dashboard.

## Add to cart form

[See _Add to Cart Form_](Add_to_Cart_Form) for the general form and information about how it works.

When you're using the resource product catalog approach, you can use the [commerce.get_resource_product_id snippet](../Snippets/get_resource_product_id) to retrieve the product ID in your template.

It will also create the resource product records for you automatically if there isn't one available. This can be disabled on the snippet if needed. 

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    <input type="hidden" name="product"
        value="[[commerce.get_resource_product_id]]">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="quantity" value="1">
    
    <input type="submit" value="Add to Cart">
</form>
````

Should you need to use an add to cart form on a collection page, where the product ID for a different resource should be fetched, you can provide the `&resource` property. For example in a getResources chunk you might do:

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    <input type="hidden" name="product"
        value="[[commerce.get_resource_product_id? &resource=`[[+id]]`]]">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="quantity" value="1">
    
    <input type="submit" value="Add to Cart">
</form>
````

You can also use the multiple products add to cart form structure. That would look like this:



```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="products[ [[commerce.get_resource_product_id]] ][quantity]" value="1">
    
    <input type="submit" value="Add to Cart">
</form>
````

or this for a different resource:

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    <h3>[[+pagetitle]]</h3>
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="products[ [[commerce.get_resource_product_id? &resource=`[[+id]]`]] ][quantity]" value="1">
    
    <input type="submit" value="Add to Cart">
</form>
````

