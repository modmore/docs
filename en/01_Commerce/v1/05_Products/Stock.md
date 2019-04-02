Commerce natively supports stock/inventory levels. These are stored on the product records and also included in the [product reports](../Reports). 

To use stock with [Resource Products](Resource_Products), make sure you've set up a number template variable to hold the stock level and have set up the `commerce.resourceproduct.stock_field` system setting accordingly.

To automatically reduce the stock level when an order is paid, enable the [Update Stock module](../Modules/Cart/UpdateStock). 

To make sure customers cannot add more to their cart than what is in stock, enable the [Enforce Stock module](../Modules/Cart/EnforceStock) as well. 

When using third party stock management (e.g. an ERP or PIM system), you'd typically only use EnforceStock to prevent customers from ordering more than is available. Instead of the UpdateStock module, you'd let products retrieve the accurate stock directly from the ERP/PIM system. 
