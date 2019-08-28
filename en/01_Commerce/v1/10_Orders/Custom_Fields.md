Custom order fields were added in v0.12. They are [added to an order programmatically](../Developer/Order_Fields) or through an existing module like the [Basic Custom Fields module](../Modules/Custom_Fields_(Basic)). 

The basic concept of a custom order field is that it has a name, a value, and a type which is indicated by the class. A custom order field may render differently to the merchant in the dashboard, compared to customer-facing rendering in emails or templates.


Some modules store certain information in custom order fields. This includes the [Coupons module](../Modules/Discounts/Coupons), which adds a special Coupon-type order field.  

Important to note: a custom order field has a max length of 190 characters. For fields that need more than that, consider a custom field type that stores a reference to a dedicated table. 

## Accessing custom order field values

To read the value of a custom field, you can use `{{ order_fields.NAME_OF_FIELD }}`, for example `{{ order_fields.delivery_date }}`. 

You can also read all custom fields, like so:

``` html
<ul>
  {% for fieldName, fieldValue in order_fields %}
    <b>{{ lex('commerce.' ~ fieldName) }}:</b>
    {{ fieldValue|raw }}
  {% endfor %}
</ul>

That works in [email templates](../Orders/Messages) as well as checkout templates.
