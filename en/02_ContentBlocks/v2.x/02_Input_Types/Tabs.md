The `tabs` input type groups nested inputs into fixed tabs in the editor. Each tab has a label and its own `inputs` (and optional `drawer` or `modal`). Tabs are defined in the block configuration only — editors cannot add or remove tabs.

Saved values are stored **flat by input name**, not by tab. Tabs are an editor-only grouping layer. Moving an input from one tab to another in the configuration does not affect stored content.

## Supported properties

- `tabs`: an object keyed by tab ID. Each tab supports:
  - `label`: the tab title shown in the editor UI
  - `inputs`: nested inputs for the tab (same structure as a block's `inputs`)
- `defaultTab`: which tab is shown first in the editor. Config-only; not saved. Falls back to the first tab key.

## Config constraints

- Input keys must be **unique across all tabs**, including drawer and modal inputs. Duplicate keys across tabs would share the same stored value.
- Each tab should define `inputs`, even if empty (`{}`), when using `drawer` or `modal` only.

## Returned values

The tabs input returns a flat object keyed by nested input name. Each value uses that input type's data keys (for example `{ "value": "..." }`).

No `activeTab` or `tabs` wrapper is stored.

## Example block

```json
{
    "title": "Tabs settings",
    "description": "Example block using the tabs input type.",
    "icon": "folder-open",
    "inputs": {
        "settings": {
            "type": "tabs",
            "width": 100,
            "properties": {
                "defaultTab": "general",
                "tabs": {
                    "general": {
                        "label": "General",
                        "inputs": {
                            "title": {
                                "type": "text",
                                "width": 100,
                                "properties": {
                                    "placeholder": "Page title"
                                }
                            }
                        }
                    },
                    "seo": {
                        "label": "SEO",
                        "inputs": {
                            "metaDescription": {
                                "type": "textarea",
                                "width": 100,
                                "properties": {}
                            }
                        }
                    }
                }
            }
        }
    }
}
```

## Example template structures

Access nested input values directly on the tabs input key. No tab ID prefix is needed. Values are stored directly by their inputKeys (`title` and `metaDescription` in the example above) and are not affected by their placement.

inputKeys need to be unique across the tabbed interface.

### Twig

```twig
<h2>{{ settings.title.value }}</h2>
<meta name="description" content="{{ settings.metaDescription.value }}">
```

### tpl

```tpl
<h2>[[+settings.title.value:htmlent]]</h2>
<meta name="description" content="[[+settings.metaDescription.value:htmlent]]">
```

## Real-world example

A **Code Sample** block can use a `tabs` input named `languages` to group locked `code` inputs for JavaScript, PHP, and HTML. Templates read `languages.javascript.value`, `languages.php.value`, and `languages.html.value`. See [Code input — multiple languages](Code#code-sample-in-multiple-languages).
