## Meta

- Extends: [`comStatusChangeAction`](comStatusChangeAction)
- Table: `modx_commerce_status_change_action`

## Relations

- `StatusChange`: one [`comStatusChange`](comStatusChange) object (`comStatusChangeActionInvoice.status_change = comStatusChange.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **status_change** | integer (`int[10]`) |  |
| **name** | string (`varchar[190]`) |  |
| **description** | string (`varchar[1024]`) |  |
| **sortorder** | integer (`int[10]`) |  |
| **active<br>Default: `1`** | boolean (`tinyint[1]`) |  |
