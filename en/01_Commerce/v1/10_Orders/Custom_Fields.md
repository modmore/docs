Custom order fields were added in v0.12. They are [added to an order programmatically](../Developer/Order_Fields) or through an existing module like the [Basic Custom Fields module](../Modules/Custom_Fields_(Basic)). 

The basic concept of a custom order field is that it has a name, a value, and a type which is indicated by the class. A custom order field may render differently to the merchant in the dashboard, compared to customer-facing rendering in emails or templates.

Some modules store certain information in custom order fields. This includes the [Coupons module](../Modules/Discounts/Coupons), which adds a special Coupon-type order field.  

Important to note: a custom order field has a max length of 190 characters. For fields that need more than that, consider a custom field type that stores a reference to a dedicated table. 
