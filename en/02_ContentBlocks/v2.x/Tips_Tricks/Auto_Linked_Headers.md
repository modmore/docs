---
title: Auto-linked Headers
description: Give heading blocks an id and an in-page link from the heading template.
---

A heading block stores the text and the level (`h1` through `h6`). The template can turn that into a heading with an id and a link, so editors get clickable, bookmarkable headings without extra fields.

[TOC]

## Block

Add `blocks/heading.json` in your [config directory](../01_Configuring_Content/Config_Directories):

```json
{
    "title": "Heading",
    "icon": "heading",
    "inputs": {
        "heading": {
            "type": "heading"
        }
    }
}
```

The input key `heading` is what the template uses. `heading.value` is the text and `heading.level` is the chosen tag. See [Heading](../02_Input_Types/Heading).

## Template

Put `blocks/heading.twig` next to the JSON file. `_meta.uniqueIdx` is a canvas-wide counter, so two headings with the same text do not share an id.

`[[*uri]]` is left in the output for MODX to parse when the page is requested. That keeps the link working on sites that use a `<base href>` tag.

```twig
{% if heading.value %}
    {% set tag = heading.level|default('h2') %}
    {% set anchor = 'jump_' ~ (heading.value|lower|replace({' ': '_'})) ~ '_' ~ _meta.uniqueIdx %}
    <{{ tag }} id="{{ anchor }}">
        <a href="[[*uri]]#{{ anchor }}">{{ heading.value }}</a>
    </{{ tag }}>
{% endif %}
```

If you prefer `.tpl` files, it looks like this.

```tpl
<[[+heading.level:default=`h2`]] id="jump_[[+heading.value:strtolower:replace=` ==_`]]_[[+_meta.uniqueIdx]]">
    <a href="[[*uri]]#jump_[[+heading.value:strtolower:replace=` ==_`]]_[[+_meta.uniqueIdx]]">[[+heading.value]]</a>
</[[+heading.level:default=`h2`]]>
```

Template placeholders follow the input key. If you name the input something different like `title`, use `title.value` and `title.level` instead. See [Templating](../04_Templating/index).
