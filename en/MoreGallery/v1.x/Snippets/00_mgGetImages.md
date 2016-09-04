The **mgGetImages** snippet is used to iterate over images in a gallery.

It is the main snippet in MoreGallery, complemented with the [mgGetTags](mgGetTags) snippet for listing tags.

[TOC]

## General mgGetImages Usage

The minimum mgGetImages snippet call outputs a list of thumbnails, linking to an integrated detail page. The minimum snippet call looks like this:

```` html
[[!mgGetImages]]
````

You should always call mgGetImages uncached, as it manages caching internally. This makes sure the images on a Gallery resource are in sync with the frontend, without relying on full site cache clears.

## Snippet Properties


#### `&resource`   

The ID of the MoreGallery resource to get images from. By default, this will use the current resource, so you wont need to specify this if you want to show images from the current resource. 

As of 1.5.0, you can also specify a comma separated list of resource IDs to get images from. This is best used in combination with a `&sortBy` of `uploadedon` or `random`. 

**Default**: current resource ID  

#### `&sortBy`   

The field to sort images on. This can be one of the following: `filename`, `name`, `sortorder`, `uploadedon`, `editedon` or `random` to randomise the order of the images.  

**Default**: `sortorder`

#### `&sortDir`   

Used with the `&sortBy` property, this will decide in what direction (ASC: ascending or DESC: descending) the results will be sorted.  

**Default**: `ASC` 

#### `&tags`   

Specify a comma separated list of tag names or IDs to filter the resulting images on. 

To find images that are _not_ tagged with a certain tag, you can specify it with a dash in front (e.g. `-highlight`) since 1.4.0. 

While similar in naming, has no relation to `&getTags`. If you would like to accept tags through an URL parameter, you can do so with the `&tagsFromUrl` property. Added in 1.1.0.  

**Default**: 

#### `&tagsFromUrl`   

When not empty, the snippet will look for an URL parameter with the specified name (so if you set this property to "tag" it will look for an URL parameter called "tag") and filter image results on the value of that parameter, which can be a tag ID or actual tag display name. Added in 1.1.0.  

#### `&getTags`   

Set to `1` to load tags for each image and to parse them through the chunk specified in the `&tagTpl` property. 

The result of parsing tags through &tagTpl and separated by the value in `&tagSeparator` will be set to the `[[+tags]]` placeholder in both chunks for `&imageTpl` and `&singleImageTpl`. For added performance, disable this property by setting it to `0` when not using tags. 

Added in 1.1.0.  

**Default**: 1

#### `&getResourceFields`   

Set to `1` to make resource fields available in the `&imageTpl` and `&singleImageTpl` chunks.
 
The resource fields will be made available as placeholders prefixed by "resource". For example `[[+resource.pagetitle]]`. 

When calling mgGetImages on the Gallery resource itself, this isn't typically needed as you could just use the `Snippet: mgGetImages` resource fields, but with [multiple galleries](../Multiple_Galleries) this is useful to enable. 

Added in 1.0.1.  

#### `&getResourceTVs`   

Set to a comma separated list of TV names to make available in the `&imageTpl` and `&singleImageTpl` chunks. 

The TVs will be made available as placeholders prefixed by "resource". For example for a TV called "superlongtitle", the placeholder would be `[[+resource.superlongtitle]]`. 

When calling mgGetImages on the Gallery resource this isn't typically needed as you could just use the `Snippet: mgGetImages` resource fields, but with [multiple galleries](../Multiple_Galleries) this is useful to enable. 

Added in 1.0.1. 

#### `&imageTpl`   

The name of a chunk to use for each image in the result set. See further down this page for the default and placeholders for this chunk. Individual images will be joined together by the value of the `&imageSeparator` property.  

#### `&imageSeparator`   

A string to be used between images parsed through the chunk specified in `&imageTpl`.   

**Default**: linebreak (`\n`)  

#### `&tagTpl`   

The name of a chunk to use for each tag for each image, only if `&getTags` is enabled. Individual tags will be joined together by the value of the `&tagSeparator` property. The default chunk is stored in the filesystem to prevent changes which are overwritten on upgrade, but looks like this:   

```` html
<a href="[[~[[*id]]? &tag=`[[+id]]`]]" class="th" title="View all images tagged [[+display]]">
[   [+display]]
</a> 
````

This generates links to the current resource, passing along a "tag" URL parameter. 

If the mgGetImages snippet call has &tagsFromUrl=`tag` added, that will filter the image results based on the tag. 

Placeholders in the tagTpl are `[[+id]]`, `[[+display]]` (the tag itself), `[[+createdon]]` (the first time the tag was added to an image) and `createdby` (the user ID of the user that used the tag the first time). 

Added in 1.1.0.

#### `&tagSeparator`   

A string to be used between tags parsed through the chunk specified in `&tagTpl`. Added in 1.1.0.  

**Default**: linebreak (`\n`)  

#### `&singleImageEnabled`   

Set to `1` to enable the single image view, or `0` to disable it. When enabled, the snippet will automatically show a single image with a different template (see `&singleImageTpl`) if the `&singleImageParam` is present in the URL. Useful for accessible image galleries. The single image view has been available since v1.0, the singleImageEnabled property was added in v1.4.  

**Default**: `1`  

#### `&singleImageTpl`   

The name of a chunk to use for the single image view. See further down this page for the default and placeholders for this chunk.  

#### `&singleImageParam`   

The URL param to use for the single image view. This will contain the ID of an image inside the gallery that needs to be shown with the `&singleImageTpl` chunk. The single image view has been available since v1.0, but this property was added in v1.4. This setting inherits from the `moregallery.single_image_url_param` setting if left empty.  

**Default**: `iid` 

#### `&wrapperTpl`   

The name of a chunk to use as wrapper template. See further down this page for the default and placeholders for this chunk.  

#### `&wrapperIfEmpty`   

Set to `0` to return an empty result instead of the `&wrapperTpl` chunk when there are no (matching) images. Added in v1.4.  

**Default**: 1  

#### `&toPlaceholder`   

The name of a placeholder to set the result to. When empty it will return the result directly where called.  

#### `&totalVar`   

Name of a placeholder to set the total amount of images to. ([Primarily used for paginating results](../Pagination))  

**Default**: `total`

#### `&limit`   

The amount of images to return ([optionally per page](../Pagination)) when listing images.  

#### `&offset`   

Indicates starting at what index the results should be returned ([primarily used for paginating results](../Pagination)). 

**Note:** if you're specifying an offset, you also need to specify a limit larger than 0. This can be a crazy big amount if you want all images, but without a limit offset wont work. 

#### `&scheme`   

The scheme to be used in url generation when the `url` field of an image is a resource ID. Defaults to the value of the `link_tag_scheme` (core) system setting.  

#### `&cache`   

When enabled, mgGetImages will cache the images on various levels. 

There really is no need to turn this off since 0.9.6. Changes to chunks and snippet properties are automatically recognised, causing it to regenerate the markup. 

**Default**: 1  

#### `&where`   

A JSON object for generic filtering. For example you can use this to get a specific image by passing `{"id":5}`.  

#### `&activeOnly`   

By default mgGetImages will only show active images, but if you also want hidden images to be returned you can set this property to `0`.  

**Default**: 1  

---

## &imageTpl Chunk

The default chunk used in the imageTpl property is the following:

```` html
<a href="[[+view_url]]" class="th">
    <img src="[[+file_path:phpthumbof=`w=200`]]" class="img-polaroid" alt="[[+name]]">
</a>
````

As you can see, the default uses phpthumbof to resize the file to a smaller thumbnail. You are encouraged to change this tpl to meet your specific needs. While we're using the `[[+file_path]]` value to pass to phpthumbof, you can also use the `[[+file_url]]` instead. 

This is mostly a matter of preference as it should work either way. If you're not using a thumbnailing snippet, you should use `[[+file_url]]`.

Our [Demo Site](http://demo.modmore.com/) contains an example implementation of MoreGallery.

The placeholders you can use are below:

#### `[[+idx]]`   

The index of the image in the total set.  

**Example**: `1` 

#### `[[+id]]`   

The ID of the image.  

**Example**: `64`  

#### `[[+filename]]`   

The filename of the originally uploaded image. MoreGallery prepends the image ID to a filename when uploading, however this field does not include that.  

**Example**: `my-beautiful-image.png`  

#### `[[+file]]`   

The actual filename, relative to the location of the configured media source and this gallery its folder.   

**Example**: `64_my-beautiful-image.png`  

#### `[[+file_url]]`   

A fully qualified url to the image based on the configured media source.  

**Example**: `/assets/galleries/6/64_my-beautiful-image.png`  

#### `[[+file_path]]`   

A fully qualified path to the image based on the configured media source.   

**Example**: `/home/user/public_html/assets/galleries/6/64_my-beautiful-image.png`  

#### `[[+mgr_thumb]]`   

A fully qualified url to a resized thumbnail used in the manager, retaining the aspect ratio within a maximum size of 250px by 250px.

#### `[[+width]]`   

The width of the uploaded image in pixels. Added in v1.3  

#### `[[+height]]`   

The height of the uploaded image in pixels. Added in v1.3  

#### `[[+exif.KEY_HERE]]`   

An array containing the raw EXIF data extracted from the uploaded image. [Learn more about using EXIF in MoreGallery](../Exif).  

#### `[[+exif_dump]]`   

A readable dump of the EXIF data extracted from the uploaded image. It's best to wrap this in a `pre` tag for better legibility. [Learn more about using EXIF in MoreGallery](../Exif). Added in v1.4.  

#### `[[+exif_json]]`   

A JSON formatted object of the EXIF data extracted from the uploaded image. [Learn more about using EXIF in MoreGallery](../Exif). Added in v1.4.  

#### `[[+iptc.KEY_HERE]]`   

An array containing the IPTC data extracted from the uploaded image, processed to use normalised names for known elements. [Learn more about using IPTC in MoreGallery](../IPTC). Added in v1.4.  

#### `[[+iptc_dump]]`   

A readable dump of the IPTC data extracted from the uploaded image. It's best to wrap this in a `pre` tag for better legibility. [Learn more about using IPTC in MoreGallery](../IPTC). Added in v1.4.  

#### `[[+iptc_json]]`   

A JSON formatted object of the IPTC data extracted from the uploaded image. [Learn more about using IPTC in MoreGallery](../IPTC). Added in v1.4.  

#### `[[+name]]`   

The name as entered by the user in the backend.  

**Example**: My Beautiful Image  

#### `[[+description]]`   

The description as entered by the user in the backend.  

#### `[[+url]]`   

The URL as entered by the user in the backend. If a resource ID was entered, this will contain a generated url to the resource. 

#### `[[+sortorder]]`   

The sort order as managed by the user in the backend through drag & drop. 

#### `[[+view_url]]`   

An URL to the Gallery resource with the `&iid` URL parameter with the image's ID as value. This is used for image detail pages, instead of linking to the image file directly.  

This is also called the single image view. 

#### `[[+prev.KEY_HERE]]`   

An array containing all the same fields above, but then for the image that was before this one in the result set. For example `[[+prev.name]]`.

#### `[[+next.KEY_HERE]]`   

An array containing all the same fields above, but then for the image that is next in the result set. For example`[[+next.name]]`.  

#### `[[+custom.KEY_HERE]]`   

An array containing custom field values. [Read more about Custom Fields](../Custom_Fields). Added in v1.4.  


## &singleImageTpl Chunk

The singleImageTpl is used when viewing a single image (with the `&iid` URL parameter or the parameter specified in the `&singleImageParam` property, generated by the  placeholder. 

The default chunk used in the singleImageTpl property is the following:

```` html
[[+prev.id:notempty=`
    <a href="[[+prev.view_url]]" class="th">
        <img src="[[+prev.file_path:phpthumbof=`w=200`]]" class="img-polaroid" alt="[[+prev.name]]">
    </a>
`]]
<a href="[[+file_url]]" class="th">
    <img src="[[+file_path:phpthumbof=`w=500`]]" class="img-polaroid" alt="[[+name]]">
</a>
[[+next.id:notempty=`
    <a href="[[+next.view_url]]" class="th">
        <img src="[[+next.file_path:phpthumbof=`w=200`]]" class="img-polaroid" alt="[[+next.name]]">
    </a>
`]]
````

The placeholders you can use are exactly the same as the placeholders for the imageTpl chunk, listed above.

## &wrapperTpl Chunk

The wrapperTpl chunk can be used (it is optional) to wrap the list output (i.e. &singleTpl's) in.

There is no default wrapperTpl chunk. But you might use it like this:

```` html
<ul class="image-list">
    [[+output]]
</ul>
````

The available placeholders in the wrapperTpl are `[[+output]]`, which contains all the images parsed through imageTpl chunks, and `[[+image_count]]`, which contains the number of matching images. 

If you have enabled `&getResourceFields`, the resource data is also available in the wrapperTpl as of v1.4.
