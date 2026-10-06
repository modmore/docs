---
title: cbHasLayout Snippet
---

cbHasLayout checks whether a layout is in use on a resource, and returns one value if it is and another if it is not. Use it to load layout-specific assets or to switch template markup based on the canvas.

It checks the current resource unless you pass `&resource`. Call it cached.

[TOC]

## Snippet Usage

`&layout` is the layout key: the path under `layouts/` without the extension. For example a layout in `layouts/full-width.json` is `full-width`, and a layout in `layouts/columns/50-50.json` is `columns/50-50`.

Separate several keys with commas to match any of them.

```html
[[cbHasLayout?
    &layout=`full-width`
    &then=`Something if the layout was used`
    &else=`Something else if the layout was not used`
]]
```

- `&resource`: resource ID to check. Defaults to the current resource.
- `&canvas`: resource field the canvas is stored on. Defaults to `content`.
- `&layout`: layout key, or a comma-separated list of keys to look for.
- `&then`: returned when a matching layout is in use. Defaults to `1`.
- `&else`: returned when it is not, or when the resource has no canvas. Defaults to empty.

Unpublished layouts are ignored.

## Example: returning one of two chunks

MODX parses tags inside `&then` and `&else` before the snippet runs, so to avoid unnecessary processing, return chunk names from the `&then` and `&else` properties and wrap that in a chunk call, like this:

```html
[[$[[cbHasLayout?
    &layout=`full-width`
    &then=`chunk_one`
    &else=`chunk_two`
]]]]
```
