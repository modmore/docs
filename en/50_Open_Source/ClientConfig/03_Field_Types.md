You can choose a number of field types for your configurations. The xtype in brackets is for hardcore ExtJS ninjas that want to know what is used behind the scenes to craft the form.

- Text (xtype: textfield)
- Textarea (xtype: textarea)
- Rich Text
- Image (xtype: modx-panel-tv-image)
- Number (xtype: numberfield)
- Color picker (xtype: colorpickerfield)
- Checkbox (xtype: xcheckbox)
- Date (xtype: datefield)
- Time (xtype: timefield)
- Selectbox (xtype: modx-combo); properties: Text==value||Text2==value
- Google Font List (xtype: googlefontlist)

 You can use the Selectbox field type to mimick the boolean yes||no behaviour of certain System Settings by setting the field options like the screenshot example:

## Text

The textfield is a simple single-line textfield.

![](https://www.modmore.com/assets/uploads/2014/02/6.png)

## Textarea

the textarea is a simple multi-line textfield.

![](https://www.modmore.com/assets/uploads/2014/02/5.png)

## Rich Text

The Rich Text field is a simple multi-line textfield that will get enhanced to a rich text editor based on what is installed in your MODX site. Both [Redactor](https://www.modmore.com/extras/redactor/) and TinyMCE are supported, others have not been tested.

## Image

Provides an input that opens the MODX Browser to select an image.

![](https://www.modmore.com/assets/uploads/2014/02/4.png)

## Number

A simple field that only accepts numbers.

![](https://www.modmore.com/assets/uploads/2014/02/7.png)

## Colorpicker

Allows the user to pick a color.

## 

![](https://www.modmore.com/assets/uploads/2014/02/1.png)

## Checkbox

Allows a user to toggle something on or off.

![](https://www.modmore.com/assets/uploads/2014/02/2.png)

## Datefield

Pick a date.

![](https://www.modmore.com/assets/uploads/2014/02/9.png)

## Timefield

Pick a time.

![](https://www.modmore.com/assets/uploads/2014/02/8.png)

## Selectbox

Combined with the Field Options setting, you can create a dropdown for your users to choose between any of a number of options. Specify the options like you would set input options for template variables:  
Display==Value,Other Display==OtherValue

![](https://www.modmore.com/assets/uploads/2014/02/10.png)

## Google Font List

To use the Google Font List input type, you need to set the _clientconfig.google\_fonts\_api\_key_ setting with your API Key from Google.