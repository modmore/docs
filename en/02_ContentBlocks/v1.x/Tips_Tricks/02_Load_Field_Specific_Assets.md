Say you have a Gallery field that depends on a large javascript library for the display. Or you are [displaying code which needs to be syntax highlighted](Displaying_MODX_Code). You may not want to load all the necessary css and javascript on all pages, but only on those specific pages to prevent other pages slowing down unnecessarily. Perhaps you would add a template variable to toggle when specific libraries need to be loaded?

This Tip makes use of the cbHasField snippet, included in the ContentBlocks core, to do it all automatically without having to worry about it as editor.

## The Setup

In this case, we're using the [Displaying (MODX) Code tip](https://www.modmore.com/contentblocks/tips-tricks/displaying-code/) as example. We want to only load our syntax highlight script, in this case Prism, when we have a code input in the content.

Prism consists of [two files](http://prismjs.com/download.html) you'll need on your server, a CSS file (which should go into the `<head>`) and a javascript file (which should go right before the `</body>`). Let's assume that you have uploaded these files to /assets/js/prism.css and /assets/style/prism.js, and that the code field you created earlier has an ID of 4.

Using the [cbHasField](../Snippets/cbHasField) snippet, we would add the following to our template head:
```` HTML
[[cbHasField?
    &field=`4`
    &then=`<link rel="stylesheet" href="/assets/style/prism.css">`
]]
````
And the following to our template footer:
```` HTML
[[cbHasField?
    &field=`4`
    &then=`<script src="/assets/js/prism.js">`
]]
````
And we're done. Now, whenever we use the Code input, we will load the right resources on that page only.

