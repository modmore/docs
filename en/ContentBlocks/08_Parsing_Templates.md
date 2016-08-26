---
title: Parsing & Templates
---

ContentBlocks provides a revolutionary way of managing content. With this new way of doing things, there are also a few things to keep in mind when developing websites - in particular related to the way your page will be parsed and what is and what isn't possible. This document will walk you through a few of these limitations and best practices.

## When & Where

When you're using ContentBlocks, the layouts and fields you used are parsed **when the resource is saved**. This was done to make integration into your templates as easy as possible (by simply using `[[*content]]` in your template), as well as to prevent parsing the resource from slowing down the front-end of the website. As many [input types](Input_Types) offer very granular templateing, it is not uncommon for large or complex resources to take 0,5-2 seconds to fully parse, and you don't want that delay in front of your users.

If you're changing field or layout templates, you will notice that this doesn't automatically update the resources using this content before the change. To parse every resource again, simply hit the "Rebuild Content" button in the component. This will kick off a process that loops over all of your resources and re-generates the content with the latest templates.

## Resource Fields

Up to ContentBlocks 1.2, Resource Fields (such as `Parsing & Templates`) would **not** get parsed when saving or rebuilding the content. This means that if you're aggregating content from different resources onto a different page the resource fields would get replaced with values from the calling resource, not the one that held the content. For example when you're showing a couple of tabs on a page, of which the content is loaded from subresources that use ContentBlocks with a snippet like getResources, any occurences of `Parsing & Templates` in the subresources would get replaced with the pagetitle from the parent resource. The workaround in 1.2 or before is to use the renderResources snippet rather than getResources; that way you're sure the content shows up as it should be.

As of ContentBlocks 1.3 (released January 2016), resource fields are also parsed when saving a resource or rebuilding all content. This means the workaround with renderResources is no longer necessary.

## Output Modifiers & Snippets

Because the ContentBlocks parsing happening during the resource save process, you will need to be extra careful about using snippets and output modifiers (or output filters) in the templates. While you can definitely use them, some need to be handled slightly differently.

Generally speaking, Snippets, as well as Chunks and all other tags except the  tags **will not be parsed** by ContentBlocks while saving or rebuilding the content. These will be skipped, and parsed when the resource is requested in the front-end, like MODX would do normally.

On the other hand, **output modifiers** placed on on placeholder tags will be parsed.

For example, **resizing images** is typically done with an output filter on the placeholder, like this:
```` HTML   
  <img src="[[+url:pthumb=`w=500&h=300`]]">
````

However, if you use this as a template for an Image field, this can cause an endless save loop if the extra expects certain prerequisites that aren't met in ContentBlocks, or the save can take a long time because of the image parsing.

This is because placeholder tags are parsed during save, as well as their output modifiers (`:pthumb=`) . To make sure output filters like these are only parsed when the resource is requested, you need to change the output modifier to a snippet call. This can be done with any third party output modifiers, but not with the core ones.

You can call an output modifier as a snippet by passing an `&input` property with the url (or other value you want it to work with), and your options in an `&options` property, like so:
```` HTML
<img src="[[pthumb? &input=`[[+url]]` &options=`w=500&h=300`]]">
````

## Chunks

If you'd like to reuse templates between different fields or layouts, you can add tags to your template. It is important to note that these chunks will not be executed by the ContentBlocks parser, and they will only be parsed when the resource is requested in the frontend.

Because of the delayed parsing of the chunk, if you want to use any of the field/layout placeholders from the template inside your chunk, you will need to pass those as a property to the chunk. For example if inside your chunk called content\_header you want to access the value of a text input type, you'll need to do this:
```` HTML
[[$content_header? &value=`[[+value]]`]]
`````

In your chunk the value placeholder will then be available.

It's worth noting that this is not necessary to do when you use the Chunk or Chunk Selector input type, those input types automatically construct the full chunk tag for you, and will include all provided values to it.
