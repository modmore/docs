The `commerce.get_order` snippet will display information about a specific order on the customers' user account. This is typically used with [commerce.get_orders](get_orders) which lists orders available on a account, which will link to a detail page that has the get_order snippet on it.

This will send the customer to the unauthorized_page if they are not logged in, and the error page if the order does not exist or is not assigned to their account.
 
Added in v0.9.

## Usage

```` html
[[!commerce.get_order]]
[[!commerce.get_order? &tpl=`name/of/twig/template.twig`]]
````

## Properties

- `&tpl`: the name of a twig template file (_not_ a chunk) to show the order details. This defaults to frontend/account/order-detail.twig, which you should override in a [custom theme](../Front-end_Theming). The ability to specify a different tpl is mostly meant for when you have different variations of the detail page (e.g. for different contexts)
 - `&loadItems`: 1 or 0 to indicate if items should be loaded. If you're not showing items, you can gain a bit of speed by setting this to 0. Defaults to 1.
 - `&loadStatus`: 1 or 0 to indicate if the status record should be loaded. If you're not showing the status name, you can gain a bit of speed by setting this to 0. Defaults to 1.
 - `&loadTransactions`: 1 or 0 to indicate if transactions should be loaded. If you're not showing transactions, you can gain a bit of speed by setting this to 0. Defaults to 1.
 - `&loadBillingAddress`: 1 or 0 to indicate if the billing address should be loaded. If you're not showing the billing address, you can gain a bit of speed by setting this to 0. Defaults to 1.
 - `&loadShippingAddress`: 1 or 0 to indicate if the shipping address should be loaded. If you're not showing the shipping address, you can gain a bit of speed by setting this to 0. Defaults to 1.