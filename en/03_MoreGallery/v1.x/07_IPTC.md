---
title: Dealing with IPTC data
---

MoreGallery automatically extracts IPTC data from an image on upload and import, since v1.4. With the `moregallery.prefill_from_iptc` system setting enabled, it will also automatically pre fill image data from the IPTC information.

A collection of known keys are normalised, as detailed below.

- `DocumentTitle` (`2#005`) Used to pre fill the image name on upload/import
- `Urgency` (`2#010`)
- `Category` (`2#015`) Used to pre fill image tags
- `Subcategories` (`2#020`) Used to pre fill image tags
- `Keywords` (`2#025`) Used to pre fill image tags
- `SpecialInstructions` (`2#040`)
- `CreationDate` (`2#055`)
- `AuthorByline` (`2#080`)
- `AuthorTitle` (`2#085`)
- `City` (`2#090`)
- `State` (`2#095`)
- `Country` (`2#101`)
- `OTR` (`2#103`)
- `Headline` (`2#105`) Used to pre fill the image name
- `Source` (`2#110`)
- `PhotoSource` (`2#115`)
- `Copyright` (`2#115`)
- `Caption` (`2#120`) Used to pre fill the image name
- `CaptionWriter` (`2#122`)

Any IPTC keys that are not in the list above are available through their numerical key in your templates.

[TOC]

## Identifying available data

To see what IPTC data has been extracted from an image, you can use the `[[+iptc_dump]]` and `[[+iptc_json]]` placeholders in the chunk called by the `&imageTpl` property on the mgGetImages snippet.

For example, you might temporarily add this to your chunk to see what's available for each image:


```` html   
<pre>[[+iptc_dump]]</pre>
````

which might show something like this:

```` html   
Array
(
    [1#090] => %G
    [2#000] => 
    [Urgency] => 0
    [CreationDate] => 20140913
    [Copyright] => Copyright 2008-2014, SomeOne
    [Category] => category or tag
)  
````   

To then use one of these values in your template, you would use the `[[+iptc.KeyHere]]` placeholder, for example like so:

```` html   
[[+iptc.Copyright:notempty=`<p><small>Copyright: [[+iptc.Copyright]]</small></p>`]]
````

## Processing IPTC Data with a Snippet

To do more processing with the IPTC data, you can use the `[[+iptc_json]]` placeholder to get a JSON encoded object with all IPTC data extracted by MoreGallery. You can decode this data in a snippet using `json_decode($data, true)`.