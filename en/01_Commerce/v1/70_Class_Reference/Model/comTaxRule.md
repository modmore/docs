## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_tax_rule`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **group** | integer (`int[10]`) |  |
| **priority** | integer (`int[10]`) |  |
| **conditions** | array (`text`)<br>may be null |  |
| **rate_provider** | string (`varchar[190]`) |  |
| **rate_provider_options** | array (`text`)<br>may be null |  |
