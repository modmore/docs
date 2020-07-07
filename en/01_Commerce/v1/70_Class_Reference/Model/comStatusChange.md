## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_status_change`

## Relations

- `Source`: one [`comStatus`](comStatus) object (`comStatusChange.source = comStatus.id`)
- `Target`: one [`comStatus`](comStatus) object (`comStatusChange.target = comStatus.id`)
- `Actions`: many [`comStatusChangeAction`](comStatusChangeAction) objects (`comStatusChange.id = comStatusChangeAction.status_change`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **source** | integer (`int[10]`) |  |
| **target** | integer (`int[10]`) |  |
| **sortorder** | integer (`int[10]`) |  |
| **name** | string (`varchar[190]`) |  |
| **description** | string (`varchar[1024]`) |  |
