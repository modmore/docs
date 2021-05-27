With the User Group Shipment, you can set up delivery types that automatically assign users to a specified user group on payment. This is especially useful when you sell access to a private part of a website.

**User Group Shipment is available as a separate (free) package from the modmore.com package provider** and is also on [GitHub](https://github.com/modmore/Commerce_UserGroupShipment). Commerce 0.11 is required to use it.

[TOC]

## Configuration

- Download and install the User Group Shipment for Commerce package from our package provider.
- In the Commerce Dashboard, navigate to Configuration > Modules to enable the UserGroupShipment module. This makes the shipment type available.
- At Configuration > Delivery Types, create or edit a Delivery Type and set the Shipment Type to "Assign User to User Group"
- Create or edit a product and set the Delivery Type to the one from step 3. Save the product.
- Choose the user group in the Delivery Type section of the product

Note that when you're just setting this up, you may need to complete your order or delete and re-add products to the cart, in order for the right shipment type to be used. 

## Advanced usage

By default, roles will be assigned automatically when an order moves from Draft to Processing. However, you can also use Status Change Actions to control that with more granularity.

1. Uncheck the "Run automatically when an order is moved to processing" box on the Shipping Method editing screen
2. Add a "Assign User Groups to purchaser" Status Change Action to the status that you would like this to apply to
