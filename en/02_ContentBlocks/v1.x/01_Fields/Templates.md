Field templates can be found by editing a [field in the ContentBlocks component](../Fields) and opening the Properties tab.

## Placeholders

Templates use the standard MODX parser, and have access to a number of placeholders in the form of `[[+KEY]]`. Which placeholders exactly depend on the [input type](../Input_Types).

All field templates have access to a set of shared placeholders:

- `[[+layout_id]]`, the ID of the parent layout the field is inserted in.
- `[[+layout_column]]`, the string name of the column the field is inserted in.
- `[[+idx]]`, an incrementing index for the fields inside the current column.
- `[[+unique_idx]]`, a guaranteed to be unique incrementing index. This index number is incremented for each field or layout that is processed, nested layouts included, meaning the order is dependant on the exact page structure. You can **not** rely on two fields side-by-side being one index apart.
- `[[+layout_idx]]`, an incrementing index for the position of the layout on the page.

## Using @CHUNK

If you'd like to use static elements, you can use chunks. The best way to do so is by using the `@CHUNK` syntax, which will pass all available placeholders into your chunk automatically.

**Important to note: chunks are processed when rendering the page, rather than when saving it.** This means that using chunks in ContentBlocks comes at an extra performance penalty for the first (uncached) front-end request for a page.

For example, define your template like this:

```html
@CHUNK NameOfYourChunk
```

That will be parsed by ContentBlocks into a full chunk tag, like this:

```
[[$NameOfYourChunk?
    &value=`Some Value`
    &layout_id=`5`
    &layout_column=`main`
    ...
]]
```