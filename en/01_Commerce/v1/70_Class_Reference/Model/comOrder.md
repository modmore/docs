Base order class.

## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_order`

## Descendant Classes

- [`comCartOrder`](comCartOrder)
- [`comProcessingOrder`](comProcessingOrder)
- [`comCompletedOrder`](comCompletedOrder)
- [`comCancelledOrder`](comCancelledOrder)
- [`comSessionCartOrder`](comSessionCartOrder)


## Relations

- `Context`: one `modContext` object (`comOrder.context = modContext.key`)
- `Status`: one [`comStatus`](comStatus) object (`comOrder.status = comStatus.id`)
- `CreatedBy`: one `modUser` object (`comOrder.created_by = modUser.id`)
- `LastUpdatedBy`: one `modUser` object (`comOrder.last_updated_by = modUser.id`)
- `StatusUpdatedBy`: one `modUser` object (`comOrder.status_updated_by = modUser.id`)
- `ShippingMethod`: one [`comShippingMethod`](comShippingMethod) object (`comOrder.shipping_method = comShippingMethod.id`)
- `Parent`: one [`comOrder`](comOrder) object (`comOrder.parent = comOrder.id`)
- `User`: one `modUser` object (`comOrder.user = modUser.id`)
- `Descendants`: many [`comOrder`](comOrder) objects (`comOrder.id = comOrder.parent`)
- `Items`: many [`comOrderItem`](comOrderItem) objects (`comOrder.id = comOrderItem.order`)
- `Addresses`: many [`comOrderAddress`](comOrderAddress) objects (`comOrder.id = comOrderAddress.order`)
- `Transactions`: many [`comTransaction`](comTransaction) objects (`comOrder.id = comTransaction.order`)
- `Logs`: many [`comOrderLog`](comOrderLog) objects (`comOrder.id = comOrderLog.order`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **secret** | string (`varchar[191]`) |  |
| **test** | boolean (`tinyint[1]`) |  |
| **status** | integer (`int[10]`) |  |
| **currency** | string (`varchar[3]`) |  |
| **context<br>Default: `web`** | string (`varchar[190]`)<br>may be null |  |
| **reference** | string (`varchar[190]`)<br>may be null |  |
| **reference_incr** | integer (`int[10]`)<br>may be null |  |
| **subtotal** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **subtotal_formatted** |  | `subtotal` passed through the [financial formatter](../Formatters/financial) |
| **discount** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **discount_formatted** |  | `discount` passed through the [financial formatter](../Formatters/financial) |
| **shipping** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **shipping_formatted** |  | `shipping` passed through the [financial formatter](../Formatters/financial) |
| **transaction** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **transaction_formatted** |  | `transaction` passed through the [financial formatter](../Formatters/financial) |
| **total_before_tax** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **total_before_tax_formatted** |  | `total_before_tax` passed through the [financial formatter](../Formatters/financial) |
| **total_ex_tax** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **total_ex_tax_formatted** |  | `total_ex_tax` passed through the [financial formatter](../Formatters/financial) |
| **tax** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **tax_formatted** |  | `tax` passed through the [financial formatter](../Formatters/financial) |
| **total** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **total_formatted** |  | `total` passed through the [financial formatter](../Formatters/financial) |
| **total_due** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **total_due_formatted** |  | `total_due` passed through the [financial formatter](../Formatters/financial) |
| **total_quantity** | integer (`int[20]`) |  |
| **created_on** | int (`int[20]`) | UNIX timestamp |
| **created_on_formatted** |  | `created_on` passed through the [datetime formatter](../Formatters/datetime) |
| **received_on** | int (`int[20]`) | UNIX timestamp |
| **received_on_formatted** |  | `received_on` passed through the [datetime formatter](../Formatters/datetime) |
| **last_updated_on** | int (`int[20]`) | UNIX timestamp |
| **last_updated_on_formatted** |  | `last_updated_on` passed through the [datetime formatter](../Formatters/datetime) |
| **status_updated_on** | int (`int[20]`) | UNIX timestamp |
| **status_updated_on_formatted** |  | `status_updated_on` passed through the [datetime formatter](../Formatters/datetime) |
| **created_by** | int (`int[10]`) |  |
| **last_updated_by** | int (`int[10]`) |  |
| **status_updated_by** | int (`int[10]`) |  |
| **shipping_method** | integer (`int[10]`) |  |
| **parent** | int (`int[10]`)<br>may be null |  |
| **user** | int (`int[10]`)<br>may be null |  |
