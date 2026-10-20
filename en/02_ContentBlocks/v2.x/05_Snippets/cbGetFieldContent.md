---
title: cbGetFieldContent Snippet
---

cbGetFieldContent renders blocks of one type from a resource. Use it to reuse a block somewhere else, including inside getResources.

It checks the current resource unless you pass `&resource`. Call it uncached when the resource you are reading is not the resource being cached.

Output goes through the block's parser, so a `.twig` block renders as Twig and a `.tpl` block renders as MODX placeholders. Custom parsers registered for the block are used as well.

[TOC]

## Snippet Usage

`&field` is the block key: the path under `blocks/` without the extension. `blocks/image.json` is `image`. Separate several keys with commas. `&block` is an alias for `&field`.

1.x calls passed a numeric field ID. Update `&field` to the block key. Placeholder names inside templates follow the 2.x input shape (`image.value`, not the old flat `url`).

```html
[[cbGetFieldContent?
    &field=`image`
    &resource=`ID OF REFERENCED RESOURCE`
]]
```

- `&resource`: resource ID to read. Defaults to the current resource.
- `&canvas`: resource field the canvas is stored on. Defaults to `content`.
- `&field`: block key, or a comma-separated list of keys.
- `&fieldSettingFilter`: keep blocks whose input value matches. `class==keyImage` reads `class.value`. `class!=plain` is the opposite. Commas combine filters, and all of them must match. Dotted paths work (`settings.title==Hello`). A block that does not have that input is kept.
- `&limit`: maximum number of matched blocks, after the filter.
- `&offset`: number of matched blocks to skip, after the filter.
- `&innerLimit`: for each matched block, maximum number of repeater rows to keep.
- `&innerOffset`: number of repeater rows to skip on each matched block.
- `&tpl`: replacement for the block template. A value containing `/` is a config path (`blocks/special-image.twig`); the extension selects the parser. Otherwise it is a chunk name, rendered with the block's own parser.
- `&wrapTpl`: chunk or template path wrapped around each rendered block. The wrapper receives the block data and `output`, the rendered HTML. A chunk uses the block's parser. A path uses the parser for its extension.
- `&input`: when set, return this input's value instead of rendered HTML. Repeater rows on the matched blocks are searched too.
- `&key`: data key to read for `&input`. Defaults to `value`. `relative_url` is the other common image key.
- `&returnAsJSON`: return the matched blocks as JSON. Filters and limits are applied. Templates are not. Each item has `id`, `block`, `layout`, `column`, and `data`.
- `&showDebug`: append the lookup details. With `&returnAsJSON`, they are included in the JSON.

Blocks are read top to bottom, and columns left to right. Unpublished blocks, and blocks outside their publish window, are skipped. The same applies to layouts.

## Examples

### All video blocks on another resource

```html
[[!cbGetFieldContent?
    &field=`video`
    &resource=`3`
]]
```

### The first image block

```html
[[!cbGetFieldContent?
    &field=`image`
    &limit=`1`
]]
```

### The second image block

```html
[[!cbGetFieldContent?
    &field=`image`
    &limit=`1`
    &offset=`1`
]]
```

### An image filtered by a modal or drawer input

`class` here is an input on the image block, the same role as a 1.x field setting.

```html
[[!cbGetFieldContent?
    &field=`image`
    &limit=`1`
    &fieldSettingFilter=`class==keyImage`
]]
```

### The same image, through a different template

```html
[[!cbGetFieldContent?
    &field=`image`
    &limit=`1`
    &fieldSettingFilter=`class==keyImage`
    &tpl=`specialImageTpl`
]]
```

`specialImageTpl` is a chunk. If the image block uses Twig, write the chunk as Twig:

```twig
<div class="specialTemplate">
    <img src="{{ image.value }}" alt="">
</div>
```

A `.tpl` block, or a chunk written with MODX tags, looks like this:

```html
<div class="specialTemplate">
    <img src="[[+image.value]]" alt="">
</div>
```

To point at a file instead of a chunk, pass a config path: `&tpl=`blocks/special-image.twig``.

### A raw value, such as an image URL

`&input` skips rendering and returns one string. This is the usual way to fill a meta tag from the first image block. See [Grabbing the first image](../Tips_Tricks/Grabbing_the_First_Image).

```html
[[cbGetFieldContent?
    &field=`image`
    &input=`image`
    &key=`value`
]]
```

`&key=`relative_url`` returns the site-relative path instead. On a repeater, set `&field` to the parent block and `&input` to the image input inside each row. The first non-empty row is used, after `&offset`, `&limit`, `&innerOffset`, and `&innerLimit`.

### JSON

```html
[[!cbGetFieldContent?
    &field=`gallery`
    &limit=`1`
    &returnAsJSON=`1`
]]
```

### The first two rows of a repeater

```html
[[!cbGetFieldContent?
    &field=`featured-products`
    &limit=`1`
    &innerLimit=`2`
]]
```

`&tpl` still replaces the whole block template. Loop the remaining rows from `rows` (or whatever the repeater input is called) inside that template.
