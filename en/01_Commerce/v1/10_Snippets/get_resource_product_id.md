The `commerce.get_resource_product_id` snippet can be used to retrieve the product IDs, specifically for use with a [Resource-based Catalog](../Product_Catalog/Resource). It looks up a product record which links to the current (or provided) resource for its information.

## Usage

Call cached inside an add to cart form. 

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="products[ [[commerce.get_resource_product_id]] ][quantity]" value="1">
    
    <input type="submit" value="Add to Cart">
</form>
````

## Properties

- `resource`: the resource ID to look up a product record for. Leave empty to look up a product for the current resource. 
- `classKey`: the comProduct derivative to look up. This is set to `comResourceProduct` by default, which will be fine for 99% of all use cases. If you're not sure if you need to provide this, you don't need to provide it. 
- `autoCreateIfNotExists`: set to `1` (default) to automatically create new product records for the provided resource if there isn't one yet. **Note**: before using this snippet with autocreate enabled, make sure your resources and related resource product system settings are set up correctly. 

## Used Templates

None.
