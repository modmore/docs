## Meta

- Extends: [`comOrderMessage`](comOrderMessage)
- Table: `modx_commerce_order_message`

## Relations

- `Order`: one [`comOrder`](comOrder) object (`comOrderEmailMessage.order = comOrder.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **order** | integer (`int[10]`) |  |
| **content** | string (`text`) |  |
| **recipient** | string (`varchar[250]`) |  |
| **from** | string (`varchar[250]`) |  |
| **created_on** | int (`int[20]`) | UNIX timestamp |
| **created_on_formatted** |  | `created_on` passed through the [datetime formatter](../Formatters/datetime) |
| **created_by** | int (`int[10]`) |  |
| **sent** | boolean (`tinyint[1]`) |  |
| **sent_on** | int (`int[20]`) | UNIX timestamp |
| **sent_on_formatted** |  | `sent_on` passed through the [datetime formatter](../Formatters/datetime) |
| **sent_by** | int (`int[10]`) |  |
