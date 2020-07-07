## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_currency`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **name** | string (`varchar[100]`) |  |
| **active** | boolean (`tinyint[1]`) |  |
| **alpha_code** | string (`varchar[3]`) |  |
| **numeric_code** | integer (`int[5]`) |  |
| **subunits** | integer (`int[5]`) |  |
| **prefix** | string (`varchar[20]`) |  |
| **suffix** | string (`varchar[20]`) |  |
| **decimal_point** | string (`varchar[20]`) |  |
| **thousands_separator** | string (`varchar[20]`) |  |
