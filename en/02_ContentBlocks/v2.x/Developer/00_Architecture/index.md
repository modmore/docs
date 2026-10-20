Depending on your goals, you will touch different parts of ContentBlocks.

[TOC]

## Client-side structure

```
assets/components/contentblocks/js/
  core/       ContentBlocks.js, Elements/, Collections/, Utilities/
  inputs/     One file per input type (extends ContentBlocks.Input)
  plugins/    One file per plugin (extends ContentBlocks.Plugin)
```

### Key classes

- **ContentBlocks** — main initializer
- **Canvas**, **Layout**, **Column**, **Block** — UI element hierarchy
- **Input** — base class for input types
- **ContentBlocks.Store** — reactive data store
- **ContentBlocks.Dispatcher** — event system

See [Canvas Structure](Canvas_Structure).

## Configuration

Block, layout, and canvas definitions are JSON files loaded from [config directories](../../01_Configuring_Content/Config_Directories). Templates are resolved at render time. See [Blocks](../../01_Configuring_Content/Blocks) and [Templating](../../04_Templating/index).

## Server-side content building

Building pages programmatically? See [Building Content in PHP](../03_Parser_and_Rendering/Building_Content_in_PHP) for a set of fluid PHP interfaces that turns code into canvases.

Please don't manually build JSON or write directly to the database anymore.

## Server-side rendering

`RenderService` orchestrates template resolution and parsing. See [Parser and Rendering](../03_Parser_and_Rendering/index) and [Data Flow](Data_Flow).

## Database

Generally, the database is abstracted away, and you would not touch it directly in a normal integration. Using the provided PHP API instead ensures backwards (and forwards) compatibility with core and other extensions.

| Table | Purpose |
|-------|---------|
| `cbCanvas` | Canvas per principal (`principal_type`, `principal_id`, `principal_field`) |
| `cbCanvasLayout` | Layout instances (`layout_key`, position, `title`, `data`, publishing fields) |
| `cbCanvasBlock` | Block instances (`block_key`, `column_key`, position, `parent_block`, `repeater_key`, data) |

Legacy v1 tables (`cbField`, `cbLayout`, `cbTemplate`, etc.) are deprecated. See [Database and Legacy Tables](../../06_Migration_from_v1/Database_and_Legacy_Tables).
