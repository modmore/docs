[Authorize.net](https://www.authorize.net/) is a major payment provider with both online and offline payment solutions for credit cards. It is heavily focused on merchants in the United States.

Commerce integrates with Authorize.net with their Accept.js integration, offering an on-page credit card form with minimal PCI-DSS compliance. It also supports auth/capture payment flows.

This integration does require javascript to be enabled by the customer.

## Creating an Authorize.net Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

Authorize.net requires the following configuration options:

- **API Login ID**: Merchant's unique ID.
- **Transaction Key**: The transaction key is used server-side to create the actual transactions. A new key can be created in the Authorize.net merchant interface by navigating to Account > Settings > Security Settings > API Credentials & Keys.
- **Client Key**: The public client key that can be used on the client-side. It can be foundor created in the Authorize.net merchant interface by navigating to Account > Settings > Security Settings > General Security Settings > Manage Public Client Key.
- **Request authorization instead of payment**: Opt-in to use the [Authorize/Capture payment flows](Authorize_Capture_Flow), which means you request a temporary hold on a credit card upfront but only charge that when delivering your products. This was added to Authorize.net in 1.3.0-rc8.

> Prior to Commerce 1.3.0-rc8, there were separate properties for Test and Developer mode. In 1.3.0-rc8, we removed those to bring the Authorize.net gateway in line with other gateways, which toggles production/sandbox based on the mode Commerce is in.  Make sure to set up the Availability accordingly.
