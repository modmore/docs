MoreGallery allows embedding videos from YouTube and Vimeo since version 1.5. This made it the first Gallery Extra for MODX that also supports video natively.

> As of version 1.18, you can also embed local videos in MoreGallery.

[TOC]

## Adding videos to a Gallery

To add a video from YouTube or Vimeo to a Gallery resource, click the _Add Video_ button in the toolbar of the gallery. In the popup, you can paste in the link to a video on YouTube or Vimeo. It will automatically recognise the link, extract its unique video ID, and use that to talk to the YouTube/Vimeo APIs to retrieve a thumbnail.

The name and description of the image will also be pre-filled with information from the video service automatically. Pre-filling the description can be disabled by setting the `moregallery.vimeo_prefill_description` or `moregallery.youtube_prefill_description` system settings to no.

To add a local video, just use the Upload button and select the video from your computer, or use the Import button to select it from the file manager. Note that videos are often larger than PHP is allowed to process, so you may need to increase the memory limit, max_post_size, and upload_max_filesize in your php.ini file. For videos over 100MB, it's better to upload them using FTP instead of the web interface or to use YouTube/Vimeo.

 [ ![](https://assets.modmore.com/uploads/2016/07/moregallery_video.gif)](https://assets.modmore.com/uploads/2016/07/moregallery_video.gif)

## Showing videos on your site

To show videos on your site, you would also use the [mgGetImages snippet](Snippets/mgGetImages).

In the default situation (when you haven't defined any custom chunks yet), the video thumbnail will be shown in the listing view. In the image example below, the first image is a standard image while the other two are videos from YouTube and Vimeo respectively.

 [ ![](https://assets.modmore.com/uploads/2016/07/Screen_Shot_2016_07_25_at_22.11.37.png)](https://assets.modmore.com/uploads/2016/07/Screen_Shot_2016_07_25_at_22.11.37.png)

While there's no visual difference, the images have a class of mg-image on the list item, and the videos have mg-video as well as mg-video-youtube or mg-video-vimeo to offer you styling hooks for CSS.

When clicking on an image in the default setup, you'll be pointed towards the single image view (which is a link to the current page, but with an &iid url parameter by default), and it will embed the video with the YouTube or Vimeo player, along with the familiar Previous and Next image links.

 [ ![](https://assets.modmore.com/uploads/2016/07/Screen_Shot_2016_07_25_at_22.11.49.png)](https://assets.modmore.com/uploads/2016/07/Screen_Shot_2016_07_25_at_22.11.49.png)


## Customising the front-end output (listing view)

To change the way videos are shown through the mgGetImages snippet, you can use the `&youtubeTpl`, `&vimeoTpl`, and `&videoTpl` snippet properties to provide the name of a new chunk for on listing pages.

The default for `&youtubeTpl` and `&vimeoTpl` is the following, which will display a static thumbnail image, with a link to the single image view.

```` html
<li class="mg-video mg-video-[[+service]]">
    <a href="[[+view_url]]" title="[[+name:htmlent]]">
        <img src="[[+mgr_thumb]]" class="img-polaroid" alt="[[+name:htmlent]]">
    </a>
</li>
````

If you'd like to show the embed on the list view, instead of the static image thumbnail, you can use something like the following for **YouTube** (`&youtubeTpl`). Note that in this case it doesn't include the view_url placeholder, so there's no way to get to its detail view.

```` html
<li class="mg-video mg-video-[[+service]]">
    <div class="flex-video widescreen [[+service]]">
        <iframe class="mg-video mg-video-[[+service]]" width="[[+width]]" height="[[+height]]"
                src="//www.youtube.com/embed/[[+video_id]]" frameborder="0"></iframe>
    </div>
</li>
````

For **Vimeo** (`&vimeoTpl`), you could use the following.

```` html
<li class="mg-video mg-video-[[+service]]">
    <div class="flex-video widescreen [[+service]]">
        <iframe class="mg-video mg-video-[[+service]]" width="[[+width]]" height="[[+height]]"
                src="//player.vimeo.com/video/[[+video_id]]" frameborder="0"></iframe>
    </div>
</li>
````

The default for `&videoTpl` is the following, which embeds the video directly using the html5 video tag.

```` html
<li class="mg-video">
    <a href="[[+view_url]]" title="[[+name:htmlent]]">
        <video
            class="mg-video-player"
            width="[[+width]]"
            height="[[+height]]"
            poster="[[+mgr_thumb]]"
            controls
            preload="metadata"
            playsinline
            aria-label="[[+name:htmlent]]"
            loading="lazy">
            <source src="[[+video_url]]" type="video/[[+extension]]">
            <p class="mg-video-fallback">
                Your browser does not support video.
                <a href="[[+video_url]]" download="[[+name]]">Download the video file</a> instead.
            </p>
        </video>
    </a>
</li>
````

## Customising the front-end output (single image view)

In the single image view, videos will by default be shown as an embed using the proper YouTube or Vimeo player.

This is the default chunk for **YouTube** (`&singleYoutubeTpl`):

```` html
<div class="flex-video widescreen [[+service]] embed-responsive embed-responsive-16by9">
    <iframe class="mg-video mg-video-[[+service]] embed-responsive-item" width="[[+width]]" height="[[+height]]"
            src="//www.youtube.com/embed/[[+video_id]]" frameborder="0"></iframe>
</div>

<p>
[[+prev.id:notempty=`
    <a href="[[+prev.view_url]]">&laquo; [[+prev.name]]</a>
`]]
    <span class="text-center center">[[+name]]</span>
[[+next.id:notempty=`
    <a href="[[+next.view_url]]" class="text-right right">[[+next.name]] &raquo;</a>
`]]
</p>
````

For **Vimeo** (`&singleVimeoTpl`), the default chunk contains:

```` html
<div class="flex-video widescreen [[+service]] embed-responsive embed-responsive-16by9">
    <iframe class="mg-video mg-video-[[+service]] embed-responsive-item" width="[[+width]]" height="[[+height]]"
            src="//player.vimeo.com/video/[[+video_id]]" frameborder="0"></iframe>
</div>

<p>
[[+prev.id:notempty=`
    <a href="[[+prev.view_url]]">&laquo; [[+prev.name]]</a>
`]]
    <span class="text-center center">[[+name]]</span>
[[+next.id:notempty=`
    <a href="[[+next.view_url]]" class="text-right right">[[+next.name]] &raquo;</a>
`]]
</p>
````

For **local videos** (`&singleVideoTpl`), the default chunk contains:

```` html
<<p>
    <a href="[[+file_url]]" title="[[+name:htmlent]]">
        <video
            class="mg-video-player"
            width="[[+width]]"
            height="[[+height]]"
            poster="[[+mgr_thumb]]"
            controls
            preload="metadata"
            playsinline
            aria-label="[[+name:htmlent]]"
            loading="lazy">
            <source src="[[+video_url]]" type="video/[[+extension]]">
            <p class="mg-video-fallback">
                Your browser does not support video.
                <a href="[[+video_url]]" download="[[+name]]">Download the video file</a> instead.
            </p>
        </video>
    </a>
</p>

<p>
    [[+prev.id:notempty=`
    <a href="[[+prev.view_url]]">&laquo; [[+prev.name]]</a>
    `]]
    <span class="text-center center">[[+name]]</span>
    [[+next.id:notempty=`
    <a href="[[+next.view_url]]" class="text-right right">[[+next.name]] &raquo;</a>
    `]]
</p>
````

Of course you can customise the embed codes further. The available options for that can be found in the official YouTube Player and Vimeo Player documentation.
