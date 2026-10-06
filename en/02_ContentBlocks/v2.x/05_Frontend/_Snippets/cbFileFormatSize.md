---
title: cbFileFormatSize Snippet
---

cbFileFormatSize converts a size in bytes to a shorter form. Use it as an output filter. `[[+size]]` is a number of bytes:

```html
[[+size:cbFileFormatSize]]
    => "1.15 MB"
```

The option is how many decimals to keep. The default is 2.

```html
[[+size:cbFileFormatSize=`2`]]
    => "1.15 MB"
[[+size:cbFileFormatSize=`1`]]
    => "1.2 MB"
[[+size:cbFileFormatSize=`0`]]
    => "1 MB"
```

In a Twig template, use the `format_bytes` filter. It is registered on the Twig environment ContentBlocks renders with:

```twig
{{ file.size|format_bytes }}
{{ file.size|format_bytes(0) }}
```
