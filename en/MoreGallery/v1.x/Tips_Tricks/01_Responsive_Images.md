## Using Picture for Responsive Images

MoreGallery 1.3 added a neat [cropping & resizing feature](https://www.modmore.com/moregallery/documentation/crops/). 


One of the use cases for that feature is the use of responsive images, where different crops are shown for different browser dimensions. In this document, we'll explain how you can set up your gallery to use `<picture>` and `<source>` tags with several different crops. 

## What are responsive images?

Responsive images basically lets you show different images depending on the browser size of your visitor, or somethings other factors (such as bandwidth or preferences). With responsive images you can ensure the user doesn't download enormous images they don't need, but it can also be about art direction, where the proper thumbnail is hand-picked, or different variations of the same image are optimised for different users.

The core problem with using responsive images has been the lack of a standard approach. But now, the `<picture>` element and the `srcset` attribute on the `img` tag are making it into browsers. Combined with MoreGallery and a polyfill, that gives you all the tools you need for responsive images in MODX.

## Step 1: Setting up Crops

While the syntax between  and srcset is different, you can use the same set of crops in MoreGallery to generate the different images. There are many ways this can be configured and it would be great to read up on [Cropping in MoreGallery](../Cropping) first if you haven't yet.

The first thing to figure out is **what crops do we want to have available**. This entirely depends on your use case, but a fairly standard use case will be showing different images for different devices to better fit the screen size and design. 

We'll assume, for this tutorial, that we are going to make 3 different crops available (one for mobile, one for tablets and one for desktop).

Let's set the `moregallery.crops` setting to the following: `desktop:default_aspect=1.75, width=1200|tablet:default_aspect=1.3,width=800|mobile:default_aspect=0.6,width=480`

Read the Cropping documentation for more information about what this means, but in a nutshell, we set 3 crops:

1. `desktop`: by default we make it a widescreen image, and we resize the image to a maximum width of 1200px.
2. `tablet`: a landscape image with a max width of 800px
3. `mobile`: a portrait image with a max width of 480px

By specifying a default aspect, any image we did not manually crop yet (like newly uploaded images) will be of the specified aspect ratio; without forcing the editor to use that exact aspect ratio.

With these crops set up, open your gallery resource to have it generate the default crops (this may take a while the first time it's loading).

## Step 2: Loading Required Assets

While `<picture>` and srcset are rapidly being adopted in browsers natively, you will need to use the [awesome Picturefill.js polyfill](http://scottjehl.github.io/picturefill/) for now to ensure browsers know what to do you with your fancy responsive images. 

The recommended way of loading that polyfill at time of writing is by adding the following into the `<head>` of your page/template:

```` html   
<script>
document.createElement( "picture" );
</script>
<script src="path/to/picturefill.js" async></script> 
````   

[The picturefill.js file (v2+) can be downloaded here](http://scottjehl.github.io/picturefill/#download).

## Step 3: Setting up your Snippet Call and Chunk

To display the images in the front-end, we'll need to use the mgGetImages snippet and a chunk for the imageTpl property. If you already have a front-end gallery set up, you'll need to tweak that, but for this tutorial we'll just set up a simple image list. You could use prettyPhoto or just some basic CSS to style these.

In your Gallery resource content (or template), set up the following snippet call:


```` html   
<ul class="responsive-images-gallery">
    [[!mgGetImages?
        &imageTpl=`responsiveImageTpl`
    ]]
</ul>
```` 

And add a chunk with the name responsiveImageTpl. Here's an example of what it should contain if you want to use the `<picture>` element:


```` html   
<li>
    <a href="[[+file_url]]" rel="prettyPhoto[gallery]">
        <picture alt="[[+name]]">
        	<!--[if IE 9]><video style="display: none;"><![endif]-->
           <source srcset="[[+crops.desktop.thumbnail_url]]" media="min-width:800px">
           <source srcset="[[+crops.tablet.thumbnail_url]]" media="min-width:480px">
           <source srcset="[[+crops.mobile.thumbnail_url]]">
           <!--[if IE 9]></video><![endif]-->
           
          <!-- fallback for browsers without picturesupport -->
          <img src="[[+crops.tablet.thumbnail_url]]" alt="[[+name]]">
        </picture>
    </a>
</li>
````

We're linking to the original, full-size file with `[[+file_url]]`, while using the cropped images as sources for the `<picture>` element. 

The media queries on the `<source>` tags define which image is shown on supported browsers. It parses top-down until it finds a match, so our media queries start from largest (800+ pixels wide) to smaller. 

For clients that don't support the picture tag - not even with the polyfill loaded - the default `<img>` tag is loaded.

The IE9 specific comments, with the `<video>` tag, are for IE9 specific issues [as documented here](http://scottjehl.github.io/picturefill/#ie9).

## Step 4: Done!

And that's basically it! You can now start cropping your images and watch them get loaded conditionally by using the picture tag. 

It's possible to achieve similar results with the `<img srcset>` spec.

