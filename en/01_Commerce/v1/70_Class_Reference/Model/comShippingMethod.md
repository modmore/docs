Base (standard) shipping method type. Commonly extended.

## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_shipping_method`

## Descendant Classes

- [`comShippingMethodByCountry`](comShippingMethodByCountry)
- [`comShippingMethodByWeight`](comShippingMethodByWeight)

The following classes belong to classes in extensions or third-party code. They may require a package to be installed or are not publicly available at all.

- `TableRatesShippingMethod`
- `MyParcelShippingMethod`


## Relations

- `DeliveryType`: one [`comDeliveryType`](comDeliveryType) object (`comShippingMethod.delivery_type = comDeliveryType.id`)

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **delivery_type** | integer (`int[10]`) |  |
| **enabled_in_test** | boolean (`tinyint[1]`) |  |
| **enabled_in_live** | boolean (`tinyint[1]`) |  |
| **name** | string (`varchar[250]`)<br>may be null |  |
| **description** | string (`varchar[250]`)<br>may be null |  |
| **email_note** | string (`text`)<br>may be null |  |
| **price** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **price_formatted** |  | `price` passed through the [financial formatter](../Formatters/financial) |
| **price_percentage** | float (`decimal[20,4]`) |  |
| **price_percentage_formatted** |  | `price_percentage` passed through the [percentage formatter](../Formatters/percentage) |
| **minimum_order_total** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **minimum_order_total_formatted** |  | `minimum_order_total` passed through the [financial formatter](../Formatters/financial) |
| **maximum_order_total** | integer (`int[20]`) | Integer number in the currency base unit (e.g. cents) |
| **maximum_order_total_formatted** |  | `maximum_order_total` passed through the [financial formatter](../Formatters/financial) |
| **minimum_order_items** | integer (`int[10]`) |  |
| **maximum_order_items** | integer (`int[10]`) |  |
| **allowed_contexts** | string (`text`)<br>may be null |  |
| **countries** | string (`varchar[250]`)<br>may be null |  |
| **sortorder** | integer (`int[20]`) |  |
| **removed** | boolean (`tinyint[1]`) |  |
| **removed_on** | int (`int[20]`) | UNIX timestamp |
| **removed_on_formatted** |  | `removed_on` passed through the [datetime formatter](../Formatters/datetime) |
| **removed_by** | boolean (`tinyint[1]`) |  |
