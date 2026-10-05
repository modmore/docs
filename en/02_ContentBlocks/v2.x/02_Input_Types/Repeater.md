The `repeater` input type lets editors add, remove, and duplicate rows of nested inputs within a single block. Each row acts like a block with its own input values.

[TOC]

## Supported properties

- `minimumRows`: the minimum number of rows that must be present (defaults to `1`)
- `maximumRows`: the maximum number of rows allowed
- `inputs`: an object defining the inputs available in each row (same structure as a block's `inputs`)
- `drawer`: optional drawer inputs for each row (same structure as a block's `drawer`)

## Returned values

- `rows`: an array of row objects, each containing:
  - `id`: unique row identifier (matches the child `cbCanvasBlock` ID after save)
  - `block`: the row block type (always `repeater-row`)
  - `data`: an object of nested input data keyed by input name, using each input type's data keys (e.g. `{ "title": { "value": "..." } }`)
  - `active`, `activate_on`, `deactivate_on`: optional per-row publishing fields

## Example block

```json
{
    "title": "Featured Products",
    "description": "",
    "icon": "exclamation-triangle",
    "inputs": {
        "title": {
            "type": "text",
            "width": 100,
            "properties": {
                "placeholder": "Block Title"
            }
        },
        "productRepeater": {
            "type": "repeater",
            "width": 70,
            "properties": {
                "minimumRows": 1,
                "maximumRows": 4,
                "inputs": {
                    "icon": {
                        "type": "icon",
                        "width": "auto",
                        "properties": {
                            "iconStyles": {
                                "--icon-font-size": "20px"
                            }
                        }
                    },
                    "title": {
                        "type": "text",
                        "width": "fill",
                        "properties": {
                            "placeholder": "Title for section"
                        }
                    },
                    "text": {
                        "type": "textarea",
                        "properties": {}
                    }
                }
            }
        }
    }
}
```

## Example template structures

Repeater rows must be looped in Twig. Access each row's inputs through `row.data`.

### Twig

```twig
{% if productRepeater.rows %}
    <div class="product-grid">
        {% for row in productRepeater.rows %}
            {% set item = row.data %}
            <article class="product-grid__item">
                {% if item.icon.value %}
                    <span class="icon icon-{{ item.icon.value }}"></span>
                {% endif %}
                {% if item.title.value %}
                    <h3>{{ item.title.value }}</h3>
                {% endif %}
                {% if item.text.value %}
                    <p>{{ item.text.value|nl2br }}</p>
                {% endif %}
            </article>
        {% endfor %}
    </div>
{% endif %}
```

## Persistence

Each repeater row is stored as its own `cbCanvasBlock` record in the database, linked to the parent block via `parent_block` and `repeater_key`. The parent block stores only its non-repeater input values.

The editor and Twig templates still use the same `rows` array shape. The server hydrates child block records into that structure when loading content and when rendering frontend output.
