The dropdown input allows the user to select an option in, well, the dropdown.   

Aside from being useful as a more restrictive alternative for the Chunk or Snippet input type (i.e. no properties), it is also perfect for in a [Repeater group](Repeater).

The dropdown input was added in ContentBlocks 1.5. Ben's [cb.classSelectInput](https://github.com/bennyb/cb.classSelectInput) is a good third party alternative for use in older releases.

- **Key**: dropdown 
- **Template Placeholders**: `[[+value]]` and `[[+display]]`
- **Requirements**: ContentBlocks 1.5 

## On this page

[TOC]

## Example

[ ![Dropdown](https://assets.modmore.com/assets/uploads/images/dropdown.png)](https://assets.modmore.com/assets/uploads/images/dropdown.png)  

## Available Properties

### Drop-down Options

Specify the options for the dropdown here. See the section _Defining the Options_ below for the format and possibilities.

### Default Value

A value, which exists in the Drop-down Options, that should be preselected when the field is added to a page. 

**Important:** If your default value is **empty**, the dropdown input will use the **first option**. 

### Search Enabled

Available in ContentBlocks 1.12 and above, there is a new `Search Enabled` property. If enabled, it will include a typeahead/search
field on the dropdown that allows filtering the available options displayed. Disabled it any time to revert to a regular dropdown field.

## Defining the Options

The Dropdown input type needs to have a set of options configured via the field properties. The way these are defined is very flexible.

Here are the different formats which are supported. The _value_ is the actual value for a selection, and the _Displayed Value_ is what the editor sees in the dropdown. Both are also available in the field template. 

Each format is specified on a single line, separated by a line break (\\n).

- `value==Displayed Value`  
Simple static value definition. Note the use of the double equal signs, this is similar to how you would define template variables.
- `Displayed Value=value` - _Deprecated_  
The single equal sign indicates this uses the reversed order. Prior to ContentBlocks 1.5 this was the recommended format for select field settings as well, however we decided to deprecate this behaviour in favour of `value==Displayed Value`. You can use either of those until ContentBlocks 2.0, at which point the `Displayed Value=value` format will be removed.
- `value`  
By only adding the value (no equal signs), the value will be used also for the displayed value.
- `#Displayed Value`  
Prefix a single value with a hashtag/pound sign and it will be added as a disabled option without a value. This is useful for segmenting or adding something like comments to the dropdown.
- `-`  
A single hyphen is used to show a separator, consisting of a disabled option "-----". This is identical to setting `#-----` as an option.
- `@SNIPPET NameOfSnippet`  
Use the `@SNIPPET` binding to dynamically fill the dropdown with the output from a snippet. The snippet can either return the options as a JSON encoded array, or as a line break (`\n`) separated plain text list with any of the above formats. See the section below for more information.

These formats can be mixed and matched as needed. The official recommendation is to use the `value==Displayed Value` format predominantly.

**Important:** Do not use empty values, except for a first option if you must. ContentBlocks **does not differentiate** between when an empty value was selected, and when no value is set yet, which means that empty values cause ContentBlocks to always fall back to the default value. If you have an empty value that is not the first value, that means it will never be pre-selected. (This may change in 2.0.) 

### Dynamic options with @SNIPPET

With the @SNIPPET binding you can execute a snippet to fill the dropdown. The snippet needs to return either a JSON encoded array, or a list of options following the above format, separated by a line break (\\n).

The snippet will receive two variables: `$field`, containing the current `cbField` object, and `$input`, containing an instance of the `DropdownInput` class.

#### Returning JSON

When opting for the JSON approach in your snippet, you are expected to provide the options in a slightly different format than what we mentioned above. Every option is an array, which contains the following keys:

- value
- display
- disabled

The value and display options are required, only provide the disabled key with a value of true if you wish for the option to be disabled in the dropdown.

To give an example, here's how you might define your options from a snippet that returns the data as JSON:
```` PHP
<?php
$options = array(
  array(
    'value' => 'value1',
    'display' => 'My Displayed Value',
  ),
  array(
    'value' => 'value2',
    'display' => 'This one is much better',
  ),
  array(
    'value' => '',
    'display' => '--- this is a separator ---',
    'disabled' => true,
  ),
  array(
    'value' => 'value3',
    'display' => 'Option for Professonals',
  ),
);
return json_encode($options);
````

#### Returning as list

When the result of the snippet is not valid JSON, it will be considered a simple list. The return value here can be of any format as mentioned before (except @SNIPPET bindings). Here's an example that will result in the same dropdown values as the JSON sample above.

```` PHP
<?php
$options = array(
  'value1==My Displayed Value',
  'value2==This one is much better',
  '#--- this is a separator ---',
  'value3==Option for Professionals',
);

return implode("\n", $options);
````

