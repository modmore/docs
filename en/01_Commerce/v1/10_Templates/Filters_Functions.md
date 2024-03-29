---
title: Filters & Functions
---

Twig has a [number of useful filters, functions, and language constructs](https://twig.symfony.com/doc/2.x/).

Commerce ships with some more custom twig filters and functions. These can be used both in the [frontend](../Front-end_Theming) and the admin.

## Filters

Filters are applied to a value. For example: `{{ value|FILTER_NAME(filter, options) }}`

- `str_pad_left(length, paddingString)` (since 0.12.0-rc2), call on a value you want to pad with a string to be a minimum length long, where the paddingString is applied to the left.
- `str_pad_right(length, paddingString)` (since 0.12.0-rc2), call on a value you want to pad with a string to be a minimum length long, where the paddingString is applied to the right.
- `smart_date` (since 0.12.0-rc2), call on an unformatted timestamp to get a "smart" date, which shows more or less specific information depending on the difference between the provided date and the current date. It shows the full date and time for timestamps longer than 7 days ago, the localised day name plus the time for timestamps in the last week, or "today" plus the time for timestamps from today.
- `country_code_to_name`, call on a 2-character country code to get the localised (based on MODX `locale` system setting) name of the country
- `format_address` (since 0.10.0-rc2), call on an array containing an address to get it automatically formatted according to the country formatting rules.
- `format_currency(currency [optional])` (since 0.12.0-rc2), call on an integer number to format is as currency. Uses the current currency unless you specify the 3-character currency code in the optional parameter
- `strftime(format)` (since 1.1.0), provided a unix timestamp or strtotime-compatible date/time string, this will format it to a localised date/time string for you using [strftime](https://php.net/strftime). Make sure to set the `locale` system setting in MODX accordingly.
- `matrix(fld)` (since v1.4.0), used on a matrix ID can be used to access product matrix data such as the `description`, `column_name`, and `row_name`. Example: `{{ item.product.matrix|matrix('column_name') }}`
- `matrix_column(fld)` (since v1.4.0), used on a matrix column ID to access information about the column, such as the `name`, `description`. Example: `{{ item.product.column|matrix_column('name') }}`
- `matrix_row(fld)` (since v1.4.0), used on a matrix row ID to access information about the row, such as the `name`, `description`. Example: `{{ item.product.row|matrix_row('name') }}`

## Functions

Functions are called by itself, provided a value. For example: `{{ functionName(Value1, Value2) }}`

- `lex(lexiconKey)`, returns a string from the lexicon identified by the lexiconKey.
- `admin_url(actionKey, {parameter: value})`, returns a URL to the Commerce dashboard, at the action you specify, with the optional parameters.
- `country_code_to_name(countryCode)`, returns the localised name for a provided country code.
