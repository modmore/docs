By default SimpleCart sends two email confirmation when new orders are placed. One of them goes to the customer, and the other to the shop merchant.

[ ![Default configuration for SimpleCart's confirmation emails](https://assets.modmore.com/uploads/2015/12/emails_overview.png)](https://assets.modmore.com/uploads/2015/12/emails_overview.png "Default configuration for SimpleCart's confirmation emails")

Click _Create new email_ or right click an email to edit it. The fields are mostly self-explanatory. 

## To & From address formatting

In the boxes for setting up the addresses you can enter some hard coded details. But you also have the ability to use placeholders here. Basically you can use every placeholder known at the order. Some examples:

- `[[+address.firstname]]` and `[[+address.lastname]]` or `[[+address.name]]`
- `[[+address.email]]`

To enter the to or from address with both a name and an email address (which you should!), separate the email and name with a colon (`:`), like `[[+address.email]]:[[+address.name]]`.

## Template setup

The email is created based on some different chunks. Each of this chunks does it's own part of the email and you can create yours to override the default ones. Here's a list of all the template options;

- `tpl`: This template is used to wrap your whole email in. This also will contain the "greeting" and stuff like totals from the order done by your customer. Default [scEmailOrder](../../Chunks/scEmailOrder),
- `rowTpl`: This row template is used to wrap the ordered products in, inside your wrapper template. This will be used for all products added to the order, in the email to the customer. Default: [scEmailOrderRow](../../Chunks/scEmailOrderRow)
- `rowOptionTpl`: This row option template is used to wrap the custom product options in, per ordered product. This will be used for all product options added to the product, in the email to the customer. Default: [scEmailOrderRowOptions](../../Chunks/scEmailOrderRowOptions)
- `rowFieldTpl`: This row field template is used to wrap the custom product fields in, per ordered product. This will be used for all custom fields added to the product, in the email to the customer. Default: [scEmailOrderRowField](../../Chunks/scEmailOrderRowField)
- `vatRowTpl`: This template is used to wrap the different VAT rows in, wrapped inside the wrapper template. This will be used for all VAT rows in the email to the customer. Default: [scEmailOrderVatRow](../../Chunks/scEmailOrderVatRow)

## Override with snippet properties

Each email has a unique type. This can be used to override email properties on the scFinishOrder snippet. This can be useful if you have different carts/checkout flows and want an email to go to a different address depending on the used cart. This can be achieved by adding the following properties:

```` html   
[[!scFinishOrder?
    ...
    &emailStoreTo=`you@example.com`
    &emailStoreSubject=`A new order is made`
    ...
]]
````

The `&emailStore` part indicates that the `To` and `Subject` for the email with the unique type `store` needs to be overridden. For the email sent to the customer, the properties are simply `&emailTo` and `&emailSubject` as that is the default email.  
