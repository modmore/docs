## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_product_bundle_product`

## Relations

- `Bundle`: one [`comProductBundle`](comProductBundle) object (`comProductBundleProduct.bundle = comProductBundle.id`)
- `Product`: one [`comProduct`](comProduct) object (`comProductBundleProduct.product = comProduct.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **bundle** | integer (`int[10]`) |  |
| **product** | integer (`int[10]`) |  |
| **quantity** | integer (`int[10]`) |  |
