The `toggle` input type provides a checkbox-style on/off control with a configurable label and stored values.

## Supported properties

- `label`: the text shown next to the toggle.
- `checkedValue`: the value stored when the toggle is on. Defaults to `"1"`.
- `uncheckedValue`: the value stored when the toggle is off. Defaults to `""`.
- `default`: the initial state when no value has been saved yet. Use `true` or the same value as `checkedValue` to start checked; use `false` or the same value as `uncheckedValue` to start unchecked.
- `styles`: an object of CSS styles to apply to the toggle wrapper.

## Returned values

- `value`: either `checkedValue` or `uncheckedValue`, depending on the current state.

## Example block

```json
{
    "title": "Featured item",
    "description": "Content with an optional featured badge.",
    "icon": "star",
    "inputs": {
        "text": {
            "type": "textarea",
            "width": "fill",
            "properties": {}
        }
    },
    "drawer": {
        "featured": {
            "type": "toggle",
            "width": 50,
            "properties": {
                "label": "Mark as featured",
                "checkedValue": "yes",
                "uncheckedValue": "no",
                "default": "no"
            }
        }
    }
}
```

## Example template structures

### Twig

```twig
<div class="featured-item{% if featured.value == 'yes' %} featured-item--featured{% endif %}">
    {{ text.value|nl2br }}
    {% if featured.value == 'yes' %}
        <span class="featured-item__badge">Featured</span>
    {% endif %}
</div>
```

### tpl

```tpl
<div class="featured-item[[+featured.value:is=`yes`:then=` featured-item--featured`]]">
    [[+text.value:htmlent:nl2br]]
    [[+featured.value:is=`yes`:then=`<span class="featured-item__badge">Featured</span>`]]
</div>
```

### Plugins

The Toggle input type is very useful when used with the [Conditional Inputs plugin](../03_Plugins/Conditional_Inputs). You can use the toggle to show/hide additional inputs in a block based on its state.
