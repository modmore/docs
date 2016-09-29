SimpleCart has a basic checkout flow and relevant statuses. Here's an illustration of what typically happens. 

[ ![](https://assets.modmore.com/uploads/2015/12/orders_status_flow_diagram.png)](https://assets.modmore.com/uploads/2015/12/orders_status_flow_diagram.png)

The order is created with either a status of `finished` or `payment_failed` depending on the result of the transaction. 

If you'd like to change the finished order status, you can either create a new status and create/update the `simplecart.finished_order_status` setting, or rename the finished status through the lexicon system. 

## Renaming the Finished status

In your MODX manager, go to System > Lexicons. In the dropdowns above the grid, select the namespace `simplecart` and topic `statuses`. Double click on the value for the lexicon key `simplecart.statuses.finished` and update the value. 

As this updated value is stored separately from the SimpleCart files, this is safe for upgrades. You can repeat the process for different languages if needed. 

## Create a new status

Alternatively you can create a new status entirely. Go to Extras > SimpleCart > Administer and open the Order Statuses tab. 

Create the new status. Note that the **name needs to be unique**. The title is specific to the chosen language, and the Default Message is for an optional email notification to the user when an order is set to this status. 

To make sure new orders are automatically assigned to your status, go to the SimpleCart system settings via System > System Settings > choose simplecart in the first dropdown. If it doesn't exist yet, create a setting with the key `simplecart.finished_order_status`. Set the value to the name (not title) of the status you just created. 
