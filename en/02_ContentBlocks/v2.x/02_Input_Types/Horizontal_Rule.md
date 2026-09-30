The `hr` input type renders a horizontal rule in the manager. It is a visual divider with no editor-facing content; use it when you want a block that outputs a styled `<hr>` on the front end or want to add a visual separator in a complex block.

## Supported properties

- `styles`: an object of CSS styles to apply to the horizontal rule in the manager preview

## Returned values

- None — the `hr` input does not persist data

## Example block

```json
{
    "title": "Horizontal Rule",
    "description": "Display a simple horizontal rule",
    "icon": "line",
    "inputs": {
        "hr": {
            "type": "hr",
            "properties": {
                "styles": {
                    "border": "5px solid blue"
                }
            }
        }
    }
}
```

## Example template structures

### Twig

```twig
<hr class="cb-hr">
```

### tpl

```tpl
<hr class="cb-hr">
```
