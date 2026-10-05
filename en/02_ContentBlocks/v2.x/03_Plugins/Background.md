The `Background` plugin sets a background color on visual inputs in the block it is applied to. The background color to use comes from an input you define (typically, a color or select input).

The [Color](Color) plugin is very similar but affects the text color instead of the background.

This plugin applies to a specific block by adding it to its configuration.

[TOC]

## Accepted options

- `inputKey`: the key of the input that holds the color to apply. This defaults to `background`.
- `inputValueKey`: the key of the value in the input that holds the color to apply. This defaults to `value` which is correct for the majority of input types.

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
    "drawer": {
        "colorLabel": {
            "type": "label",
            "width": 20,
            "properties": {
                "for": "color",
                "text": "Color"
            }
        },
        "color": {
            "type": "text",
            "width": 30
        },
        "color2Label": {
            "type": "label",
            "width": 20,
            "properties": {
                "for": "color2",
                "text": "Background"
            }
        },
        "color2": {
            "type": "text",
            "width": 30
        }
    },
    "plugins": {
        "Color": {},
        "Background": {
            "inputKey": "color2"
        }
    }
}
```
