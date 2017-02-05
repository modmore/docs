To add a product to the cart, you'll need to submit the product record ID (not the catalog ID) to the cart page. There are two variations supported, one for multiple products, and the other for single products. 

## Single Products Form

With the single products form only one product can be added to the cart per request. As the structure of the form is a little easier than the multiple products form, it is easier to use this when providing different products as variations in your catalog. 

Include an `add_to_cart` hidden input with value 1, provide the product ID in a `product` input, and provide the quantity in a `quantity` input. 

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    <input type="hidden" name="product" value="123">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="quantity" value="1">
    
    <input type="submit" value="Add to Cart">
</form>
````

Alpha note: support for the single products form was added in 0.3.3.

## Multiple Products Form

To add multiple products, you need to provide a `add_to_cart` value and a `products` array. The products array is provided as `product id => [options]`, for example `products[123][quantity] = 5`.

In a form, that looks somewhat like this. Replace `123` with the ID of your product. 

```` html
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    
    <label for="add-quantity">Quantity:</label>
    <input type="number" name="products[123][quantity]" value="1">
    
    <input type="submit" value="Add to Cart">
</form>
````

Note that these two form structures cannot be mixed. The `products[id][quantity]` array format takes precedence over the `product` + `quantity` structure.

## AJAX

You can also add products to the cart using AJAX. Just serialize the form values, and POST those values to the cart page with an XMLHttpRequest. Instead of HTML, you'll get JSON back. 

For example the following jQuery snippet can be used to progressively enhance add to cart forms with AJAX. 

```` html
<script type="text/javascript">
$(document).on('ready', function() {
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
