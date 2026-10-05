In ContentBlocks 1.x, a **field** was a manager-defined configuration of an input type (name, icon, template, properties). In v2, the equivalent is a **block**, defined as a JSON file.

An experimental component is provided to offer configuration editing from the manager, but the files remain the source of truth.

## Mapping

| v1 field property | v2 block JSON |
|-------------------|---------------|
| Name | `title` |
| Description | `description` |
| Icon | `icon` |
| Input type | `"type"` on each input in `inputs` |
| Template | Separate `.twig` or `.tpl` file |
| Properties | `properties` on each input |
| Category | `category` |

## Example

**v1:** A "Warning" field using textarea input with a custom template in the manager.

**v2:** `blocks/warning.json`:

```json
{
    "title": "Warning",
    "description": "Callout warning box",
    "icon": "exclamation-triangle",
    "category": "Content",
    "inputs": {
        "text": {
            "type": "textarea",
            "width": 100,
            "properties": {}
        }
    }
}
```

Plus `blocks/warning.twig`:

```twig
<div class="callout callout-warning">{{ text.value }}</div>
```

## Multiple inputs per block

In v1, each Field would have a single Input Type. There were a limited set of field properties you could add on to it.

In v2, each block consists of many input types in one of three input zones: `inputs`, `drawer` (a pop-down section that appears when focusing a block), and `modal` (a modal settings popup accessible from the block's toolbar).

This means that every block in v2 is more like a single-row repeater in v1, and is composed from more smaller elements per block.

See [Blocks](../01_Configuring_Content/Blocks) for the full JSON reference.
