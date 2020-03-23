## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_transaction_log`

## Relations

- `Transaction`: one [`comTransaction`](comTransaction) object (`comTransactionLog.transaction = comTransaction.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **transaction** | integer (`int[10]`) |  |
| **created_on** | integer (`int[20]`) | UNIX timestamp |
| **created_on_formatted** |  | `created_on` passed through the [datetime formatter](../Formatters/datetime) |
| **message** | string (`varchar[1024]`) |  |
| **source** | string (`varchar[100]`) |  |
