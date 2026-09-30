The `image` input type opens the MODX media browser so editors can select an image. The selected file is stored as a URL along with its media source metadata.

> Compared to v1, the image input is still pretty bare bones. It will be expanded upon during beta.

## Supported properties

- `source`: the media source ID to use when opening the browser (defaults to `MODx.config.default_media_source`)
- `styles`: an object of CSS styles to apply to the image input in the manager

## Returned values

- `value`: the full image URL used in front-end output
- `source`: the media source ID the image was selected from
- `relative_url`: the relative URL returned by the media browser

## Example block

```json
{
    "title": "Image",
    "description": "",
    "icon": "image",
    "inputs": {
        "image": {
            "type": "image",
            "properties": {
                "source": 2
            }
        }
    },
    "drawer": {
        "styleLabel": {
            "type": "label",
            "width": "auto",
            "properties": {
                "for": "style",
                "text": "Image style"
            }
        },
        "style": {
            "type": "select",
            "width": "fill",
            "properties": {
                "options": [
                    { "label": "Standard", "value": "standard" },
                    { "label": "Circle cutout", "value": "round" },
                    { "label": "Polaroid", "value": "polaroid" }
                ]
            }
        }
    }
}
```

## Example template structures

Use `image.value` for the `src` attribute. `relative_url` is available when you need a path relative to the site root.

### Twig

```twig
{% if image.value %}
    <figure class="cb-image cb-image--{{ style.value|default('standard') }}">
        <img src="{{ image.value }}" alt="">
    </figure>
{% endif %}
```

### tpl

```tpl
[[+image.value:notempty=`<figure class="cb-image cb-image--[[+style.value:default=`standard`]]"><img src="[[+image.value]]" alt=""></figure>`]]
```
