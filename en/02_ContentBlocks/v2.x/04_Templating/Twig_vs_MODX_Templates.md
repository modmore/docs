ContentBlocks supports two template formats out of the box. Choose based on complexity and your team's familiarity.

## Comparison

| Extension | Parser | Best for |
|-----------|--------|----------|
| `.twig` | Twig | Logic, loops, includes, filters; preferred when both exist |
| `.tpl` | MODX placeholders | Simple output, resource fields (`[[*pagetitle]]`), snippets/chunks via placeholders |

## Resolution order

By convention, a template sits next to its definition with the same base name:

```
blocks/text.json  →  blocks/text.twig  or  blocks/text.tpl
```

Registered extensions are tried in registration order. Twig is registered before `.tpl`, so `blocks/text.twig` wins when both exist, and any custom parsers come after those.

You can only have **one** template file per element.

## Override paths

```json
{
    "title": "Text",
    "template": "blocks/shared/wrapper.twig",
    "inputs": { ... }
}
```

- A path with `/` is relative to the config base (e.g. `blocks/shared/wrapper.twig`).
- A filename only (e.g. `alternate.tpl`) resolves next to the definition.
- Paths must stay inside the config directory; `..` segments are rejected.

## Variable access

| Format | Input `text` with value "Hello" |
|--------|--------------------------------|
| Twig | `{{ text.value }}` |
| MODX | `[[+text.value]]` |

Layout columns receive rendered HTML by column key: `{{ main }}` / `[[+main]]`.

See [Templating](index) for `_meta` variables and the full input data key reference.

## Custom parsers

Register additional parsers via `ContentBlocks_RegisterParsers`. See [Parser](../Developer/03_Parser_and_Rendering/Parser).
