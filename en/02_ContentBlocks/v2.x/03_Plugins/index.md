Plugins add manager-side behavior to blocks, layouts, or the canvas. Add a plugin to the `plugins` object in the relevant configuration.

[TOC]

## Core Plugins

| Plugin | Description |
|--------|-------------|
| [Background](Background) | Sets a block background color from an input value |
| [Color](Color) | Sets block text color from an input value |
| [Conditional Inputs](Conditional_Inputs) | Shows or hides inputs based on other input values |
| [Fullscreen](Fullscreen) | Adds a fullscreen editing toolbar button |
| [Highlight Changed](Highlight_Changed) | Highlights blocks with unsaved changes |
| [Lockable](Lockable) | Block- and layout-level locking for protected content |
| [Publishing](Publishing) | Block-level publishing state with schedule support |
| [MiniRTE](MiniRTE) | Lightweight rich text on text/textarea fields (keyboard shortcuts) |
| [Styler](Styler) | Applies conditional inline styles from input values |

## Custom Plugins

To create a custom plugin, extend `ContentBlocks.Plugin` and register an instance on `ContentBlocks.Plugins`. See [Creating Plugins](../Developer/02_Custom_Plugins/Creating_Plugins).

## Example plugins on a Canvas

On your [Canvas Configuration](../01_Configuring_Content/Canvas_Configuration), you might add some global plugins like this:

```json
{
    "plugins": {
        "HighlightChanged": {},
        "Publishing": {},
        "Fullscreen": {
            "blocks": false,
            "layouts": true
        }
    }
}
```

For the configuration on each plugin, check the detail pages.
