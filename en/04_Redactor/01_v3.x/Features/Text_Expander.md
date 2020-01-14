The text expander lets you define shortcuts that insert a longer content. 

Once defined, you type the shortcut, follow it with a space, and the expanded text will be inserted. 

Text expanders are configured in your configuration set under Text Utilities. 

Text expanders use a JSON format with arrays nested in an array. The first element in the nested array is the shortcut, and the second element is the text to insert.

For example:

```` json
[
    [
        "lorem",
        "Lorem ipsum dolor sit amet..."
    ],
    [
        "modmore",
        "modmore - More for MODX!"
    ]
]
````
