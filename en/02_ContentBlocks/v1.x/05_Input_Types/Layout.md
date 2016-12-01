---
title: Layout
---

The Nested Layout input type provides you with the opportunity to add layouts from within a field. This enables you to further split up the page into multiple columns or to provide different wrappers.   

Input types like the [Repeater](Repeater) also support embedding Layout fields, allowing you to add layouts where normally you would only be able of adding fields.  

While editing a layout through the ContentBlocks component, you can tick a checkbox on the Availability tab to make the layout only available through a Layout field. This way you can set up layouts that only appear when in a layout field. Through the layout field properties itself, you can also choose which layouts and templates should be available.

- **Key**: layout 
- **Template Placeholders**: `[[+value]]`, containing the fully parsed HTML output from the children layouts 
- **Requirements**: ContentBlocks 1.1 


## On this page

[TOC]

## Example

[ ![Layout](https://assets.modmore.com/assets/uploads/images/nested_layout.png)](https://assets.modmore.com/assets/uploads/images/nested_layout.png)

## Example Use Cases

- Complex designs where, instead of simply having multiple columns, you require multiple columns within certain columns.
- Creating complex components such as Tabs or Accordions. [See Chris, our front-end developer, talk about how to create Tabs with ContentBlocks in his talk at the MODX Weekend 2014.](http://video.modmore.com.local/modx-weekend-2014/sunday-frontend/building-sites-with-contentblocks/)
- Hand-crafting beautiful grids of images
- Recursion, because recursion.

## Setting up a Nested Layout

Despite the enormous flexibility and additional functionality the Nested Layout brings, it is surprisingly simple to set up.

Go to Extras in the top navigation and open the ContentBlocks component. On the Fields tab, hit the button to create a new field. Choose **Layout** as the input type, give it a name and choose an icon.

On the Properties tab, you can customise the template (just make sure it contains ) and choose to limit the available layouts or templates to the one you want to use, however this is not required. Save the field.

When editing a resource, choose Add Content and insert the Layout field you just created. You will immediately see the Add Layout modal pop up asking you to choose a layout to insert, and you're done. :)
