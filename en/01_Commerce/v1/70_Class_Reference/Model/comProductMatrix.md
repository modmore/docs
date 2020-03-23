## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_product_matrix`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **principal<br>Default: `modResource`** | string (`varchar[190]`) |  |
| **principal_id** | integer (`int[10]`)<br>may be null |  |
| **principal_field** | string (`varchar[190]`)<br>may be null |  |
| **column_name** | string (`varchar[190]`) |  |
| **row_name** | string (`varchar[190]`) |  |
| **sku_template** | string (`varchar[190]`) |  |
| **name_template** | string (`varchar[190]`) |  |
| **description** | string (`varchar[1024]`)<br>may be null |  |
| **base_price** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **base_price_formatted** |  | `base_price` passed through the [financial formatter](../Formatters/financial) |
| **pricing** | string (`text`)<br>may be null |  |
| **base_weight** | float (`decimal[20,3]`)<br>may be null |  |
| **weight_unit** | string (`varchar[190]`)<br>may be null |  |
| **tax_group** | integer (`int[10]`)<br>may be null |  |
| **delivery_type** | integer (`int[10]`)<br>may be null |  |
| **removed** | boolean (`tinyint[1]`) |  |
| **removed_on** | int (`int[20]`) | UNIX timestamp |
| **removed_on_formatted** |  | `removed_on` passed through the [datetime formatter](../Formatters/datetime) |
| **removed_by** | boolean (`tinyint[1]`) |  |
