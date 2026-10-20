---
title: Grabbing the First Image
description: Read the first image on a page for social meta tags.
---

Social meta tags need an image URL from the page content. When that image lives in a known block, [cbGetFieldContent](../05_Snippets/cbGetFieldContent) can return the URL without rendering the block.

An [image input](../02_Input_Types/Image) stores:

- `value`, the URL used on the front end
- `relative_url`, the path relative to the site root
- `source`, the media source ID

`&field` is the block key (`image` for `blocks/image.json`). `&input` is the input key inside that block. `&key` defaults to `value`.

Layouts are read from top to bottom, and columns from left to right. Unpublished blocks are skipped. If the image sits in a repeater, set `&field` to the parent block. Rows are searched in order and the first non-empty value is returned.

Cache the snippet call. Saving the resource clears that cache.

[TOC]

## Meta tags

`:toPlaceholder` runs the snippet once and stores the URL. `:default` supplies a fallback when the page has no image. `value` is already a front-end URL, so the meta tag uses it as-is. Point the fallback at a full URL as well.

```html
[[cbGetFieldContent:default=`[[++site_url]]assets/images/logo.jpg`:toPlaceholder=`first_image`?
    &field=`image`
    &input=`image`
]]
<meta property="og:image" content="[[+first_image]]">
<meta name="twitter:image" content="[[+first_image]]">
```

For a resized share image, request the relative path and pass it through pThumb or phpThumbOf. The fallback here is a site-relative path, same as `relative_url`.

```html
[[cbGetFieldContent:default=`assets/images/logo.jpg`:toPlaceholder=`first_image`?
    &field=`image`
    &input=`image`
    &key=`relative_url`
]]
<meta property="og:image" content="[[++site_url]][[+first_image:phpthumbof=`w=1200&h=630&zc=1`]]">
```

The same pattern works for any block: set `&field` and `&input` to the keys in that block's JSON, and `&key` to the data key you need (`value` for most inputs).
