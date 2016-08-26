Product options in SimpleCart use a custom [Template Variable](http://rtfm.modx.com/revolution/2.x/making-sites-with-modx/customizing-content/template-variables) (TV) called the SimpleCart Option. 

Let's say you have products with different sizes or different colors and you want the customers to be able to select the one they want to order. 

## Create a new Template Variable

Navigate to the MODX elements tree on the left and click on the new Template Variable icon.

 [ ![Create a new TV for product options](https://assets.modmore.com/uploads/2015/12/products_options_newtv.png)](https://assets.modmore.com/uploads/2015/12/products_options_newtv.png "Create a new TV for product options")

In the form you can add the standard name and caption. Remember the name of the TV, as you'll need it to add to the add to cart form. Make sure to assign the template variable to your product template so it is available to edit. 

On the Input Options tab, set the input type to SimpleCart Option. This will give you a simple table when editing resources to enter the product options. 

 [ ![Product option TV input type should be set to ](https://assets.modmore.com/uploads/2015/12/products_options_newtv_input.png)](https://assets.modmore.com/uploads/2015/12/products_options_newtv_input.png "Product option TV input type should be set to ")
 
On the Output Options tab set the output type to SimpleCart Option as well. This will give you a few more options which control how the option is shown on the front-end website.

 [ ![Product option TV output type should also be set to SimpleCart Option](https://assets.modmore.com/uploads/2015/12/products_options_newtv_output.png)](https://assets.modmore.com/uploads/2015/12/products_options_newtv_output.png "Product option TV output type should also be set to SimpleCart Option")
 
 - Single Caption: the title to use on the front-end for a single of this product option, for example "Color" or "Size".
 - Type: how the option will be rendered in the add to cart form. This defaults to a select list, but can also be set to radio buttons, checkboxes (allowing multiple selections), or a custom chunk, detailed below. 

### Custom chunk placeholders

When using the custom chunk output option, you can use the following placeholders. 

- `[[+first]]`: 1 if this is the first option, otherwise an empty string. 
- `[[+last]]`: 1 if this is the last option, otherwise an empty string
- `[[+id]]`: the ID of the TV, which should be used to build the input's `name` attribute.
- `[[+value]]`: the value for the option
- `[[+label]]`: the label of the option that should be shown to the customer.
- `[[+price]]`: the additional price for the option
- `[[+percentage]]`: the percentage increase/decrease for the option

Here's an example of a custom chunk, which is in fact the standard for the select list output type.
   
```` html   
[[+first:notempty=`<select name="simplecart_option_[[+id]]">`]]
    <option value="[[+value]]" [[+selected:eq=`1`:then=`selected="selected"`]]>
        [[+label]][[+price:notempty=`, [[%simplecartoption.price? &namespace=`simplecart` &topic=`tvrenders`]]: &euro; [[+price:scNumberFormat]]`]][[+percentage:notempty=` ([[+percentage]]%)`]]
    </option>
[[+last:notempty=`</select>`]]
````   
## Example

This is what the product option TV might look like when editing a product.

 [ ![Example of a product option TV](https://assets.modmore.com/uploads/2015/12/products_options_input_example_1.png)](https://assets.modmore.com/uploads/2015/12/products_options_input_example_1.png "Example of a product option TV")
