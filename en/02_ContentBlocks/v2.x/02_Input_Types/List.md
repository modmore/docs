The `list` input type provides a visual nested list editor. Editors work directly in real `<ul>` / `<ol>` markup with keyboard-driven nesting, optional ordered/unordered switching, and an ordered-list start value.

[TOC]

## Supported properties

| Property | Type | Default | Description |
|----------|------|---------|-------------|
| `listType` | `"unordered"` \| `"ordered"` | — | **Locks** the list type. Hides the toolbar toggle. |
| `defaultListType` | `"unordered"` \| `"ordered"` | `"unordered"` | Default type of list, while letting the editor switch types. |
| `defaultStart` | number | `1` | Initial `start` value for new blocks (ordered lists). |
| `placeholder` | string | `"List item"` | Placeholder text for each item input. |
| `minItems` | number | `1` | Minimum number of root-level items. Nested lists may be empty. |
| `maxItems` | number | — | Maximum number of sibling items in one list. Applies to the root list and to each nested list. Omit for no limit. |
| `maxDepth` | number | — | Maximum nesting depth. Root items are depth `1`, so `1` is a flat list and `2` allows one level of children. Omit for no limit. |

Enter does not add another sibling once that list is at `maxItems`. Tab and drag do not nest an item, or its subtree, past `maxDepth`. Outdent is also blocked when it would push the destination list, or the item's children after absorbing following siblings, past `maxItems`. Items already saved above a limit stay in place. Reordering within the same list is still allowed. `maxItems` should be greater than or equal to `minItems`.

## Keyboard shortcuts

| Key | Action |
|-----|--------|
| Enter | Insert sibling below, unless that list is at `maxItems` |
| Backspace (empty) | Remove item |
| Tab | Indent under previous sibling, unless that would pass `maxDepth`, `maxItems`, or leave fewer than `minItems` at the root |
| Shift+Tab | Outdent |
| Arrow Up / Down | Move focus in tree order |

Drag and drop from the handle to move items around.

## Returned values

- `items`: recursive array of list nodes, each with:
  - `value`: item text (plain text)
  - `items`: nested child items (array)
- `listType`: `"unordered"` or `"ordered"`
- `start`: integer start value for the root ordered list (default `1`)

## Example block

```json
{
    "title": "List",
    "description": "Visual nested list",
    "icon": "unorderedlist",
    "category": "Structure",
    "inputs": {
        "content": {
            "type": "list",
            "width": 100,
            "properties": {
                "placeholder": "Add a list item..."
            }
        }
    }
}
```

### Limited nesting

```json
{
    "content": {
        "type": "list",
        "width": 100,
        "properties": {
            "maxItems": 5,
            "maxDepth": 2
        }
    }
}
```

### Locked ordered list with custom start

```json
{
    "content": {
        "type": "list",
        "width": 100,
        "properties": {
            "listType": "ordered",
            "defaultStart": 1
        }
    }
}
```

## v1 migration

v1 had separate `list` and `ordered_list` field types. In v2, use a single `list` input:

| v1 field type | v2 equivalent |
|---------------|---------------|
| `list` | `{ "type": "list", "properties": { "listType": "unordered" } }` |
| `ordered_list` | `{ "type": "list", "properties": { "listType": "ordered" } }` |

Saved data shape (`items` with nested `value` / `items`) is compatible with v1. Templates that looped `items` can be adapted to read `content.items`, `content.listType`, and `content.start`.

## Example template structures

### Twig

For nested lists, we can use a twig macro like the example below.

```twig
{% macro renderListItems(items, type) %}
    {% if type == 'ordered' %}
        <ol>
    {% else %}
        <ul>
    {% endif %}
    {% for item in items %}
        {% if item.value or item.items|length %}
            <li>
                {{ item.value }}
                {% if item.items|length %}
                    {{ _self.renderListItems(item.items, type) }}
                {% endif %}
            </li>
        {% endif %}
    {% endfor %}
    {% if type == 'ordered' %}</ol>{% else %}</ul>{% endif %}
{% endmacro %}
{% if content.items|length %}
    {% set listType = content.listType|default('unordered') %}
    {% if listType == 'ordered' %}
        <ol{% if content.start and content.start > 1 %} start="{{ content.start }}"{% endif %}>
    {% else %}
        <ul>
    {% endif %}
    {% for item in content.items %}
        {% if item.value or item.items|length %}
            <li>
                {{ item.value }}
                {% if item.items|length %}
                    {{ _self.renderListItems(item.items, listType) }}
                {% endif %}
            </li>
        {% endif %}
    {% endfor %}
    {% if listType == 'ordered' %}</ol>{% else %}</ul>{% endif %}
{% endif %}
```

### tpl

We don't recommend using MODX templates for the list input.
