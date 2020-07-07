## Meta

- Extends: [`comProduct`](comProduct)
- Table: `modx_commerce_product`

## Relations

- `Products`: many [`comProductBundleProduct`](comProductBundleProduct) objects (`comProductBundle.id = comProductBundleProduct.bundle`)
- `PriceIndex`: many [`comProductPriceIndex`](comProductPriceIndex) objects (`comProductBundle.id = comProductPriceIndex.product`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **sku** | string (`varchar[190]`) |  |
| **barcode** | string (`bigint[20]`)<br>may be null |  |
| **name** | string (`varchar[190]`) |  |
| **description** | string (`varchar[1024]`)<br>may be null |  |
| **price** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **price_formatted** |  | `price` passed through the [financial formatter](../Formatters/financial) |
| **pricing** | string (`text`)<br>may be null |  |
| **stock** | integer (`int[20]`)<br>may be null |  |
| **stock_infinite** | boolean (`tinyint[1]`) |  |
| **weight** | float (`decimal[20,3]`)<br>may be null |  |
| **weight_unit** | string (`varchar[190]`)<br>may be null |  |
| **image** | string (`varchar[190]`)<br>may be null |  |
| **tax_group** | integer (`int[10]`)<br>may be null |  |
| **delivery_type** | integer (`int[10]`)<br>may be null |  |
| **target** | integer (`int[10]`)<br>may be null |  |
| **removed** | boolean (`tinyint[1]`) |  |
| **removed_on** | int (`int[20]`) | UNIX timestamp |
| **removed_on_formatted** |  | `removed_on` passed through the [datetime formatter](../Formatters/datetime) |
| **removed_by** | boolean (`tinyint[1]`) |  |
