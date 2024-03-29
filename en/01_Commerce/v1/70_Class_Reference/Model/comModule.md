Stored copies of modules; should not typically be interacted with directly.

## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_module`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **enabled_in_test** | boolean (`tinyint[1]`) |  |
| **enabled_in_live** | boolean (`tinyint[1]`) |  |
| **name** | string (`varchar[250]`) |  |
| **author** | string (`varchar[250]`) |  |
| **class_name** | string (`varchar[250]`) |  |
| **class_path** | string (`varchar[250]`) |  |
| **error** | string (`varchar[250]`) |  |
