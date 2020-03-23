Tax value applied to an order item. Don't create these manually; use the relevant methods on the comOrderItem to calculate taxes that hooks into the rules and rate providers.

## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_order_item_tax_rate`

## Relations

- `OrderItem`: one [`comOrderItem`](comOrderItem) object (`comOrderItemTax.item = comOrderItem.id`)
- `TaxRate`: one [`comTaxRate`](comTaxRate) object (`comOrderItemTax.tax_rate = comTaxRate.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **item** | integer (`int[10]`) |  |
| **tax_rate** | integer (`int[10]`) |  |
| **currency** | string (`varchar[3]`) |  |
| **taxed_amount** | integer (`int[10]`) | Integer number in the currency base unit (e.g. cents) |
| **taxed_amount_formatted** |  | `taxed_amount` passed through the [financial formatter](../Formatters/financial) |
| **percentage** | float (`decimal[20,4]`) |  |
| **percentage_formatted** |  | `percentage` passed through the [percentage formatter](../Formatters/percentage) |
| **tax_amount** | integer (`int[10]`) | Integer number in the currency base unit (e.g. cents) |
| **tax_amount_formatted** |  | `tax_amount` passed through the [financial formatter](../Formatters/financial) |
| **is_inclusive** | boolean (`tinyint[1]`) |  |
