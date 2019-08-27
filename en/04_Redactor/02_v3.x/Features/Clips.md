Clips are pre-set elements or special characters available from a simple interface. They are configured in **Text Utilities > Clips** as a JSON array of arrays. 

For example:

``` JSON
[
    ["Lorem ipsum...", "Lorem..."],
    ["Red label", "<b class=\"label-red\">Label</b>"]
]
```

Be sure to use **"double quotes"** or it will not be considered valid JSON.

## Clips from 2.x

Redactor 2.x also had Clips, but with a different structure. That structure is also recognised in 3.x and will be automatically converted on save. 

[You can find a whole bunch of example configurations in the 2.x Clips documentation](../../v2.x/Clips), including currency selectors and other special characters.
