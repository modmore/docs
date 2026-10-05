The `richtext` input type loads the site-configured MODX rich text editor (via `MODx.loadRTE`) for formatted HTML content. It requires a supported RTE to be installed and configured in MODX.

Redactor and TinyMCE RTE are supported.

## Supported properties

None — the editor configuration comes from MODX.

## Returned values

- `value`: the HTML entered by the editor

## Example block

```json
{
    "title": "Rich text",
    "description": "Standard MODX-configured editor",
    "icon": "align-left",
    "inputs": {
        "text": {
            "type": "richtext",
            "properties": {}
        }
    }
}
```

## Example template structures

Output the stored HTML without escaping. In Twig, use the `raw` filter to trust the output as HTML.

### Twig

```twig
{% if text.value %}
    <div class="cb-richtext">
        {{ text.value|raw }}
    </div>
{% endif %}
```

### tpl

```tpl
[[+text.value:notempty=`<div class="cb-richtext">[[+text.value]]</div>`]]
```
