Taxes in Commerce are usually handled automatically. For example the EUVat module will automatically apply the proper tax rate to an order. It's possible to create your own modules that handle tax rates.

Taxes are always handled with the following in mind. This is a fairly technical list of considerations. 

- Modules provide tax **rates**, not the actual calculation of how much tax is on an order.  
- Taxes are applied for each item in the cart individually. This is then summed up for the total tax on the order. 
- Different tax rates can be stacked on top of each other, for example in the USA where there are State taxes and County or City taxes. Each of these tax rates is applied individually, while Commerce will handle the calculation. Each tax rate has its own key, provided by the tax module. 
- While different tax rates stack, applying a tax rate that has the same key as a rate that was already added will instead overwrite the old rate. 

## Prices Exclusive vs Inclusive 

Commerce defaults to treating product prices as exclusive of taxes. Any tax rate provided will be added on top of the product price. This is most commonly used in business-to-business sales, or if the tax rates vary so much depending on customer location that it's not realistically possible to provide the inclusive price up-front. 

By configuring the `commerce.tax_calculation` system setting to `inclusive`, this behaviour can be changed to treat product prices as inclusive of taxes. In this case the product price is what the customer will pay, and the tax percentage is taken as a cut from that. 

Prices including taxes are most commonly used in business-to-consumer shops. 

**Note:** changing the `tax_calculation` setting will only affect new orders. Existing orders remain unchanged. If you're in the cart/checkout process and want to see the result of changing the setting, you can append `_commerce_recalculate=1` to force a recalculation. It is possible to get caching issues in this scenario, so manually removing the contents of `core/cache/commerce/` can be necessary. 