Status Change Actions are internally represented as `comStatusChangeAction` objects, and a number of derivative classes. It is primarily these derivative classes that you will use, and for more advanced use cases you will likely write your own. 

The base `comStatusChangeAction` object doesn't really do anything.

The following derivatives are included in Commerce:

- `comStatusChangeActionEmail`. This action will send an email. The various settings, like who to send it to, its contents and other meta data, are configured through the status workflow editor in the commerce admin area. This allows the single action class to send a number of different emails just by adding additional configurations. 

- `comStatusChangeActionEvent`. This status change action will allow you to fire a user-defined (custom) event. This is convenient to use if you want to provide the merchant/site builder the flexibility to define when a custom module is defined by adding the actions to their status workflow. Your module can then listen to that particular event.

Below you'll find more information about each, and the options they expose/require. For information on custom actions, keep reading.

## Email Action (comStatusChangeActionEmail)

The email action allows you to configure an email to be sent whenever a certain status change happens. The obvious use cases are sending an order confirmation and a shipping notification email to the customer, but this can also be used to send a copy of the order to the merchant or accounting department.

## Event Action (comStatusChangeActionEvent)

The Event action fires a user-defined event. This event will be passed a `modmore\Commerce\Events\OrderStatus` object, which contains references to the order, old status, new status and the status change object; all available via getters. 

An example use case for this implementation is a flexible CRM integration. An admin could use the status workflow editor to set up when certain information gets pushed to the CRM to fit their workflow. 

## Custom Actions
For advanced actions, you can write your own action class. Basically extend the `comStatusChangeAction` class, and provide a `process()` method to do what you need it to do. 

To define options that need to be shown in the interface, define the <.........> method and make it return an array of fields.
