
The page you're currently looking at contains information related to Redactor 1.x. Please visit [Custom Formatting](https://www.modmore.com/redactor/documentation/custom-formats/) for the relevant information for Redactor 2.x.


For Redactor 1.2.0, we added something special to do exactly what many of you requested, custom formatting. By making use of the [Redactor Styles Plugin](https://github.com/jpdevries/styles) by JP DeVries, you can create custom formats to more easily format your text. [Redactor TVs](Custom_Template_Variable) can even have their own custom formats that overrides the System Defaults.

![Using className to style individiual format options in the toolbar](https://www.modmore.com/assets/uploads/redactor_custom_styles.png "Styling individual Format Options")

To add custom styles to Redactor you will need to set the [redactor.stylesJson](Configuration) System Setting to properly formatted JSON that defines each of your styles. 

To make sure your formats are valid JSON you can use the [JSONLint Validator](http://jsonlint.com/). For using with [Custom Redactor TVs](Custom_Template_Variable) set the Custom Formatting field under Template Variable Input Options.

To style the options in the dropdown, you will need to create a CSS file and reference it with the Stylesheet option (called Iframe CSS prior to 1.2.3). E.g.: `.redactor_toolbar .your_className_value { your: styling; }`

[TOC]

## Format Options


#### btnName



The unique name of the custom format. (Required)


#### className 


A CSS classname to assign to the associated option in the toolbar. Use to style how the option appears. 


#### spanClass

A class to be applied to the selection. Will be wrapped in a span tag. Must be set if neither wrap or style is set.

#### style

Inline CSS to be applied to the selection. Must be set if neither spanClass or wrap is set.

#### wrap

HTML tag to wrap the selection in. Must be set if neither spanClass or style is set.


#### forceBlock

Set to 1,0, or -1 to control whether block or inline wrapping is applied. Defaults to 0.

- 0 auto determines based on wrap tag
- 1 forces block level wrapping
- -1 prevents block level wrapping


## Creating Custom Formats

Similar to the [Clips Plugin](Using_Clips_Plugin), options for custom styles are set using JSON. Make sure that each format is a valid JSON Object, meaning it needs to be wrapped in curly braces. The properties and property values need to be wrapped in double quotes. Each format should be separated by a comma and everything should be wrapped in square brackets.

## Examples

See some examples below for more information on how you can create custom formats and utilize the available propertie.

### Styling Toolbar Options

Adding custom formats and styling their toolbar option using CSS.

````
[{"btnName":"Note",
"className":"redactor_format_note",
"wrap":"div",
"spanClass":"note"},

{"btnName":"Warning",
"className":"redactor_format_warning",
"wrap":"div",
"spanClass":"warning"},

{"btnName":"Info",
"className":"redactor_format_info",
"wrap":"div","spanClass":"info"},

{"btnName":"Danger",
"className":"redactor_format_danger",
"wrap":"div",
"spanClass":"danger"},

{"btnName":"PHP Code",
"className":"redactor_format_pre redactor_dropdown_pre",
"wrap":"pre",
"spanClass":"brush: php"}]
````


Add this CSS to style the toolbar options.

````
.redactor_dropdown .redactor_format_note {
  color: #468847;
}
.redactor_dropdown .redactor_format_warning {
  color: #806637;
}
.redactor_dropdown .redactor_format_info {
  color: #3a87ad;
}
.redactor_dropdown .redactor_format_danger {
  color: #b94a48;
}
````


### Superscript & Subscript

Create formats for formatting text using superscript and subscript tags.

````
[{"btnName":"superscript",
"className":"redactor_format_superscript",
"wrap":"sup"},
{"btnName":"subscript",
"className":"redactor_format_subscript",
"wrap":"sub"}]
````

### Inline Formatting

Adds an option to the custom formats toolbar that wraps the selected text in a code tag.

````
[{"btnName":"Inline Code",
"className":"redactor_format_pre",
"wrap":"code"}]
````


### Block Formatting

Adds an option to the custom formats toolbar that wraps the entire block of selected text in a code tag.

````
[{"btnName":"Inline Code",
"className":"redactor_format_pre",
"wrap":"code",
"forceBlock":"1"}]
````


### Block Level By Tag

This will add one option to the custom formats toolbar that wraps the selected text in a code tag and apply an 'inline-code' class. Since forceBlock is 0, whether or not to use block level wrapping is auto determined based on the wrapping tag.

````
[{"btnName":"Block Code",
"className":"redactor_format_pre",
"spanClass":"block-code",
"wrap:"code",
"forceBlock":"0"}]
````


### Inline Style

Set inline CSS on selected text.

````
[{"btnName":"Transparent",
 "style":"opacity:0.5",
 "forceBlock":"-1"}]
````


### Multiple Options

Adds multiple options to the dropdown.

````
[{"btnName":"Warning",
 "className":"redactor_format_warning",
 "spanClass":"warning",
 "wrap":"div"},
 {"btnName":"Note",
 "className":"redactor_format_note",
 "spanClass":"note",
 "wrap":"div"},
 {"btnName":"Success",
 "className":"redactor_format_success",
 "spanClass":"success",
 "wrap":"div"}]
````


### Bootstrap Examples

Some examples creating custom formats for the [Bootstrap CSS Framework](http://getbootstrap.com/css/).

````
[{
 "btnName":"Lead Text",
 "className":"redactor_format_lead",
 "wrap":"p class='lead'"
},{
 "btnName":"Small Text",
 "className":"redactor_format_small",
 "wrap":"small"
},{
 "btnName":"Default Button",
 "className":"redactor_format_default_button",
 "wrap":"a class='btn btn-default'",
 "forceBlock":"-1"
},{
 "btnName":"Primary Button",
 "className":"redactor_format_primary_button",
 "wrap":"a class='btn btn-primary'",
 "forceBlock":"-1"
},{
 "btnName":"Read More",
 "className":"redactor_format_read_more",
 "wrap":"a class='read-more'",
 "forceBlock":"-1"
},{
 "btnName":"Responsive Table",
 "className":"redactor_format_table_responsive",
 "wrap":"div class='table-responsive'",
 "forceBlock":"1"
},{
 "btnName":"Label Default",
 "className":"redactor_format_label_default",
 "spanClass":"label label-default",
 "forceBlock":"-1"
},{
 "btnName":"Label Primary",
 "className":"redactor_format_label_primary",
 "spanClass":"label label-primary",
 "forceBlock":"-1"
},{
 "btnName":"Alert Success",
 "className":"redactor_format_alert_success",
 "wrap":"div class='alert alert-success'",
 "forceBlock":"1"
},{
 "btnName":"Alert Info",
 "className":"redactor_format_alert_info",
 "wrap":"div class='alert alert-info'",
 "forceBlock":"1"
},{
 "btnName":"Well",
 "className":"redactor_format_well",
 "wrap":"div class='well'",
 "forceBlock":"1"
}]
````