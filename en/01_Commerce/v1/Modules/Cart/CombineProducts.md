The EUVat Module is shipped with the Commerce core. It needs to be enabled before use via Configuration > Modules. 

The CombineProducts module runs when products are added to the cart, and makes sure that there is only ever a single row of a specific product (based on SKU and price) in the cart. Additional products are combined into a single cart row.

To give an example. 

1. Bob adds Awesome Product to the cart. His cart now has 1x Awesome Product in it.
2. Bob also adds Great Product to the cart. His cart now has 1x Awesome Product and 1x Great Product in it.
3. Bob adds another Awesome Product to the cart. 
    - Without the CombineProducts module, the cart will contain 1x Awesome Product, 1x Great Product, and 1x Awesome Product. 
    - With the CombineProducts module, the cart will contain 2x Awesome Product and 1x Great Product.
    
Not all types of products are suitable for use with this module. For example if you sell red carpets, the quantity of a product might be the length in meter or inch. If a customer requires one carpet of 4 meters, and one carpet of 3 meters, with this module enabled you would only see an order of 7 meters without the length of each carpet the customer wanted. 
