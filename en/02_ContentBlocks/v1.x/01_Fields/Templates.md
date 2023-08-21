Field templates can be found by editing a [field in the ContentBlocks component](../Fields) and opening the Properties tab.

[TOC]

## Placeholders

Templates use the standard MODX parser, and have access to a number of placeholders in the form of `[[+KEY]]`.

Which placeholders exactly depend on the [input type](../Input_Types). In the ContentBlocks component you can hover over the "Template" label to see available placeholders for the selected input type in the tooltip.

In most cases, you'll have at least a `[[+value]]` placeholder. Any field settings you add are also available as `[[+name_of_setting]]`.

All field templates have access to a set of shared placeholders:

- `[[+idx]]`, an incrementing index for the fields inside the current layout column.
- `[[+unique_idx]]`, a guaranteed to be unique incrementing index. This index number is incremented for each field or layout that is processed, nested layouts included, meaning the order is dependant on the exact page structure. You can **not** rely on two fields side-by-side being one index apart.
- `[[+layout_id]]`, the ID of the parent layout the field is inserted in.
- `[[+layout_column]]`, the string name of the column the field is inserted in.
- `[[+layout_idx]]`, an incrementing index for the position of the layout on the page.
- `[[+layout_title]]`, the title of the layout (user-editable by clicking on it in the interface); may be empty.

It's also possible to access layout settings in field templates (as of v1.8.3). Those are available with the `layout_settings` prefix, for example:

```
[[+layout_settings.my_setting_key]
```

## Using @CHUNK templates

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

(_This works exactly the same in layout templates._)

## Using @FILE templates

As of v1.11 `@FILE` templates are also supported.

Unlike `@CHUNK` templates which don't get parsed until the front-end renders a resource, `@FILE` templates are parsed during the resource save so are more performant. You do however need to save the resource or rebuild all pages after making a change to a template file, similar to regular inline templates.

The syntax is simply `@FILE path/to/file.ext`. There is no required extension, but `.tpl` or `.html` is suggested.

**In order to use `@FILE`, you need to configure a media source and path first.**

1. Create, if you don't already have one, a media source to hold the templates. We strongly recommend using one that has its base path set to a non-web-accessible location, such as `core/elements/`.
2. Set the `contentblocks.file_template_source` system setting to your media source.
3. Set the `contentblocks.file_template_path` system setting to a path inside that media source where ContentBlocks templates are located. To use the root of the media source, use `/`. By setting this to a value like `contentblocks` or `cb`, you can use it alongside other elements.

After these steps, you can go to Extras > ContentBlocks to add the `@FILE` template to your fields or layouts.

If the media source and/or path is not correct, your front-end will render the following:

```html
<p class="error">Failed processing template, please refer to the error log.</p>
```

The MODX error log will have a more detailed message telling you if the problem was loading the media source or the template file. If it can't find the file, it will log the full path to make debugging easier.

(_This works exactly the same in layout templates._)

## Using pdoTools' @FILE templates (@PDO_FILE)

If you'd like to use Fenom templates, you can use @PDO_FILE in field and layout templates. This works exactly like a @FILE template like you're used to with pdoTools/Fenom, it just has a different prefix to differentiate between the built-in @FILE support.

This was added in ContentBlocks 1.13, with special thanks to Joeke Kloosterman


