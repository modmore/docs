The `MiniRTE` plugin adds lightweight rich text editing to `text` and `textarea` inputs on a block. There is no toolbar — formatting is applied with keyboard shortcuts.

This plugin is the v2 replacement for v1's per-field `use_tinyrte` option. Configure it on the **block** instead of on individual inputs.

[TOC]

## Accepted options

- `inputKeys` (required): array of input keys to enhance, e.g. `["text", "title"]`
- `formats`: inline formats to allow. Defaults to `["bold", "italic", "underline"]`
- `links`: enable link support. Defaults to `true`
- `lazyInit`: only create the editor when the field is first focused. Defaults to `false`
- `pastePlainText`: paste as plain text instead of rich clipboard HTML. Defaults to `true`

## Keyboard shortcuts

| Shortcut | Action |
|----------|--------|
| Cmd/Ctrl+B | Bold |
| Cmd/Ctrl+I | Italic |
| Cmd/Ctrl+U | Underline |
| Cmd/Ctrl+K | Add or edit link (opens link dialog) |
| Cmd/Ctrl+S | Save resource (MODX save button) |

Additional link behavior:

- Click a link or place the cursor inside one to show a small toolbar with **Visit** (open in new tab), **Edit**, and **Remove Link** actions
- Select text and paste a URL (or `mailto:` address) to turn the selection into a link
- Use **Remove Link** in the link dialog to unlink the current selection

## Stored value and templates

The enhanced field still stores its content in the `value` data key, but the value becomes **limited HTML** (`<strong>`, `<em>`, `<u>`, `<a href="...">`, and `<br>` for textareas).

### Twig

When rendering values that contain HTML, you must add the `|raw` filter as Twig will otherwise htmlencode the value as a safety precaution.

```twig
{% if text.value %}
    <div class="cb-copy">
        {{ text.value|raw }}
    </div>
{% endif %}
```

### tpl

MODX templates don't automatically encode, so the following will render HTML:

```tpl
[[+text.value:notempty=`<div class="cb-copy">[[+text.value]]</div>`]]
```

For existing plain-text textarea content, line breaks are preserved when the plugin is first enabled.

## v1 migration

Replace per-input `use_tinyrte` with a block plugin:

```json
{
  "plugins": {
    "MiniRTE": {
      "inputKeys": [
        "text"
      ]
    }
  }
}
```

The separate `richtext` input type (full MODX editor) is unchanged, and we recommend that for full formatting options when you need them. Use `richtext` when you need the site-wide editor; use `MiniRTE` for minimal inline formatting on `text` or `textarea` fields.

## Example block

```json
{
    "title": "Mini RTE text",
    "description": "Textarea with lightweight rich text via the MiniRTE plugin.",
    "icon": "bold",
    "inputs": {
        "text": {
            "type": "textarea",
            "properties": {
                "placeholder": "Start typing..."
            }
        }
    },
    "plugins": {
        "MiniRTE": {
            "inputKeys": ["text"],
            "formats": ["bold", "italic", "underline"],
            "links": true
        }
    }
}
```
