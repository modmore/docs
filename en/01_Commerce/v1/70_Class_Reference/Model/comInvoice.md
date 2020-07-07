## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_invoice`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **test** | boolean (`tinyint[1]`) |  |
| **order** | integer (`int[10]`)<br>may be null |  |
| **currency** | string (`varchar[3]`) |  |
| **context<br>Default: `web`** | string (`varchar[190]`)<br>may be null |  |
| **reference** | string (`varchar[190]`)<br>may be null |  |
| **reference_incr** | integer (`int[10]`)<br>may be null |  |
| **created_on** | int (`int[20]`) | UNIX timestamp |
| **created_on_formatted** |  | `created_on` passed through the [datetime formatter](../Formatters/datetime) |
| **template** | string (`varchar[190]`)<br>may be null |  |
| **raw_data** | array (`text`)<br>may be null |  |
| **file_name** | string (`varchar[190]`)<br>may be null |  |
