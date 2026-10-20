The `text` input type is a visual editable text field, allowing a single line of text without line breaks. This input type is especially useful for simple text inputs and when combined with other inputs in a block.

[TOC]

## Accepted properties

- `styles`: an object of css styles to apply to the text.
- `maxlength` integer of the minimum length in characters
- `minlength` integer of the minimum length in characters
- `pattern` regex validation pattern

## Returned values

- `value`: the text that was entered

## Example block

```json
{
    "title": "Text",
    "inputs": {
        "text": {
            "type": "text",
            "properties": {
                "styles": {
                    "--cb-text-color": "#999"
                }
            }
        }
    }
}
```

## Example template structures

### Twig

```twig
{% if text.value %}
    <p class="cb-text">{{ text.value }}</p>
{% endif %}
```

### tpl

```tpl
[[+text.value:notempty=`<p class="cb-text">[[+text.value]]</p>`]]
```

## Simple text formatting

Use the MiniRTE plugin to add basic inline text formatting in a text field. See [MiniRTE](../03_Plugins/MiniRTE).
