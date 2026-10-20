The `Color` plugin sets the text color on visual inputs in the block it is applied to. The color to use comes from an input you define (typically, a color or select input).

The [Background](Background) plugin is very similar but affects the background instead of text color.

This plugin applies to a specific block by adding it to its configuration.

[TOC]

## Accepted options

- `inputKey`: the key of the input that holds the color to apply. This defaults to `color`.
- `inputValueKey`: the key of the value in the input that holds the color to apply. This defaults to `value`.

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
