ContentBlocks loads block, layout, and canvas definitions from directories on disk. The system setting `contentblocks.config_directories` controls which directories are checked.

The default config directory is `{core_path}components/contentblocks/config`. This directory, except the README.md file, is safe from ContentBlocks updates and where we recommend keeping your files.

[TOC]

## Directory structure

```
config/
  blocks/          ← one JSON/JSONC file per block type (+ template file)
  layouts/         ← one JSON/JSONC file per layout (+ template file)
  canvas/          ← canvas configurations (e.g. per principal/field)
```

The first **valid** directory in the comma-separated `contentblocks.config_directories` list is used. You can add multiple paths separated by commas, but only one is read.

## Setting value

A portable default pointing at the package config:

```
{core_path}components/contentblocks/config
```

You can also use a path outside the package:

```
{base_path}_data/contentblocks/config
```

Both `{core_path}` and `{base_path}` placeholders are supported.

## Manager component

If the resolved config directory is writable, you can also browse and edit definitions from **Components → Content Blocks** in the MODX manager. The component reads and writes the same JSON and template files as manual/IDE editing.

Ensure the web server user can write to the config directory when using the manager editor. Renaming a definition changes its key; existing canvas content keeps the old key until updated manually.

## File formats

- **JSON** — standard block, layout, and canvas definitions
- **JSONC** — JSON with comments (recommended for easier authoring, more forgiving structure)
- **Templates** — `.twig` or `.tpl` files paired with definitions (see [Templating](../04_Templating/index))

## Important notes

- Files in your custom config directory are **not** overwritten when ContentBlocks is updated.
- The readme in the package `config/` directory is overwritten on install/update; keep site-specific definitions in a separate path.
