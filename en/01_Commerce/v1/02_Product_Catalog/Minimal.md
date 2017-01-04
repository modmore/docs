With a (very) minimal catalog, the products store in Commerce are the catalog. This gives you very little features in terms of providing additional information, but that's why it's called the minimal catalog. 

## Pros

- Product management is in a single place
- Best for shops with only one or very few products. 

## Cons

- (Alpha) No snippets available yet to load product information into your frontend.
- Very basic, only a SKU, name, description and price are available per product.

## Setup

For the minimal product catalog, you'll create your product records in Commerce > Products as standard products. 

## Add to cart form

Somewhere on your site (a "shop" page?), add the following add to cart form, replacing `123` on line 5 below with the ID of your created product. 

You can repeat the form for additional products. 

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="products[123][quantity]" value="1">
    
    <input type="submit" value="Add to Cart">
</form>
````
