Every order has a status. This status summarises where along the process the order is. 

As you can see below there are four default statuses on installation. These statuses are used by SimpleCart by default, but you can add custom ones or change the title of the existing ones through Extras > SimpleCart > Administer on the Statuses tab.

[ ![The default list of statuses available to use out of the box](https://assets.modmore.com/uploads/2015/12/statuses_overview.png)](https://assets.modmore.com/uploads/2015/12/statuses_overview.png "The default list of statuses available to use out of the box")

- Draft: This status is used by new orders, created by you via the MODX Manager
- New order: This is the status on new orders being placed by customers. 
- Finished order: This is the status that will be set to the order when the order was placed and payment was received. 
- Payment failed: This status will be used when the payment failed. The order log typically contains more information about why the payment failed if this happens. 

## Creating a new status

It's easy to add new order statuses to the above list. Just hit the _Create_ button and fill in the form that pops up. 

[ ![Create new order statuses window](https://assets.modmore.com/uploads/2015/12/statuses_create_win.png)](https://assets.modmore.com/uploads/2015/12/statuses_create_win.png "Create new order statuses window")

When you create a new status you will notice you have to enter a name and a title. 

The name a **unique reference** for the status. It should be unique, lowercase, without spaces or non-standard characters, and cannot be changed once it is created. 

The title is what the status is shown as. This is stored as a lexicon (you can switch the language to see translations) and can change. 

Every status can also have a default message. This is meant to be the default message that is sent to the customer when the order status is updated. By filling in a default message, it will appear automatically [when changing the order status](https://modmore.com/simplecart/documentation/manager/orders/update-status/). 

This default message can also contain placeholders like `[[+firstname]]` and `[[+lastname]]`.

## Overriding default statuses

To override the status that's used by SimpleCart in the checkout process, you have to create your own status and use the name (reference) as value for a new MODX System Setting. These settings are not created automatically.

Let's say you want to give all new orders a status "processing" instead of "new". Below the steps to take;

1. Create a new status, with the name `processing`
2. Go to your MODX System Settings and select `simplecart` from the namespaces list
3. Add a new setting with the key `simplecart.new_order_status`
4. Fill the value with the name of your new status (`processing` in this example)
