## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_order_log`

## Relations

- `Order`: one [`comOrder`](comOrder) object (`comOrderLog.order = comOrder.id`)
- `ActionBy`: one `modUser` object (`comOrderLog.action_by = modUser.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **order** | integer (`int[10]`) |  |
| **created_on** | integer (`int[20]`) |  |
| **action_by** | int (`int[10]`) |  |
| **public** | boolean (`tinyint[1]`) |  |
| **message** | string (`varchar[1024]`) |  |
