The `label` input type provides a static rendered label. This is meant to be used with other input types to build a form-like structure for complex block types in the manager.

The text in the label is uneditable.

> Generally we recommend using visual elements instead of labeled content to not break the flow content where possible, but labels can be very useful when used right.

## Supported properties

- `text`: the label text to show
- `for`: the name of the input field (e.g. a text, textarea, or select field) that this label is associated with. This makes sure that a user clicking on the label receives the correct focus. Provide the key for the associated input in the current block.
- `styles`: an object of css styles to apply to the label

## Returned values

- None

## Example block

For example, a quote block that has a dedicated labeled field for the author.

```json
{
    "title": "Quote",
    "description": "Quote with citation.",
    "inputs": {
        "quote": {
            "type": "textarea",
            "width": 100,
            "properties": {}
        },
        "authorLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "author",
                "text": "Author"
            }
        },
        "author": {
            "type": "text",
            "width": 70,
            "properties": {}
        }
    }
}
```

> Labels still need a unique key, despite not having data associated with it. As a convention, we recommend using the name of the field it is a label for, followed by Label. So in the above example, the label is for the `author` field, so we suggest `authorLabel`.

## Example template structures

`label` does not persist data, so is not typically rendered itself.

### Twig

```twig
<blockquote class="quote">
    <p>{{ quote.value|nl2br }}</p>
    {% if author.value %}
        <footer>{{ author.value }}</footer>
    {% endif %}
</blockquote>
```

### tpl

```tpl
<blockquote class="quote">
    <p>[[+quote.value:htmlent:nl2br]]</p>
    [[+author.value:notempty=`<footer>[[+author.value:htmlent]]</footer>`]]
</blockquote>
```
