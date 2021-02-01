Looking to use a rich text editor in your MIGX TV? Look no further than Redactor 3.

## Standard configuration set

[By following the MIGX Backend-Usage tutorial](https://docs.modx.com/current/en/extras/migx/migx.backend-usage), you'll get the default Redactor configuration set inside your form. This is because in the Form Tabs, you've defined `"inputTVtype": "richtext"` - which grabs the default editor in the default configuration.

The inputTVtype `migxredactor` (from v2, shipped with MIGX) also works.

## MIGX-specific configuration set

To use a configuration set specific to the MIGX instance, you can use the provided `migxredactor3` (note: the one with the 3 suffix!) input TV type. That accepts a `configs` option to provide the ID of the configuration set to use.

In your form tabs, add two things:

- `"inputTVtype": "migxredactor3"`
- `"configs": id-of-configuration-set`

For example, to use configuration set #12 on a description field, your MIGX form tabs configuration would look something like this:

``` js
[{
    "caption": "Info",
    "fields": [{
        "field": "title",
        "caption": "Title"
    },{
        "field": "description",
        "caption": "Description",
        "inputTVtype": "migxredactor3",
        "configs": 12
    }]
}]
```
