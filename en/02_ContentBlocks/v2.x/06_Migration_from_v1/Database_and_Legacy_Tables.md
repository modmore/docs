[TOC]

## v2 tables

ContentBlocks 2 stores canvas data in:

| Table | Purpose |
|-------|---------|
| `cbCanvas` | Canvas instance per principal (resource + field) |
| `cbCanvasLayout` | Layout instances within a canvas |
| `cbCanvasBlock` | Block instances (including repeater rows) |

These tables are not meant to be interacted with directly, except for advanced usage. Instead, a fluid PHP wrapper and mapping layer is provided that takes care of storing the right data in the right place.

Key fields on `cbCanvasBlock`:

- `block_key` — identifies the block type (matches JSON filename)
- `column_key` — column within the parent layout
- `parent_block`, `repeater_key` — repeater row relationships where each row in a repeater is its own Block
- `data` — JSON input values

## Deprecated v1 tables

These tables are from ContentBlocks 1 and are no longer the source of configuration:

| Table | v1 purpose | v2 replacement |
|-------|-----------|----------------|
| `cbField` | Field definitions | `blocks/*.json` |
| `cbLayout` | Layout definitions | `layouts/*.json` |
| `cbTemplate` | Template presets | Not replaced |
| `cbCategory` | Categories | `category` on JSON |
| `cbDefault` | Default settings | Canvas config |

Do not rely on these tables for v2 configuration. They remain in the database after upgrade for migration tooling.

## Migration tooling

Migration tooling is planned for the beta.
