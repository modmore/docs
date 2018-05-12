All orders in Commerce have a _State_ and a _Status_. 

[TOC]

## States

There are 4 different _States_:

- **Draft** is used for orders that have not yet been completed by the customer. Orders are created in the database with a draft state when they click _Checkout_ in the cart, so this may contain abandoned carts as well as customers that are still going through the checkout.

- **Processing** is for orders that have been received (and paid), but have not yet been handled and marked as completed by the merchant. When in the Processing state, you can make changes to orders via the dashboard.

- **Completed** is for orders that the merchant has marked as being completed. This means the order has been shipped and no changes to the order are allowed anymore.

- **Cancelled** is for orders that were cancelled. These could have been draft or processing orders, but the bottom line is that they have not been fulfilled. 

## Statuses

_States_ cannot be changed and are core to the Commerce system.

_Statuses_ on the other hand are configured by your development team, and determine how an order flows from one state to the next. 

A typical status workflow could be, for example:
 
1. Draft
2. Received 
3. Processing
4. Ready for shipping
5. Shipped

In this example, the Draft _status_ matches the Draft _state_, and when payment is received Commerce automatically sets the order to the _Processing_ state with the _Received_ status, notifying the merchant and the customer about the new order.

Then when you or your warehouse starts working on the order, they change the status to _Processing_. When the package is packaged, they change the status to _Ready for shipping_ which may automatically create the shipping label for your carrier and send the customer their tracking code. 

Finally, when the package has been picked up, the status is changed to _Shipped_, and the _state_ is changed to _Completed_. 

## Status Changes

What status changes are available to you when managing an order depends on how your development partner set up the status workflow. Commerce offers a lot of flexibility for custom integrations to enhance your fulfillment process, with automatic actions and messages being sent at any step.

If you're unsure about the specifics of your status workflow, or how to improve the process, please contact your development partner.


