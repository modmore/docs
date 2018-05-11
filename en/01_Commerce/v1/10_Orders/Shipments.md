Order shipments are automatically created during checkout as of Commerce v0.8. They're basically a collection of products that the customer ordered, which all belong to the same [Delivery Type](../Delivery_Types). 

Each Order Shipment is assigned to a shipping method. This makes it possible to have multiple shipping methods per order for different types of products. [The Delivery Type documentation](../Delivery_Types) explains in more detail how this process works. 

As of v0.11 order shipments are shown on the order view in the dashboard, along with the ability to edit  them. Extensions can also add additional information and actions to shipments, such as the [Packing Slip extension](https://www.modmore.com/commerce/extensions/packingslip/) which adds an action to print a packing slip with the product information and address to use in fulfillment.

## Custom Order Shipment Types

Custom Order Shipment Types can be used to further automate fulfillment, in particular for digital product types and with deep fulfillment integrations. 

- [UserGroupShipment](https://www.modmore.com/commerce/extensions/usergroupshipment/) allows you to automatically assign customer accounts to MODX user groups after completing an order. This is useful for selling access to sections of your site.

## Developing Custom Order Shipment Types

To create custom order shipment types, you'll need to [extend the comOrderShipment xPDO model](../Developer/Extended_Models). Your custom shipment type can then define methods to add fields to other forms in the dashboard (`getFieldsForDeliveryType`, `getFieldsForProduct`), add actions into the order shipment grid (`getShipmentActions`), and to automatically process an order when it is paid by the customer (`onOrderStateProcessing`).

