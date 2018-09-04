---
title: Item Data
---

The Item Data module allows you to add, or overwrite, arbitrary data when adding a product to cart. The data is persisted in the order item, and shown back to you in the order view automatically.

This lets you do a bunch of different things:

- Add a customer note to specific items
- Accept "name your own price"-type products
- Offer very basic product options that do not affect price/stock/sku/etc.

The Item Data module ships with Commerce 0.11 and up. 

Note that the [Combine Products Module](CombineProducts) may discard data when it combines two different order items into one.

[TOC]

## Properties

- Allowed fields: a comma separated list of field names that the module should accept and store. Only fields on this list are accepted, anything else is quietly discarded.

## Fields to use

Technically you can use any of the order item fields, but the module is particularly useful with the following:

- `comment`: allow the user to add a comment/note to an order item
- `price`: lets the user set their own price. Note that because the module operates globally, and not per product, allowing the price field would make it possible for customers to change the price of any product in their cart.
- `link`: while resource products automatically have a link back to their source, standard products (in a Products TV) do not. If you pass along the link field with the ID of a resource, Commerce will store a link to that resource in the order items' link.

**Please be aware that there is risk in accepting any user input**. While Commerce escapes user input in twig-powered templates, you may need to take additional protection measures if you use the data elsewhere (including in MODX chunks, e.g. get_cart, and custom exports). 

You can define arbitrary field names, including names that don't exist in the order item schema. In that case the value will be added to the order item properties, and you will probably want to create a new lexicon entry (via System > Lexicon Management) with the key `commerce.YOUR_FIELD_NAME` to present it nicely in the dashboard.

## Implementing custom fields 

The ItemData module is fired when products are added to the cart, so you will need to add additional fields to your [add to cart forms](../../Product_Catalog/Add_to_Cart_Form).

Commerce doesn't place strict requirements on the type of field. Its name only needs to match one of the fields in your allowed fields property.

For example, to allow the customer to enter special requests into the comment field, make sure you've enabled the Item Data module and added `comment` to the allowed fields, and then use a form like this:

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    <input type="hidden" name="product" value="123">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="quantity" value="1">
    
    <label for="add-comment">Special request:</label>
    <textarea name="comment" id="add-comment"></textarea>
    
    <input type="submit" value="Add to Cart">
</form>
````

When using the multiple-products form, add the fieldname inside the products array, for example like this:

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="products[123][quantity]" value="1">
    
    <label for="add-comment">Special request:</label>
    <textarea name="products[123][comment]" id="add-comment></textarea>
    
    <input type="submit" value="Add to Cart">
</form>
````

## Showing custom fields in the cart or emails

Once you've added fields, you may want to show them somewhere. For example in the cart (`frontend/checkout/cart/items.twig`), checkout summary view (`frontend/checkout/partial/summary.twig`) or in the confirmation email (`emails/order-received.twig`). 

If you've not worked with the templates in Commerce before, read up on those first under Front-end Theming.

Depending on wether the field name you used is an existing field (e.g. `name`, `price`, or `comment`), or if it doesn't (e.g. `special_request`, `ship_to`), you can access the value as `{{ item.KEY_HERE }}` or `{{ item.properties.KEY_HERE }}`. For example the comment would be in `{{ item.comment }}`, as that's a recognised core field, while `special_request` does not exist in the Commerce schema, so that would be `{{ item.properties.special_request }}`. 

The custom fields will automatically be shown in the order view in the dashboard.
