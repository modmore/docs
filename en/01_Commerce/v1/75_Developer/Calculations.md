As [mentioned in the taxes documentation](../Taxes), Commerce handles calculations primarily on the order item level, in particular the tax calculation.

Here you'll find what the different numbers for each calculation means and how they interact. 

## Order Items

Most calculations happen on the order item. 

### Subtotal

The subtotal is simply calculated as the price per item, times the quantity. This is the base price for a row in the cart/order. 

### Shipping

If per-item shipping costs are added (which is not something currently exposed in the core), the shipping field on the item will sum those up.

### Discount

The discount field sums up order item price adjustments. 

### Total Before Tax

The `total_before_tax` is a sum of the subtotal, the shipping and the discount fields, prior to the tax calculation taking place (see total excluding tax description, below)

### Total Excluding Tax

The `total_ex_tax` contains the total price for the item excluding the calculated tax. 

If `commerce.tax_calculation` is set to `exclusive`, this value will be the same as `total_before_tax`. 

However if `commerce.tax_calculation` is set to `inclusive`, it will be lower because `total_before_tax` is based on prices including tax, while `total_ex_tax` has removed the tax portion. 

### Tax

The total tax based on summing up the tax for the item. The tax field may consist of different tax rates stacked on top of each other. 

### Total

The actual grand total for this item. 

## Order

On the order objects you'll find totals and non-item-specific numbers. 

### Subtotal

Sum of the `subtotal` of all order items combined. 

### Shipping

Sum of the `shipping` of all order items combined, plus the fee for each order shipment (based on shipping method) combined.

### Discount

Sum of the `discount` of all order items combined.

### Transaction

The total transaction fee for the order. This is calculated by taking the `fee` column of all transactions that have a status of pending or completed. 

### Total Before Tax

The `total_before_tax` is a sum of the subtotal, the shipping and the discount fields for all items combined.

### Total Excluding Tax

The `total_ex_tax` contains the total price excluding the calculated tax. 

If `commerce.tax_calculation` is set to `exclusive`, this value will be the same as `total_before_tax`. 

However if `commerce.tax_calculation` is set to `inclusive`, it will be lower because `total_before_tax` is based on prices including tax, while `total_ex_tax` has removed the tax portion. 

### Tax

The total tax as calculated, from all items combined. The tax calculation uses the `total_before_tax` column as value to calculate tax on. 

The tax field may consist of different tax rates stacked on top of each other. 

### Total

The actual grand total for the order. 

### Total Due

The total amount of the order that is as of yet unpaid. This is based on the `total`, minus the total amount that was already paid. The amount that was already paid is calculated by summing up the `amount` for all transactions with a status of completed. 