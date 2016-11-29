This page is about setting up a payment method in the SimpleCart manager. [Read more about the available payment gateways here](../../Payment_Methods).

Usually you don't have to set up additional payment methods. When installing a payment gateway, it is added to the grid for you during the installation.

If you're building your own gateway, you will need to add it manually. The name you enter must match with the name of the payment class, which should be located in `core/components/simplecart_{NAME}/{NAME}.class.php`. [See GitHub for example gateways](https://github.com/modmore/?utf8=%E2%9C%93&query=simplecart_).

##Custom Payment Methods

Sometimes it could be necessary to setup a **custom payment** method without actually using a specific payment provider. For instance you would like to give customers the possibility to pay by cash on delivery. Or you have a physical store (beside your web shop) and customers can pick up the ordered products in store and pay by cash there.

SimpleCart comes preinstalled with a **default** payment method which is not bound to a payment provider like PayPal, Mollie, Stripe or something else. On your website - within the checkout process, this **default** payment method is listed as "Bank Transfer" (on english language sites).

###Now let's create a new payment option for allowing **cash on delivery**:

1. within SimpleCart Configuration page open the tab **Payment methods**
2. create a new payment method here and enter **cashondelivery** into the **Name** field (this needs to be a unique name)
3. now enter **Cash On Delivery** into the **Title** field and fill in all other fields as needed. Please note: the **Title**, **Description** and **Order Descriptiom** fields are stored in MODX lexicon to enable multi language usage.
4. save this new payment method
5. for the next step please navigate to the web-root of your MODX installation (e.g. via FTP) and go to folder: /core/components/simplecart/gateways
6. locate the folder **default** and duplicate it - including it's content
7. rename the duplicated folder to **cashondelivery**
8. open this folder and rename the file within to **cashondelivery.class.php**
9. open this file with an editor an change the class name from **SimpleCartDefaultPaymentGateway** to **SimpleCartCashOnDeliveryPaymentGateway**

That's it! The new payment option is now listed within the SimpleCart checkout process. Repeat above steps to create further custom payment methods as needed. 

The documentation about the [Delivery Methods](Delivery_Methods) also apply to Payment Methods. 
