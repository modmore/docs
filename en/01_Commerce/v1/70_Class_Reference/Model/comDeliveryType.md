## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_delivery_type`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **name** | string (`varchar[250]`)<br>may be null |  |
| **description** | string (`varchar[250]`)<br>may be null |  |
| **checkout_description** | string (`text`)<br>may be null |  |
| **shipment_type<br>Default: `comOrderShipment`** | string (`varchar[191]`)<br>may be null |  |
| **shipping_step<br>Default: `depends`** | string (`varchar[191]`)<br>may be null |  |
| **tax_group** | integer (`int[10]`) |  |
| **removed** | boolean (`tinyint[1]`) |  |
| **removed_on** | int (`int[20]`) | UNIX timestamp |
| **removed_on_formatted** |  | `removed_on` passed through the [datetime formatter](../Formatters/datetime) |
| **removed_by** | boolean (`tinyint[1]`) |  |
