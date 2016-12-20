Commerce contains a very flexible system to allow custom status workflows. These are primarily meant to make the system match your business requirements for the fulfillment stage. 

Basically, everything between when a customer checks out and when the order is marked as completed in the back-end.

There are a couple of core concepts when it comes to the status workflow in Commerce.

1. **Status**. We do need to have the actual status. Examples of statuses are _New Order_, _Processing_ and _Completed_; but also more advanced use cases like _In backorder_ or _Awaiting return_ can be added. The status can have a color and description to provide additional context and recognisability to the merchant. An order can only be in one status at a time.

2. **Status Change**. To control exactly how an order flows through the process, the status changes restrict movement from one status to the next. This can be configured as a simple linear flow ("New Order" => "Processing" => "Completed"), but also as a more complex flow with loops or reverting back to earlier or even the same status ("New Order" => "Processing" => "In backorder" => "Processing" => "Completed"). It is only possible to change an order from one status to the next if there is an appropriate Status Change configured; randomly jumping between statuses is not supported in Commerce.

3. **Status Change Action**. When a status change happens, it's not just a database field that is updated. Depending on your business requirements, a lot more can happen at that point. With Status Change Actions, which are tied to a specific Status Change, you can configure certain actions to be automatically processed when an order is pushed through a status change. The most obvious example would be sending a shipping confirmation email when an order status moves from "Awaiting pickup" to "Shipped" status. There are also more advanced use cases, such as triggering a synchronization action which will synchronize data with a CRM system.

These three concepts are strongly related to each other. They are also managed from the same page in the Commerce admin area, under Status Workflow.

For relevant technical information, please see [Orders](Developer/Orders), [Modules](Developer/Modules) and [Status Change Actions](Developer/Status_Change_Actions) in the Developers Reference.
