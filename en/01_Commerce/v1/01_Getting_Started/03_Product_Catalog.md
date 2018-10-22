_This document assumes [Commerce was downloaded and installed with the default options](index) and that [you've gone through the basic configuration](Configuration)._

Now that your basic shop configuration is in place, and you have an idea of the different pieces that are involved, let's start talking about the actual products and your catalog.

[TOC]

## Products and the Catalog

In Commerce there is a distinction between the _products_ and the _catalog_. This may seem a bit odd, but is by design to enable more flexible and powerful shops.

**Products** are simple representations of an item that you sell. A product could be "Rainbow shirt in size M", which has its SKU, price, weight, stock, etc. Commerce doesn't natively have variations within products: each unique option you have in your warehouse is a unique product. 

The **Catalog** is how your products are organised and presented to customers. This contains your products, of course, but may also cover reviews, categories, filters, product videos and galleries, brands, etc. 

**Commerce focuses primarily on the products**. You'll use a selection of tools, not necessarily tools provided by modmore, to build out the catalog exactly how you want it to work. Then you'll hook in the products in Commerce. 

## Laying out your product catalog

For most MODX shops, we recommend building the catalog based around resources. For example, you might use:

- [Collections](https://modx.com/extras/package/collections) as categories. Collections show up in the resource tree like regular resources, except it hides regular child resources from the tree. That allows you to have hundreds or even thousands of resources, without overloading the tree. Each child resource would be a product page.
- [Tagger](https://modx.com/extras/package/tagger) and/or [mSearch2](https://en.modstore.pro/packages/ecommerce/msearch2) to allow a customer to drill down products within categories based on values you store in TVs on each product page. 
- [pdoTools](https://modx.com/extras/package/pdotools) to list resources and to generate menus.

These tools allow you to use MODX in the same way you would for normal sites. 

To hook up Commerce, you will then use what we call the **Products TV** on your product pages. This is a template variable type that ships with Commerce that lets you maintain a list of products that are associated with the page. 

Imagine this resource structure:

- Clothing
    - Shirts
        - Design A
        - Design B
        - Design C
    - Jeans
        - Design D
        - Design E
        - Design F
        
All designs will have a set of sizes that are available for selection on that product page. Those sizes are the products in Commerce, with their own price and stock. 

So let's start building. Install Collections, and create a sample resource structure for your shop, perhaps based on the sample above. Make sure to create a template for your categories, and a template for your product resources.

### Product Template

Create a [Products TV](../Product_Catalog/Products_TV) with name `products`, and assign it to your product template. Use it to create some products on one of your product pages. (For example, on your _Design A_ resource, add `Design A - M`, `Design A - L` and `Design A - XL` and give them different prices.)

In your product template, add `[[*products]]` to see the comma separated list of product IDs for that specific product page. We can turn that into a list of product variations with the [get_product](../Snippets/get_product) and [get_products](../Snippets/get_products) snippets. 

Start by making the first product in the list available as the main product information:

````html
[[!commerce.get_product? &product=`[[*products]]` &toPlaceholders=`product_info`]]
````

Now we can use placeholders prefixed with `product_info` to get any of the product fields. For example, we may show the resource title followed by the SKU and price of the first product, and then the main resource content that may include a product description:

````html
[[!commerce.get_product? &product=`[[*products]]` &toPlaceholders=`product_info`]]
<h1>[[*longtitle:default=`[[*pagetitle]]`]]</h1>
<h4>SKU: <code>[[!+product_info.sku]]</code> | Price: [[!+product_info.price_formatted]]</h4>
[[*content]]
````

We'll also need to add the ability to select from the different products, and submit that to the cart. [There are 2 different form structures you can use](../Product_Catalog/Add_to_Cart_Form), we'll use the single product variation.

````html
<form method="post" action="[[~[[++commerce.cart_resource]]]]" class="add-to-cart">
    <input type="hidden" name="add_to_cart" value="1">
    <input type="hidden" name="link" value="[[*id]]">
    
    <div class="product-variation">
        <label for="choose-variation">Product</label>
        <select id="choose-variation" name="product">
            [[!commerce.get_products? 
                &products=`[[*products]]`
                &tpl=`product_as_select`
            ]]
        </select>
    </div>
    <div class="product-quantity">
        <label for="add-quantity">Quantity</label>
        <input type="number" id="add-quantity" name="quantity" value="1">
    </div>
    
    <input type="submit" class="cta-button" value="Add to Cart">
</form>
````

The `product_as_select` chunk:

````html
<option value="[[+id]]">[[+name]] ([[+price_formatted]])</option>
````

What's important to note here is that we have 3 required fields we're submitting to the cart: 

- `add_to_cart` with value 1 to indicate we want to add something
- `product` with the ID of a Commerce Product that we want to add. In the example above, this is a `<select>`, but it can also be a hidden field. 
- `quantity` with the number of products to add. 

We're also submitting a `link` hidden field with the current resource ID. This is optional, meant to be used with the [ItemData](../Modules/Cart/ItemData) module to be able of linking back to where the user added the product from. 

When viewing a product resource, you should now have the add to cart form and basic product information shown. Adding to cart should also work, as the installation already set up our cart page accordingly.

### Category Template

In your category template, use [pdoResources](https://docs.modx.pro/en/components/pdotools/snippets/pdoresources) or [getResources](https://docs.modx.com/extras/revo/getresources) to generate a list of your product pages. Include the `products` TV so we can show information from the Commerce products.

For example:

````html
[[getResources?
    &parents=`[[*id]]`
    &limit=`20`
    &tpl=`template.products_list`
    &includeTVs=`1`
    &includeTVList=`products`]]
````

`template.products_list` chunk:

````html
<div class="product-list-item">
    <h4>
        [[+longtitle:default=`[[+pagetitle]]`]]
        <small>[[commerce.get_product? &product=`[[+tv.products]]` &field=`price_formatted`]]</small>
    </h4>
    <p>[[+introtext]]</p>
    <div class="product-list-actions">
        <form method="post" class="product-list-addform" action="[[~[[++commerce.cart_resource]]]]">
            <input type="hidden" name="add_to_cart" value="1">
            <input type="hidden" name="product" value="[[commerce.get_product? &product=`[[+tv.products]]` &field=`id`]]">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="link" value="[[+id]]">
            
            <input class="cta-button" type="submit" value="Add to Cart">
        </form>
        
        or <a href="[[~[[+id]]]]">find out more</a> 
    </div>
</div>
````

The add to cart form in this listing is slightly different because we used the quantity as a hidden field, and we're using the get_product snippet with a `&field` property to get specific product information. 

## Going beyond

With the basic structure in place, you can now start building our your catalog. Perhaps you want to add related products, show the add to cart form only if there's sufficient stock, or add more TVs to your products for highlights or product specs. 

## Next: customising your Cart & Checkout

The cart and checkout should already be up and running, but you can customise a great deal. [Lets work on the cart and checkout, and look at theming them with Twig](Cart_Checkout).
