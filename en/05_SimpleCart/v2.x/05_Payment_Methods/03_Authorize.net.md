The Authorize.net Gateway for SimpleCart is free to install from the modmore.com package provider. Its source code can be found on [GitHub](https://github.com/modmore/SimpleCart_Stripe) and development was sponsored by Roger Sullivan, Founder of [Snow Day Code](http://snowdaycode.com/). Thanks, Roger!

After installing the gateway, it will show up in the Payment Methods tab in the SimpleCart > Administer component.

 [ ![](https://assets.modmore.com/uploads/2015/06/stripegateway.png)](https://assets.modmore.com/uploads/2015/06/stripegateway.png)

## Managing Gateway Configuration

To manage the properties for Authorize.net, simply hit the Cog icon next to the name, or right click the row in the grid and choose Configuration.

 [ ![](https://assets.modmore.com/uploads/2015/08/sc_authnet_conf.png)](https://assets.modmore.com/uploads/2015/08/sc_authnet_conf.png)

Here's what each of the properties are for:

- MD5 Hash Secret: the MD5 Hash Secret is really important, as this is used to validate the response from Authorize.net to make sure it is the real deal. The Hash Secret is a string of **up to 20 characters long**, which you also need to add to your Authorize.net merchant account. You can find this under Account > Security Settings > General Security Settings > MD5-Hash.
- Login ID: the ID for your merchant account (or sandbox account). This is provided during signup, but can also be found under Account > Security Settings > General Security Settings > API Login ID and Transaction Key.
- Transaction Key: found at the same place as the Login ID, the Transaction Key is also used for authentication and validation of the MD5 signature.
- Test Mode: set to 1 to use the sandbox, or 0 to use the live Authorize.net environment.

## Changing the Title, Description and Price

To manage the title, description and transaction fee for the Stripe gateway, you right click the gateway in the list and choose _Update Method_. In the popup, you can then edit those values.

The name cannot be changed, as that is tied in with loading and identifying the gateway.

 [ ![](https://assets.modmore.com/uploads/2015/08/sc_authnet_method.png)](https://assets.modmore.com/uploads/2015/08/sc_authnet_method.png)

## Streamlining the Hosted Checkout Form

As SimpleCart has already collected billing (and optional shipping) addresses before the user is forwarded to Authorize.net, we can simplify the hosted checkout form significantly. To do this, login to the sandbox/merchant dashboard again, and go to Account > Transaction Format Settings > Transaction Submission Settings > Payment Form.

In the page that opens you have several options for customising the checkout. You will likely want to use the Color & Font Settings, Header and Footer options for making the checkout look similar to your site visually, but right now we're interested in Form Fields primarily.

When opening the Form Fields page you will see a lot of checkboxes. You can choose to hide all of the fields completely by unticking them all, but as the gateway passes client information to Authorize.net you can also choose to leave "View" checked for the majority of the fields. That way the information is shown again on the checkout form for verification of the user.

_Please note that if you do choose to leave the various fields editable that the submitted information is NOT updated in SimpleCart when the user returns to the site._

After the user enters their credit card number and submits the form, they will be sent back to the Thank You page of your shop where the payment is validated and the order gets processed.