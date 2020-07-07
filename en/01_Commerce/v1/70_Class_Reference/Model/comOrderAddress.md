An address that has been added to the order.

## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_order_address`

## Relations

- `Address`: one [`comAddress`](comAddress) object (`comOrderAddress.address = comAddress.id`)
- `Order`: one [`comOrder`](comOrder) object (`comOrderAddress.order = comOrder.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **order** | integer (`int[10]`) |  |
| **type<br>Default: `billing`** | string (`varchar[190]`) |  |
| **user_address** | integer (`int[10]`)<br>may be null |  |
| **fullname** | string (`varchar[190]`)<br>may be null |  |
| **firstname** | string (`varchar[190]`)<br>may be null |  |
| **lastname** | string (`varchar[190]`)<br>may be null |  |
| **company** | string (`varchar[190]`)<br>may be null |  |
| **address1** | string (`varchar[190]`)<br>may be null |  |
| **address2** | string (`varchar[190]`)<br>may be null |  |
| **address3** | string (`varchar[190]`)<br>may be null |  |
| **zip** | string (`varchar[190]`)<br>may be null |  |
| **city** | string (`varchar[190]`)<br>may be null |  |
| **state** | string (`varchar[190]`)<br>may be null |  |
| **country** | string (`varchar[190]`)<br>may be null |  |
| **phone** | string (`varchar[190]`)<br>may be null |  |
| **mobile** | string (`varchar[190]`)<br>may be null |  |
| **email** | string (`varchar[190]`)<br>may be null |  |
| **notes** | string (`text`)<br>may be null |  |
| **address** | integer (`int[10]`) |  |
