## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_order_item`

## Descendant Classes

- [`comSessionCartOrderItem`](comSessionCartOrderItem)


## Relations

- `Order`: one [`comOrder`](comOrder) object (`comOrderItem.order = comOrder.id`)
- `Product`: one [`comProduct`](comProduct) object (`comOrderItem.product = comProduct.id`)
- `TaxGroup`: one [`comTaxGroup`](comTaxGroup) object (`comOrderItem.tax_group = comTaxGroup.id`)
- `DeliveryType`: one [`comDeliveryType`](comDeliveryType) object (`comOrderItem.delivery_type = comDeliveryType.id`)
- `Shipment`: one [`comOrderShipment`](comOrderShipment) object (`comOrderItem.shipment = comOrderShipment.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **order** | integer (`int[10]`) |  |
| **product** | integer (`int[10]`) |  |
| **idx** | integer (`int[20]`) |  |
| **currency** | string (`varchar[3]`) |  |
| **status** | integer (`int[10]`) |  |
| **allow_update<br>Default: `1`** | boolean (`tinyint[1]`) |  |
| **is_manual_price** | boolean (`tinyint[1]`) |  |
| **tax_group** | integer (`int[20]`) |  |
| **delivery_type** | integer (`int[20]`) |  |
| **shipment** | integer (`int[10]`) |  |
| **sku<br>Default: `(missing sku)`** | string (`varchar[190]`) |  |
| **name<br>Default: `(missing name)`** | string (`varchar[1024]`) |  |
| **link** | string (`varchar[1024]`)<br>may be null |  |
| **description** | string (`varchar[1024]`) |  |
| **price** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **price_formatted** |  | `price` passed through the [financial formatter](../Formatters/financial) |
| **image** | string (`varchar[190]`)<br>may be null |  |
| **quantity<br>Default: `1`** | integer (`int[20]`) |  |
| **subtotal** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **subtotal_formatted** |  | `subtotal` passed through the [financial formatter](../Formatters/financial) |
| **discount** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **discount_formatted** |  | `discount` passed through the [financial formatter](../Formatters/financial) |
| **shipping** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **shipping_formatted** |  | `shipping` passed through the [financial formatter](../Formatters/financial) |
| **total_before_tax** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **total_before_tax_formatted** |  | `total_before_tax` passed through the [financial formatter](../Formatters/financial) |
| **total_ex_tax** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **total_ex_tax_formatted** |  | `total_ex_tax` passed through the [financial formatter](../Formatters/financial) |
| **tax** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **tax_formatted** |  | `tax` passed through the [financial formatter](../Formatters/financial) |
| **total** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **total_formatted** |  | `total` passed through the [financial formatter](../Formatters/financial) |
| **comment** | string (`varchar[1024]`) |  |
