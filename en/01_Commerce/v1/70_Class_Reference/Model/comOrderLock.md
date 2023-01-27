Internal representation for order processing locks. Unlike other model classes, this does **not** extend `comSimpleObject`.

See `comOrder::getProcessLock()` and `comOrder::releaseOrderLock()`

## Meta

- Extends: `xPDOObject`
- Table: `modx_commerce_order_lock`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **target** | integer (`int[10]`) |  |
| **granted_on** | int (`int[20]`) | UNIX timestamp |
| **granted_on_formatted** |  | `granted_on` passed through the [datetime formatter](../Formatters/datetime) |
| **expires_on** | int (`int[20]`) | UNIX timestamp |
| **expires_on_formatted** |  | `expires_on` passed through the [datetime formatter](../Formatters/datetime) |
