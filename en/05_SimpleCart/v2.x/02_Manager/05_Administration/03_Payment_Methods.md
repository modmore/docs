This page is about setting up a payment method in the SimpleCart manager. [Read more about the available payment gateways here](../../Payment_Methods).

Usually you don't have to set up additional payment methods. When installing a payment gateway, it is added to the grid for you during the installation.

If you're building your own gateway, you will need to add it manually. The name you enter must match with the name of the payment class, which should be located in `core/components/simplecart_{NAME}/{NAME}.class.php`. [See GitHub for example gateways](https://github.com/modmore/?utf8=%E2%9C%93&query=simplecart_).

The documentation about the [Delivery Methods](Delivery_Methods) also apply to Payment Methods. 
