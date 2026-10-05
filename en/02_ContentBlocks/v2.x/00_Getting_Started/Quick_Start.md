This walkthrough creates a minimal text block and full-width layout to get you comfortable with how configuration works.

[TOC]

## 1. Set the config directory

In _System_ → _System Settings_, set `contentblocks.config_directories` to your definitions folder. A portable value:

```
{core_path}components/contentblocks/config
```

Or point to a custom path outside the package (recommended for site-specific definitions). See [Config Directories](../01_Configuring_Content/Config_Directories).

## 2. Create your first block

Blocks are configured as JSON. They define the meta data, and the `inputs` that the block is made up from.

> If you're used to ContentBlocks 1.x, think of a _block_ as a single-row repeater. It is a collection of _inputs_, which are specific types of content (text, image, link, etc) that get combined into a single template.

Create `blocks/text.json` describing a simple text field in JSON:

```json
{
    "title": "Text",
    "description": "Add simple text content.",
    "icon": "paragraph",
    "category": "Content",
    "inputs": {
        "text": {
            "type": "text",
            "width": 100,
            "properties": {}
        }
    }
}
```

Templates are stored **alongside the definition files**, with the same name, but just a different extension.

Default parsers include support for `.twig` or `.tpl` templates. We recommend Twig templates for their flexibility and performance. You can also use `.tpl` templates to use standard MODX syntax.

You can mix templates of different types in your configuration. If multiples exist, Twig takes precedence.

Create `blocks/text.twig`:

```twig
<div class="text-block">{{ text.value }}</div>
```

Important to note about Twig is that values will be automatically html-escaped. If a value is expected (and trusted!) to contain html you want to render, you can apply the `raw` filter: `{{ text.value|raw }}`.

## 3. Create your first layout

Create `layouts/full-width.json` defining the metadata of your layout and the `columns` it contains.

```json
{
    "title": "Full width",
    "text": "Single column layout",
    "category": "Columns",
    "columns": [{
        "key": "main",
        "title": "Main",
        "width": 100
    }]
}
```

Just like blocks, layouts also have a separate template file with either a `.twig` or `.tpl` extension.

Create `layouts/full-width.twig`:

```twig
<div class="layout-full-width">{{ main }}</div>
```

For layouts, it's unnecessary to apply the `raw` filter; when rendering columns ContentBlocks already marks those as safe HTMl.

## 4. Configure the canvas (optional)

The canvas is a new concept in ContentBlocks 2. The basic concept is that it separates ContentBlocks from the resource content, opening up a path forward for ContentBlocks to be used in more places than just the resource content.

In the canvas configuration, you can also apply global plugins to the canvas. This is useful for plugins that you want to apply to all layouts or blocks. For example, the HighlightChanged plugin that highlights blocks that have been changed since the last save, or the Fullscreen plugin that adds a button to take a single block or layout fullscreen.

Create `canvas/modresource.content.json` like this:

```json
{
    "plugins": {
        "HighlightChanged": {},
        "Fullscreen": {
            "blocks": true,
            "layouts": true
        }
    }
}
```

See [Canvas Configuration](../01_Configuring_Content/Canvas_Configuration) for more.

## 5. Edit a resource

Open a resource in the manager. Add your layout, then add your Text block to a column. Save the resource. The front-end output is generated from your Twig template when the resource is saved.

Congrats on your first ContentBlocks 2 canvas!

## Next steps

- [Blocks](../01_Configuring_Content/Blocks) — full block JSON reference
- [Templating](../04_Templating/index) — Twig vs MODX templates
- [Input Types](../02_Input_Types/index) — all built-in input types
