## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_transaction`

## Relations

- `Order`: one [`comOrder`](comOrder) object (`comTransaction.order = comOrder.id`)
- `Method`: one [`comPaymentMethod`](comPaymentMethod) object (`comTransaction.method = comPaymentMethod.id`)
- `CreatedBy`: one `modUser` object (`comTransaction.created_by = modUser.id`)
- `Logs`: many [`comTransactionLog`](comTransactionLog) objects (`comTransaction.id = comTransactionLog.transaction`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **test** | boolean (`tinyint[1]`) |  |
| **order** | integer (`int[10]`) |  |
| **status** | integer (`int[10]`) |  |
| **method** | integer (`int[10]`) |  |
| **is_manual_transaction** | boolean (`tinyint[1]`) |  |
| **reference** | string (`varchar[250]`)<br>may be null |  |
| **currency** | string (`varchar[3]`) |  |
| **amount** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **amount_formatted** |  | `amount` passed through the [financial formatter](../Formatters/financial) |
| **amount_authorized** | integer (`int[20]`)<br>may be null | Integer number in the currency base unit (e.g. cents) |
| **amount_authorized_formatted** |  | `amount_authorized` passed through the [financial formatter](../Formatters/financial) |
| **amount_authorized_expires** | int (`int[20]`)<br>may be null | UNIX timestamp |
| **amount_authorized_expires_formatted** |  | `amount_authorized_expires` passed through the [datetime formatter](../Formatters/datetime) |
| **amount_chargeable** | integer (`int[20]`)<br>may be null | Integer number in the currency base unit (e.g. cents) |
| **amount_chargeable_formatted** |  | `amount_chargeable` passed through the [financial formatter](../Formatters/financial) |
| **amount_charged** | integer (`int[20]`)<br>may be null | Integer number in the currency base unit (e.g. cents) |
| **amount_charged_formatted** |  | `amount_charged` passed through the [financial formatter](../Formatters/financial) |
| **fee** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **fee_formatted** |  | `fee` passed through the [financial formatter](../Formatters/financial) |
| **created_by** | int (`int[10]`) |  |
| **created_on** | int (`int[20]`) | UNIX timestamp |
| **created_on_formatted** |  | `created_on` passed through the [datetime formatter](../Formatters/datetime) |
| **updated_on** | int (`int[20]`) | UNIX timestamp |
| **updated_on_formatted** |  | `updated_on` passed through the [datetime formatter](../Formatters/datetime) |
| **completed_on** | int (`int[20]`) | UNIX timestamp |
| **completed_on_formatted** |  | `completed_on` passed through the [datetime formatter](../Formatters/datetime) |
