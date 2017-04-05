MoreGallery comes with about a dozen system settings, which can be found in the MODX manager under System (cog symbol top right) > System Settings. In the _Namespace_ dropdown select MoreGallery.

To override setting values per context, you can create context settings with the exact same key as the system setting. Context settings will override the system settings for resources in those contexts.

It's also possible to configure some settings like [Cropping](Cropping), [Custom Fields](Custom_Fields) and the gallery positioning per resource. The resource specific options can be found when editing a resource, and going to the Settings tab. When those options are set to `inherit` (the default), they will use the appropriate context or system setting value instead.

You can use [Permissions](Permissions) to limit access to specific features, like uploads, import, etc.

[TOC]

## Storage

### source_relative_url

The `moregallery.source_relative_url` determines the upload path that is used within the configured media source. If your source has a baseUrl and basePath set to `assets/`, and your source_relative_url is set to `galleries/`, the images will be created in `assets/galleries/`.

Defaults to `assets/galleries/`

### source

The media source to use for the image uploads. MoreGallery works with both local (filesystem) and remove (Amazon S3) media sources.

### image_id_in_name

When enabled (the default), image files will have the image record in the file name. This makes sure that images are unique. It's recommended to leave this on to make sure it doesn't accidentally overwrite existing files.

### resource_id_in_path

When enabled (the default), a gallery-specific folder is created within the `source_relative_url` with the ID of the gallery resource. For example an image in gallery 123 is uploaded to `assets/galleries/123/`. Only disable this if your media source or source_relative_url ensures directories are unique in a different way.

## Interface

### content_position

Where to show the content on a gallery resource. Defaults to `above`, where the content is shown in the standard place, and the gallery is added to the bottom of the page.

Alternative values are `below` (gallery is shown first, then the content), `tab` (content is moved into a "Content" tab), or `hide` (content is not available anywhere).

### custom_fields

See [Custom Fields](Custom_Fields).

### use_rte_for_images

When enabled (the default), the standard system-wide editor is available for editing the image description.

## Advanced

### prefill_from_iptc

When enabled (the default), image meta data like the name, description, and tags, are prefilled from the IPTC data embedded within an image. IPTC data is commonly added by photographers or image editors within software like PhotoShop or Lightroom. 

### single_image_url_param

The URL parameter to use for single image views. Defaults to `iid`, but can also be defined on the [mgGetImages snippet](Snippets/mgGetImages) in the `&singleImageParam` property.

### prefetch_image_as_base64

The number of images to prefetch as base64 images. This is set to 20 by default. The reason to prefetch images as base64 is to more instantly show images in the gallery (in the manager) without additional requests made by the browser. It does mean that the server-side has to load the images into memory first. It's recommended to leave this as the default unless you have been instructed by support to change it. 

### allowed_extensions_per_source

When enabled, the allowed file extensions will be checked against the media source. When disabled (the default for legacy reasons) will only be checked against the system configuration. The media source may still deny an upload even when this setting is off.

### add_icon_to_toolbar

When enabled, an image icon will be added to the resource toolbar in the manager sidebar to quickly create a gallery in the root of the site.

## Video

### vimeo_profill_description, youtube_prefill_description

When enabled the description of a video added to the gallery will be prefilled based on the video description as available from Vimeo or YouTube respectively. 

## Cropping

### crops

See [Cropping](Cropping).

### crop_jpeg_quality

The quality to create jpeg crops at, as a number between 1 and 100. Defaults to 100. Lower quality will result in smaller crop images, but also sacrifice sharpness in the image.

### png_compression_level

The compression level to use when creating png crops, as a number between 1 and 10. Defaults to 9.

## Sanitize

### sanitize_pattern

A regex pattern with allowed characters in filenames. Defaults to `/([[:alnum:]_\.-]*)/`

### sanitize_replace

What to replace matches of the `sanitize_pattern` regex with. Defaults to `_`.

### translit

The translit table to use for cleaning up foreign characters. This table must be known to the class defined in `translit_class` at the path `translit_class_path`. The translit extra (available from modx.com) provides translit tables `german`, `russian` and `noaccents`. 

