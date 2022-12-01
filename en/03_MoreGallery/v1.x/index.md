---
title: MoreGallery 1.x
description: Documentation for MoreGallery, a premium extra from modmore for MODX.
---

[MoreGallery](https://modmore.com/moregallery/) is an intuitive and fully featured image gallery for MODX with tags, cropping, custom fields and video.

# Recommended Reading

- [Getting Started](Getting_Started)
- [Configuration](Configuration)
- [mgGetImages Snippet](Snippets/mgGetImages)
- [mgGetTags Snippet](Snippets/mgGetTags)



| Property | Description | Default |
|----------|-------------|---------|
| `&resource` | The ID of the MoreGallery resource to get images from. By default, this will use the current resource, so you wont need to specify this if you want to show images from the current resource. <br><br> As of 1.5.0, you can also specify a comma separated list of resource IDs to get images from. This is best used in combination with a `&sortBy` of `uploadedon` or `random`. | Current resource ID |
| `&sortBy` | The field to sort images on. This can be one of the following: `filename`, `name`, `sortorder`, `uploadedon`, `editedon` or `random` to randomise the order of the images. | `sortorder` |
| `&sortDir` | Used with the `&sortBy` property, this will decide in what direction (ASC: ascending or DESC: descending) the results will be sorted. | `ASC` |
| `&tags` | Specify a comma separated list of tag names or IDs to filter the resulting images on. To find images that are _not_ tagged with a certain tag, you can specify it with a dash in front (e.g. `-highlight`) since 1.4.0. <br><br> While similar in naming, has no relation to `&getTags`. If you would like to accept tags through an URL parameter, you can do so with the `&tagsFromUrl` property. Added in 1.1.0.| none |
| `&tagsFromUrl` | When not empty, the snippet will look for an URL parameter with the specified name (so if you set this property to "tag" it will look for an URL parameter called "tag") and filter image results on the value of that parameter, which can be a tag ID or actual tag display name. Added in 1.1.0. | none |
| `&getTags` | Set to `1` to load tags for each image and to parse them through the chunk specified in the `&tagTpl` property.<br><br>The result of parsing tags through &tagTpl and separated by the value in `&tagSeparator` will be set to the `[[+tags]]` placeholder in both chunks for `&imageTpl` and `&singleImageTpl`. For added performance, disable this property by setting it to `0` when not using tags. | 1 |
| `&getResourceFields` | Set to `1` to make resource fields available in the `&imageTpl` and `&singleImageTpl` chunks. The resource fields will be made available as placeholders prefixed by "resource". For example `[[+resource.pagetitle]]`. <br><br>When calling mgGetImages on the Gallery resource itself, this isn't typically needed as you could just use the `[[*pagetitle]]` resource fields, but with [multiple galleries](../Multiple_Galleries) this is useful to enable. | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |
| | | |


