---
title: Thumbnails & Performance
---

Thumbnail generation is quite an intensive process and can delay load times quite significantly. But it's also quite necessary to ensure a consistent look on the website, that matches the design perfectly. The de-facto thumbnail solution in MODX is phpThumbOf, but there are a number of alternatives and other techniques to improve the performance when it comes to creating custom-sized thumbnails for your front-end presentation.

[TOC]

### Use pThumb instead of phpThumbOf

While the recommendations change from time to time, currently pThumb is generally considered the better alternative compared to phpThumbOf and phpThumbsUp. It's somewhat faster and is actually a drop-in replacement for phpThumbOf, so it's easy to move.

phpThumbsUp is the only resizing snippet that processes thumbnail requests when the **image** file is requested, rather than when the **resource** is requested. This can have an impact on the perceived rendering time of your site, but not necessarily overall rendering time due to the slightly increased overhead of multiple heavy requests. 

### Use the `mgr_thumb` or Cropping

On upload MoreGallery creates a small thumbnail (at most 250x250px) to show in the back-end. If your front-end needs fit within that size, you can use the `[[+mgr_thumb]]` placeholder inside your chunks, instead of the `[[+file_url]]` or `[[+file_path]]`. 

It also takes less resources and time to resize a smaller image, so you can also use `[[+mgr_thumb]]` as target for your resizing snippet, so long as it's meant to be smaller than 250x250px. 

You can also use [Cropping](Cropping) to create thumbnails that fit your own requirements. These crops can also be changed by the user to contain the right part of the image, and they are created during upload or when edited, so they don't bog down your server when a visitor views a gallery. 

### Disable the phpThumbOfCacheManager Plugin

If you're using phpThumbOf, one of the easiest things to improve performance is to disable the phpThumbOfCacheManager plugin. 

This plugin handles clearing the thumbnail cache each time the site cache is cleared. This is a convenient feature when you're still developing a website, and source images change so thumbnails need to be updated.
 
In production however it can be a strain on performance as thumbnails don't have to be regenerated on every site change/cache clear. 

Just make sure the image name is unique when uploaded (MoreGallery will ensure that for images in your Gallery), and for most use cases you'll be better off without the plugin. 

### Prevent phpThumb Cache Control

Whenever the phpThumb library included in the MODX core is used, it will check the cache directories to verify its accuracy. This includes checking if cached files aren't too old, that there are too much cache files and that the size of the cache doesn't grow out of control.

If the limits are exceeded, the system will remove cache files.

By setting the following settings to 0, the cache check will not be executed which can save precious milliseconds off the processing time.

The settings to set to 0 are:

- `phpthumb_cache_maxage`
- `phpthumb_cache_maxfiles`
- `phpthumb_cache_maxsizes`

These settings can be found in _System_ > _System Settings_ and then under the _phpThumb_ area.
