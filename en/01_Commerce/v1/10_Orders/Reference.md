---
title: Order Reference
---

The order reference was introduced in 0.12 and offers an incremental and templated number to refer to orders. The order reference is set when an order is marked as ready for processing. 

[TOC]

## Usage

The order reference is primarily meant to be the customer-facing reference for an order. 

Incrementing the order reference happens when an order is marked as ready for processing. This means that (compared to the order ID which is determined when a customer clicks the Checkout button in the cart) there are no gaps in the numbering and that the number is in order of when an order was received.

## Templating the order reference

The order reference is generated not only from an incrementing number, but also from a twig template. This template is stored as a string in the `commerce.order_reference_template` system setting. 

By default, the order reference uses the following twig template string:

````html
{{- increment|str_pad_left(5, '0') -}}
````

In this template, `increment` is an integer number greater than 0. By applying the `str_pad_left` filter, we pad the number with `0`s on the left side so that the value is at least `5` characters long. 

This way, an increment of 123 is formatted as 00123 instead. 

By using `{{-` and `-}}` instead of `{{` and `}}`, any spaces to the left and right of the twig tag are ignored.

If there are syntax errors in your template, that will be logged into the MODX error log when Commerce tries to generate a reference.

### Available values

You can use any order fields in the template string. Most useful are the following:

- `increment`: contains the integer increment. It's not required to use this, but you probably _should_ to ensure the reference is unique and useful.
- `id`: contains the actual order id. This is likely a much larger number than the increment.
- `context`: contains the key of the context the order originated from (only for orders created since 0.12, "web" for older orders)
- `received_on`: contains the date the order was received (or if it's a concept order, when it was persisted to the database). Use the `date` filter to format this. See examples below.
- `test`: boolean indicating if the order was in test mode or not
- `user`: the ID of the logged in user, or 0 if anonymous

### Examples

Default: `00123`

````html
{{- increment|str_pad_left(5, '0') -}}
````

Prefixed with a hash: `#00123`

````html
#{{- increment|str_pad_left(5, '0') -}}-{{- id -}}
````

Suffixed with the order ID: `00123-3182`

````html
{{- increment|str_pad_left(5, '0') -}}-{{- id -}}
````

Suffixed with a padded order ID: `00123-0003182`

````html
{{- increment|str_pad_left(5, '0') -}}-{{- id|str_pad_left(7, '0') -}}
````

Prefixed with the year: `2019-00123` (Also see section on resetting increments yearly, below.)

````html
{{- received_on|date('Y') -}}-{{- increment|str_pad_left(5, '0') -}}
````

Prefixed with the year and date: `2019-01-00123` (Also see section on resetting increments yearly, below.)

````html
{{- received_on|date('Y-m') -}}-{{- increment|str_pad_left(5, '0') -}}
````

Prefix with the originating context: `NL-00123`

````html
{{- context|upper -}}-{{- increment|str_pad_left(5, '0') -}}
````

Suffix of "-TEST" if the order was made in test mode: `00123-TEST`

````html
{{- increment|str_pad_left(5, '0') -}}{% if test %}-TEST{% endif %}
````

## Start increments at a certain number

By default, increments start at 1. To change that, set the `commerce.order_increment_start` system setting to the lowest value you want increments to start at. (Added in v1.0.1)

## Reset increments yearly

If you include the year in the reference, you'll likely want to reset the increment every year as well. To do that, enable the `commerce.order_increment_reset_yearly` system setting. New orders will automatically start from 1 (or the value of the `commerce.order_increment_start` setting) again at January 1st midnight server time.

## Regenerating order references

If you want to change the reference template and update all the order references, there is a utility for that included with Commerce. This utility has to be run from the command line and will overwrite existing references, with no way to restore (unless you restore a backup you made before running the utility).

The utility is mode aware, so you can run it on an environment where the commerce mode is set to test before running it on live orders.

First configure your template and the `commerce.order_increment_reset_yearly` setting the way you like it. Then SSH into your server, `cd` into the root of your site, and execute the following command (make sure to change the path if needed):

````bash
php core/components/commerce/utilities/generate_order_references.php
````

You'll see output similar to the following:

````html
Your order reference template is set to:
        {{- increment|str_pad_left(5, '0') -}}
Resetting the order increment yearly is:
        disabled
This utility will look at all received orders in the current mode (test), and (re-)generate the order reference. This resets the increment, so your order numbering may change.

Are you sure you want to regenerate your order references? This cannot be undone. Type yes to confirm: 
````

Check if your template and yearly increment are set correctly, and type yes (followed by enter).

Next, it asks you if you also want to reset the increments:

````html
Would you like to reset the increments? This will cause order numbers to be counted again. To reset increments, type yes: 
````

If you type yes, the increment value on all orders will be set to 0. Commerce will then also set the increment values again. This is useful if you changed the yearly order increment setting, as the newly calculated increment values will be per-year as well.

To not reset the increments, type no or just hit enter without entering a value.

Now the system will loop over all received orders (= orders where the received_on date is set) in order from oldest to newest. The script will output, for each order, what the old and new increment and generated reference are. 

````html
Starting generation...
Order 1 from 2017-03-31 21:21:
        Old: increment 1 and reference "00001"
        New: increment 1 and reference "00001"
Order 2 from 2017-03-31 22:27:
        Old: increment 2 and reference "00002"
        New: increment 2 and reference "00002"

...

Order 4708 from 2018-12-24 20:32:
        Old: increment 89 and reference "00089"
        New: increment 89 and reference "00089"
Order 4709 from 2018-12-24 20:50:
        Old: increment 90 and reference "00090"
        New: increment 90 and reference "00090"
Completed in 1.09s
````

It may be useful to save this output and check if all references were set correctly. 