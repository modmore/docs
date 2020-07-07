## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_status`

## Relations

- `Changes`: many [`comStatusChange`](comStatusChange) objects (`comStatus.id = comStatusChange.source`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **name** | string (`varchar[190]`) |  |
| **color<br>Default: `#DDDDDD`** | string (`varchar[10]`) |  |
| **state<br>Default: `new`** | string (`varchar[190]`) |  |
| **sortorder** | integer (`int[20]`) |  |
| **removed** | boolean (`tinyint[1]`) |  |
| **removed_on** | int (`int[20]`) | UNIX timestamp |
| **removed_on_formatted** |  | `removed_on` passed through the [datetime formatter](../Formatters/datetime) |
| **removed_by** | boolean (`tinyint[1]`) |  |
