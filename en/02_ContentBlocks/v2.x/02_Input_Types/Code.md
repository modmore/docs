The `code` input type provides a syntax-highlighted code editor powered by [Ace](https://ace.c9.io/). When multiple languages are available, a language selector is shown in the bottom-right corner of the editor.

[TOC]

## Accepted properties

- `languages`: controls which Ace language modes are available.
  - **Array** — shows a language selector with the listed modes. Example: `["javascript", "php", "html"]`.
  - **String** — locks the editor to that language and hides the selector. Example: `"php"`.
  - **Single-item array** — same as a string; locks the editor and hides the selector. Example: `["javascript"]`.
  - **Omitted** — defaults to `javascript`, `php`, `html`, `css`, `json`, `xml`, `markdown`, and `sql`, with a selector.

## Returned values

- `value`: the code entered in the editor.
- `language`: the selected or locked Ace language mode (e.g. `javascript`, `php`).

## Example block

```json
{
    "title": "Code",
    "description": "Syntax-highlighted code snippet",
    "icon": "code",
    "inputs": {
        "code": {
            "type": "code",
            "properties": {
                "languages": [
                    "javascript",
                    "php",
                    "html",
                    "css"
                ]
            }
        }
    }
}
```

### Code sample in multiple languages

Use a [`tabs`](Tabs) input to group one locked `code` input per language. Each tab gets its own editor in the canvas; saved values are stored flat on the tabs input key (e.g. `languages.javascript.value`). On the frontend, render the snippets in tabs (or similar).

Block definition:

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
                "placeholder": "Sample title (e.g. Fetch user data)"
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
                    },
                    "html": {
                        "label": "HTML",
                        "inputs": {
                            "html": {
                                "type": "code",
                                "width": 100,
                                "properties": {
                                    "languages": "html"
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

Twig template with tabbed output with some inline javascript:

```twig
{% if languages.javascript.value or languages.php.value or languages.html.value %}
    {% set samples = [
        { key: 'javascript', label: 'JavaScript', input: languages.javascript },
        { key: 'php', label: 'PHP', input: languages.php },
        { key: 'html', label: 'HTML', input: languages.html }
    ] %}
    {% set defaultKey = languages.javascript.value ? 'javascript' : (languages.php.value ? 'php' : 'html') %}
    {% set showTabs = (languages.javascript.value ? 1 : 0) + (languages.php.value ? 1 : 0) + (languages.html.value ? 1 : 0) > 1 %}
    <section class="cb-code-sample">
        {% if title.value %}
            <h3 class="cb-code-sample__title">{{ title.value }}</h3>
        {% endif %}
        {% if showTabs %}
            <div class="cb-code-sample__tabs" role="tablist">
                {% for sample in samples %}
                    {% if sample.input.value %}
                        {% set isActive = sample.key == defaultKey %}
                        <button type="button" class="cb-code-sample__tab" role="tab" data-language="{{ sample.key }}" aria-selected="{{ isActive ? 'true' : 'false' }}">
                            {{ sample.label }}
                        </button>
                    {% endif %}
                {% endfor %}
            </div>
        {% endif %}
        {% for sample in samples %}
            {% if sample.input.value %}
                {% set isActive = not showTabs or sample.key == defaultKey %}
                <div class="cb-code-sample__panel cb-code-sample__panel--{{ sample.key }}" role="tabpanel" {% if showTabs and not isActive %}hidden{% endif %}>
                    <pre class="cb-code"><code class="language-{{ sample.input.language|default(sample.key) }}">{{ sample.input.value|escape_modx }}</code></pre>
                </div>
            {% endif %}
        {% endfor %}
    </section>
    {% if showTabs %}
        <script>
            (function () {
                const section = document.currentScript.previousElementSibling;
                const tabs = section.querySelectorAll('.cb-code-sample__tab');
                const panels = section.querySelectorAll('.cb-code-sample__panel');
                tabs.forEach((tab) => {
                    tab.addEventListener('click', () => {
                        const language = tab.getAttribute('data-language');
                        tabs.forEach((item) => {
                            const isActive = item === tab;
                            item.setAttribute('aria-selected', isActive ? 'true' : 'false');
                        });
                        panels.forEach((panel) => {
                            panel.hidden = !panel.classList.contains('cb-code-sample__panel--' + language);
                        });
                    });
                });
            })();
        </script>
    {% endif %}
{% endif %}
```

Each locked input stores its own `value` and `language` on the tabs input (e.g. `languages.javascript.value`, `languages.php.language`). A single-item array (`["php"]`) works the same as a string for locking the language.

The sample template uses the `escape_modx` filter so MODX tags in the content are shown as text. The approaches below explain when to use that filter, Twig's default HTML escaping, or raw output.

## Example template structures

Output the stored code inside a `<pre><code>` element. Use the `language` value as a CSS class for syntax highlighting on the frontend (Prism, highlight.js, and similar tools).

Which escaping you use depends on whether the page should **show** the code or **run** it.

### Show the code, including MODX tags

Twig escapes HTML by default, so a `<div>` or scripts in the field are shown as text automatically. That does not stop MODX. When the resource is rendered, MODX still parses tags such as `[[*pagetitle]]`, `[[$chunk]]`, and `[[!snippet]]`. A template sample would run instead of being displayed.

`escape_modx` is the v2 equivalent of the v1 Code input **Encode Entities** option. It escapes HTML, then turns `[` and `]` into `&#91;` and `&#93;` so MODX ignores it.

```twig
{% if code.value %}
    <pre><code class="language-{{ code.language|default('plaintext') }}">
        {{ code.value|escape_modx }}
    </code></pre>
{% endif %}
```

In a `.tpl` template, `:htmlent` only escapes HTML. Replace the brackets after that to prevent MODX tags from being processed:

```tpl
<pre><code class="language-[[+code.language:default=`plaintext`]]">
    [[+code.value:htmlent:replace=`[==&#91;`:replace=`]==&#93;`]]
</code></pre>
```

### Show the code, and let MODX tags run

Leave the value to Twig's HTML auto-escape when the sample should show HTML as text, but MODX tags inside it should still be parsed on the page:

```twig
<pre><code class="language-{{ code.language|default('plaintext') }}">{{ code.value }}</code></pre>
```

```tpl
<pre><code class="language-[[+code.language:default=`plaintext`]]">[[+code.value:htmlent]]</code></pre>
```

### Insert the code as HTML

To output the entered code as markup, for example a raw HTML widget, mark it as safe in Twig by adding the `|raw` filter or skip `:htmlent` in a `.tpl` template. MODX tags in that markup are parsed when the page is rendered.

> You need to **trust your manager users** when allowing this. They can insert scripts and other nefarious code.

```twig
{{ code.value|raw }}
```

```tpl
[[+code.value]]
```
