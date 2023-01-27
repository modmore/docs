Internal representation of a task processed by the [Scheduler](../../Scheduler). Not interacted with directly.

## Meta

- Extends: [`comSimpleObject`](comSimpleObject)
- Table: `modx_commerce_scheduler_tasks`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
| **at** | integer (`int[20]`) | UNIX timestamp |
| **at_formatted** |  | `at` passed through the [datetime formatter](../Formatters/datetime) |
| **repeatable** | boolean (`tinyint[1]`) |  |
| **callback** | string (`text`)<br>may be null |  |
| **data** | array (`text`)<br>may be null |  |
| **status** | integer (`tinyint[1]`) |  |
| **error** | string (`text`)<br>may be null |  |
