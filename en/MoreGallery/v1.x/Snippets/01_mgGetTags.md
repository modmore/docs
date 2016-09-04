Tagging is available since MoreGallery 1.4. 

Using the mgGetTags snippet it is possible to create a list of all available tags, either limited to a specific Gallery resource, or for the entire website. 

By combining this with the [mgGetImages snippet](mgGetImages), it is possible to create tag-based image navigation. 

The ability to display tags for a specific image is built into [mgGetImages](mgGetImages) through the `&getTags` property.

[TOC]

## General mgGetTags Usage

To make sure tags and image references are synchronised, make sure that the mgGetTags snippet is always called uncached. 

It has built-in caching to make sure it only accesses the database and parses chunks when needed, so there should be little to no performance impact when doing so.

The minimum snippet call for mgGetTags is as follows, and returns all tags on the current resource in a simple link:

```` html
[[!mgGetTags]]
````

The default output creates simple links passing a "tag" URL parameter to the current resource. 

In order for filtering on tags to be enabled, your [mgGetImages](mgGetImages) snippet call needs to have the `&tagsFromUrl` property specified as `tag`, as such:

```` html
[[!mgGetImages? &tagsFromUrl=`tag`]]
````

mgGetTags can be combined with [getPage](http://rtfm.modx.com/extras/revo/getpage) for pagination.

## mgGetTags Property Reference

The list below contains all properties available for use with the mgGetTags snippet.

#### `&resource`   

Defaulting to the current resource, the `&resource` property allows you to choose what resource (by its ID) to load the tags for. Setting this to 0 (or empty) will result in all tags across the entire site being loaded.   

**Default**: Current Resource  

#### `&sortBy`   

Decides the field to sort the tags on. This can be one of three options: `display` (the tag itself), `id`, `createdon` (the first time the tag was added to an image) or `createdby` (the user ID of the person that used this tag the first time).  

**Default**: `display  ``

#### `&sortDir`   

The sort direction for loading the tags, either `ASC` (A-Z) or `DESC` (Z-A)  

**Default**: `ASC`

#### `&tpl`   

Used for defining a chunk (by its name) for the tag output (per tag). 

The placeholders you can use are: `[[+id]]`, `[[+display]]` (the tag itself), `[[+createdon]]` (the first time the tag was added to an image) and `[[+createdby]]` (the user ID of the person that used this tag the first time). 

If `&includeCount` is enabled, the `[[+image_count]]` placeholder contains the number of times the tag is used on the current or all resources. 

The default chunk is stored in the filesystem to prevent changes which are overwritten on upgrade, but looks like this:   

```` html
<a href="[[~[[*id]]? &tag=`[[+id]]`]]" class="th" title="View all images tagged [[+display]]">

    [[+display]]

</a>
````

#### `&separator`   

Used for specifying a string that will separate the &tpl chunks. For example, set this to ", " to join tags together in a comma separated list.  

**Default**: linebreak (`\n`)

#### `&wrapperTpl`   

If a chunk is specified (by its name), it will be used to wrap all the other output from the snippet. There are two placeholders available in this chunk: `[[+output]]` which contains the formatted tags and `[[+tag_total]]` which is a number indicating the total number of retrieved tags.  

**Default**: linebreak (`\n`)  

#### `&wrapperIfEmpty`   

Set to `0` to return an empty result instead of the `&wrapperTpl` chunk when there are no (matching) tags. Added in v1.4.  

**Default**: 1  

#### `&includeCount`   

When set to `1` the mgGetTags snippet will include the number of times the tag is used in the `[[+image_count]]` placeholder. 

This will be limited to the current resource if `&resource` is larger than 0; if no resource is provided it will get the global count. The count is limited to active images only. Added in v1.4.  

#### `&toPlaceholder`   

When specified, a placeholder with the name of this value is set with the output from the snippet. Otherwise it just returns the output where the snippet is called.

#### `&totalVar`   

Used with getPage integrations, the `&totalVar` property can be used to allow multiple getPage paginations on the same page. 

Please consult the getPage documentation or contact support if you need help with getting a getPage integration functional.   

**Default**: `total`

#### `&limit`   

Specify a number larger than `0` to limit the amount of tags will be displayed, useful when combined with a getPage integration.  

#### `&offset`   

Specify a number larger than 0 to skip a number of results when displaying tags, useful when combined with a getPage integration.  

Note that when you specify an offset, you also need to specify a limit (even if it's just a really high number). 

#### `&cache`   

When enabled, the in-built caching will be used to automatically manage the cache state, based on images and tags used on images. This should always be on.  

**Default**: 1 (true)  

#### `&where`   

A JSON object for generic filtering. For example you can use this to do a partial tag search by passing `{"display:LIKE":"foo%"}`.  

