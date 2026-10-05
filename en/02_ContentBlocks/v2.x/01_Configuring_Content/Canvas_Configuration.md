The canvas is the main container for layouts and blocks on a resource (or other principal). Canvas-level settings are defined in JSON files in the `canvas/` directory of your config path.

Most sites will only have a single canvas configuration, for the resource content.

[TOC]

## File naming

Canvas configs are matched to principals by filename pattern. For example:

```
canvas/modresource.content.json
```

This applies to the `content` field on `modResource` resources. Other principals will be supported in future versions.

## Configuration structure

Currently, canvases offer minimal configuration. They are most useful for enabling plugins that apply to your entire canvas.

```json
{
    "plugins": {
        "HighlightChanged": {},
        "Fullscreen": {
            "blocks": true,
            "layouts": true
        },
        "Publishing": {}
    }
}
```

Canvas plugins apply globally to everything in the canvas. Individual block and layout definitions can also declare their own `plugins` object for type-specific behavior.

> For plugins that apply to many things, having it on the canvas is both more convenient and more **performant**. A single canvas-level listener can keep track of all changes on all blocks, while applying it to each block individually would require a listener on each block.

## Built-in canvas plugins

| Plugin | Typical canvas use |
|--------|-------------------|
| HighlightChanged | Show unsaved change indicators on all blocks |
| Fullscreen | Enable fullscreen editing for blocks and/or layouts |
| Publishing | Add publish/unpublish controls to all blocks |

See [Plugins](../03_Plugins/index) for a run-down of each plugin, its configuration options, and on what levels it can be applied.

## Principal fields

Canvas data is stored per principal using `principal_type`, `principal_id`, and `principal_field` in the `cbCanvas` table.

Currently, the main principal type is `modResource`, applying to the `content` field. Others will be supported in future versions.

## Client events

Canvas-level JavaScript events for plugin authors are documented in [Canvas Events](../Developer/04_Client_Events/Canvas_Events).
