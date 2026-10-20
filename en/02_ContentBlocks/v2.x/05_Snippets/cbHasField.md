---
title: cbHasField Snippet
---

cbHasField checks whether a block is in use on a resource, and returns one value if it is and another if it is not. Use it to [load block-specific assets](../Tips_Tricks/Load_Block_Specific_Assets) or to switch template markup based on the canvas.

It checks the current resource unless you pass `&resource`. Call it cached.

[TOC]

## Snippet Usage

`&block` is the block key: the path under `blocks/` without the extension. For example a block in `blocks/code.json` is `code`, and a block in `blocks/structure/heading.json` is `structure/heading`.

Separate several keys with commas to match any of them.

`&field` is an alias for `&block` for simpler v1 -> v2 upgrades, however v1's numeric field IDs will not automatically translate to a block.

```html
[[cbHasField?
    &block=`code`
    &then=`Something if the block was used`
    &else=`Something else if the block was not used`
]]
```

- `&resource`: resource ID to check. Defaults to the current resource.
- `&canvas`: resource field the canvas is stored on. Defaults to `content`.
- `&block` (or `&field`): block key, or a comma-separated list of keys to look for.
- `&then`: returned when a matching block is in use. Defaults to `1`.
- `&else`: returned when it is not, or when the resource has no canvas. Defaults to empty.

Unpublished blocks and blocks in an unpublished layout are ignored. The snippet does not search within a repeater; just for the repeater itself.

## Example: returning one of two chunks

MODX parses tags inside `&then` and `&else` before the snippet runs, so to avoid unnecessary processing, return chunk names from the `&then` and `&else` properties and wrap that in a chunk call, like this:

```html
[[$[[cbHasField?
    &field=`code`
    &then=`chunk_one`
    &else=`chunk_two`
]]]]
```
