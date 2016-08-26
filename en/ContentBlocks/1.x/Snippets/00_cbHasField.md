---
title: cbHasField Snippet
---

The cbHasField snippet, distributed with the core ContentBlocks package, is a simple utility snippet that lets you check if a specific field is in use on a resource, and if that is the case (or if it's not), return a specific value. This is useful for [loading field-specific resources](Tips_Tricks/Load_Field_Specific_Resources) or other tweaks you may want to make to a resource/template depending on the presence of a field.

By default it will check the current resource, however by passing a `&resource` property you can also run it for other resources. The cbHasField snippet should always be called cached.

**Note:** if you're using nested layouts, cbHasField does not currently check data from within nested layouts.

## Snippet Usage

The snippet is super simple to use. Pass the field ID via the `&field` property, pass something you want returned if the field was used to the `&then` property, and pass a value to the `&else` property for when the field was not used.
```` HTML
[[cbHasField?
    &field=`ID OF FIELD`
    &then=`Something if the field was used`
    &else=`Something else if the field was not used`
]]
````
The following properties are accepted:

- `&resource`: defaults to the current resource, but pass this a resource ID if you want to run the check on a different resource.
- `&field`: the ID of the field you want to make sure was used. The field ID can be found in the ContentBlocks component, it is between brackets after the field name.
- `&then`: if the field was present, return whatever was passed to this property. If not set, this will return 1.
- `&else`: if the field was not present, or the resource did not use ContentBlocks at all, return whatever was passed to this property. If not set, this will return an empty value.

## Example: returning one of two chunks

Because of MODX' recursive parsing, it's important to use "tags as the result of tags" for when you want to return a chunk. While the following example will seem to work as expected, both chunks will have been parsed before the cbHasField snippet has been parsed and the right condition is used.
```` HTML
[[cbHasField?
    &field=`5`
    &then=`[[$chunk_one]]`
    &else=`[[$chunk_two]]`
]]
````
Instead, using the following example will have the same effect, but without parsing both chunks before the conditional is determined.
```` HTML
[[$[[cbHasField?
    &field=`5`
    &then=`chunk_one`
    &else=`chunk_two`
]]]]
````
This works because MODX first runs inner-most tag, the cbHasField snippet, which will return either "chunk\_one" or "chunk\_two". That results in a new tag or which is then parsed to grab the chunk.