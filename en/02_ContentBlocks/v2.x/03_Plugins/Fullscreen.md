The `Fullscreen` plugin adds a fullscreen toolbar button to blocks, layouts, or the entire canvas. Editors can expand the selected element to fill the browser window for a distraction-free editing view.

The Fullscreen plugin can be applied on blocks, layouts, or the entire canvas.

[TOC]

## Accepted options

When configured on the **canvas**, the plugin accepts:

- `blocks`: set to `false` to disable the fullscreen button on block toolbars. Defaults to `true`.
- `layouts`: set to `false` to disable the fullscreen button on layout toolbars. Defaults to `true`.

Block and layout plugins do not accept options.

## Example block

```json
{
    "title": "Textarea",
    "inputs": {
        "text": {
            "type": "textarea",
            "properties": {}
        }
    },
    "plugins": {
        "Fullscreen": {}
    }
}
```

## Example canvas

```json
{
    "plugins": {
        "Fullscreen": {
            "blocks": true,
            "layouts": true
        }
    }
}
```
