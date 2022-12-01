---
title: Using MoreGallery with Isotope.js
---

[Isotope](https://isotope.metafizzy.co/) is a popular JavaScript library for building layouts, with client-side filtering and sort options.

Setting up a continuous gallery with Isotope and MoreGallery is quite straightforward.

This example assumes you already have MoreGallery set up with some images; if you haven't yet, see [the getting started guide](../Getting_Started) for where to begin.

_This tutorial assumes you also have the **pthumb** extra installed. If not, install that from the MODX package manager first._

[TOC]


## Install Isotope

First [download Isotope](https://isotope.metafizzy.co/#install). You can download the file manually, install it with npm or bower, or use the provided CDN.

Do note the Isotope is GPLv3 licensed; there are some restrictions what you can do with the free version. Commercial licenses are quite affordable and help its developer, so maybe consider buying that if you enjoy working with Isotope.

## Preparing the MoreGallery output

On your Gallery template (or where-ever you want the gallery to appear), call the [mgGetImages snippet](../Snippets/mgGetImages) like so:

````html
[[!mgGetImages?
    &imageTpl=`gallery-isotope`
    &wrapperTpl=`gallery-isotope-wrapper`
]]
````

> If you don't have a separate template for your gallery, you can also place the snippet call in the content of the gallery resource.

> If you use the same template for galleries and non-galleries, you can use the following to only call mgGetImages on a Gallery resource:
> ```html
> [[[[*class_key:eq=`mgResource`:then=`!mgGetImages`:else=`- do nothing`]]?
>      &property=`here`
> ]]
> ```
> This is the so-called mosquito trick, where the inner tag is executed first and constructs a new tag that is then parsed in the next parser cycle.

Next, create the **gallery-isotope** chunk:

````html

````

And the **gallery-isotope-wrapper** chunk:

````html

````

If you visit the gallery now, you should see

## Load & initialize Isotope

Regardless of how you've downloaded Isotope, upload it to a location on your server.

In your template or footer/scripts chunk, include the script:

````html
<script src="[[++zoofari.assets_url]]lib/isotope.pkgd.min.js"></script>
<script>
    /* Initiate the Isotope gallery */
</script>
````

If you have a shared template and only want to load it on Gallery resources, wrap it with a condition:

````html

[[*class_key:eq=`mgResource`:then=`
<script src="[[++zoofari.assets_url]]lib/isotope.pkgd.min.js"></script>
<script>
    /* Initiate the Isotope gallery */
</script>
`:else=``]]
````

To initialise the gallery, we'll refer to the [Isotope documentation](https://isotope.metafizzy.co/options.html). In this case we like the [Masonry layout mode](https://isotope.metafizzy.co/layout-modes/masonry.html),  but feel free to choose another one. Just check in the documentation as some modes are not included in the original file.

Here's what we ended up as an initialisation script:

````html


````


