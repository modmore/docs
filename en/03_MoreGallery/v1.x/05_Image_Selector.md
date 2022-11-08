As of MoreGallery 1.16 a new Image Selector is included. This feature was sponsored by Catch Media.

The image selector allows you to choose specific images from one (or multiple) galleries, which you can then output elsewhere. For example to use MoreGallery as some sort of assets library.

## Availability

The image selector is available as:

1. a Template Variable
2. a ContentBlocks input type

Both work exactly the same, and return a comma-separated list of image IDs as their value.

> If you did not have ContentBlocks installed when installing MoreGallery 1.16+, you may need to reinstall MoreGallery before the ContentBlocks input type will be available.

## Configuration (TV)

Create a new Template Variable and select the `[MoreGallery] Image Select` input type for it.

You can use its value as `[[*name-of-tv]]`, or `[[+name-of-tv]]` when accessing the resource through pdoResources/getResources. Note you may need to provide `&includeTVs`/`&includeTVList` and `&tvPrefix` in the latter case.

Where you want the selected image(s) to show up, place the mgGetImages snippet call:

````html
[[!mgGetImages?
    &images=`[[*name-of-tv]]`
]]
````

Add additional parameters as needed.

## Configuration (ContentBlocks)

Create a new field in Extras > ContentBlocks and choose the `MoreGallery Image Selector` input type for it.

In the field template you'll already find the mgGetImages snippet call provided the `[[+value]]`. Add additional parameters as needed.


