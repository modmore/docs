---
title: cbFileFormatSize Snippet
---

The cbFileFormatSize snippet is a utility snippet that can convert sizes in bytes to a more human readable format. cbFileFormatSize is intended to be used as an output filter in MODX templates.

Here's how to use it, assuming `[[+size]]` is a valid placeholder containing a size in bytes:

```` HTML
[[+size:cbFileFormatSize]]
    => "1.15 MB"
````

To specify the number of decimals that should be used when the number is converted into KB/MB/GB, pass a numeric option to the output filter, like so:

```` HTML
[[+size:cbFileFormatSize=`2`]] // the default
    => "1.15 MB"
[[+size:cbFileFormatSize=`1`]]
    => "1.2 MB"
[[+size:cbFileFormatSize=`0`]]
    => "1 MB"
````

## Using the ContentBlocks Service

The formatSize method available on the ContentBlocks service in 1.x was removed in 2.0.

