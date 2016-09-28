---
title: Available Input Types
---

This page contains an **alphabetical** list of the _built-in_ input types for [ContentBlocks](https://www.modmore.com/contentblocks/). For information on building custom input types for things that are not included, check out the [Custom Inputs documentation](../Custom_Inputs/Developing_Custom_Inputs) and see the [List of Available Custom Input Types](../Custom_Inputs/Third_Party_Input_Types) for custom input types you can use.


## Field vs Input

Inputs, or Input Types, control how a piece of content is managed and displayed in the front-end. From a user perspective, it's a certain type of content.

Using these Input Types, the site builder (that's probably you) can define [Fields](../Fields). A Field has a name ("Introduction"), an icon and an input type attached to it. The input type enables certain properties (such as templates) that affect how the user interacts with it, or how it is displayed in the front-end.

A single input type can be reused in multiple configurations (for example with different templates) by defining multiple fields with the input type.

 

## Chunk

The Chunk input type is used to insert a pre-defined MODX chunk into the content. The chosen chunk will be loaded into the canvas dynamically to give a preview of what was added.

If the chunk has properties attached to it, they will be shown below the preview, allowing the user to insert bits of content into the chunk.

The chunk input type has no template. If your chunk relies on certain styling, you will probably need to use a plugin to register a CSS file in the manager to style it nicely in the manager.

 



[![](https://www.modmore.com/assets/uploads/7595c06a23a490d4b6e805f21c62d277.png)](https://www.modmore.com/assets/uploads/7595c06a23a490d4b6e805f21c62d277.png)

 

 

## Code

 The Code input is a syntax highlighted code editor. It is powered by [Ace](http://ace.c9.io) and is complemented with a drop down to change the highlighted language.

 Through the input properties it is possible to customise what languages can be chosen in the drop down (defaulting to HTML, CSS, JavaScript and PHP) and which one is the default (HTML).

 The template for the Code input determines how the code is displayed to the front-end. Two common scenarios are:

1. Inserting a code block into the markup to display the code. In this case, it's important to properly escape the code. In this case enable the _Encode Entities_ property, which will make sure the `` placeholder is properly escaped (including MODX tags) for display.
2. Actually interpreting the code. For example, if you need to insert some custom HTML and want to use the syntax highlighter in doing so. Simply add a template that just contains the `` placeholder.

The `contentblocks.code.theme` setting allows you to change the theme that is used for the syntax highlighting. You can try different themes [here](http://ace.c9.io/build/kitchen-sink.html).

Also see this tip for [Displaying (MODX) Code](../Tips_Tricks/Displaying_MODX_Code).

 



[![](https://www.modmore.com/assets/uploads/e280ca4db15226f2778c7e119dc1600d.png)](https://www.modmore.com/assets/uploads/e280ca4db15226f2778c7e119dc1600d.png)

 

 

## Gallery

While not quite as full featured as MoreGallery, the built-in Gallery input for ContentBlocks is quite nice. It allows you to limit the number of images editors can add and is fully template-able as you would expect.

The template property is used for each individual image (placeholders: `[[+idx]]`, `[[+url]]` and `[[+title]]`), while the wrapper template is used to wrap the images (placeholder: `[[+images]]`).

 



[![](https://www.modmore.com/assets/uploads/6b2273fa0b7ea82850c83f94a3e70ef8.png)](https://www.modmore.com/assets/uploads/6b2273fa0b7ea82850c83f94a3e70ef8.png)

 

 

## Heading

The heading input is a simple one, but extremely useful. It combines a drop down for different levels, with a text input. The default template outputs a simple heading tag, however with a bit of creativity it's possible to make them more useful.

For example, a template could contain a link and and anchor to [automatically link headings](../Tips_Tricks/Auto_Linked_Headers), like we're doing on modmore.com.

 



[![](https://www.modmore.com/assets/uploads/cf0526ac66123db933a73b506130c053.png)](https://www.modmore.com/assets/uploads/cf0526ac66123db933a73b506130c053.png)

 

 

## Horizontal Rule

Possibly one of the easiest input types ever, this input type inserts a simple visual horizontal rule (`<hr>`) into the canvas. Make sure to add a `<hr>` (or similar markup) to the template. No preview of this input type, sorry.

 

## Image (+ Image with Title)

The Image input offers a super streamlined image upload, as well as the ability to select images previously uploaded to the server using the regular MODX File Browser.

Similar to how Redactor works, you can configure a bunch of settings to influence how uploaded images are handled. These are:

- _contentblocks.image.source_: the Media Source to upload images to.
- _contentblocks.image.upload\_path_: the path (relative to the root of the media source) to upload images to. You can use placeholders as well: `[[+year]]`, `[[+month]]`,`[[+day]] `, `[[+user]]`, `[[+username]]`, `[[+resource]]` (ID).
- _contentblocks.image.sanitize_: when enabled, the image name will be sanitised before upload. This is done with regex and the pattern and replacement can be tweaked with the _contentblocks.sanitize\_pattern_ and _contentblocks.sanitize\_replace_ settings.
- _contentblocks.image.hash\_name_: when enabled, the image name will be hashed (a simple md5 hash) before upload.
- _contentblocks.image.prefix\_time_: when enabled, a unix timestamp will be prefixed to the image name before upload to ensure it's unique.

The image with title input type is exactly the same as the image, except that it adds a title field under the image to add a title/alt attribute.

The image is available through the `[[+url]]` placeholder in the template, and when using the image with title you can also use the `[[+title]]` placeholder.

 



[![](https://www.modmore.com/assets/uploads/82308bae9d682e0df6aa26c8f29cf2e7.png)](https://www.modmore.com/assets/uploads/82308bae9d682e0df6aa26c8f29cf2e7.png)

[![](https://www.modmore.com/assets/uploads/226117876a28868059b4da1b0e3a93b5.png)](https://www.modmore.com/assets/uploads/226117876a28868059b4da1b0e3a93b5.png)

 

 

## List (+ Ordered List)

Need to make complex lists? The List (and Ordered List) input type have you covered. It is built to be keyboard friendly and supports pretty much infinitely nested lists.

 



[![](https://www.modmore.com/assets/uploads/0600fcde539a94c22b1864d5bbb69adb.png)](https://www.modmore.com/assets/uploads/0600fcde539a94c22b1864d5bbb69adb.png)

 

 

## Quote

The Quote input type combines a simple textfield with a smaller input field to add the author. This works great with a `<blockquote>` and `<cite>` tag for semantic markup. The textarea grows automatically to accommodate longer quotes.

 



[![](https://www.modmore.com/assets/uploads/f30c46c28bb0725ed917ad29344a824b.png)](https://www.modmore.com/assets/uploads/f30c46c28bb0725ed917ad29344a824b.png)

 

 

## Rich Text

The rich text input uses the installed rich text editor, such as [Redactor](https://www.modmore.com/extras/redactor/) or TinyMCE, to provide the richtext editing experience your clients are already used to. If no supported rich text editor is installed, a simple textarea is shown instead.

 



[![](https://www.modmore.com/assets/uploads/1cd44c5242245bf7754332f2ea6e8743.png)](https://www.modmore.com/assets/uploads/1cd44c5242245bf7754332f2ea6e8743.png)

 

 

## Snippet

The snippet input provides an interface for choosing and configuring snippets. While still pretty technical, it is more accessible to editors than MODX tags. The properties are based on the properties defined by the snippet and a list of them is shown in the Add Property drop down.

If enabled on the Field properties tab, there is also the option to call snippets uncached, otherwise all snippets are assumed cached as they should be.

It is possible to filter the available snippets based on name/IDs as well as categories by configuring the properties as such.

 



[![](https://www.modmore.com/assets/uploads/a9e5ae3f5f9b8770a1c28e9fd0455c27.png)](https://www.modmore.com/assets/uploads/a9e5ae3f5f9b8770a1c28e9fd0455c27.png)

 

 

## Table

Docs to be added.

 



[![](https://www.modmore.com/assets/uploads/76fde4cb13d90fb56d43c301f03af29a.png)](https://www.modmore.com/assets/uploads/76fde4cb13d90fb56d43c301f03af29a.png)

 

 

## Texarea & Textfield

Docs to be added.

 

 

## Video

The Video input allows the user to either paste in a YouTube URL, or to search public YouTube videos for a video to include in the content. In both ways the Video ID is stored in the `[[+value]]` placeholder, allowing you to set up the embed code as desired.

 



[![](https://www.modmore.com/assets/uploads/12ec4e5848bf5df6ddd62a916b977b6c.png)](https://www.modmore.com/assets/uploads/12ec4e5848bf5df6ddd62a916b977b6c.png)