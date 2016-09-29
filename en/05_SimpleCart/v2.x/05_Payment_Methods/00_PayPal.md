The PayPal Gateway for SimpleCart is free to install from the modmore.com package provider. Its source code can be found on [GitHub](https://github.com/modmore/SimpleCart_PayPal).

After installing the gateway, it will show up in the Payment Methods tab in the SimpleCart > Administer component.

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.05.04.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.05.04.png)

## Managing Gateway Configuration

To manage the configuration of the gateway, including the API connection to PayPal, click the cog icon in the Title column. A new window will pop up, that provides you with a number of configuration options you can update by double clicking the value.

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.07.42.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.07.42.png)

We'll go over these options now.

- Currency: set this to the 3 character code of currencies to use. This should match the currency configured as default on the Currencies tab.
- Disable PayPal Shipping: when set to 1, PayPal will not ask for shipping details. When set to 0, customers will be asked to choose or provide their address when paying with PayPal. As shipping details will already be collected by PayPal, setting this to 1 is typically the recommended action.
- API Password, Username and Signature: please see below on how to get these.
- Sandbox Mode: when set to 1, the gateway will operate on the sandbox APIs. This is useful while testing, but make sure to set this to 0 when you're going live. Make sure your API password, username and signature match the environment too.

When you're happy with the configuration, close the window. Double click the value in the Active column to enable the gateway for your customers.

## Changing the Title, Description and Price

To manage the title, description and transaction fee for the PayPal gateway, you right click the gateway in the list and choose _Update Method_. In the popup, you can then edit those values.

The name cannot be changed, as that is tied in with loading and identifying the gateway.

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.16.55.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.16.55.png)

## Getting Live API Keys

To get your Live API Keys, login to the PayPal dashboard. Go to Tools in the top menu, and choose PayPal Express Checkout under Accept Payments Anywhere.

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.30.33.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.30.33.png)

Under Integrated Carts, find the link that says Request API Signature and follow the instructions until you get the API Username, Password and Signature. Enter those values into the gateway configuration to set up your cart.
