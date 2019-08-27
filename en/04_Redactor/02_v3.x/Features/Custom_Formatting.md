Custom formatting options are used to add custom styles to the content. They can be provided classes, styles, and attributes. 

Custom formatting options are added into the regular formatting dropdown, and configured as JSON in your configuration set under Formatting.

[TOC]

## Structure

Custom formatting is defined as a nested JSON object. Make sure to use **double quotes** for values and keys. 

The top-level keys are the names, which correspond to a class that will be added to the toolbar dropdown in the editor in the format `.redactor-dropdown-format .redactor-dropdown-item-{KEY}`. You can use that to style the display of the item in the dropdown.

Each item can contain the following keys:

- `title`: the name of the custom format as shown in the dropdown
- `api`: the internal API method to call when the item is clicked, usually: `module.block.format`, `module.inline.format`, or `module.inline.clearformat`
- `args`: an object defining the custom format, containing the following:
    - `tag`: the name of the tag to use for this custom format
    - `class`: a class to apply to the tag (optional)
    - `type`: either `set` (default, removes all existing classes, styles or attributes before applying your defined options), `add` (adds the new values leaving existing ones in place), `toggle` (either adds or removes the values depending on whether they are already set or not), or `remove` (removes the provided values). 
    - `attr`: an object defining attributes to set on a tag, for example: `{ "data-toggle": "modal" }`
    - `style`: an object defining inline styles to add to the tag, for example: `{"background-color": "#ff9900"}`


## Examples

Toggles a `h3.blue-styled` and `h3[style=color:red]`:

```` json
{
    "blue-heading": {
        "title": "Blue Heading",
        "api": "module.block.format",
        "args": {
            "tag": "h3",
            "class": "blue-styled",
            "type": "toggle"
        }
    },
    "red-heading": {
        "title": "Red Heading",
        "api": "module.block.format",
        "args": {
            "tag": "h3",
            "style": {
                "color": "red"
            },
            "type": "toggle"
        }
    }
}
````

Sets `div.callout.callout__info` and toggles inline `code`:

```` json
{
    "info-callout": {
        "title": "Info callout",
        "api": "module.block.format",
        "args": {
            "tag": "div",
            "class": "callout callout__info"
        }
    },
    "inline-code": {
        "title": "Inline Code",
        "api": "module.inline.format",
        "args": {
            "tag": "code",
            "type": "toggle"
        }
    }
}
````

Clear inline formatting/styles:

```` json
{
    "clear-format": {
        "title": "Clear inline formatting",
        "api": "module.inline.clearformat"
    }
}
````

