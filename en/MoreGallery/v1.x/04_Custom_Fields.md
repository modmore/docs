Custom Fields were introduced in MoreGallery 1.4 and allow you to add additional fields to the image edit modals in the back-end. These values are available in your [mgGetImages](Snippets/mgGetImages) `&imageTpl` chunks with a `custom.` prefix.

To manage the custom fields you'll need to write some JSON and store that in the `moregallery.custom_fields` system setting (or context setting). Additionally, it's also possible to set up custom fields per MoreGallery resource on the Settings tab.

[TOC]

## Example Custom Fields Configuration


```` javascript   
{
    "story":{
        "label":"Story behind this image",
        "type":"richtext"
    },
    "copyright":{
        "label":"Copyright"
    },
    "class":{
        "label":"Extra Class",
        "type":"select",
        "options":[{
            "value":"",
            "label":"None"
        },{
            "value":"boxed",
            "label":"Boxed thumbnail"
        }]
    }
}
````   

Here's what the above example would look like in the image editing modal.

[ ![](https://assets.modmore.com/uploads/2016/03/gallery_custom_fields.png)](https://assets.modmore.com/uploads/2016/03/gallery_custom_fields.png)

## JSON Structure

As you can see in the example above, the general structure is an object with keys (the field names, which is also how you can access them in your chunks via `custom.key_here`), and then an object per custom field with a bunch of options.

For each of the custom fields, you can include any of the following options:

- `type`: how the field is shown. This currently supports `text` (the default), `textarea`, `richtext`, and `select`.
- `label`: the label that is shown before the field.
- `options`: only used for the select type, this expects an array of objects, each with a value and label specified.
- `default`: you can also define a default value that is to be used.
