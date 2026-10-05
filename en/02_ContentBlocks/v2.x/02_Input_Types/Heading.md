The `heading` input type defines a visual header with selectable levels, used for breaking content into distinct sections. 

## Supported properties

- `styles`: an object of css styles to apply to the heading text

## Returned values

- `value`: the text entered by the editor
- `level`: the chosen level; one of `h1`, `h2`, `h3`, `h4`, `h5`, `h6`

## Example block

```json
{
    "title": "Heading",
    "inputs": {
        "heading": {
            "type": "heading",
            "properties": {
                "styles": {
                    "color": "#ff9900"
                }
            }
        }
    }
}
```

## Example template structures

`heading` stores both `value` and `level`:

### Twig

```twig
{% set tag = heading.level|default('h2') %}
<{{ tag }} class="section-heading">
    {{ heading.value }}
</{{ tag }}>
```

### tpl

```tpl
<[[+heading.level]]>[[+heading.value]]</[[+heading.level]]>
```
