The `commerce.get_orders` snippet will list orders that a logged in customer placed.  This is typically used with [commerce.get_order](get_order) which shows detailed information about the specific order, but the get_orders snippet also has access to all information, so it could also be implemented in an accordion-style order listing.

This snippet will send the user to the unauthorized_page if they are not logged in, and show a message if no orders exist yet. It shows orders that are processing or completed.

This snippet can be paginated with getPage or pdoPage.
 
Added in v0.9.

## Usage

```` html
[[!commerce.get_orders]]
[[!commerce.get_orders? &tpl=`name/of/twig/template.twig`]]
[[!getPage? &element=`commerce.get_orders` &limit=`10`]] [[!+page.nav]]
````

## Properties

- `&tpl`: the name of a twig template file (_not_ a chunk) to show the orders. This defaults to frontend/account/orders.twig, which you should override in a [custom theme](../Front-end_Theming). The ability to specify a different tpl is mostly meant for when you have different variations of the orders page (e.g. for different contexts)
- `&sortby`: a field name to sort the orders by. Defaults to the date the order was created.
- `&sortdir`: `ASC` or `DESC`.
- `&limit`: the amount of orders to show. Defaults to 10.
- `&offset`: the amount of orders to skip at the start, used with pagination. Defaults to 0.
- `&totalVar`: the variable to set the total results to. Used with getPage/pdoPage. Defaults to `total`.
- `&loadItems`: 1 or 0 to indicate if items should be loaded. If you're not showing items, you can gain a bit of speed by setting this to 0. Defaults to 1.
- `&loadStatus`: 1 or 0 to indicate if the status record should be loaded. If you're not showing the status name, you can gain a bit of speed by setting this to 0. Defaults to 1.
- `&loadTransactions`: 1 or 0 to indicate if transactions should be loaded. If you're not showing transactions, you can gain a bit of speed by setting this to 0. Defaults to 1.
- `&loadBillingAddress`: 1 or 0 to indicate if the billing address should be loaded. If you're not showing the billing address, you can gain a bit of speed by setting this to 0. Defaults to 1.
- `&loadShippingAddress`: 1 or 0 to indicate if the shipping address should be loaded. If you're not showing the shipping address, you can gain a bit of speed by setting this to 0. Defaults to 1.
- `&loadShipments`: 1 or 0 to indicate if the [order shipments](../Orders/Shipments) should be loaded into a `shipments` array. The shipment also contains the chosen shipping method. Defaults to 1. Added in 0.11.1.
- `&loadOrderFields`: 1 or 0 to indicate if custom order fields should be loaded. Defaults to 1. Added in v0.12.

