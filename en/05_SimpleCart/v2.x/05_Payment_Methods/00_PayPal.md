The PayPal Gateway for SimpleCart is free to install from the modmore.com package provider. Its source code can be found on [GitHub](https://github.com/modmore/SimpleCart_PayPal).

After installing the gateway, it will show up in the Payment Methods tab in the SimpleCart > Administer component.

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.05.04.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.05.04.png)

## Managing Gateway Configuration

To manage the configuration of the gateway, including the API connection to PayPal, click the cog icon in the Title column. A new window will pop up, that provides you with a number of configuration options you can update by double clicking the value.

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.07.42.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.07.42.png)

We'll go over these options now.

- Currency: set this to the 3 character code of currencies to use. This should match the currency configured as default on the Currencies tab.
- Disable PayPal Shipping: when set to 1, PayPal will not ask for shipping details. When set to 0, customers will be asked to choose or provide their address when paying with PayPal. As shipping details will already be collected by SimpleCart, setting this to 1 is typically the recommended action.
- API Password, Username and Signature: please see below on how to get these.
- Sandbox Mode: when set to 1, the gateway will operate on the sandbox APIs. This is useful while testing, but make sure to set this to 0 when you're going live. **Note**: live and sandbox modes both have their own unique credentials. See instructions below to retrieve the appropriate credentials.

When you're happy with the configuration, close the window. Double click the value in the Active column to enable the gateway for your customers.

## Changing the Title, Description and Price

To manage the title, description and transaction fee for the PayPal gateway, you right click the gateway in the list and choose _Update Method_. In the popup, you can then edit those values.

The name cannot be changed, as that is tied in with loading and identifying the gateway.

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.16.55.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.16.55.png)

## Getting Live API Keys

> Note: PayPal tends to shuffle around their menus from time to time. [Here's the official guidance for creating the relevant credentials.](https://developer.paypal.com/docs/nvp-soap-api/apiCredentials/#api-signatures)

To get your Live API Keys, login to the PayPal dashboard. Hover your name in the top right and choose **Account Settings**. Under **Account Access** click on update for the **API Access** entry.

Find the **NVP/SOAP API integration (Classic)** item under Custom checkout experience and click **Manage API credentials**. 

![Finding API Credentials](https://docs.modmore.com/en/Commerce/images/gateways/paypal-nvp.jpg)

Generate the API Signature and copy the username, password, and signature into the payment method.

## Getting Sandbox API Keys

Login to the [PayPal Developer Site](https://developer.paypal.com/developer/accounts/), and browse to Sandbox > Accounts. 

Create a new account with type Business (Merchant Account). In the list of accounts, expand the merchant account and click on Profile. In the modal window, you can find the Username, Password and Signature on the API Credentials tab.

![PayPal Sandbox Credentials](https://docs.modmore.com/en/SimpleCart/images/paypal-sandbox.jpg)
