On the Orders tab of Extras > SimpleCart > Management you can find all orders that customers have placed in your shop. From here you can control the orders, such as [changing the order status](Update_Status), [resending the order confirmation](Resend_Confirmation) and [exporting selected orders to CSV](Export_to_CSV). 

It's also possible to [create a new order from the manager](Create_new_Order).

[ ![The first management page for SimpleCart inside the MODX® Manager](https://assets.modmore.com/uploads/2015/12/orders_overview.png)](https://assets.modmore.com/uploads/2015/12/orders_overview.png "The first management page for SimpleCart inside the MODX® Manager")

## Overview of the columns

- Order Nr: The generated order number, starts with a configurable start number.
- Name: The customers name and optional the username if bound to a user.
- Address: A combined value of all the address fields from the order/invoice address.
- Total: The total amount for this order
- Status: The current order status (by default: "new", "finished" or "payment failed")
- Created date: A date-time stamp when the order was created

## Quick Statistics

At the top of the page you can see a short statistics bar where you can see the number of total orders, finished orders and the open orders. These statistics are automatically updated every 30 seconds. 

[ ![Short SimpleCart order statistics top bar](https://assets.modmore.com/uploads/2015/12/orders_overview_topbar.png)](https://assets.modmore.com/uploads/2015/12/orders_overview_topbar.png "Short SimpleCart order statistics top bar")

The "cog" icon in this top bar is only visible for administrators or for users with the SimpleCart admin permissions. It takes the user to the [Administration section](../Administration). 

## Auto refresh the orders list

For testing or for busy shops, automatically refreshing the list of orders by checking the checkbox at the top can be useful. With it enabled, SimpleCart will refresh the order list every 30 seconds, or at an interval specified in the `simplecart.auto_refresh_time` system setting. 

[ ![The actions for the SimpleCart orders overview](https://assets.modmore.com/uploads/2015/12/orders_overview_gridtop.png)](https://assets.modmore.com/uploads/2015/12/orders_overview_gridtop.png "The actions for the SimpleCart orders overview")

## Language selection

On the right side of the toolbar you can select a language. This language box contains all  languages for SimpleCart, so not for MODX in general. When you change the language here, you will see for example that the "Status" column labels are changed into the selected language. This is useful when you want to update an order status (and send the email notification) in another language than your MODX interface language.

## View order details

To view the order details you can right click on an order in the list and choose [View order details](View_Details). In this view you can see all information for the order, including addresses, products, order log and custom fields. 

## Creating a new order

With the _Create new order_ button you can create an order from the back-end. This is useful for invoice-based billing or when accepting orders via the phone. [Read more about creating orders here](https://www.modmore.com/simplecart/documentation/manager/orders/create-new-order/).

[ ![The SimpleCart order create window](https://assets.modmore.com/uploads/2015/12/orders_overview_createorder.png)](https://assets.modmore.com/uploads/2015/12/orders_overview_createorder.png "The SimpleCart order create window")