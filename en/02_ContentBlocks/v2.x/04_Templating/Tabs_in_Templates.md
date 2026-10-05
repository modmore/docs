Tabs inputs group nested fields into fixed editor tabs. Saved values are stored **flat by nested input name**, not by tab ID.

[TOC]

## Block configuration

This block stores a `title` text input and a `languages` tabs input. Each tab holds a locked `code` input, `javascript` or `php`, which is the shape used in the examples below.

```json
{
    "title": "Code Sample",
    "description": "The same code snippet in multiple programming languages.",
    "icon": "code",
    "inputs": {
        "title": {
            "type": "text",
            "width": 100,
            "properties": {
                "placeholder": "Sample title"
            }
        },
        "languages": {
            "type": "tabs",
            "width": 100,
            "properties": {
                "defaultTab": "javascript",
                "tabs": {
                    "javascript": {
                        "label": "JavaScript",
                        "inputs": {
                            "javascript": {
                                "type": "code",
                                "width": 100,
                                "properties": {
                                    "languages": "javascript"
                                }
                            }
                        }
                    },
                    "php": {
                        "label": "PHP",
                        "inputs": {
                            "php": {
                                "type": "code",
                                "width": 100,
                                "properties": {
                                    "languages": "php"
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
```

See [Tabs input](../02_Input_Types/Tabs) and [Code input — multiple languages](../02_Input_Types/Code#code-sample-in-multiple-languages) for the full property list and a three-language example.

## Data access

For a tabs input named `languages` with nested inputs `javascript` and `php`:

```twig
{{ languages.javascript.value }}
{{ languages.php.value }}
```

Moving an input between tabs in the configuration does not change stored data or template access paths.

## Twig example

```twig
<div class="code-sample">
    <h3>{{ title.value }}</h3>
    {% if languages.javascript.value %}
        <pre class="lang-js">{{ languages.javascript.value }}</pre>
    {% endif %}
    {% if languages.php.value %}
        <pre class="lang-php">{{ languages.php.value }}</pre>
    {% endif %}
</div>
```
