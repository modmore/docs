## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_coupon_usage`

## Relations

- `Coupon`: one [`comCoupon`](comCoupon) object (`comCouponUsage.coupon = comCoupon.id`)
- `User`: one `modUser` object (`comCouponUsage.user = modUser.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **coupon<br>Default: `1`** | int (`int[10]`) |  |
| **order<br>Default: `1`** | int (`int[10]`) |  |
| **user<br>Default: `1`** | int (`int[10]`) |  |
| **discount** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **discount_formatted** |  | `discount` passed through the [financial formatter](../Formatters/financial) |
| **used_on** | int (`int[20]`) | UNIX timestamp |
| **used_on_formatted** |  | `used_on` passed through the [datetime formatter](../Formatters/datetime) |
