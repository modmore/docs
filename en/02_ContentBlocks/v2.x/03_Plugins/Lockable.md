# Lockable

The Lockable plugin adds block- and layout-level locking controls to the manager. Enable it on a canvas, or on an individual block or layout configuration.

```json
{
    "plugins": {
        "Lockable": {}
    }
}
```

On a canvas, the plugin injects a lock toolbar button on every block and layout. This can be restricted with `blocks` / `layouts`:

```json
{
    "plugins": {
        "Lockable": {
            "blocks": true,
            "layouts": true
        }
    }
}
```

On a block or layout definition, it applies only to that type.

[TOC]

## Core field

Each block and layout instance stores one core locking field:

| Field | Purpose |
|-------|---------|
| `locked` | When true, the instance cannot be edited, moved, or deleted unless unlocked by a user with the `contentblocks_unlock` permission |

Blocks and layouts are unlocked by default (`locked: false`).

When a layout is locked, **every block inside that layout is treated as locked**, even if the block's own `locked` flag is false.

## Permission

Locking and unlocking both require the MODX permission `contentblocks_unlock`. Users without that permission can see locked items, but cannot toggle the lock state or change locked content.

Grant the permission through the ContentBlocks policy template, for example via the **ContentBlocks Full Access** policy.

## Manager UI

The plugin adds a lock icon to the block and layout toolbars. Locked items appear with a muted background and a lock indicator on the toolbar button.

While locked:

- Inputs cannot be interacted with
- Delete, drag, and move actions are disabled
- Blocks cannot be added to a locked layout
- Publishing controls are disabled

To make changes, even users with the unlock permission should first unlock the block or layout.

## Server-side enforcement

`cbCanvas::updateContentFromJSON()` rejects changes to locked blocks and layouts for users without `contentblocks_unlock`. Those records keep their stored data, publishing fields, and position. Locked layouts retain all child blocks. Locked blocks retain repeater rows.

Users with `contentblocks_unlock` can save content changes to a locked block or layout, including when it stays locked. That covers unlocking an item, editing it, and locking it again before save.

Rejected changes are logged and do not fail the resource save.
