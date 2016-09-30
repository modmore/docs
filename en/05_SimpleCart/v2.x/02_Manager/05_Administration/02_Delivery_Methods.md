You can have multiple delivery methods to offer different prices for different types of shipping. SimpleCart does not currently support dynamic shipping prices based on product weight or target location out of the box. 

You can manage delivery methods at Extras > SimpleCart > Administer on the Delivery Methods tab.

## Method flags

In the grid you'll see a couple of flags for the delivery methods; you can change these values by double clicking the value in the grid. 

The **Ignore Free** column shows you if the method should ignore the "delivery free amount" setting at all. This setting controls from what order total delivery is free. If you don't want this delivery method to be affected by that setting, set ignore free to yes. 

The **Allow remarks** column is no longer used. 

The **Default** column lets you mark one delivery method as the standard one, which will be preselected in the checkout. 

With the **Active** column you can show or remove the method from the checkout. 

## Creating a new delivery method

You can update the title, price and description of the default delivery method to suit your needs. If you want to offer additional shipping options, you can add additional delivery methods with the _Create new Method_ button. 

[ ![The delivery create window](https://assets.modmore.com/uploads/2015/12/delivery_create_win.png)](https://assets.modmore.com/uploads/2015/12/delivery_create_win.png "The delivery create window")

- Name: Unique name of the delivery method. No weird characters and spaces allowed.
- Title: The human readable name for the delivery method. Stored as MODX Lexicon in the chosen language. 
- Description: The general description. Used on the frontend to inform customers about this method
- Order Description: This description is shown in the confirmation email.
- Price: The price that should be calculated for this methodLanguageSelect the language of the Title and Descriptions. Note: only SimpleCart languages available here

## Don't need a delivery method?

SimpleCart does expect the delivery method in the checkout, but you can hide it for the customer. 

Instead of calling the `[[!scDeliveryMethods]]` snippet in the cart (that's in the `scCart` chunk by default), add the following markup to the form:

```` html
<input type="hidden" name="deliveryMethod" value="1" />
````

Make sure the ID in the value is correct with your delivery method. With this change to the form, the order will always be created with that specific delivery method. 
