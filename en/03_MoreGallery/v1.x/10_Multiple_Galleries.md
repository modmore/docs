With MoreGallery, each Resource is a single Gallery or Album. This means that if you want multiple galleries, or albums, you will need to create multiple Gallery resources. 

To show cover images for a number of galleries, or to show all images in each of the galleries on a single page, the suggested method is to use getResources to loop over each of the Gallery Resources. Inside the getResources template, you can then call the [mgGetImages snippet](Snippets/mgGetImages) which will provide you with the image(s) you would like. 

By re-using the getResources addon for looping over Resources, you get a lot of flexibility.

[TOC]

## getResources Call

Start with your getResources call on the albums page (the one that contains a number of Gallery resources) which looks like this:

```` html   
<ul class="albums">
[[getResources? 
  &tpl=`albumGallery`
  &parents=`[[*id]]`
]]
</ul>
```` 
  
If your Gallery resource is hidden from menus, be sure to include the `&showHidden` property in the snippet call as well, otherwise it wont show up. 

If you want more than 5 galleries to show up, you'll also need to set the `&limit` property and of course [all the other properties of getResources](http://rtfm.modx.com/extras/revo/getresources) apply as well.

## The albumGallery Chunk

In the albumGallery chunk we call the mgGetImages snippet ( [fully documented here](Snippets/mgGetImages)) to get images from the resource. 

Please note that we are calling this snippet **uncached**, as this will ensure this will always load the right images. Because the mgGetImages snippet contains various levels of caching, it is safe to call it uncached.

```` html   
<li class="album">
[[!mgGetImages?
   &resource=`[[+id]]`
   &imageTpl=`albumGalleryImage`
   &limit=`1`
   &getResourceFields=`1`
]]
</li>
````

In this example we are limiting the results to a single image, which results in the first image of the gallery to be shown using the albumGalleryImage chunk. 

If you would like to show more images, adjust the limit property as desired. We're also passing the getResourceFields property, so that we can access resource fields (with a resource. prefix) in the imageTpl chunk.

To format the image result we are using the `albumGalleryImage` chunk.

## The albumGalleryImage Chunk

This chunk is used for each individual image that is returned. Be sure to refer to the [Snippet Usage](Snippets/mgGetImages) document for all available placeholders.

```` html
<div class="image">
  <img src="[[+file_url:pthumb=`w=150&h=200&zc=1`]]" alt="[[+resource.pagetitle]]" />
  <h4>[[+name]]</h4>
</div>
````