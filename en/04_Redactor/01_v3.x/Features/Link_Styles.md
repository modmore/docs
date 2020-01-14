With the **Link Styles** option (located under Links in the configurator), you can easily add a selection of classes that can be added to a link.

> **Note:** in the current development version, there's a known issue where link styles are only saved when added when inserting the link the first time. To fix this, a patch in Redactor.js is needed which will hopefully be available soon.

The option requires a valid JSON structure, where an outer array contains objects with the keys `value` (containing the name of the class to add) and `label` (with a user-friendly name of the image style). 

For example, to add an "external" class to a link:

``` json
[
    {
        "value": "external",
        "label": "External Link"
    }
]
```

Or to offer Bootstrap button options:

``` json
[
    {
        "value": "btn btn-primary",
        "label": "Primary Button"
    },
    {
        "value": "btn btn-secondary",
        "label": "Secondary Button"
    }
]
```

(To make it affect the way a link is shown in the editor as well, you'll need to [register a custom CSS file](Custom_CSS)). 

When selecting a style for a link, all other styles are removed automatically. 
