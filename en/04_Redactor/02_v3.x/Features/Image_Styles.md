With the **Image Styles** option (located under Media in the configurator), you can easily add a selection of classes that can be added to an image.

The option requires a valid JSON structure, where an outer array contains objects with the keys `value` (containing the name of the class to add) and `label` (with a user-friendly name of the image style). 

For example, to add a "polaroid" class to an image:

``` json
[
    {
        "value": "polaroid",
        "label": "Polaroid Photo"
    }
]
```

(To make it affect the way an image is shown in the editor as well, you'll need to [register a custom CSS file](Custom_CSS)). 

When the use of `figure` tags is enabled (also on the Media tab in the configurator), the class will be added to the wrapping `<figure>` tag for an image. When `figure` is disabled, or the figure tag could not be found, it will be added to the `<img>` tag instead.

When selecting a style for an image, all other styles are removed automatically. 

