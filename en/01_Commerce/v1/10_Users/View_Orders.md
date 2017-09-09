So you set up a [login resource](Login_Resource) and customers are checking out. Now, you want your customers to be able of seeing their past orders.

Commerce comes with 2 snippets to help you do that.

1. [commerce.get_orders](../Snippets/get_orders) is used to list a collection of orders.
2. [commerce.get_order](../Snippets/get_order) is used to view a single order

Both snippets have access to all the order information. This gives you two options:

1. Create a list of orders with the `get_orders` snippet, link those orders to a different order detail resource that has the `get_order` snippet; or
2. Create an accordion-style order list with just the `get_orders` snippet, where all information is loaded on the same resource. 

## Basic setup (Orders + separate Order Detail)

On an Orders resource, add `[[!commerce.get_orders]]` to the content or its template. This will show a simple table with orders. 

To add pagination, you can use [getPage](https://modx.com/extras/package/getpage) or pdoPage, for example:

````html
[[!getPage? &element=`commerce.get_orders` &limit=`10`]]
[[!+page.nav]]
````

Update the `commerce.orders_resource` system setting with the ID of the orders resource.

On an Order Detail resource, add `[[!commerce.get_order]]` to the content or its template. This will look at the `order` request parameter to determine what order to show.

Update the `commerce.order_resource` system setting with the ID of the order detail resource.

This should give you a simple, but functional, order view.
 
## Basic setup (Orders with included Order Detail)

To show order details within the same page, you'll need to provide a custom template that shows the order information you'd like to show. 

This could be used to create a nice accordion-style orders page, where clicking a table row will expand it to show the purchased items, address information, etc. 

## More information

See the snippet documentation for [commerce.get_orders](../Snippets/get_orders) and [commerce.get_order](../Snippets/get_order). Those contain all the available properties. 