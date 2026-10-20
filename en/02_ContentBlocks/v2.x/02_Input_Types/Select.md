The `select` input type is used to offer users a dropdown to select from different values.

By default only a single selection is allowed; set `multiple: true` to allow selecting multiple options.

[TOC]

## Accepted properties

- `options`: an array of objects with `value` and `label` keys defining the allowed options.
- `chunk`: a chunk name or ID that returns options in MODX option format (one option per line).
- `snippet`: a snippet name or ID that returns options.
- `resource`: optional resource ID used as context when resolving options from `chunk` or `snippet`; by default the current resource (if not a new resource) is passed.
- `multiple`: set to `true` to allow selecting multiple selections. Multiple selections can also be reordered.
- `styles`: an object of css styles to apply to the select input.

Use at least one options source: `options`, `chunk`, or `snippet`.

## Returned values

- `value`: when `multiple` is false (default), the `value` of the selected option.
- `value`: when `multiple` is true, a comma-separated string of selected option values, in the order they were selected.

## Example block (single select)

```json
{
    "title": "Call to action",
    "description": "",
    "inputs": {
        "selectLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "select",
                "text": "Style"
            }
        },
        "select": {
            "type": "select",
            "width": 70,
            "properties": {
                "options": [{
                    "label": "Contact",
                    "value": "contact"
                },{
                    "label": "Purchase product",
                    "value": "purchase"
                },{
                    "label": "Share on social media",
                    "value": "social"
                }]
            }
        }
    }
}
```

## Example block (multiple select)

```json
{
    "title": "Multi-Select",
    "description": "Select multiple options from a dropdown list.",
    "icon": "chevron-circle-down",
    "inputs": {
        "selectLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "audiences",
                "text": "Choose options:"
            }
        },
        "audiences": {
            "type": "select",
            "width": 70,
            "properties": {
                "multiple": true,
                "options": [{
                    "label": "Option 1",
                    "value": "value1"
                },{
                    "label": "Option 2",
                    "value": "value2"
                },{
                    "label": "Option 3",
                    "value": "value3"
                }]
            }
        }
    }
}
```

## Example using `chunk`

Use a chunk (by name or ID) to provide options dynamically.

```json
{
    "title": "Multi-Select from chunk",
    "inputs": {
        "audiences": {
            "type": "select",
            "properties": {
                "multiple": true,
                "chunk": "options_chunk"
            }
        }
    }
}
```

Example chunk content (`options_chunk`):

```text
all==All audiences
new==New visitors
returning==Returning visitors
vip==VIP
```

## Example using `snippet`

Use a snippet (by name or ID) that returns options.

```json
{
    "title": "Multi-Select from snippet",
    "inputs": {
        "audiences": {
            "type": "select",
            "properties": {
                "multiple": true,
                "snippet": "optionsSnippet"
            }
        }
    }
}
```

Example snippet implementation (`optionsSnippet`) using xPDO:

```php
<?php
/** @var modX $modx */
$parentId = 12; // Set this to the parent resource ID to pull children from.
if ($parentId <= 0) {
    return json_encode([]);
}
$resources = $modx->getIterator('modResource', [
    'parent' => $parentId,
    'published' => 1,
    'deleted' => 0,
]);
$options = [];
foreach ($resources as $resource) {
    /** @var modResource $resource */
    $options[] = [
        'value' => (string)$resource->get('id'),
        'label' => $resource->get('pagetitle'),
    ];
}
return json_encode($options);
```

Example snippet output (`optionsSnippet`) as JSON:

```json
[
    { "value": "all", "label": "All audiences" },
    { "value": "new", "label": "New visitors" },
    { "value": "returning", "label": "Returning visitors" }
]
```

## Example template structures

### Twig (single select)

```twig
{% set style = select.value|default('contact') %}
<a class="btn btn-{{ style }}" href="#contact">{{ text.value }}</a>
```

### tpl (single select)

```tpl
<a class="btn btn-[[+select.value:default=`contact`:htmlent]]" href="#contact">[[+text.value]]</a>
```

### Twig (multiple select)

When `multiple` is true, the input stores selected values **as a comma-separated string** in `value`. Use Twig to split and map values into markup.

```twig
{% set selectedAudiences = audiences.value ? audiences.value|split(',') : [] %}
{% set labels = {
    all: 'All audiences',
    new: 'New visitors',
    returning: 'Returning visitors',
    vip: 'VIP'
} %}
{% if selectedAudiences is not empty %}
    <ul class="audience-list">
        {% for audience in selectedAudiences %}
            <li class="audience-list__item audience-list__item--{{ audience }}">
                {{ labels[audience]|default(audience) }}
            </li>
        {% endfor %}
    </ul>
{% endif %}
```

### Twig (render specific CTA blocks)

```twig
{% set selectedCtas = ctas.value ? ctas.value|split(',') : [] %}
<div class="cta-group">
    {% if 'contact' in selectedCtas %}
        <section class="cta cta--contact">
            <h3>Talk to our team</h3>
            <p>Questions about implementation? We can help.</p>
            <a class="btn btn-primary" href="/contact">Contact us</a>
        </section>
    {% endif %}
    {% if 'purchase' in selectedCtas %}
        <section class="cta cta--purchase">
            <h3>Ready to start?</h3>
            <p>Choose a plan and launch quickly.</p>
            <a class="btn btn-success" href="/pricing">View pricing</a>
        </section>
    {% endif %}
    {% if 'newsletter' in selectedCtas %}
        <section class="cta cta--newsletter">
            <h3>Stay updated</h3>
            <p>Get product updates and release notes by email.</p>
            <a class="btn btn-outline" href="/newsletter">Subscribe</a>
        </section>
    {% endif %}
</div>
```
