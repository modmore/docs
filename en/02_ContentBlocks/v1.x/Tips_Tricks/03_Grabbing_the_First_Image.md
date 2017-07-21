So you've got ContentBlocks all set up, and you're happily inserting images into your blog posts or other type of content. Now you want to set the proper image meta tags so Twitter and Facebook can use them when your page gets shared.

This is a very typical scenario, where structured content really shines, as you can easily extract certain information from the content. To aid this use case, we've provided a snippet called [cbGetFieldContent](../Snippets/cbGetFieldContent) (as of v1.2).

The markup we're looking to add is the following, for both Facebook and Twitter Cards:
```` HTML
<meta property="og:image"
      content="http://mysite.com/images/uploads/image.jpg" />
<meta name=”twitter:image” 
      content=”http://mysite.com/images/uploads/image.jpg” /> 
````
We'll use the cbGetFieldcontent snippet to grab the first image that exists in the content.

It's important to know the ID of your Image field. In this example, we'll assume it is ID 5. You can find the ID in the ContentBlocks component, it's the number between brackets.

```` HTML
[[cbGetFieldContent?
    &field=`5`
]]
````

That will return the first image in the current resource, however it will be parsed through the defined field template. As we just want the image url, we'll need to specify a chunk to use as template.

```` HTML
[[cbGetFieldContent?
    &field=`5`
    &tpl=`firstImageTpl`
]]
````

Create a chunk called firstImageTpl. As we just want the image url, the chunk is super simple:

```` HTML
[[+url]]
````

Now we've extracted just the url from the first image field. Awesome! If you'd like to resize the image, you can use any of the phpthumb packages, like pthumb, to resize the image. 

Let's insert it into our meta tags, using a little trick to make sure we only have to call the snippet once with the toPlaceholder output modifier.

```` HTML
[[cbGetFieldContent:toPlaceholder=`first_image`?
    &field=`5`
    &tpl=`firstImageTpl`
]]
<meta property="og:image"
      content="[[++site_url]][[+first_image]]" />
<meta name=”twitter:image” 
      content=”[[++site_url]][[+first_image]]” />
````

We can also add a default image, in case there are no image fields in the content, like this:

```` HTML
[[cbGetFieldContent:default=`assets/images/logo.jpg`:toPlaceholder=`first_image`?
    &field=`5`
    &tpl=`firstImageTpl`
]]
<meta property="og:image"
      content="[[++site_url]][[+first_image]]" />
<meta name=”twitter:image” 
      content=”[[++site_url]][[+first_image]]” /> 
````

And that's it! You can do this with any kind of field. Checkout the [cbGetFieldContent documentation](../Snippets/cbGetFieldContent) for more information about the features and available properties on the snippet.
