---
title: cbFileFormatSize Snippet
---

The cbFileFormatSize snippet is a utility snippet that can convert sizes in bytes to a more human readable format. It was introduced in ContentBlocks 1.2, and extended with the ability to set the number of decimals in ContentBlocks 1.3. cbFileFormatSize is intended to be used as an output filter.

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

If you're writing your own snippet and need to process some file sizes into a human friendly format, you can also use the ContentBlocks service (**as of ContentBlocks 1.3**). Simply load it with the following code:
```` PHP
<?php
$cbCorePath = $modx->getOption('contentblocks.core_path', null, $modx->getOption('core_path').'components/contentblocks/');
$contentBlocks = $modx->getService('contentblocks','ContentBlocks', $cbCorePath.'model/contentblocks/');
````
Then you have access to the `$contentBlocks->formatSize()` method which will return the formatted size. The method accepts two parameters: $bytes, containing a size defined as integer number of bytes, and $decimals, setting how many decimals should be used. For example:
```` PHP
<?php
$cbCorePath = $modx->getOption('contentblocks.core_path', null, $modx->getOption('core_path').'components/contentblocks/');
$contentBlocks = $modx->getService('contentblocks','ContentBlocks', $cbCorePath.'model/contentblocks/');
echo $contentBlocks->formatSize(1234567890, 1); 
// will echo "1.1 GB"
````
Keep in mind this method requires ContentBlocks 1.3 or up.