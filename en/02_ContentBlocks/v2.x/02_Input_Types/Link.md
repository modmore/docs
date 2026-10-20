The `link` input type lets editors create links to MODX resources, external URLs, email addresses, and phone numbers. The input normalizes values client-side so templates can use `link` directly in `href` attributes.

[TOC]

## Supported properties

- `allowed_types`: array of allowed link types. Defaults to all: `resource`, `url`, `email`, `tel`.
- `limit_to_current_context`: when `true` (default), resource autocomplete is limited to the working context.
- `contexts`: optional array of context keys to restrict resource results (overrides single-context limiting when set).
- `templates`: optional array of template IDs to restrict resource results.
- `parents`: optional array of parent resource IDs; results are limited to those parents and their descendants.
- `link_detection_pattern`: optional regex override for detecting absolute URLs. Falls back to the `contentblocks.link_detection_pattern` system setting.
- `placeholder`: placeholder text for the input field.
- `styles`: object of CSS styles applied to the input wrapper.

## Returned values

- `link`: output-ready href value:
  - Resources: `[[~123]]`
  - Email: `mailto:user@example.com`
  - Phone: `tel:+15551234567`
  - URLs: absolute (`https://example.com`) or relative (`/about?ref=home`)
- `linkType`: one of `resource`, `url`, `email`, or `tel`.
- `resource_id`: the MODX resource ID when `linkType` is `resource`; empty string otherwise.

## Link detection

Detection runs as the editor types. Order of checks:

1. Resource — numeric-only value, or explicit selection from autocomplete
2. Email — valid email address pattern
3. Tel — `tel:` prefix or phone-like value
4. Relative URL — value starting with `/` (supports query strings and anchors)
5. Absolute URL — matches the link detection regex
6. Fallback URL — prepends `https://` when no other type matches

## Example block

```json
{
    "title": "Call to action",
    "description": "A button with text and link.",
    "icon": "link",
    "inputs": {
        "textLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "text",
                "text": "Button text"
            }
        },
        "text": {
            "type": "text",
            "width": 70,
            "properties": {
                "placeholder": "Read more"
            }
        },
        "linkLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "link",
                "text": "Link"
            }
        },
        "link": {
            "type": "link",
            "width": 70,
            "properties": {
                "allowed_types": ["resource", "url", "email", "tel"],
                "limit_to_current_context": true
            }
        }
    }
}
```

## Example with resource filters

```json
{
    "link": {
        "type": "link",
        "properties": {
            "allowed_types": ["resource", "url"],
            "contexts": ["web"],
            "templates": [1, 5],
            "parents": [12]
        }
    }
}
```

## Example template (Twig)

```twig
{% if link.link %}
    <a href="{{ link.link }}" class="btn" data-link-type="{{ link.linkType }}">
        {{ text.value }}
    </a>
{% endif %}
```
