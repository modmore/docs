---
title: Displaying MODX Code
description: Show code samples, including MODX tags, with the code input.
---

Use a [code input](../02_Input_Types/Code) to show code samples on the page.

By default, using a Twig template will apply HTML encoding. But, that does not automatically encoding to MODX tags, which means those will still be parsed and executed by the parser when a page is requested.

To fix that, use the `escape_modx` filter available in Twig templates, or manually escape `[` and `]` characters.

Assuming a block like this:

```json
{
    "title": "Code",
    "icon": "code",
    "inputs": {
        "sample": {
            "type": "code",
            "properties": {
                "languages": ["html", "javascript", "css", "php"]
            }
        }
    }
}
```

## Escaping MODX in Twig

```twig
{% if sample.value %}
    <pre><code class="language-{{ sample.language|default('plaintext') }}">{{ sample.value|escape_modx }}</code></pre>
{% endif %}
```

To insert the value as live HTML instead, use `|raw`. That also lets MODX tags inside it run. See the [code input](../02_Input_Types/Code) page, and only do this for manager users you trust.

## Escaping MODX in .tpl

In a `.tpl` template, `:htmlent` only escapes HTML, so we need to chain a `replace` filter with that:

```tpl
<pre><code class="language-[[+sample.language:default=`plaintext`]]">[[+sample.value:htmlent:replace=`[==&#91;`:replace=`]==&#93;`]]</code></pre>
```
