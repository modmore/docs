ContentBlocks 2 is a ground-up rewrite. If you are familiar with ContentBlocks 1.x, these are the most important differences.

[TOC]

## Configuration model

| v1 | v2 |
|---|---|
| Fields, layouts, and templates managed in the ContentBlocks component UI | Blocks, layouts, and canvas settings defined as JSON/JSONC files on disk, with a v2 manager component for browsing, editing, validating, and inspecting usage |
| Per-field templates in the manager | Template files (`.twig` or `.tpl`) alongside JSON definitions |
| Template Builder for preset content inserts | No equivalent — editors add blocks and layouts individually |
| Categories in the component | `category` property on block and layout JSON |

## Terminology

- **Field** (v1) → **Block** (v2): a content unit an editor can add to the canvas.
- **Input type** remains the same concept, but is referenced by `type` in block JSON instead of being selected in a manager dropdown.

## Data storage

Canvas content is stored in `cbCanvas`, `cbCanvasLayout`, and `cbCanvasBlock` tables. Legacy v1 tables (`cbField`, `cbLayout`, `cbTemplate`, etc.) are deprecated. The resource content is no longer saved as a big JSON block to resource properties.

## What to read next

- [Quick Start](Quick_Start) — create your first v2 definitions
- [Migration from v1](../06_Migration_from_v1/index) — detailed upgrade guide
