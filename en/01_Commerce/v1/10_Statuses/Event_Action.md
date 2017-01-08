With the Event Status Change Action you can fire an event that modules listen to at a specific stage of the checkout. This is most useful for modules that need to interact with an order, but need the timing for that to be configured by the merchant.

Of course, such modules could also provide their own status change action implementation. 

[TOC]

## Options

The following options are available when creating or updating an event status change action.

- Event: the name of the event to fire.

## Listener Event

Modules that listen to the defined event will receive an OrderStatus event object which contains references to the order, new and old status, and status change that was fired. 

