The `Styler` plugin lets you add conditional inline styles to a block based on input values. This lets you preview how a class selector or style variant changes the content _in the manager_.

This plugin applies to a specific block by adding it to its configuration.

## Accepted options

- **`triggers`**: an object keyed by input name. Each input key maps option values to CSS property objects applied when that value is selected.

```json
{
  "plugins": {
    "Styler": {
      "triggers": {
        "style": {
          "alert": {
            "--cb-text-color": "#ff0000",
            "background-color": "#ff9999"
          },
          "info": {
            "--cb-text-color": "darkblue",
            "background-color": "cyan"
          }
        }
      }
    }
  }
}
```

When the `style` input has value `alert`, the listed CSS properties are applied inline to the block preview.

## Example block

```json
{
    "title": "Alert box",
    "description": "Information or error box.",
    "icon": "exclamation-triangle",
    "inputs": {
        "icon": {
            "type": "icon",
            "width": "auto",
            "properties": {
                "iconStyles": {
                    "--icon-font-size": "50px"
                }
            }
        },
        "text": {
            "type": "textarea",
            "width": "fill",
            "properties": {}
        }
    },
    "drawer": {
        "styleLabel": {
            "type": "label",
            "width": 20,
            "properties": {
                "label": "Alert box style",
                "for": "style"
            }
        },
        "style": {
            "type": "select",
            "width": 30,
            "properties": {
                "options": [
                    {
                        "label": "Error alert",
                        "value": "alert"
                    },
                    {
                        "label": "Warning",
                        "value": "warning"
                    },
                    {
                        "label": "Info",
                        "value": "info"
                    }
                ]
            }
        },
        "styleSpacer": {
            "type": "spacer",
            "width": 50,
            "properties": {}
        }
    },
    "plugins": {
        "Styler": {
            "triggers": {
                "style": {
                    "alert": {
                        "--cb-text-color": "#ff0000",
                        "background-color": "#ff9999",
                        "border-radius": "5px"
                    },
                    "warning": {
                        "--cb-text-color": "darkorange",
                        "background-color": "#ffcc44",
                        "border-radius": "15px"
                    },
                    "info": {
                        "--cb-text-color": "darkblue",
                        "background-color": "cyan",
                        "border-radius": "30px"
                    }
                }
            }
        }
    }
}

```
