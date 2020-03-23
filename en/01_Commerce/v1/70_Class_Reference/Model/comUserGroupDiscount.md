## Meta

- Extends: [`comDiscount`](comDiscount)
- Table: `modx_commerce_discount`

## Relations

- `User`: one `modUser` object (`comUserGroupDiscount.user = modUser.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **target<br>Default: `1`** | int (`int[10]`) |  |
| **note** | string (`varchar[190]`) |  |
| **active<br>Default: `1`** | boolean (`tinyint[1]`) |  |
| **discount_percentage** | float (`decimal[20,4]`) |  |
| **discount_percentage_formatted** |  | `discount_percentage` passed through the [percentage formatter](../Formatters/percentage) |
| **minimum_order_total** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **minimum_order_total_formatted** |  | `minimum_order_total` passed through the [financial formatter](../Formatters/financial) |
| **maximum_order_total** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **maximum_order_total_formatted** |  | `maximum_order_total` passed through the [financial formatter](../Formatters/financial) |
| **minimum_order_items** | integer (`int[10]`) |  |
| **maximum_order_items** | integer (`int[10]`) |  |
| **products** | string (`text`)<br>may be null |  |
| **available_from** | int (`int[20]`) | UNIX timestamp |
| **available_from_formatted** |  | `available_from` passed through the [datetime formatter](../Formatters/datetime) |
| **available_until** | int (`int[20]`) | UNIX timestamp |
| **available_until_formatted** |  | `available_until` passed through the [datetime formatter](../Formatters/datetime) |
| **last_used** | int (`int[20]`) | UNIX timestamp |
| **last_used_formatted** |  | `last_used` passed through the [datetime formatter](../Formatters/datetime) |
| **created_on** | int (`int[20]`) | UNIX timestamp |
| **created_on_formatted** |  | `created_on` passed through the [datetime formatter](../Formatters/datetime) |
| **created_by** | int (`int[10]`) |  |
| **removed** | boolean (`tinyint[1]`) |  |
| **removed_on** | int (`int[20]`) | UNIX timestamp |
| **removed_on_formatted** |  | `removed_on` passed through the [datetime formatter](../Formatters/datetime) |
| **removed_by** | boolean (`tinyint[1]`) |  |
