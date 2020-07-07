## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_order_shipment`

## Descendant Classes

The following classes belong to classes in extensions or third-party code. They may require a package to be installed or are not publicly available at all.

- `UserGroupShipment`
- `MyParcelOrderShipment`


## Relations

- `Order`: one [`comOrder`](comOrder) object (`comOrderShipment.order = comOrder.id`)
- `DeliveryType`: one [`comDeliveryType`](comDeliveryType) object (`comOrderShipment.delivery_type = comDeliveryType.id`)
- `Method`: one [`comShippingMethod`](comShippingMethod) object (`comOrderShipment.method = comShippingMethod.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **test** | boolean (`tinyint[1]`) |  |
| **order** | integer (`int[10]`)<br>may be null |  |
| **delivery_type** | integer (`int[10]`) |  |
| **status** | integer (`int[10]`) |  |
| **method** | integer (`int[10]`) |  |
| **tracking_reference** | string (`varchar[250]`)<br>may be null |  |
| **currency** | string (`varchar[3]`) |  |
| **product_quantity<br>Default: `1`** | integer (`int[20]`) |  |
| **product_value** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **product_value_formatted** |  | `product_value` passed through the [financial formatter](../Formatters/financial) |
| **product_value_ex_tax** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **product_value_ex_tax_formatted** |  | `product_value_ex_tax` passed through the [financial formatter](../Formatters/financial) |
| **weight** | float (`decimal[20,3]`) |  |
| **weight_unit<br>Default: `kg`** | string (`varchar[190]`) |  |
| **fee** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **fee_formatted** |  | `fee` passed through the [financial formatter](../Formatters/financial) |
| **is_inclusive** | boolean (`tinyint[1]`) |  |
| **tax_group** | integer (`int[10]`) |  |
| **tax_rate** | integer (`int[10]`) |  |
| **tax_percentage** | float (`decimal[20,4]`) |  |
| **tax_percentage_formatted** |  | `tax_percentage` passed through the [percentage formatter](../Formatters/percentage) |
| **fee_ex_tax** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **fee_ex_tax_formatted** |  | `fee_ex_tax` passed through the [financial formatter](../Formatters/financial) |
| **tax_amount** | integer (`int[10]`) | Integer number in the currency base unit (e.g. cents) |
| **tax_amount_formatted** |  | `tax_amount` passed through the [financial formatter](../Formatters/financial) |
| **fee_incl_tax** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **fee_incl_tax_formatted** |  | `fee_incl_tax` passed through the [financial formatter](../Formatters/financial) |
