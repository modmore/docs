---
title: Link
---

Easily create a link to a resource, `mailto:` link or simply an external link with the Link input type. The Link input type automatically detects the type of link as you type in the field, providing auto complete suggestions for resources within MODX.  

External links automatically get `http://` prefixed if it wasn't there yet to prevent broken URLs due to the missing protocol as much as possible. Email links automatically prefix `mailto:` and resource links are wrapped in `[[~5]]` tags to properly resolve to the full URI.

- **Key**: link 
- **Template Placeholders**: `[[+link]]`: the parsed link; `[[+link_raw]]`: the link without protocols or link tag; `[[+linkType]]`: the type of link, one of the following: `email`, `resource` or `link` 
- **Requirements**: ContentBlocks v1.2 

## On this page

[TOC]

## Example

[ ![Link](https://assets.modmore.com/assets/uploads/images/Editing_All_Inputs_MODX_Revolution_1.png)](https://assets.modmore.com/assets/uploads/images/Editing_All_Inputs_MODX_Revolution_1.png) 

## Example Use Cases

The link input type is great for any type of content that references another page, such as call-to-action buttons or "more information" links. It provides a one-stop solution for the most common types of links so you don't have to train your client to use different input types for different kinds of links, or create your own parser to figure out what type of link it is.

The Link input is also great to use with a [Repeater](Repeater) or Field Settings. 

## Related System Settings

The regular expression used to identify a link type of "link" is configurable through the `contentblocks.link.link_detection_pattern` system setting, and there is also an override available on the field level for when you need to tweak it more granularly. This allows you to add for example support of `ftp://` protocols, while in the standard situation it forces a protocol of `http://`. Changing the setting (either at the field level or at the system setting) to `^(?:f|ht)tps?:\/\/` will enable absolute URLs as well (for example, to include files on the local server as valid links without `http://`).