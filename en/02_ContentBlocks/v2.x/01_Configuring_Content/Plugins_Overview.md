Plugins add manager-side behavior to blocks, layouts, or the canvas. Add a plugin to the `plugins` object in the relevant JSON configuration.

Where inputs define *content*, plugins define *behavior*.

See the full [Plugins](../03_Plugins/index) reference for per-plugin options and examples.

[TOC]

## Where to add plugins

| Level | Config file | Scope |
|-------|-------------|-------|
| Canvas | `canvas/*.json` | All blocks/layouts on that canvas |
| Layout | `layouts/*.json` | All instances of that layout |
| Block | `blocks/*.json` | All instances of that block type |

## Custom plugins

To create a custom plugin, extend `ContentBlocks.Plugin` and register an instance on `ContentBlocks.Plugins`. See [Creating Plugins](../Developer/02_Custom_Plugins/Creating_Plugins).
