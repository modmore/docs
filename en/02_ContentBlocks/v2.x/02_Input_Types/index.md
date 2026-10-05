---
title: Input Types
---

Built-in input types for ContentBlocks 2. Each type is referenced by `"type"` in block JSON `inputs`, `drawer`, or `modal` configuration.

Inputs are the most basic building blocks of ContentBlocks. They define the **type of data** that can be stored in a block, and can be combined to create a wide variety of structured content.

Remember that inputs are *content*, and that you can add *behavior* via plugins on block, layout, or canvas level.

[TOC]

## Catalog

| Type | Use for |
|------|---------|
| [Text](Text) | Single-line text |
| [Textarea](Textarea) | Multi-line plain text |
| [Richtext](Richtext) | Full MODX rich text editor |
| [Number](Number) | Numeric values with min/max/step |
| [Select](Select) | Dropdown (static, chunk, or snippet options) |
| [Toggle](Toggle) | On/off checkbox |
| [Color](Color) | Color picker with palette |
| [Image](Image) | MODX media browser image |
| [Icon](Icon) | Font Awesome icon picker |
| [Link](Link) | Resource, URL, email, or tel links |
| [Video](Video) | YouTube, Vimeo, Wistia, Loom, or direct embed |
| [Chunk](Chunk) | Select and configure a MODX chunk |
| [Snippet](Snippet) | Select and configure a MODX snippet |
| [Code](Code) | Ace code editor |
| [Repeater](Repeater) | Repeatable rows of nested inputs |
| [Tabs](Tabs) | Fixed editor tabs grouping inputs |
| [List](List) | Nested ordered/unordered lists |
| [Label](Label) | Static manager label (no stored data) |
| [Spacer](Spacer) | Blank spacing in the manager (no stored data) |
| [Heading](Heading) | Visual heading with level |
| [Horizontal Rule](Horizontal_Rule) | Divider line (no stored data) |

## Rich text options

For lightweight formatting on text fields, see [Rich Text Options](../01_Configuring_Content/Rich_Text_Options). ContentBlocks 2 supports a full rich text editor (like Redactor or TinyMCE), but also ships with [MiniRTE](../03_Plugins/MiniRTE) that can add basic formatting (like bold, italic, and underline) and links to regular text or textarea inputs.

## Custom input types

To build your own input type, see [Creating Custom Inputs](../Developer/01_Custom_Inputs/Creating_Custom_Inputs). [Input Patterns](../Developer/01_Custom_Inputs/Input_Patterns) shows the approaches used by the core inputs: extra stored keys, modals, the media browser, shared libraries, and options loaded from a connector.
