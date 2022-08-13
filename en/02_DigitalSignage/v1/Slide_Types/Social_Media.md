> **This extra is discontinued**. It was originally built by Sterc and distributed by modmore as a Premium Extra, however in 2020 Sterc decided they can no longer offer the support required. It is no longer available from modmore, but may be available elsewhere.
>
> Unfortunately modmore cannot provide standard support for this extra. You may request support from Sterc directly or consider [booking Premium MODX Support](https://modmore.com/premium-modx-support/) if you need help with it.

To integrate recent Facebook, Twitter & Instagram posts, you can use the free [Social Media extension for Digital Signage](https://modmore.com/digitalsignage/extensions/social-media/).

## Setting up your template

First, you need to have a [custom template](../Custom_Templates). We'll make changes to it to support the Social Media plugin, and don't want those reverted when you next update Digital Signage.

#### Adding CSS Styles

In the header, after the main.css file from Digital Signage, add the following CSS:

````html
<link rel="stylesheet" href="/assets/components/digitalsignagesocialmedia/socialmedia.plugin.css?hash=[[!+digitalsignage.hash]]" />
````

#### Adding Slide HTML

Somewhere in the middle (around line 55 in the default template) you should find a `<div class="slides" data-placeholder="slides">`. Add the following inside that div to act as a template for our Social Media slides..

````html
<!-- Begin Social Media Plugin -->
<div class="social-media" data-plugin="SocialMediaPlugin" data-plugin-settings="{'feed': '/ds/social-media-export.json', 'feedType': 'JSON'}">
    <div class="social-media-inner" data-placeholder="social-media">
        <div class="social-media-item" data-template="item">
            <div class="image">
                <img src="" data-placeholder="image" data-placeholder-wrapper="image" />
            </div>
            <div class="content">
                <div class="content-mask">
                    <p data-placeholder="content" data-placeholder-renders="striptags,ellipsis:80"></p>
                    <p class="date" data-placeholder="pubDate" data-placeholder-renders="date:%d %F %Y"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Social Media Plugin -->
````

#### Adding JavaScript Plugin

Next, way in the footer, but before digitalsignage.js is included, load the Social Media plugin JavaScript:

````html
<script type="text/javascript" src="/assets/components/digitalsignagesocialmedia/socialmedia.plugin.js?hash=[[!+digitalsignage.hash]]"></script>
````

## Adding new Slide Type

In the Digital Signage dashboard, click on Admin View in the top right and add a new Slide Type with key `social_media`, a name and icon of your choosing (e.g. `icon-heart`).

## Adding a new Slide

Go back to the default view with the button in the top right, and add a new slide using the slide type you just created.

## Adding Social Media access tokens

In System > System Settings open the `digitalsignagesocialmedia` namespace to find the various access credentials you'll need, as well as search options. You only have to add the tokens for the social media you want to integrate with.

To check if the credentials are working, you can view the "Export (social media)" resource in your digitalsignage context. That should contain your post, or might contain error messages.
