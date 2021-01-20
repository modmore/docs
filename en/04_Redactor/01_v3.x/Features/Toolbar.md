---
title: Toolbar Buttons
---

The toolbar is the most important aspect of Redactor, providing you with the buttons to add markup and media. 

It is primarily configured by the list of buttons, in the Toolbar section of the configurator. The available list of buttons is shown below that field.

[TOC]

## Buttons

- Formatting and text: format (includes [custom formatting](Custom_Formatting)), bold, italic, deleted, underline, sup, sub, fontcolor, fontfamily, fontsize, [inlinestyle](Inline_Styles), textdirection, alignment 
- Lists: lists, ol, ul, indent, outdent 
- Media: link, image, file, video, widget 
- Editor: redo, undo, fullscreen, [divider](Dividers)
- Others: [html](Source), line, [properties](Properties), specialchars, table, download

## Redactor Plugins

Whenever a toolbar button requires a Redactor plugin, it is automatically initialised. 

In some cases, the positioning of buttons initialised by a plugin cannot be changed. This has to do with how plugins are initialised one at a time, and that buttons added to the toolbar are added either at the end or relative to specific buttons.

The following plugins have hardcoded positions in the toolbar which cannot be changed:

- inlinestyle, always added after the format button
- table, always added before the link button
- video, always added after the image button

As of Redactor v3.1, plugins that previously had no defined position that would always get added at the end of the toolbar, will now position themselves properly, based on their location in the buttons configuration. This affected the following plugins before v3.1: `alignment, clips, fontcolor, fontfamily, fontsize, fullscreen, properties, specialchars, textdirection, variable, widget`.

If you still seeing odd positioning of toolbar buttons in v3.1+ that's different from your configuration, make sure the buttons with a fixed position (inlinestyle, table, video) are configured in their hardcoded position (e.g. make sure `table` is before `link` in your toolbar buttons configuration). 

## Examples

Redactor ships with a Minimal and Standard configuration out of the box. These use the following button configuration.

Minimal: 

> format, divider, bold, italic, underline, deleted, divider, link, image

Standard: 

> format, bold, italic, underline, divider, table, link, image, file, divider, ol, ul, indent, outdent, divider, redo, undo, divider, html

![Minimal vs Standard configuration example](../images/min-vs-standard.png)