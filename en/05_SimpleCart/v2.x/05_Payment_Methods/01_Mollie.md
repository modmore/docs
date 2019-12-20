The Mollie Gateway for SimpleCart is free to install from the modmore.com package provider. Its source code can be found on [GitHub](https://github.com/modmore/SimpleCart_Mollie).

After installing the gateway, it will show up in the Payment Methods tab in the SimpleCart > Administer component.

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.05.04.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.05.04.png)

## Managing Gateway Configuration

To manage the Mollie API Key, click the cog icon in the Title column. A new window will pop up, that gives you a field to enter the API Key in. Your Mollie API Keys can be found under [Beheer > My Account > Website profiles](https://www.mollie.com/beheer/account/profielen/) in the Mollie dashboard. If you don't have a Mollie account yet, [you can sign up here](https://www.mollie.com/nl/signup/718037).

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.24.49.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.24.49.png)

The API Key can be both your live or test API Key. Just make sure to change it to the live one when your shop is launched.

When you're happy with the configuration, close the window. Double click the value in the Active column to enable the gateway for your customers.

## Changing the Title, Description and Price

To manage the title, description and transaction fee for the Mollie gateway, you right click the gateway in the list and choose _Update Method_. In the popup, you can then edit those values.

The name cannot be changed, as that is tied in with loading and identifying the gateway.

 [ ![](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.25.37.png)](https://assets.modmore.com/uploads/2015/06/Screen_Shot_2015_06_11_at_17.25.37.png)

## Payments not getting confirmed?

The Mollie integration uses a webhook to listen to payments. If you're constantly stuck in the "Payment is awaiting confirmation" view, the webhook may be failing.

To check the webhook URL, login to the Mollie dashboard and look at a specific transaction. Find the Webhook URL for the transaction, and verify that it is correct.

In many cases, we've seen that webhook URLs are generated with `HTTP` while the site runs on `HTTPS`. That can cause webhooks to fail. To fix that, update the `server_protocol` system setting in MODX to `https`. 
