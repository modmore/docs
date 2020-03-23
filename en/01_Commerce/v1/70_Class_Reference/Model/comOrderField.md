## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_order_field`

## Relations

- `Order`: one [`comOrder`](comOrder) object (`comOrderField.order = comOrder.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **order** | integer (`int[10]`) |  |
| **name** | string (`varchar[190]`) |  |
| **type** | string (`varchar[190]`) |  |
| **value** | string (`text[190]`) |  |
