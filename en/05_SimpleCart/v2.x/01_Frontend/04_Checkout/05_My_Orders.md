SimpleCart hooks into the user management provided by MODX. This allows you to add an account  section to your website where the user can view their past orders. 

SimpleCart does not provide the login functionality; instead it is assumed you use the [Login extra](http://rtfm.modx.com/extras/revo/login/login.tutorials/login.basic-setup) for setting up this secure area on your website.

## Assigning orders to users

If a customer is logged in when they place an order, it will be automatically assigned to their account. 

## My Orders

Once you have your [members-only area](https://rtfm.modx.com/revolution/2.x/administering-your-site/security/security-tutorials/making-member-only-pages) set up in MODX, you can add a page that lists the users orders with the [scGetOrders snippet](../../Snippets/scGetOrders). 

All you need is the following snippet call. 

```` html   
[[!scGetOrders]]
````   

This will get the orders for the currently logged in users, and includes an order detail page as well. For customising the output, see the [scGetOrders documentation](../../Snippets/scGetOrders). 

## Bind existing orders to a user

If a customer isn't logged in when checking out, you can still bind an order to an account via the SimpleCart backend. 

Find the order, right click it in the list, and choose _Bind order to user_ in the context menu. 

[ ![Bind order to user context menu in the SimpleCart Manager](https://assets.modmore.com/uploads/2015/12/orders_bind_user.png)](https://assets.modmore.com/uploads/2015/12/orders_bind_user.png "Bind order to user context menu in the SimpleCart Manager")

In the modal window you can search for the account it should be bound to. After saving that, the customer can view the order on the _My Orders_ page when they're logged in.
