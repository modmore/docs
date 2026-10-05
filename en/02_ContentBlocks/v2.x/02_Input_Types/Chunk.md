The `chunk` input type lets editors choose a MODX chunk, configure its properties, and preview the rendered output in the manager. The generated chunk **call** is saved with the block.

When a specific `chunk` is set in the input properties, the dropdown is hidden and only that chunk is used. A single value in `chunks` behaves the same way. Use an array of chunk names/IDs in `chunks` values to show a dropdown, and/or `categories` to filter by element category.

## Accepted properties

- `chunk`: lock the input to a single chunk by name or numeric ID. No dropdown is shown, just the preview.
- `chunks`: limit which chunks appear in the dropdown. Use a comma-separated string or an array of chunk names or IDs. When exactly one chunk is listed, the input behaves like `chunk` and locks to that chunk. When omitted, all chunks the user can view are listed.
- `categories`: comma-separated list of MODX category names or IDs used to filter the chunk dropdown.
- `empty_text`: message shown when no chunk is selected, the chunk does not exist, or preview output is empty.
- `placeholders`: default chunk property values applied when a chunk is first selected or locked.
- `styles`: object of CSS styles applied to the input container.

## Returned values

- `chunk_call`: the full MODX chunk tag generated from the selected chunk and properties.
- `name`: the selected chunk name.
- `chunk`: the selected chunk name (used for selection state).
- `properties`: object of chunk property values, including optional `__other__` for manual property syntax.

## Manager behaviour

- Editors choose a chunk from a dropdown (unless locked with `chunk` or a single `chunks` value).
- A cog button opens a modal to edit chunk properties and optional manual properties.
- Preview output is fetched from the server when the selection or properties change.
- Only the chunk call and property values are saved.

## Example block (selectable chunk)

```json
{
    "title": "Chunk",
    "description": "Display output from a MODX chunk",
    "icon": "cube",
    "inputs": {
        "chunkLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "chunk",
                "text": "Chunk"
            }
        },
        "chunk": {
            "type": "chunk",
            "width": 70,
            "properties": {
                "chunks": "tplContentBlocksAlert,tplContentBlocksQuote",
                "empty_text": "No chunk output is available."
            }
        }
    }
}
```

## Example block (locked chunk)

```json
{
    "inputs": {
        "chunk": {
            "type": "chunk",
            "properties": {
                "chunk": "tplContentBlocksAlert",
                "placeholders": {
                    "title": "Alert title",
                    "message": "Alert message body."
                }
            }
        }
    }
}
```

## Example template structures

Output the stored chunk call. MODX will parse the tag when the resource content is rendered.

### Twig

```twig
{{ chunk.chunk_call }}
```

### tpl

```tpl
[[+chunk.chunk_call]]
```
