---
title: cbGetFieldContent Snippet
---

The cbGetFieldContent snippet, distributed with the core ContentBlocks package since version 1.2.0, lets you retrieve content from a specific type of field on a resource. This is useful for reusing content elsewhere on the site (within getResources, for example).

By default it will check the current resource, but with the `&resource` property you can also retrieve information from a different resource.

**Note:** if you're using nested layouts, cbGetFieldContent does not currently retrieve data from within nested layouts.

## Snippet Usage

The snippet is easy to use but very powerful. Pass the field ID via the `&field` property and the resource ID with the `&resource` property. When called within getResources, it can be called cached, but if used directly on another page, it would be best to call it uncached so updates on the referenced resource will be reflected on the calling resource.
```` HTML
[[cbGetFieldContent?
    &field=`ID OF FIELD`
    &resource=`ID OF REFERENCED RESOURCE`
]]
````
 The following properties are accepted:

- `&resource`: defaults to the current resource, but pass this a resource ID if you want to get the contents of a field on a different resource.
- `&field`: the ID of the field you want content from. The field ID can be found in the ContentBlocks component; it is between brackets after the field name.
- `&fieldSettingFilter`: allows filtering by == or != of a field setting. Only items matching the filter will be returned.
- `&limit`: allows limiting the number of matched fields. Runs after `&fieldSettingFilter`.
- `&offset`: allows skipping the first n matched fields
- `&tpl`: a chunk name defining a template to use for your field. If not set, the ContentBlocks template for the field will be used.
- `&wrapTpl`: a chunk name defining a template to use for your field wrapper. If not set, the ContentBlocks wrapper template for the field will be used. Applies only to multi-value inputs (galleries, files, etc.)
- `&returnAsJSON`: return values of the selected field as JSON. Filters, offsets, and limits will be applied, but templates will be disregarded.

## Examples

### Return contents of all video fields
```` HTML
[[!cbGetFieldContent?
    &field=`5` [[- ID of video field]]
    &resource=`3` [[- ID of document that holds the video]]
]]
````
This will return all video fields included on document 5.

### Return contents of a single video field
```` HTML
[[!cbGetFieldContent?
    &field=`5` [[- ID of video field]]
    &resource=`3` [[- ID of document that holds the video]]
    &limit=`1`
]]
````
 This will return only a single result (because of the ``&limit=`1`` parameter) — the first video field contained in a resource. ContentBlocks stores data from top to bottom, left to right. This means that a video in a left column will be before video in a right column within the same layout.

### Return contents of the second video field
```` HTML
[[!cbGetFieldContent?
    &field=`5` [[- ID of video field]]
    &resource=`3` [[- ID of document that holds the video]]
    &limit=`1`
    &offset=`1`
]]
````
This will return only a single result (because of the ``&limit=`1`` parameter), but will return the second video field contained in the resource (because of the ``&offset=`1`` parameter).

### Return a single image filtered by a setting
```` HTML
[[!cbGetFieldContent?
    &field=`6` [[- ID of image field]]
    &resource=`3` [[- ID of document that holds the image]]
    &limit=`1`
    &fieldSettingFilter=`class==keyImage`
]]
```` 
 This will first find all fields with an ID of 6, filter those results to only images with a setting `class` that is equal to `keyImage`. It will be parsed through the template for the image set in the ContentBlocks CMP.

### Return a single image filtered by a setting, passed through a different template

### Snippet call
```` HTML
[[!cbGetFieldContent?
    &field=`6` [[- ID of image field]]
    &resource=`3` [[- ID of document that holds the image]]
    &limit=`1`
    &fieldSettingFilter=`class==keyImage`
    &tpl=`specialImageTpl`
]]
```` 

#### Chunk: specialImageTpl
```` HTML
<div class="specialTemplate">
    <img src="[[+url:phpthumbof=`w=500&h=250&zc=1`]]" />
</div>
````
This will get the first image with a `class` setting of `keyImage`, but instead of using the template set within ContentBlocks, will use our special template. This could be used to make a listing of documents that includes image thumbnails using getResources, where you might want to use the key image from the page but at a different size or aspect ratio.

### Return JSON for further processing
```` HTML
[[!cbGetFieldContent:processJSON?
    &field=`7` [[- ID of gallery field]]
    &resource=`3` [[- ID of document that holds the images]]
    &limit=`1`
    &returnAsJSON=`1`
]]
````
 This will retrieve 1 gallery field from resource 3. Instead of returning templated results, it will return a JSON string, which, in this case, would be processed through a snippet called `processJSON`. Within `processJSON`, you might further filter these results to only include the first item, to include only items with titles, or something similar. If this were a file field, you could filter to only include `.xls` files or `.txt` files. Your processing snippet would be responsible for handling templating the results.