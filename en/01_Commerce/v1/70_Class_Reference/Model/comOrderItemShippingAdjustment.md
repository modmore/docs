> This class is not currently used.

## Meta

- Extends: [`comOrderItemAdjustment`](comOrderItemAdjustment)
- Table: `modx_commerce_order_item_adjustment`

## Relations

- `OrderItem`: one [`comOrderItem`](comOrderItem) object (`comOrderItemShippingAdjustment.item = comOrderItem.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **item** | integer (`int[10]`) |  |
| **key** | string (`varchar[190]`) |  |
| **name<br>Default: `(missing name)`** | string (`varchar[190]`) |  |
| **description** | string (`varchar[1024]`) |  |
| **sortorder** | integer (`int[10]`) |  |
| **show_on_order** | boolean (`tinyint[1]`) |  |
| **price_change** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **price_change_formatted** |  | `price_change` passed through the [financial formatter](../Formatters/financial) |
| **price_change_per_quantity** | boolean (`tinyint[1]`) |  |
| **price_change_percentage** | float (`decimal[20,4]`) |  |
| **price_change_percentage_formatted** |  | `price_change_percentage` passed through the [percentage formatter](../Formatters/percentage) |
| **total_change** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **total_change_formatted** |  | `total_change` passed through the [financial formatter](../Formatters/financial) |
| **currency** | string (`varchar[3]`) |  |
