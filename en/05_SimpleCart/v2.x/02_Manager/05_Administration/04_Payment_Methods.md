This page is about setting up a payment method in the SimpleCart manager. [Read more about the available payment gateways here](../../Payment_Methods).

Usually you don't have to set up additional payment methods. When installing a payment gateway, it is added to the grid for you during the installation.

If you're building your own gateway, you will need to add it manually. The name you enter must match with the name of the payment class, which should be located in `core/components/simplecart_{NAME}/{NAME}.class.php`. [See GitHub for example gateways](https://github.com/modmore/?utf8=%E2%9C%93&query=simplecart_).

The documentation about the [Delivery Methods](Delivery_Methods) also apply to Payment Methods. 

## Custom Payment Methods

Sometimes it may be useful to add a custom payment method that doesn't actually use a payment provider. For example if you would like to give customers the option to pay by cash on delivery. Or if you have a physical store and customers can pick up the ordered products in store and pay by cash there.

SimpleCart comes preinstalled with a `default` payment method which is not bound to a payment provider like PayPal, Mollie, Stripe or something else. It just marks the order as successful. In the checkout, this `default` payment method is listed as "Bank Transfer" by default.

### Create "Cash on Delivery" method

With these steps you can add an additional payment method that does not charge the user online. 

1. Go to Extras > SimpleCart > Administration and open the tab **Payment methods**
2. Create a new payment method with the Name set to `cashondelivery`. The name needs to be unique, so if you need even more options, repeat it with a different name. 
3. Next enter `Cash On Delivery` into the Title field and fill in all other fields as desired. The **Title**, **Description** and **Order Description** fields are stored in MODX lexicon to enable multilingual usage.
4. Save the payment method.
5. Using FTP/SSH, browse to `core/components/simplecart/gateways/`
6. Duplicate the `default` folder, including the file it contains. Name the new directory `cashondelivery` - the same as your method name.
7. Rename the file it contains from `default.class.php` to `cashondelivery.class.php`, again the same as your method name.
8. Edit the file with an editor and change the class name from **SimpleCartDefaultPaymentGateway** to **SimpleCartCashOnDeliveryPaymentGateway**

That's it! The new payment option is now listed within the SimpleCart checkout process. Repeat above steps to create further custom payment methods as needed. 
