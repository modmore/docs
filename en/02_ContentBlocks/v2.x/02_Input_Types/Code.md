The `code` input type provides a syntax-highlighted code editor powered by [Ace](https://ace.c9.io/). When multiple languages are available, a language selector is shown in the bottom-right corner of the editor.

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
                    <pre class="cb-code"><code class="language-{{ sample.input.language|default(sample.key) }}">{{ sample.input.value }}</code></pre>
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

## Example template structures

Output the stored code inside a `<pre><code>` element. Use the `language` value as a CSS class for syntax highlighting on the frontend if desired.

> If you want to insert the entered code as-is, for example as a way to insert raw HTML widgets into a page, make sure to add the `|raw` filter in Twig templates or remove `:htmlent` from a MODX template.
> Keep in mind **you need to trust your manager users** when allowing this, as they can easily insert scripts through this.

### Twig

```twig
{% if code.value %}
    <pre><code class="language-{{ code.language|default('plaintext') }}">{{ code.value }}</code></pre>
{% endif %}
```

### tpl

```tpl
<pre><code class="language-[[+code.language:default=`plaintext`]]">[[+code.value:htmlent]]</code></pre>
```
