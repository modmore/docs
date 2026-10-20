ContentBlocks offers two approaches for rich text content.

[TOC]

## Full Richtext input

The [Richtext](../02_Input_Types/Richtext) input loads the full MODX rich text editor (`MODx.loadRTE`). Use when editors need the complete toolbar, media insertion, and familiar MODX editing experience. This supports Redactor and TinyMCE RTE.

Stored value: HTML in `value`.

## MiniRTE plugin

The [MiniRTE](../03_Plugins/MiniRTE) plugin adds lightweight formatting to existing **text** or **textarea** inputs via keyboard shortcuts (bold, italic, links).

**This is not a separate input type** — it's a plugin you apply to a block, providing the inputKey you want to add the behavior to:

```json
{
    "inputs": {
        "text": { "type": "textarea" }
    },
    "plugins": {
        "MiniRTE": {
            "inputKeys": ["text"]
        }
    }
}
```

See [MiniRTE](../03_Plugins/MiniRTE) for v1 `use_tinyrte` migration notes.

## When to use which

| Scenario | Recommendation |
|----------|----------------|
| Long-form body content with full toolbar | Richtext input |
| Short labels, captions, or callouts with basic formatting | Text/textarea + MiniRTE |
| Plain text only | Text or Textarea (no plugin) |

## Template output

Both approaches store HTML. In Twig templates, you may need to use the `raw` filter to render markup:

```twig
{{ text.value|raw }}
```

In MODX `.tpl` templates, output is typically unescaped when the value contains HTML unless you specifically add `:htmlent`.
