## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_tax_group`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **name** | string (`varchar[190]`) |  |
| **description** | string (`varchar[1024]`)<br>may be null |  |
| **active<br>Default: `1`** | boolean (`tinyint[1]`) |  |
