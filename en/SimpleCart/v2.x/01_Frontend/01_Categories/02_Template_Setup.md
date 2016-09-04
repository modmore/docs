To list products on your category pages you can use [getResources](http://rtfm.modx.com/extras/revo/getresources) and [getPage](http://rtfm.modx.com/extras/revo/getpage). 

While you can show product information with pdoTools as well, that does not load additional product information like the price and product image. 

## The getResources snippet code

A simple getResources call is all it takes to show a list of products. Here's an example:
   
 ```` html   
[[getResources?
    &parents=`[[*id]]`
    &tpl=`scProductOverviewItem`
    &sortby=`menuindex ASC, id`
    &sortdir=`ASC`
    &limit=`0`
    &includeContent=`1`
]]
 ````   

[View the getResources documentation](http://rtfm.modx.com/extras/revo/getresources) for a list of all properties and options it provides. 

## The product chunk contents

The `scProductOverviewItem` chunk used to show your products is included with the SimpleCart package, as example. Here's what it contains by default. 

   
 ```` html   
<div class="item">
    <h2><a href="[[~[[+id]]]]">[[+pagetitle]]</a> ([[+product_code]])</h2>
    <p class="price">[[+product_price_formatted]]</p>

    <form action="[[~[[*id]]]]" method="post">
        <div>
            <input type="hidden" name="productid" value="[[+id]]" />
            <input type="text" name="quantity" value="1" />
            <input type="submit" name="addcart" value="Add to Cart" />
        </div>
    </form>
</div>
 ````   
As you can see, it uses some default resources fields, like the pagetitle and the ID to generate the page link. It also uses some custom placeholders, which are provided by SimpleCart. 

## Include SimpleCarts custom fields

To make placeholders like the product_price and product_code available, it is necessary to add the &includeContent property with a value of 1 to your getResources snippet call. 

Note: this doesn't currently work with pdoResources. 
   
```` html   
[[getResources?
    ...
    &includeContent=`1`
    ... 
]]
````  
 
If you're using a custom snippet to retrieve products, you can also retrieve these placeholders with the toArray() or get($key) methods on a simpleCartProduct instance. Here's an example:

   
```` php   
<?php

// the product resource id
$id = 123;

// getting the object instance
$resource = $modx->getObject('simpleCartProduct', $id);

// also possible: since MODX turns it into a simpleCartProduct object automatic
//$resource = $modx->getObject('modResource', $id);

// get a single custom product field
$price = $resource->get('product_price');

// get all, including the defaults
$fields = $resource->toArray(); 
````   

Note: the custom fields like the currency `_formatted` fields are not standard fields, but they're generated "on the fly", so you cannot apply this trick on those fields. 

## SimpleCart Meta fields

The SimpleCart meta fields contain the image, price, code and stock. 

- `[[+product_image]]`: the absolute url to the main product image.
- `[[+product_price]]`: the unformatted product price for one item.
- `[[+product_price_formatted]]`: the product price for one item, formatted with the currency sign and decimal/thousands separator. 
- `[[+product_code]]`: the product code or SKU for the product
- `[[+product_stock]]`: the number of items still in stock for this product
- `[[+special_price]]`: (since v2.5) the special discounted price for the product, unformatted.
- `[[+special_price_formatted]]`: (since v2.5) a properly formatted representation of the special product price. 
- `[[+special_valid_from]]`: (since v2.5) the start date for when the special price becomes/became valid, as a datetime string.
- `[[+special_valid_to]]`: (since v2.5) the end date for the special price, as a datetime string.


For tax/VAT prices there are a number of other placeholders, however it is important to note that these only contain the right values if SimpleCart can figure out which prices to use. This means that if your Tax Rate has rules based on the country for example, that SimpleCart will **not** apply that tax rate until it knows what country a user is from.

This typically means that customers either need to be logged in and have a country on their profile, or they've already entered it in the checkout. 

The following tax related placeholders are available:

- `[[+product_tax_ex]]`: the price excluding tax, unformatted. Use `[[+product_tax_ex_formatted]]` for a properly formatted value. 
- `[[+product_tax_in]]`: the price including tax, unformatted. Use `[[+product_tax_in_formatted]]` for a properly formatted value. 
- `[[+product_tax_price]]`: the amount of tax that was added to the price (the difference between the price excluding and including tax), unformatted. Use `[[+product_tax_price_formatted]]` for a formatted value.
- `[[+product_tax_rate]]`: the unformatted tax rate percentage. 

The formatting of price related placeholders can be configured through the [currencies](../../Manager/Currencies) in SimpleCart.

## Adding products to the cart

To actually add the product to the cart, you need to call the scAddProduct snippet on the category page. 
   
```` html   
[[!scAddProduct]]
````   
There are a couple of properties you can set for this snippet call, and the most common is the one to redirect to the shopping cart when you have added a product.

```` html   
[[!scAddProduct? &redirectTo=`123`]]
````

Just change "**123**" into the ID of the respirce where you put the shopping cart. 

[Read more about the "scAddProduct" snippet here](../../Snippets/scAddProduct).

## Apply pagination to your template

You can use [getPage](http://rtfm.modx.com/extras/revo/getpage) for adding pagination. Compared to the earlier getResources call, you just switch out the snippets and add some getPage-related properties.
   
```` html   
[[!getPage?
    &element=`getResources`
    &cache=`1`
    &parents=`[[*id]]`
    &tpl=`scProductOverviewItem`
    &sortby=`menuindex ASC, id`
    &sortdir=`ASC`
    &limit=`10`
]]

[[!+page.nav]]
```` 

It's important to make sure this call is uncached (the `!` in front of the snippet call), otherwise the result is not changed when browsing to another page.

Another notice here is the &limit property. Previously we set this to 0, to not apply any limitations on the listing. But now it acts as the "items per page" configuration. So in the above example we will have 10 products per page.  

The final `[[!+page.nav]]` placeholder will put the pagination on your page.

It's possible to use Property Sets for the properties, for example for the getPage properties. [You can read about property sets in the MODX documentation](http://rtfm.modx.com/revolution/2.x/making-sites-with-modx/customizing-content/properties-and-property-sets#PropertiesandPropertySets-WhatarePropertySets%3F).