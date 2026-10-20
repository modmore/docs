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

- **`key`**: identifier used in layout templates (`{{ main }}` / `[[+main]]`)
- **`title`**: label shown to editors in the manager
- **`width`** (optional): relative width hint for the manager UI (percentages per row)
- **`blocks`** (optional): blocks inserted into this column when an editor adds the layout. See [Starter blocks](#starter-blocks).

## Starter blocks

This replaces v1 Templates. In v1, a Template was a preset of layouts and fields that editors inserted in one step. In v2, that preset lives on the layout. Add a `blocks` array to any column, and inserting the layout creates those blocks with the values you set.

`blocks` is optional. Leave it out, or use an empty array, and the column starts empty. Columns on the same layout can mix pre-filled and empty.

Starter blocks are copied once, when the layout is first inserted. Pages that already contain the layout keep whatever is saved there. Editors can edit or remove the inserted blocks like any other content. Each insert gets its own copy.

A starter block uses the same shape as a block stored on the canvas:

- **`block`** (required): the block definition key, which is the file name without extension. `blocks/richtext.json` is `"richtext"`.
- **`data`** (optional): values keyed by **input name**, then by that input's store. Most inputs store a `value` key. The input name comes from the block definition, so a richtext block whose input is called `text` uses `data.text.value`.
- **`locked`** (optional): `true` locks that block after insert.
- **`active`**, **`activate_on`**, **`deactivate_on`** (optional): the same publishing fields as a saved block.

```json
{
    "title": "Article",
    "columns": [
        {
            "key": "left",
            "title": "Aside",
            "width": 30
        },
        {
            "key": "main",
            "title": "Content",
            "blocks": [
                {
                    "block": "hr"
                },
                {
                    "block": "richtext",
                    "data": {
                        "text": {
                            "value": "<p>This is some example content</p>"
                        }
                    }
                },
                {
                    "block": "toggle",
                    "locked": true,
                    "data": {
                        "featured": {
                            "value": "yes"
                        }
                    }
                }
            ]
        }
    ]
}
```

In that example, `richtext` matches a block whose `text` input is a richtext field. `toggle` matches a block whose `featured` input is a toggle with `checkedValue` set to `"yes"`, so the control starts checked. A toggle that does not set `checkedValue` stores `"1"` when it is on.

A block with no `data` is inserted empty. That is enough for a block like a horizontal rule, which has nothing an editor needs to fill in.

v1 Templates could contain several layouts and appeared as their own choice in Add Layout. In v2, the preset belongs to one layout, and choosing that layout inserts its blocks. There is no separate template in the picker.

Starter blocks do not run on their own when a resource is created. v1 Default Templates, which picked a preset from rules, have no v2 equivalent yet. See [Templates and Defaults](../06_Migration_from_v1/Templates_and_Defaults).

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
