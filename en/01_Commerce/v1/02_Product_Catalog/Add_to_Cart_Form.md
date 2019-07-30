To add a product to the cart, you'll need to submit the product record ID (not the resource ID) to the cart page. There are two form variations supported, one for multiple products, and the other for single products. 

[TOC]

## Single Products Form

With the single products form only one product can be added to the cart per request. As the structure of the form is a little easier than the multiple products form, it is easier to use this when providing different products as variations in your catalog. 

The form includes:
- an `add_to_cart` hidden input with value 1, this is used to trigger the add to cart logic.
- the product ID in a hidden `product` input. This should be made dynamic, for example with the commerce.get_resource_product_id snippet, a TV holding the product ID(s) (like the Commerce Products TV), or a different way that you establish a products' ID.
- the quantity in a `quantity` input

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    <input type="hidden" name="product" value="123">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="quantity" value="1">
    
    <input type="submit" value="[[%commerce.add_to_cart]]">
</form>
````

The `[[%commerce.add_to_cart]]` lexicon was added in v0.12; in older versions you may need to hardcode your submit text.

## Multiple Products Form

To add multiple products in a single submit action, you need to provide a `add_to_cart` value and a `products` array. The products array is provided as `product id => [options]`, for example `products[123][quantity] = 5`.

In a form, that looks somewhat like this. Replace `123` with the ID of your product. 

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="products[123][quantity]" value="1">
    
    <input type="submit" value="[[%commerce.add_to_cart]]">
</form>
````

Note that these two form structures cannot be mixed. The `products[id][quantity]` array format takes precedence over the `product` + `quantity` structure.

## Adding custom fields to the order item

Commerce (as of 0.11) supports simple custom fields using the [Item Data Module](../Modules/Cart/ItemData.md). The module allows you to define what field names to accept from the user, and then you can start sending those fields along with the add to cart request. This is great for user comments or simple product variations that have no impact on stock. 

[See the Item Data Module documentation](../Modules/Cart/ItemData.md) for instructions on how to set that up.

## AJAX

You can also add products to the cart using AJAX. Just serialize the form values, and POST those values to the cart page with an XMLHttpRequest. Instead of HTML, you'll get JSON back. 

For example the following jQuery snippet can be used to progressively enhance add to cart forms with AJAX. 

```` html
<script type="text/javascript">
$(function() {
    // Grab all forms with a class of `add-to-cart`
    $('form.add-to-cart').on('submit', function(e) {
        // Prevent regular submit
        e.preventDefault();
        
        var form = $(this),
            action = form.attr('action'),
            values = form.serialize();
            
        $.ajax({
            url: action,
            data: values,
            dataType: 'json',
            success: function(result) {
                console.log(result);
                // If we receive a success message, show an alert.
                // You probably want to make this do something nice instead.
                if (result.success) {
                    if (result.message && result.message.length) {
                         alert(result.message);
                    }
                    if (result.redirect) {
                        window.location = result.redirect;
                    }
                }
                else {
                    if (result.message && result.message.length) {
                         alert(result.message);
                    }
                    else {
                        alert('Could not add the product to the cart.');
                    }
                }
            }
        });
    });
});
</script>
````

The JSON returned by the server will look something like this.

```` json
{
  "success": true, // true or false
  "message": "Added <Name of Product> to your cart.", // a localised success/error message
  "redirect": false, // false or the url to redirect the user to
  "redirect_method": "GET", // GET or POST. When this is POST, and redirect is a URL, you should create a form and submit it
  "redirect_data": [], // An array of name => value pairs of data to submit when redirect_method = POST
  "errors": [], // an array of errors
  "output": "... the full html that would have normally been shown ...",
  "order": { // information about the order / cart contents
    "subtotal": 3000,
    "discount": 0,
    "shipping": 0,
    "transaction": 0,
    "total_ex_tax": 3000,
    "tax": 0,
    "total": 1800,
    "total_due": 1800,
    "total_quantity": 2,
    "subtotal_formatted": "€18.00",
    "discount_formatted": "€0.00",
    "shipping_formatted": "€0.00",
    "transaction_formatted": "€0.00",
    "total_ex_tax_formatted": "€18.00",
    "tax_formatted": "€0.00",
    "total_formatted": "€18.00",
    "total_due_formatted": "€18.00",
    "items": [
      {
        "product": 1,
        "sku": "BEANIE",
        "name": "modmore blue beanie",
        "link": "link/to/product.html", // false or a link to the product in the catalog
        "description": "",
        "price": 900,
        "quantity": 2,
        "subtotal": 1800,
        "discount": 0,
        "shipping": 0,
        "total_before_tax": 1800,
        "total_ex_tax": 1800,
        "tax": 0,
        "total": 1800
      },
      {
        // additional products
      }
    ]
  }
}
````

### Other AJAX Cart actions

The following cart actions are available and require the mentioned data. This should be `POST`ed to the page.

- Add product to cart: `add_to_cart=1` + `products[123]['quantity']=321` or `product=123` and `quantity=321`.
- Remove item: `remove_item=123` where `123` is the ID of the order item
- Update cart quantities: `update_cart=1` + object `items[order_item_id] = quantity` 
- Continue to the checkout (persist order to database and show account step): `checkout=1`

