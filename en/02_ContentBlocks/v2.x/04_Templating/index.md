ContentBlocks turns canvas data into front-end HTML by pairing each block and layout **definition** (JSON) with a **template file**. The definition describes inputs and structure; the template decides how saved values are rendered.

The parsed output is saved to the principal; typically that is the **resource content**, so getting the output from ContentBlocks to your front-end just means putting `[[*content]]` in your template.

See also: [Parser implementation](../Developer/03_Parser_and_Rendering/Parser) for how templates are resolved and how to register custom parsers.

Also in this section:

- [Twig vs MODX Templates](Twig_vs_MODX_Templates)
- [Repeaters in Templates](Repeaters_in_Templates)
- [Tabs in Templates](Tabs_in_Templates)

[TOC]

## How definitions and templates connect

Each block or layout lives in your config directory (see `contentblocks.config_directories`) and generally has either a `.twig` or `.tpl` file beside it with the same name.

```
config/
  blocks/
    text.json          ← definition (inputs, plugins, etc.)
    text.twig          ← matching template
  layouts/
    full-width.json
    full-width.twig
```

By convention, a template sits next to its definition and shares the same base name. For a block at `blocks/structure/heading.json`, ContentBlocks looks for `blocks/structure/heading.{ext}`.

You can however override the template path in the definition:

```json
{
    "title": "Text",
    "template": "blocks/shared/wrapper.twig",
    "inputs": { ... }
}
```

Override rules:

- A path with `/` is relative to the config base (e.g. `blocks/shared/wrapper.twig`).
- A filename only (e.g. `alternate.tpl`) resolves next to the definition (e.g. `blocks/foo/alternate.tpl` for `blocks/foo/bar.json`).
- Paths must stay inside the config directory; `..` segments are rejected.

## Choosing `.twig` or `.tpl`

ContentBlocks ships with two built-in parsers:

| Extension | Parser | Best for                                                   |
|-----------|--------|------------------------------------------------------------|
| `.twig` | Twig | Logic, loops, includes, filters; preferred when both exist |
| `.tpl` | MODX placeholders | Simple output, output modifiers.                           |

When **no extension** is given in a `template` override or no template is set, registered extensions are tried in registration order. Twig is registered before `.tpl`, so `blocks/text.twig` wins over `blocks/text.tpl` when both exist.

You can only use **one** template file per element.

## Template values

Each input stores its data under the input’s **definition key**, using one or more **data keys** declared by the input type. Simple inputs use a single `value` key, so a text input named `text` is stored as `{ "text": { "value": "..." } }` and rendered with `{{ text.value }}` or `[[+text.value]]`.

More complex inputs may have multiple data keys, these are listed in their documentation.

Templates also receive a reserved **`_meta`** variable with definition config and runtime context like block/layout keys, sanitized definitions, and position info.

## Input data key reference at a glance

| Input type | Data keys | Template example (assuming input key `fld`) |
|------------|-----------|-------------------------------------|
| text, textarea, number, select, richtext, color, hr | `value` | `{{ fld.value }}` / `[[+fld.value]]` |
| snippet | `snippet_call`, `name`, `snippet`, `properties`, `uncached` | `{{ fld.snippet_call }}`, `{{ fld.name }}` |
| heading | `value`, `level` | `{{ fld.value }}`, `{{ fld.level }}` |
| image | `value`, `source`, `relative_url` | `{{ fld.value }}`, `{{ fld.relative_url }}` |
| icon | `value`, `size` | `{{ icon.value }}`, `{{ fld.size }}` |
| repeater | `rows` | `{% for row in items.rows %}` … `row.data` |
| tabs | *(flat input keys)* | `{{ fld.title.value }}` — same as block inputs |
| label, spacer, error | *(none saved)* | — |

Label and spacer inputs do not persist data and need no template placeholders.

### The `_meta` variable (RenderContext)

`_meta` is a system-provided object available in every block and layout template. Keys starting with `_` signal that the variable is managed by ContentBlocks, not editor input data. You should not create blocks starting with an `_`.

**Block templates:**

| Key | Description |
|-----|-------------|
| `_meta.type` | Always `"block"` |
| `_meta.key` | Block key (e.g. `code-multiple`) |
| `_meta.config` | Sanitized block definition (`title`, `inputs`, `drawer`, `modal`, `plugins`, etc., but not keys starting with `_`) |
| `_meta.title` | Block definition title |
| `_meta.layout` | Parent layout info when rendered inside a layout (`key`, `title`, `config`) |
| `_meta.column` | Column reference (e.g. `main`) |
| `_meta.idx` | 1-based index of the block within its column |
| `_meta.uniqueIdx` | 1-based canvas-wide render counter |

**Layout templates:**

| Key | Description |
|-----|-------------|
| `_meta.type` | Always `"layout"` |
| `_meta.key` | Layout key |
| `_meta.config` | Sanitized layout definition (`title`, `columns`, `modal`, `plugins`, etc., but not keys starting with `_`) |
| `_meta.title` | Instance title from the canvas, or definition title as fallback |
| `_meta.idx` | 1-based index of the layout on the canvas |
| `_meta.uniqueIdx` | 1-based canvas-wide render counter |
| `_meta.columns` | Column definitions from the layout config |

Internal definition keys (such as `_configPath`) are stripped from `_meta.config`. When a block is rendered in isolation (outside a layout render), `_meta` may only include `type`, `key`, `config`, and `title`.

**Twig example:**

```twig
<section class="cb-block cb-block--{{ _meta.key }}" data-idx="{{ _meta.idx }}">
    <h3>{{ _meta.config.title }}</h3>
    {{ text.value }}
</section>
```

**`.tpl` example:**

```tpl
<section class="cb-block cb-block--[[+_meta.key]]" data-idx="[[+_meta.idx]]">
    <h3>[[+_meta.config.title]]</h3>
    [[+text.value]]
</section>
```

### Blocks

The template receives the block’s saved data keyed by inputKey. Each input is an object containing that input type’s data keys.

**Twig:**

```twig
<p class="cb-text">{{ text.value }}</p>
```

**`.tpl`:**

```tpl
<p class="cb-text">[[+text.value]]</p>
```

Multi-key inputs use dotted paths in `.tpl`, and property access in Twig:

```twig
<img src="{{ image.value }}" alt="">
<{{ heading.level|default('h2') }}>{{ heading.value }}</{{ heading.level|default('h2') }}>
```

```tpl
<img src="[[+image.value]]" alt="">
```


### Layouts

Layout templates receive:

- Each column’s **rendered HTML** under the column `key` (e.g. `main`, `sidebar`); in Twig already marked as safe HTML.
- A `columns` array mapping column keys to rendered strings.
- Layout settings from the layout instance `data` object (modal inputs), using the same `{ inputKey: { value: ... } }` shape as blocks.

**Twig:**

```twig
<div class="cb-layout{% if cssClass.value %} {{ cssClass.value }}{% endif %}">
    <div class="row">
        <div class="large-8 columns">{{ main }}</div>
        <div class="large-4 columns">{{ sidebar }}</div>
    </div>
</div>
```

**`.tpl`:**

```tpl
<div class="cb-layout[[+cssClass.value:notempty=` [[+cssClass.value]]`]]">
    <div class="row">
        <div class="large-8 columns">[[+main]]</div>
        <div class="large-4 columns">[[+sidebar]]</div>
    </div>
</div>
```

Column-only example (no layout settings):

**Twig:**

```twig
<div class="row">
    <div class="large-8 columns">{{ main }}</div>
    <div class="large-4 columns">{{ sidebar }}</div>
</div>
```

**`.tpl`:**

```tpl
<div class="row">
    <div class="large-8 columns">[[+main]]</div>
    <div class="large-4 columns">[[+sidebar]]</div>
</div>
```

## Common examples

### Simple text block

Definition (`blocks/text.json`):

```json
{
    "title": "Text",
    "inputs": {
        "text": { "type": "text" }
    }
}
```

Twig (`blocks/text.twig`):

```twig
<p class="cb-text">{{ text.value }}</p>
```

`.tpl` (`blocks/text.tpl`):

```tpl
<p class="cb-text">[[+text.value]]</p>
```

### Blocks in a modal window

These are the equivalent to field settings in v1.

Modal inputs use the same data shape as `inputs` and `drawer`. Values are stored in the block data from initialization (including input defaults), so templates can use them even if the editor never opened the settings modal.

The value updates the block's store in real time when making changes.

Definition excerpt:

```json
{
    "modal": {
        "style": {
            "type": "select",
            "properties": {
                "options": [
                    { "label": "Info", "value": "info" },
                    { "label": "Warning", "value": "warning" }
                ]
            }
        }
    }
}
```

Twig:

```twig
<div class="alert alert-{{ style.value|default('info') }}">{{ text.value }}</div>
```

`.tpl`:

```tpl
<div class="alert alert-[[+style.value:default=`info`]]">[[+text.value]]</div>
```

### Blocks in a drawer

The drawer appears when focusing on a block.

Definition excerpt:

```json
{
    "drawer": {
        "style": {
            "type": "select",
            "properties": {
                "options": [
                    { "label": "Info", "value": "info" },
                    { "label": "Warning", "value": "warning" }
                ]
            }
        }
    }
}
```

Twig:

```twig
<div class="alert alert-{{ style.value|default('info') }}">{{ text.value }}</div>
```

`.tpl`:

```tpl
<div class="alert alert-[[+style.value:default=`info`]]">[[+text.value]]</div>
```

### Repeater list

Repeater inputs store rows under `{inputKey}.rows`. Each row has `id`, `block`, and `data` — where `data` holds the repeater row’s inputs using the same `{ inputKey: { value: ... } }` shape.

Twig:

```twig
<ul class="cb-list">
{% for row in items.rows %}
    {% set item = row.data %}
    <li>
        <strong>{{ item.title.value }}</strong>
        {{ item.text.value|nl2br }}
    </li>
{% endfor %}
</ul>
```

For repeaters, use Twig, because it supports loops natively.

### Tabs inputs

Tabs inputs store nested field values **flat by input name** on the tabs input key. There is no `tabs` wrapper or `activeTab` in saved data. See [Tabs input type](../02_Input_Types/Tabs).

Twig (e.g. `code-multiple` block with a `languages` tabs input):

```twig
{{ languages.javascript.value }}
{{ languages.php.value }}
```

`.tpl`:

```tpl
[[+languages.javascript.value]]
[[+languages.php.value]]
```

### Quote block with multiple fields

Twig:

```twig
<blockquote class="cb-quote">
    <p>{{ quote.value }}</p>
    {% if author.value %}
        <footer>— {{ author.value }}{% if origin.value %}, <cite>{{ origin.value }}</cite>{% endif %}</footer>
    {% endif %}
</blockquote>
```

`.tpl`:

```tpl
<blockquote class="cb-quote">
    <p>[[+quote.value]]</p>
    [[+author.value:notempty=`<footer>— [[+author.value]][[+origin.value:notempty=`, <cite>[[+origin.value]]</cite>`]]</footer>`]]
</blockquote>
```

### Full-width layout

Definition (`layouts/full-width.json`):

```json
{
    "title": "Full-width layout",
    "columns": [{ "key": "main", "title": "Main" }]
}
```

Twig (`layouts/full-width.twig`):

```twig
<div class="row">
    <div class="large-12 columns">{{ main }}</div>
</div>
```

## MODX tags in `.tpl` templates

During block and layout rendering, ContentBlocks uses a restricted parser (`cbParser`) that only processes:

- **Placeholders** — `[[+key]]`, including dotted keys like `[[+text.value]]` and `[[+image.relative_url]]`
- **Resource fields** — `[[*pagetitle]]`, `[[*id]]`, etc.

Chunks, snippets, and other MODX tags are **not** processed in this pass, so they can be rendered by the standard MODX parser, when the page is requested.

Simple placeholders without output filters are substituted before MODX parsing; remaining `[[+...]]` tags are processed through the restricted parser.

## Twig environment

Twig templates use this resolution order for the Twig environment:

1. **[Twig for MODX 3](https://extras.modx.com/package/twigformodx3.x)** package — `twigparser` service, when installed
2. **External environment** — if set via `TwigEnvironmentFactory::setExternalEnvironment()`
3. **Bundled Twig** — shipped under `core/components/contentblocks/dependencies/twig/` as fallback if no Twig is available already.

The filesystem loader is rooted at your config's base path, so templates can use `{% include 'blocks/partials/wrapper.twig' %}` for shared partials within the config tree.

## Render errors

If a template file is missing or parsing fails, ContentBlocks outputs an HTML error block (`cb-render-error`) for that element and continues rendering siblings. Check the MODX error log for details (`[ContentBlocks]` prefix).

Missing templates list the path searched and extensions tried (e.g. `twig`, `tpl`).

## Further reading

- [Parser implementation](../Developer/03_Parser_and_Rendering/Parser) — architecture, custom parsers, registration
- [Blocks](../01_Configuring_Content/Blocks) — block and layout definition structure
