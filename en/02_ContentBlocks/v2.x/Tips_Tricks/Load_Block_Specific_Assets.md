---
title: Load Block-Specific Assets
description: Load CSS and JavaScript only on pages that use a given block.
---

Some blocks need a large script or stylesheet, such as Prism for a [code block](Displaying_MODX_Code). Load those files only when that block is on the page.

[cbHasField](../05_Frontend/Snippets/cbHasField) checks the canvas for a block key. `blocks/code.json` has the key `code`. `blocks/structure/heading.json` has the key `structure/heading`.

Call it cached. Pass `&resource` when the check is for a different page. Unpublished blocks, and blocks outside their publish window, do not count.

[TOC]

## Example

Assume Prism is at `/assets/css/prism.css` and `/assets/js/prism.js`, and the code block key is `code`.

Template head:

```html
[[cbHasField?
    &block=`code`
    &then=`<link rel="stylesheet" href="/assets/css/prism.css">`
]]
```

Template footer:

```html
[[cbHasField?
    &block=`code`
    &then=`<script src="/assets/js/prism.js"></script>`
]]
```

`&field` is the same property as `&block`. The files are included only when that page has a live code block.

To return a chunk name from `&then` or `&else`, return the name only and wrap the snippet call in a chunk tag:

```
[[$[[cbHasField? &field=`code` &then=`prism_assets`]]]]
```

Putting `[[$prism_assets]]` directly in `&then` parses that chunk before the condition runs.
