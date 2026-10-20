Blocks are the basic content units editors add to the canvas. Each block type is defined by a JSON file in the `blocks/` directory of your config path.

A block is equivalent to a single-row repeater in v1. Meaning that a Block is made up from multiple inputs that together form a single entity, and has a single template.

Inputs can be placed in different regions. The main region, `inputs`, is shown on the block canvas. The `drawer` region is shown in an expandable panel below the inputs when the block is focused. The `modal` region is edited in a settings modal opened from the cog icon in the block toolbar, equivalent to field settings in v1.

[TOC]

## Block configuration structure

```json
{
    "title": "Block Title",
    "description": "Block description",
    "icon": "icon-name",
    "category": "Media",
    "inputs": {
        "inputName": {
            "type": "input-type",
            "width": 100,
            "properties": {
                "property1": "value1"
            }
        }
    },
    "drawer": {
        "drawerInput": {
            "type": "select",
            "properties": {}
        }
    },
    "modal": {
        "modalInput": {
            "type": "text",
            "properties": {}
        }
    },
    "plugins": {
        "PluginName": {
            "option": "value"
        }
    }
}
```

## Input zones

Block definitions support three input zones:

- **`inputs`** — shown on the block canvas
- **`drawer`** — shown in an expandable panel below the inputs when the block is focused
- **`modal`** — edited in a settings modal opened from the cog icon in the block toolbar; not shown on the canvas

Each input zone uses the same configuration shape, and you can move fields around freely. Data is stored keyed **by the block key**, not their position, so input keys must be unique across all regions. Changes apply live to the in-memory block store, making real-time effects in the manager possible.

Optional **`modalTitle`** on the block definition overrides the default modal window title for fields in a modal (`"{title} settings"`).

Optional **`category`** groups blocks in the insert-block modal sidebar. Use a string for a single category, or an array of strings when a block belongs to multiple categories (for example `"category": ["Dynamic", "Developer"]`). Omit `category` to list the block under **Uncategorized**. See [Categories](Categories).

> When providing multiple categories, the block is listed under each category and may appear double. That is intentional.

## Template

Pair each block JSON with a template file. By convention `blocks/text.json` uses `blocks/text.twig` or `blocks/text.tpl`.

You can also specify a `"template"` key in the JSON to use a hardcoded template. See [Templating](../04_Templating/index).

## Input types

Each input in `inputs`, `drawer`, or `modal` references a built-in or custom input type via `"type"`. See the [Input Types](../02_Input_Types/index) reference for all available types and their properties.

## Plugins

Add manager-side behavior with the `plugins` object. See [Plugins Overview](Plugins_Overview) and [Plugins](../03_Plugins/index).

## Best practices

1. **Keep blocks focused** — each block should have a single, clear purpose.
2. **Use appropriate inputs** — choose the right input type for each piece of data.
3. **Group related inputs** — use the drawer for inline settings, or `modal` for less frequently changed options.
4. **Provide clear labels** — use descriptive titles and descriptions; editors see these in the Add Content modal.
5. **Inputs are data, plugins are behavior**.


## Example: simple text block

```json
{
    "title": "Text",
    "description": "Add some simple text to show.",
    "icon": "paragraph",
    "inputs": {
        "text": {
            "type": "text",
            "properties": {

            }
        }
    }
}
```

## Example: block with repeater and plugins

```json
{
    "title": "Featured Products",
    "description": "",
    "icon": "exclamation-triangle",
    "inputs": {
        "productRepeater": {
            "type": "repeater",
            "properties": {
                "minimumRows": 1,
                "maximumRows": 4
            },
            "inputs": {
                "title": { "type": "text", "width": 70, "properties": {} },
                "text": { "type": "textarea", "width": 70, "properties": {} },
                "select": {
                    "type": "select",
                    "width": 70,
                    "properties": {
                        "options": [
                            {"label": "Option 1", "value": "1"},
                            {"label": "Option 2", "value": "2"}
                        ]
                    }
                }
            }
        }
    },
    "drawer": {
        "style": {
            "type": "select",
            "width": 70,
            "properties": {
                "options": [
                    {"label": "Style 1", "value": "style1"},
                    {"label": "Style 2", "value": "style2"}
                ]
            }
        }
    },
    "plugins": {
        "Styler": {
            "triggers": {
                "style": {
                    "style1": { "color": "red" },
                    "style2": { "color": "blue" }
                }
            }
        }
    }
}
```
