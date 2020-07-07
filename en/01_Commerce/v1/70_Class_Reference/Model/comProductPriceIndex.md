Price index for products; containing the currently valid price for a product for easier searching and filtering.

## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_product_priceidx`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **product** | integer (`int[10]`) |  |
| **currency** | string (`varchar[3]`) |  |
| **price** | integer (`int[10]`) |  |
