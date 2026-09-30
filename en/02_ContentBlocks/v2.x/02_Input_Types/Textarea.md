The `textarea` input type is a visual editable textarea, allowing multiple lines of text with line breaks. This field is useful as a generic text input.

## Accepted properties

- `styles`: an object of css styles to apply to the text.
- `minheight`: textareas automatically grow to fit your text; this controls the minimum height a field should be (in pixels)
- `maxlength` integer of the minimum length in characters
- `minlength` integer of the minimum length in characters
- `required` true/false to indicate if empty inputs should be highlighted as invalid
- `placeholder` the placeholder text, defaults to "start typing"

## Returned values

- `value`: the text that was entered. Line breaks are included as-is (`\n` characters), so if you want those to show up as enters, process this with the `nl2br` filter or something similar.

## Example block

```json
{
    "title": "Textarea",
    "inputs": {
        "text": {
            "type": "textarea",
            "properties": {
                "maxlength": 150,
                "styles": {
                    "--cb-text-color": "#332211",
                    "font-style": "italic"
                }
            }
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

## Example template structures

### Twig

```twig
{% if text.value %}
    <div class="cb-copy">
        {{ text.value|nl2br }}
    </div>
{% endif %}
```

### tpl

```tpl
[[+text.value:notempty=`<div class="cb-copy">[[+text.value:nl2br]]</div>`]]
```

## Simple text formatting

Use the MiniRTE plugin to add basic inline text formatting in a textarea. See [MiniRTE](../03_Plugins/MiniRTE).

If you want full rich text editing, use the `richtext` input type instead. See [Rich text](Richtext).
