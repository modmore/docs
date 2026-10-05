The Publishing plugin enabled block-level publishing controls to the manager. Enable it on the whole canvas, or individual block configuration.

> **Editor guide:** [Publishing Blocks](../User_Guide/Publishing_Blocks)

```json
{
    "plugins": {
        "Publishing": {}
    }
}
```

On a canvas, the plugin injects a publishing toolbar button on every block. On a block definition, it applies only to blocks of that type.

[TOC]

## Core fields

Each block instance stores three core publishing fields:

| Field | Purpose |
|-------|---------|
| `active` | Effective published state used at render time |
| `activate_on` | Unix timestamp to publish the block; `0` means not scheduled |
| `deactivate_on` | Unix timestamp to unpublish the block; `0` means not scheduled |

Blocks are published by default (`active: true`). Only blocks where `active` is true are included in generated frontend HTML.

Repeater rows are also stored as `cbCanvasBlock` records and support the same publishing fields. Repeaters let you control the publishing state of each individual row. Inactive rows are excluded from rendered output, but remain visible in the manager so editors can manage them.

## Manager UI

The plugin adds an eye icon to the block toolbar. Repeater rows include the same publishing control on their row toolbar. Clicking it opens a minimal modal with:

- **Published** — toggles `active`
- **Publish on** — optional schedule for future activation
- **Unpublish on** — optional schedule for future deactivation

Saving the modal calls `Block.setPublishing()` and marks the canvas dirty. Publishing state is persisted when the resource is saved.

Unpublished blocks appear with a slated background in the manager. Scheduled blocks show an amber indicator of when they will be published/unpublished.

## Automatic publishing

ContentBlocks mirrors MODX resource auto-publishing to automatic (un)publish blocks when the stored date occurs.

1. On save, `PublishingService` evaluates schedules and updates `active`
2. The next scheduled event timestamp is cached under `contentblocks/block_auto_publish`
3. On frontend requests (`OnHandleRequest`), the cache is checked if any blocks need to be auto (un)published, due blocks are activated/deactivated, affected resources are re-rendered, and the cache is refreshed

This keeps frontend HTML static without requiring a cron job.

Core fields remain the single source of truth for rendering and auto-publishing, but we hope this system allows extensions to implement more powerful publishing rules on top of it.
