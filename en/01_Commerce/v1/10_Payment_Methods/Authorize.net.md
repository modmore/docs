[Authorize.net](https://www.authorize.net/) is a big payment provider. It provides credit card payments.

Commerce integrates with Authorize.net with their Accept.js integration, so the customer stays on the website, while you're still clear from PCI-DSS compliance. 

This integration does require javascript to be enabled by the customer.

## Creating an Authorize.net Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

Authorize.net requires the following configuration options:

- **API Login ID**: Merchant's unique ID.
- **Transaction Key**: The transaction key is used server-side to create the actual transactions. A new key can be created in the Authorize.net merchant interface by navigating to Account > Settings > Security Settings > API Credentials & Keys.
- **Client Key**: The public client key that can be used on the client-side. It can be foundor created in the Authorize.net merchant interface by navigating to Account > Settings > Security Settings > General Security Settings > Manage Public Client Key.
- **Test Mode**: Indicates if these credentials are for the sandbox or the live mode. Make sure to also set the payment method to be available in the appropriate mode only.
- **Developer Mode**: Test mode is sometimes referred to as developer mode, but configured separately. If you've enabled test mode, also enable developer mode.