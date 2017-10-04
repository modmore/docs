You can choose a number of field types for your configurations. It's not currently possible to extend this list, so please request new field types on [Github](https://github.com/modmore/ClientConfig/issues).

[TOC]


## Text

The textfield is a simple single-line textfield.

![](https://www.modmore.com/assets/uploads/2014/02/6.png)

ExtJS Type: `textfield`

## Textarea

The textarea is a simple multi-line textfield.

![](https://www.modmore.com/assets/uploads/2014/02/5.png)

ExtJS Type: `textarea`

## Rich Text

The Rich Text field is a simple multi-line textfield that will get enhanced to a rich text editor based on what is installed in your MODX site. 

The following MODX RTE extras are supported:

- [Redactor from modmore](https://www.modmore.com/redactor/) 
- TinyMCE
- TinyMCE RTE
- CKEditor is partially supported with known issues.

ExtJS Type: `textarea`, enhanced with `MODx.loadRTE`

## Image

Provides an input that opens the MODX Browser to select an image. Can be configured to a specific media source through the _Source_ option on the field.

![](https://www.modmore.com/assets/uploads/2014/02/4.png)

ExtJS Type: `modx-panel-tv-image`

## File

Provides an input that opens the MODX Browser to select any file. Can be configured to a specific media source through the _Source_ option on the field.

ExtJS Type: `modx-panel-tv-file`

## Number

A simple field that only accepts numbers.

![](https://www.modmore.com/assets/uploads/2014/02/7.png)

ExtJS Type: `numberfield`

## Colorpicker

Allows the user to pick a color with a visual color picker.

![](https://www.modmore.com/assets/uploads/2014/02/1.png)

ExtJS Type: `colorpickerfield`

## Checkbox

Allows a user to toggle something on or off.

![](https://www.modmore.com/assets/uploads/2014/02/2.png)

ExtJS Type: `xcheckbox`

## Password

Allows a user to enter a secret value that is masked, for API Keys and the likes. 

Note that the value should not be considered securely stored. 

ExtJS Type: `textfield` with `inputType` set to `password`

## Datefield

Pick a date.

![](https://www.modmore.com/assets/uploads/2014/02/9.png)

ExtJS Type: `datefield`

## Timefield

Pick a time.

![](https://www.modmore.com/assets/uploads/2014/02/8.png)

ExtJS Type: `timefield`

## Selectbox

Uses the Field Options option on a field to create a dropdown.

This follows the syntax of listbox template variables where options are separated by two pipes (`||`) and display and stored values with two equal signs (`==`), so an example configuration would be:

`Display==Value||Other Display==OtherValue`

![](https://www.modmore.com/assets/uploads/2014/02/10.png)

If you enable _Process tags in options_ on the field, you can also use chunk or snippet tags to dynamically populate the dropdown. 

For example, you can use getResources to create a simple resource list field. This example lists all resources at the top level of the resource tree.

````html
[[getResources?
    &parents=`0`
    &tpl=`@INLINE [[+pagetitle]]==[[+id]]`
    &outputSeparator=`||`
    &limit=`0`
]]
````

ExtJS Type: `modx-combo` with a local store created from the fields' Input Options. 

## Google Font List

Provides a dropdown with all the available google fonts. You need to set the `clientconfig.google_fonts_api_key` setting with your Google API Key.

ExtJS Type: `googlefontlist`
