The `commerce.formatter` snippet makes a collection of useful formatters available as an output modifier. Added in v0.12.

[TOC]

## Usage

Call as an output filter on a placeholder, providing the type of formatter you'd like to use as the options string.

```` html
[[*price_tv:commerce.formatter=`financial`]] => €12.34 
[[*retail_dicount:commerce.formatter=`percentage`]] => 1.34%
[[*enabled_or_not:commerce.formatter=`boolean`]] => Yes
[[+file_size_in_bytes:commerce.formatter=`filesize`]] => 1.2MB
````

The following formatters are available:

- financial, formats an integer number according to the current currency
- percentage, formats a decimal number with a percentage sign and optional decimals
- boolean, returns a translated "yes" or "no" for a boolean (1/0) value.
- filesize, returns a human readable representation of a filesize provided as an integer number of bytes
- datetime, shows a formatted date and timestamp from a unix timestamp
- date, shows a formatted date from a unix timestamp
- time, shows a formatted time from a unix timestamp

When calling with an unsupported formatter, the original value will be returned. 

**Heads up: it's rarely needed to use this in Commerce templates/twig, as you can already access `FIELDNAME_formatted` for any of the core fields that contain a value that should be formatted.** So if you have a `[[+price]]` placeholder, for example from [a get_products snippet call](get_products), you can already use `[[+price_formatted]]` to get the same value, formatted with the "financial" formatter. The formatter snippet is mostly available to use for values that are stored outside Commerce.

**From PHP code**, you can use the `Commerce->formatValue` method directly. For custom tables that extend `comSimpleObject`, define the formatter on your fields in the schema to automatically make `_formatted` values available to your users. 


## Properties

When used as an output modifier, the options contains one of the formatters listed above.

When called as a snippet, provide `&input` with the value you want to format and `&options` with one of the formatter listed above.
