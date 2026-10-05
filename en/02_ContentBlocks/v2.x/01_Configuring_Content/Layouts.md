Layouts define the column structure for arranging blocks on the canvas. Each layout type is defined by a JSON file in the `layouts/` directory of your config path.

[TOC]

## Layout configuration structure

```json
{
    "title": "Layout Title",
    "text": "Layout description",
    "category": "Columns",
    "columns": [
        {
            "key": "column-key",
            "title": "Column Title",
            "width": 100
        },
        {
            "key": "column-key-2",
            "title": "Column Title 2",
            "width": 50
        }
    ],
    "plugins": {
        "PluginName": {
            "option": "value"
        }
    },
    "modal": {
        "cssClass": {
            "type": "text",
            "properties": {
                "placeholder": "Optional CSS class"
            }
        }
    }
}
```

Optional **`category`** groups layouts in the insert-layout modal sidebar. See [Categories](Categories).

## Columns

Each column requires:

- **`key`** — identifier used in layout templates (`{{ main }}` / `[[+main]]`)
- **`title`** — label shown to editors in the manager
- **`width`** (optional) — relative width hint for the manager UI (percentages per row)

## Modal inputs

You can add inputs to layouts in a `modal` - the equivalent of a layout setting in v1. These inputs are available when clicking the settings icon in the layout toolbar.

Layout modal inputs are stored on the canvas layout instance under `data` (same input data shape as blocks). Values initialize when the layout is created, so templates can use them even if the settings modal was never opened.

Optional **`modalTitle`** overrides the default modal window title (`"{title} settings"`).


## Template

Pair each layout JSON with a template file. Layout templates receive rendered column HTML by column key. See [Templating](../04_Templating/index).

## Example: full-width layout

```json
{
    "title": "Full-width layout",
    "text": "",
    "columns": [{
        "key": "main",
        "title": "Main"
    }]
}
```

## Example: multi-column layout

```json
{
    "title": "70 + 30",
    "text": "Two column layout",
    "columns": [{
        "key": "col1",
        "title": "Column 1",
        "width": 70
    }, {
        "key": "col2",
        "title": "Column 2",
        "width": 30
    }],
    "plugins": {
        "Fullscreen": {}
    }
}
```
