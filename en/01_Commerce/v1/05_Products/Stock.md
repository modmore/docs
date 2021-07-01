Commerce natively supports stock/inventory levels, but this is not enabled by default. These are stored on the product records and also included in the [product reports](../Reports).

To enable stock control you'll need to enable either or both the Update Stock and Enforce Stock modules.

## Resource Products

To use stock with [Resource Products](Resource_Products), make sure you've set up a number template variable to hold the stock level and have set the `commerce.resourceproduct.stock_field` system setting accordingly.

## Stock Modules

To automatically reduce the stock level when an order is paid, enable the [Update Stock module](../Modules/Cart/UpdateStock).

To make sure customers cannot add more to their cart than what is in stock, enable the [Enforce Stock module](../Modules/Cart/EnforceStock) as well.

When using third party stock management (e.g. an ERP or PIM system), you'd typically only use EnforceStock to prevent customers from ordering more than is available. Instead of the UpdateStock module, you'd let products retrieve the accurate stock directly from the ERP/PIM system, or have said ERP/PIM systems push the product stock levels into Commerce.

## Unlimited Stock (v1.1+)

For some products that do not need stock levels, such as digital products, you can check the "Infinite Stock" on the product. When set, the EnforceStock module does not check the amount of products in stock.

In the front-end, you can use the `stock_infinite` boolean value to customise the way stock is presented to customers. Depending on the context, that's available with `[[+stock_infinite]]` (with [get_product](../10_Snippets/get_product.md)), `{{ product.stock_infinite }}` (in [templates for matrixes](../10_Snippets/get_matrix.md)), or `{{ item.product.stock_infinite }}` (in cart/checkout templates).
