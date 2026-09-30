The `ConditionalInputs` plugin shows or hides block inputs based on the value of another input. Use it to keep the manager UI focused by only showing fields that are relevant to the current configuration.

This plugin applies to a specific block by adding it to its configuration. It works with main, drawer, and modal inputs. Hidden inputs keep their stored values; only the manager UI is affected.

When multiple trigger inputs are configured, rules from hidden trigger inputs are skipped on a second evaluation pass. That lets you nest toggles—for example, a “use contact form” toggle that hides a secondary “phone or email” toggle.

## Accepted options

- `rules`: an object keyed by trigger input. Each trigger maps stored values to `show` and `hide` arrays of input keys.

Each value rule supports:

- `show`: input keys to make visible
- `hide`: input keys to hide

Use a `default` key on a trigger when no value-specific rule matches:

```json
{
  // ...
  "plugins": {
    "ConditionalInputs": {
      "layout": {
        "default": {
          "show": [
            "title",
            "content"
          ],
          "hide": [
            "sidebar"
          ]
        },
        "two-column": {
          "show": [
            "title",
            "content",
            "sidebar"
          ],
          "hide": []
        }
      }
    }
  }
}
```

Rules are re-evaluated whenever a configured trigger input changes.

## Example block

Here's an example Contact block. It uses two `toggle` inputs as triggers:

- `contactVia`: switch between direct contact details and a contact form
- `detailsType`: when using direct contact, switch between phone and email fields

```json
{
    "title": "Contact",
    "description": "Contact details with fields that show or hide based on toggle inputs.",
    "icon": "envelope",
    "inputs": {
        "contactVia": {
            "type": "toggle",
            "width": 100,
            "properties": {
                "label": "Use contact form",
                "checkedValue": "form",
                "uncheckedValue": "details",
                "default": "details"
            }
        },
        "detailsType": {
            "type": "toggle",
            "width": 100,
            "properties": {
                "label": "Show phone number (off = email)",
                "checkedValue": "phone",
                "uncheckedValue": "email",
                "default": "phone"
            }
        },
        "phoneLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "phone",
                "text": "Phone number"
            }
        },
        "phone": {
            "type": "text",
            "width": 70,
            "properties": {
                "placeholder": "+1 555 0100"
            }
        },
        "emailLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "email",
                "text": "Email address"
            }
        },
        "email": {
            "type": "text",
            "width": 70,
            "properties": {
                "placeholder": "hello@example.com"
            }
        },
        "formActionLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "formAction",
                "text": "Form action URL"
            }
        },
        "formAction": {
            "type": "text",
            "width": 70,
            "properties": {
                "placeholder": "/contact/submit"
            }
        },
        "formSuccessLabel": {
            "type": "label",
            "width": 30,
            "properties": {
                "for": "formSuccess",
                "text": "Success message"
            }
        },
        "formSuccess": {
            "type": "text",
            "width": 70,
            "properties": {
                "placeholder": "Thanks, we will be in touch soon."
            }
        }
    },
    "plugins": {
        "ConditionalInputs": {
            "rules": {
                "contactVia": {
                    "form": {
                        "show": [
                            "formActionLabel",
                            "formAction",
                            "formSuccessLabel",
                            "formSuccess"
                        ],
                        "hide": [
                            "detailsType",
                            "phoneLabel",
                            "phone",
                            "emailLabel",
                            "email"
                        ]
                    },
                    "details": {
                        "show": [
                            "detailsType",
                            "phoneLabel",
                            "phone",
                            "emailLabel",
                            "email"
                        ],
                        "hide": [
                            "formActionLabel",
                            "formAction",
                            "formSuccessLabel",
                            "formSuccess"
                        ]
                    }
                },
                "detailsType": {
                    "phone": {
                        "show": ["phoneLabel", "phone"],
                        "hide": ["emailLabel", "email"]
                    },
                    "email": {
                        "show": ["emailLabel", "email"],
                        "hide": ["phoneLabel", "phone"]
                    }
                }
            }
        }
    }
}
```

`select` and other input types work the same way as triggers. For example, an alert box block can use a `select` input in the block modal to show or hide other fields based on the selected style.
