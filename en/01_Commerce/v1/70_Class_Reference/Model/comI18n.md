Internal storage of individual translations. [Learn how to work with translations here](https://docs.modmore.com/en/Commerce/v1/Multilingual_Shops.html#page_accessing_translations_programmatically).

## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_i18n`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **principal** | string (`varchar[191]`) |  |
| **principal_id** | integer (`int[10]`) |  |
| **field** | string (`varchar[191]`) |  |
| **lang** | string (`varchar[12]`) |  |
| **value** | string (`varchar[2048]`) |  |
