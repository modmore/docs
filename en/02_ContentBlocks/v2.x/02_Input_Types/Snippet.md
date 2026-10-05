The `snippet` input type lets editors choose a MODX snippet, configure its properties, and preview the rendered output in the manager. The generated snippet **call** is saved with the block.

When `snippet` is set in the input properties, the dropdown is hidden and only that snippet can be configured. A single value in `snippets` behaves the same way. Use multiple `snippets` values to show a dropdown, and `categories` to filter by MODX element category.

## Accepted properties

- `snippet`: lock the input to a single snippet by name or numeric ID. No dropdown is shown.
- `snippets`: limit which snippets appear in the dropdown. Use a comma-separated string or an array of snippet names or IDs. When exactly one snippet is listed, the input behaves like `snippet` and locks to that snippet. When omitted, all snippets the user can view are listed.
- `categories`: comma-separated list of MODX category names or IDs used to filter the snippet dropdown.
- `empty_text`: message shown when no snippet is selected, the snippet does not exist, or preview output is empty.
- `placeholders`: default snippet property values applied when a snippet is first selected or locked.
- `allow_uncached`: set to `false` to hide the cache/uncached toggle in the properties modal. Defaults to allowing uncached snippets.
- `styles`: object of CSS styles applied to the input container.

## Returned values

- `snippet_call`: the full MODX snippet tag generated from the selected snippet, properties, and cache preference.
- `name`: the selected snippet name.
- `snippet`: the selected snippet name (used for selection state).
- `properties`: object of snippet property values, including optional `__other__` for manual property syntax.
- `uncached`: boolean indicating whether the snippet call should be uncached (`[[!snippet?...]]`).

## Manager behaviour

- Editors choose a snippet from a dropdown (unless locked with `snippet` or a single `snippets` value).
- A cog button opens a modal to edit snippet properties, optional manual properties, and the cache setting.
- Preview output is fetched from the server when the selection or properties change.
- Only the snippet call and property values are saved.

## Example block (selectable snippet)

```json
{
    "title": "Snippet",
    "description": "Display output from a MODX snippet",
    "icon": "align-left",
    "inputs": {
        "snippetLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "snippet",
                "text": "Snippet"
            }
        },
        "snippet": {
            "type": "snippet",
            "width": 70,
            "properties": {
                "snippets": "cbHasField,cbFileFormatSize",
                "empty_text": "No snippet output is available."
            }
        }
    }
}
```

## Example block (locked via `snippets`)

A single `snippets` value locks the input the same way as `snippet`:

```json
{
    "inputs": {
        "snippet": {
            "type": "snippet",
            "properties": {
                "snippets": "cbHasField",
                "placeholders": {
                    "field": "13",
                    "then": "This page has the gallery block.",
                    "else": "This page does not have the gallery block."
                }
            }
        }
    }
}
```

## Example block (multiple snippets as array)

```json
{
    "inputs": {
        "snippet": {
            "type": "snippet",
            "properties": {
                "snippets": ["cbHasField", "cbFileFormatSize"]
            }
        }
    }
}
```

## Example block (locked snippet) with preconfigured values

```json
{
    "title": "Has field check",
    "description": "Runs cbHasField with fixed snippet selection",
    "icon": "align-left",
    "inputs": {
        "snippet": {
            "type": "snippet",
            "properties": {
                "snippet": "cbHasField",
                "empty_text": "No output.",
                "placeholders": {
                    "field": "13",
                    "then": "This page has the gallery block.",
                    "else": "This page does not have the gallery block."
                }
            }
        }
    }
}
```

## Example using categories

```json
{
    "inputs": {
        "snippet": {
            "type": "snippet",
            "properties": {
                "categories": "ContentBlocks",
                "empty_text": "No snippets available in this category."
            }
        }
    }
}
```

## Example template structures

Output the stored snippet call. MODX will parse the tag when the resource content is rendered.

### Twig

```twig
{{ snippet.snippet_call }}
```

### tpl

```tpl
[[+snippet.snippet_call]]
```

## Comparison with `select` snippet options

The `select` input can load dropdown **options** from a snippet (returning `value`/`label` pairs). The `snippet` input configures a snippet call and stores the generated tag.

| | `select` with `snippet` property | `snippet` input |
|---|---|---|
| Purpose | Populate dropdown options | Configure and store a snippet call |
| Stored data | Selected option `value` | `snippet_call`, `name`, `properties` |
| Snippet return format | `value`/`label` array or MODX option lines | Any HTML/text output for preview only |
| Front-end rendering | Template uses selected value | Template outputs stored snippet call |

Use `select` when editors pick from dynamic options. Use `snippet` when the block should output a configured MODX snippet call.
