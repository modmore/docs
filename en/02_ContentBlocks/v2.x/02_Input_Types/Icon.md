The `icon` input type lets editors pick an icon from the icon font (Font Awesome) loaded in the manager. Icons are rendered using `icon` and `icon-{name}` CSS classes.

> This input type works by parsing the icon font in the manager. You still need to make sure to load Font Awesome in the front-end, of a similar enough version as the one used in the MODX manager.

## Supported properties

- `styles`: an object of CSS styles to apply to the icon picker button
- `iconStyles`: an object of CSS styles to apply to the selected icon preview (commonly `--icon-font-size`)

## Returned values

- `value`: the selected icon name (without the `icon-` prefix), e.g. `exclamation-triangle`
- `size`: the icon size used in the manager preview (defaults to `32px`)

## Example block

```json
{
    "title": "Alert box",
    "description": "Information or error box.",
    "icon": "exclamation-triangle",
    "inputs": {
        "icon": {
            "type": "icon",
            "width": "auto",
            "properties": {
                "iconStyles": {
                    "--icon-font-size": "50px"
                }
            }
        },
        "text": {
            "type": "textarea",
            "width": "fill",
            "properties": {}
        }
    }
}
```

## Example template structures

> Note: You will need to make sure to load Font Awesome in the front-end, of a similar enough version as the one used in the MODX manager.

### Twig

```twig
{% if icon.value %}
    <span class="icon icon-{{ icon.value }}" style="font-size: {{ icon.size|default('2rem') }};"></span>
{% endif %}
```

### tpl

```tpl
[[+icon.value:notempty=`<span class="icon icon-[[+icon.value]]" style="font-size: 2rem;"></span>`]]
```
