## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_product_matrix_row`

## Relations

- `Matrix`: one [`comProductMatrix`](comProductMatrix) object (`comProductMatrixRow.matrix = comProductMatrix.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **matrix** | integer (`int[10]`)<br>may be null |  |
| **sortorder** | integer (`int[10]`)<br>may be null |  |
| **sku** | string (`varchar[190]`) |  |
| **name** | string (`varchar[190]`) |  |
| **description** | string (`varchar[1024]`)<br>may be null |  |
| **price_change** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **price_change_formatted** |  | `price_change` passed through the [financial formatter](../Formatters/financial) |
| **pricing** | string (`text`)<br>may be null |  |
| **active<br>Default: `1`** | boolean (`tinyint[1]`) |  |
