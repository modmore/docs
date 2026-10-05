The `color` input type lets content editors pick a color from a pre-defined palette, and optionally choose any custom color via a full color picker.

[TOC]

## Supported properties

| Property | Type | Default | Description                                                                                                    |
|----------|------|---------|----------------------------------------------------------------------------------------------------------------|
| `colors` | `{ hex, title?, category? }[]` | `[]` | Allowed swatch colors. Each entry must include a `hex` value and may optionally define `title` and `category`. |
| `default` | string (hex) | first color or `#ffffff` | Fallback color when the store is empty and unsetting is disabled. Also used as the color wheel starting point when opening the picker with no value. |
| `allowCustom` | boolean | `false` | When `true`, enables a full color wheel and editable hex field for custom colors outside the palette.          |
| `allowUnset` | boolean | `true` | When `true`, editors can clear the color (trigger × button and a "No color" option in the modal). Set to `false` to require a color. |
| `allowTransparency` | boolean | `false` | When `true`, shows an opacity range control and accepts 8-digit hex (`#rrggbbaa`). The modal/trigger preview updates live with the selected color and opacity. |
| `showFormats` | boolean | `false` | When `true`, shows RGB/RGBA and HSL/HSLA readouts in the picker modal.                                                   |
| `placeholder` | string | — | Label shown on the trigger button when no value or matching swatch title is available.                         |

Stored values are normalized hex strings (`#rrggbb`, or `#rrggbbaa` when transparency is enabled and opacity is below 100%), or an empty string when unset.

## Returned values

- `value`: the selected color (hex value)

## Example block (palette only)

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
            "type": "color",
            "width": 30,
            "properties": {
                "default": "#336399",
                "colors": [{
                    "hex": "#ff9900",
                    "title": "orange",
                    "category": "Warm"
                }, {
                    "hex": "#ccc",
                    "title": "grey",
                    "category": "Neutral"
                }, {
                    "hex": "#336399",
                    "title": "brand blue",
                    "category": "Brand"
                }]
            }
        }
    }
}
```

## Example block (hybrid: palette + custom colors)

```json
{
    "drawer": {
        "backgroundLabel": {
            "type": "label",
            "width": 20,
            "properties": {
                "for": "background",
                "text": "Background"
            }
        },
        "background": {
            "type": "color",
            "width": 30,
            "properties": {
                "allowCustom": true,
                "showFormats": true,
                "colors": [{
                    "hex": "#ffffff",
                    "title": "white"
                }, {
                    "hex": "#edf1ff",
                    "title": "light blue"
                }]
            }
        }
    }
}
```

## Example template structures

### Twig

```twig
{% if color.value %}
    <div class="swatch" style="--accent-color: {{ color.value }};">
        {{ text.value }}
    </div>
{% endif %}
```

### tpl

```tpl
<div class="swatch" style="--accent-color: [[+color.value]];">[[+text.value]]</div>
```
