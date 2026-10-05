ContentBlocks 2 renders front-end output through a custom **parser**. Each element gets a template file, using a supported extension that maps to a parser class.

To learn more about the built-in parsing, see [Templating](../../04_Templating/index).

[TOC]

## Architecture overview

```
Canvas
  └── Layout (template + layout data + column HTML)
        └── Column
              └── Block (template + block data)
```

| Component | Role |
|-----------|------|
| `RenderService` | Walks the canvas tree; resolves templates; calls parsers |
| `TemplateResolver` | Maps a definition to a template file and parser by extension |
| `ParserRegistry` | Holds extension → parser mappings (`twig`, `tpl`, custom) |
| `ParserInterface` | Contract for rendering files and inline strings |
| `ModxParser` | `.tpl` — MODX placeholders and resource fields |
| `TwigParser` | `.twig` — Twig templates via `TwigEnvironmentFactory` |

Initialization is **lazy**: the stack is built on first use of `getRenderService()`, `getParserRegistry()`, or `registerParser()` on the ContentBlocks service.

### Default registration

On initialization, ContentBlocks registers:

1. `twig` → `TwigParser`
2. `tpl` → `ModxParser`

Then it fires the `ContentBlocks_RegisterParsers` system event so extras can add or replace parsers before `RenderService` is constructed.

Extension **registration order** matters for template resolution when no extension is present in the path: the resolver tries each registered extension in order until a file exists. So the `TwigParser` always takes precedence over the `ModxParser`, which takes precedence over custom registered parsers.

## Template resolution

`TemplateResolver` resolves templates relative to the **config base path** (first valid directory from `contentblocks.config_directories`).

### Convention-based paths

For a block with config path `blocks/text`:

1. Start from `blocks/text` (no extension).
2. We check for `blocks/text.twig`, then `blocks/text.tpl` (order follows registry).
3. Return the first existing file with a registered parser.

Nested definitions follow the same rule: `blocks/structure/heading` → `blocks/structure/heading.twig`.

### Explicit override

A definition may set an explicit `"template"`:

```json
{
    "title": "Text",
    "template": "blocks/shared/wrapper.twig"
}
```

If the override includes an extension, only that extension is used. If it has no extension, extensions are tried in registry order.

For security reasons, paths are sanitized and must be within the configured config directory.

### Resolved result

A successful resolve returns a `ResolvedTemplate` with:

- `relativePath` — path under config base
- `absolutePath` — full filesystem path
- `extension` — e.g. `twig`
- `parser` — the `ParserInterface` instance to use

## Built-in parsers

### TwigParser (`.twig`)

- Delegates to `TwigEnvironmentFactory`.
- Passes block or layout data as Twig variables, including the reserved `_meta` object.
- Wraps Twig errors with template path and line number.

**Twig environment resolution:**

1. MODX `twigparser` service (from the [Twig for MODX extra](https://extras.modx.com/package/twigformodx3.x)), with the configured config path added to its loader
2. `TwigEnvironmentFactory::setExternalEnvironment()` allows an extension to explicitly tell ContentBlocks what Twig Environment to use
3. Local bundled Twig from `dependencies/twig/` as fallback

Auto-escape is enabled (`html`) on the bundled fallback environment. Layout column HTML is wrapped as `Twig\Markup` in `RenderService`, so placeholders like `{{ main }}` render without encoding. Use `|raw` for other pre-rendered HTML in block templates (e.g. richtext), or `|e` when you need explicit escaping.

When the **Twig for MODX** extra is installed, ContentBlocks delegates rendering to its `twigparser` service instead of the bundled environment. That environment also uses Twig’s default `html` autoescape. Cache is disabled on the bundled fallback for development-friendly iteration.

### ModxParser (`.tpl`)

- Reads template file content (or treats the argument as inline string).
- Flattens nested data arrays to dotted placeholder keys (`text.value`, `image.relative_url`).
- Replaces scalar `[[+key]]` placeholders directly.
- Remaining tags are processed with `cbParser`, an extensions of the MODX parser, which is limited to **only** replace placeholder (`+`) and resource field (`*`) tokens. This leaves chunks and snippets alone, so they can be rendered dynamically when the page is requested.

Use `.tpl` for straightforward placeholder substitution and resource field access.

## ParserInterface

Custom parsers implement:

```php
namespace modmore\ContentBlocks\Parser;

interface ParserInterface
{
    public function render(string $template, array $values): string;
    public function renderString(string $string, array $values): string;
}
```

- **`render`** — `$template` is the **absolute filesystem path** when resolving from disk; implementations should read the file when `is_file($template)` is true.
- **`renderString`** — render an inline template string (used for string-based workflows).
- **`$values`** — associative array of template variables (block data, layout columns, `_meta`, etc.).

Throw `\RuntimeException` (or let exceptions bubble) on failure; `RenderService` catches errors and emits `cb-render-error` HTML for that element without stopping the rest of the canvas.

## Registering a custom parser

### Option 1: ContentBlocks service (bootstrap)

In your component’s `bootstrap.php` (loaded during MODX namespace init):

```php
/** @var modX $modx */
$corePath = $modx->getOption('contentblocks.core_path', null, $modx->getOption('core_path') . 'components/contentblocks/');
$contentBlocks = $modx->getService('contentblocks', 'ContentBlocks', $corePath . 'model/contentblocks/');

$contentBlocks->registerParser('mustache', new MyMustacheParser());
```

Call `registerParser()` before ContentBlocks renders output. Registering after `initializeParsers()` has run still works because `registerParser()` calls `initializeParsers()` first, but registering during bootstrap or the event below is safest.

### Option 2: System event (recommended for extras)

Listen to `ContentBlocks_RegisterParsers`:

```php
<?php
switch ($modx->event->name) {
    case 'ContentBlocks_RegisterParsers':
        /** @var modmore\ContentBlocks\Parser\ParserRegistry $registry */
        $registry = $modx->event->params['registry'];

        $registry->register('mustache', new MyMustacheParser());

        // Optional: replace the default Twig parser
        // $registry->register('twig', new MyTwigParser($factory));
        break;
}
```

Event parameters:

| Key | Type | Description |
|-----|------|-------------|
| `registry` | `ParserRegistry` | Register parsers here |
| `contentBlocks` | `ContentBlocks` | ContentBlocks service instance |

### Option 3: Replace bundled Twig

For a site-wide custom Twig setup without a new extension:

```php
use modmore\ContentBlocks\Parser\TwigEnvironmentFactory;
use Twig\Environment;

TwigEnvironmentFactory::setExternalEnvironment($myCustomTwigEnvironment);
```

Do this early in bootstrap, before any ContentBlocks render.

## Example: minimal custom parser

```php
<?php

namespace MyVendor\ContentBlocks;

use modmore\ContentBlocks\Parser\ParserInterface;

class UppercaseParser implements ParserInterface
{
    public function render(string $template, array $values): string
    {
        $content = is_file($template)
            ? (string) file_get_contents($template)
            : $template;

        return $this->renderString($content, $values);
    }

    public function renderString(string $string, array $values): string
    {
        $output = $string;
        foreach ($values as $key => $value) {
            if (is_scalar($value) || $value === null) {
                $output = str_replace('{{' . $key . '}}', (string) $value, $output);
            }
        }

        return strtoupper($output);
    }
}
```

Register with extension `uc` and add `blocks/banner.uc` next to your definition.

**Tips:**

- Register a **unique extension** (letters/numbers only in the resolved path).
- Keep parsers stateless when possible; the same instance may render many blocks per request.

## RenderService behavior

### Blocks

1. Load block definition and config path (`_configPath` or `blocks/{key}`).
2. Resolve template via `TemplateResolver`.
3. Merge `$block->getData()` with a `_meta` context object and pass to the parser.

### Layouts

1. Render each column’s blocks to HTML strings.
2. Merge layout data with `columns` (map of key → HTML) and spread column keys at the top level (`main`, `sidebar`, …). Column HTML is wrapped as `Twig\Markup` so layout templates can use `{{ main }}` without `|raw` even when autoescape is enabled.
3. Add `_meta` with layout definition and runtime context.
4. Resolve layout template and render.

### Canvas

Renders each layout and joins output with the implode string from `contentblocks.implode_string` (default: two newlines).

### Error output

`RenderErrorOutput` generates commented, accessible HTML for:

- Missing templates (lists searched path and extensions)
- Parser exceptions (message + detail)

Other blocks and layouts on the same canvas continue to render.

## Legacy parser swap (`loadParser` / `restoreParser`)

ContentBlocks 1 used `loadParser()` to temporarily swap MODX’s global parser for `cbParser` during resource save. This remains for backward compatibility but is **deprecated** in v2. New code should rely on `ModxParser` inside the render stack instead of mutating `$modx->parser`.

## Related settings

| Setting | Effect |
|---------|--------|
| `contentblocks.config_directories` | Config base path for definitions and templates |
| `contentblocks.implode_string` | Separator between rendered layouts on a canvas |
| `contentblocks.core_path` | Fallback when config path cannot be resolved |

## See also

- [Building Content in PHP](Building_Content_in_PHP) — programmatic canvas construction with Elements classes vs database persistence
- [Templating](../../04_Templating/index) — template variables, `.twig` vs `.tpl` examples
- [Blocks](../../01_Configuring_Content/Blocks) — block and layout JSON structure
- `core/components/contentblocks/bootstrap.php` — bootstrap registration example
