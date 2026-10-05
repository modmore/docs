These are some commonly used examples. Each example is trimmed to the part worth copying. The named core input is the full version in the package.

Start with [Creating Custom Inputs](Creating_Custom_Inputs) to build your input; then reference this page for deeper examples.

[TOC]

## Single value

The majority of inputs only store a single string on `value`. Create the control once, and then listen for edits to update the store. Make sure your `render()` function also updates your control from the store's value for any external content updates to apply.

```javascript
ContentBlocks.registerInput(
    "myText",
    class extends ContentBlocks.Input {
        _input;

        render() {
            if (!this._input) {
                this._input = document.createElement("input");
                this._input.type = "text";
                this._input.id = this.inputId;
                this._input.placeholder = this.props.placeholder ?? "";
                this._input.addEventListener("input", () => {
                    this.store.value = this._input.value;
                });
                this.applyStyles(this._input, this.props.styles || {});
            }

            this._input.value = this.store.value || "";
            return this._input;
        }
    },
);
```

Things to note:

- `this.props` is the block's `properties` object. This is not filtered through a whitelist, so can contain any value the users put in their block configuration.
- `applyStyles` copies a `styles` map onto the element (`color`, `font-size`, custom properties). This gives users a very simple (and consistent!) property to affect the styling of elements in the manager. This utility supports most CSS styles.
- `text` also reads `maxlength`, `minlength`, `pattern`, and `required` the same way: optional keys on `this.props`, applied when the node is first built.


Block JSON example:

```json
{
    "headline": {
        "type": "text",
        "properties": {
            "placeholder": "Headline",
            "maxlength": 80,
            "styles": {
                "font-weight": "700"
            }
        }
    }
}
```

## Storing multiple values

If your input has content that consists of multiple distinct values, specify the additional ones in `dataKeys` to ensure they get tracked.

For examples in the core, `heading` stores the text value and the heading level; `code` stores `value` and `language`; `image` stores `value`, `source`, and `relative_url`; and `link` stores `link`, `linkType`, and `resource_id`.

> Inputs are meant to be composed with other inputs into a block. A single input should only have multiple values if the value it manages is too complex for a single value, or users may need to break it up in templating.
> To put it differently, if you are looking to put two simple text fields together for a single type of block, you do not need a custom input for that. You just need to put two text inputs in the same block.

```javascript
ContentBlocks.registerInput(
    "heading",
    class extends ContentBlocks.Input {
        static dataKeys = ["value", "level"];

        _root;
        _input;
        _level;

        render() {
            if (!this._root) {
                const allowed = this.props.allowedLevels ?? ["h2", "h3", "h4"];

                this._root = document.createElement("div");

                this._input = document.createElement("textarea");
                this._input.id = this.inputId;
                this._input.addEventListener("input", () => {
                    this.store.value = this._input.value;
                });

                this._level = document.createElement("select");
                allowed.forEach((level) => {
                    const option = document.createElement("option");
                    option.value = level;
                    option.textContent = level;
                    this._level.appendChild(option);
                });
                this._level.addEventListener("change", () => {
                    this.store.level = this._level.value;
                });

                if (!this.store.level) {
                    this.store.level = this.props.defaultLevel || allowed[0] || "h2";
                }

                this._root.appendChild(this._input);
                this._root.appendChild(this._level);
            }

            this._input.value = this.store.value || "";
            this._level.value = this.store.level || this.props.defaultLevel || "h2";
            return this._root;
        }
    },
);
```

Limit the level list from properties, the way `heading` reads `allowedLevels`.

```twig
{% set tag = heading.level|default('h2') %}
<{{ tag }}>{{ heading.value }}</{{ tag }}>
```

Keep related values on one input when they are one editorial choice. Split them into two inputs when an editor should fill them in independently.

## Modal picker

`icon` and `color` show a compact control on the canvas and do the real choosing in a [modal](../06_Utilities/Modal). The button writes the store, closes the modal, and calls `render()` so the canvas preview updates. The modal page covers the manager, footer buttons, and a confirm-on-save form.

```javascript
ContentBlocks.registerInput(
    "icon",
    class extends ContentBlocks.Input {
        static dataKeys = ["value"];

        _button;

        render() {
            if (!this._button) {
                this._button = document.createElement("button");
                this._button.type = "button";
                this._button.id = this.inputId;
                this._button.addEventListener("click", () => {
                    this.openPicker();
                });
            }

            this._button.textContent = this.store.value || "Choose icon";
            return this._button;
        }

        openPicker() {
            const list = document.createElement("div");

            ["star", "heart", "check"].forEach((name) => {
                const button = document.createElement("button");
                button.type = "button";
                button.textContent = name;
                button.addEventListener("click", () => {
                    this.store.value = name;
                    this.render();
                    ContentBlocks.ModalMgr.close();
                });
                list.appendChild(button);
            });

            ContentBlocks.ModalMgr.open(
                new ContentBlocks.Modal({
                    title: "Choose icon",
                    body: list,
                    buttons: {
                        Cancel: () => true,
                    },
                }),
            );
        }
    },
);
```

Returning `true` from a footer button closes the modal. `color` keeps a staging value inside the modal and only writes `this.store.value` when the editor confirms, so Cancel leaves the field unchanged. Copy that when the picker has more than one click.

`icon` also stores `size` next to `value` when the modal needs a second control.

## MODX media browser

`image` opens the manager file browser with `MODx.load`, then copies the selection onto the store. `source` in the block properties selects the media source. Fall back to the system default.

```javascript
ContentBlocks.registerInput(
    "image",
    class extends ContentBlocks.Input {
        static dataKeys = ["value", "source", "relative_url"];

        _root;

        render() {
            if (!this._root) {
                this._root = document.createElement("div");
                this._root.id = this.inputId;
                this._root.addEventListener("click", () => {
                    this.openImagePicker();
                });
            }

            this._root.replaceChildren();

            if (this.store.value) {
                const image = document.createElement("img");
                image.src = this.store.value;
                image.alt = "";
                this._root.appendChild(image);
            } else {
                const placeholder = document.createElement("span");
                placeholder.textContent = "Choose image";
                this._root.appendChild(placeholder);
            }

            return this._root;
        }

        openImagePicker() {
            const source = this.props.source || MODx.config.default_media_source;
            const browser = MODx.load({
                xtype: "modx-browser",
                id: Ext.id(),
                multiple: false,
                hideFiles: true,
                source: source,
                modal: true,
                listeners: {
                    select: (imageData) => {
                        this.selectImage(imageData);
                    },
                },
            });
            browser.setSource(source);
            browser.show();
        }

        selectImage(imageData) {
            let url = imageData.fullRelativeUrl;
            if (url.substr(0, 4) !== "http" && url.substr(0, 1) !== "/") {
                url = MODx.config.base_url + url;
            }

            this.store.value = url;
            this.store.relative_url = imageData.relativeUrl || url;
            this.store.source = imageData.source || 0;
            this.render();
        }
    },
);
```

Declare `static dataKeys = ["value", "source", "relative_url"]` or the extra keys will not be tracked. `render()` should show `this.store.value` as an `<img>` when it is set, and a placeholder button when it is empty. Both open the browser.

## Load a library once

`code` needs Ace. `color` needs iro, and only if custom colors are allowed. Load that file the first time an instance needs it. `ContentBlocks.Input.loadAssets` dedupes by id and returns a promise.

```javascript
ContentBlocks.registerInput(
    "code",
    class extends ContentBlocks.Input {
        static dataKeys = ["value"];

        _root;
        editor;

        static loadAce() {
            return ContentBlocks.Input.loadAssets(
                "https://cdnjs.cloudflare.com/ajax/libs/ace/1.43.1/ace.min.js",
                "js",
                "ace-editor",
            );
        }

        render() {
            if (!this._root) {
                this._root = document.createElement("div");
                this._root.id = this.inputId;

                window.setTimeout(() => {
                    this.constructor.loadAce().then(() => {
                        if (this.editor) {
                            return;
                        }

                        this.editor = ace.edit(this._root.id);
                        this.editor.setValue(this.store.value || "", -1);
                        this.editor.session.on("change", () => {
                            this.store.value = this.editor.getValue();
                        });
                    });
                }, 0);
            }

            return this._root;
        }
    },
);
```

The timeout waits until the node is in the document, which Ace requires. Guard the editor setup so a second `render()` after a drop does not call `ace.edit` again.

Point `loadAssets` at a file in your extra when you ship the library yourself:

```javascript
static loadWidget() {
    return ContentBlocks.Input.loadAssets(
        MODx.config["myextra.assets_url"] + "js/vendor/widget.js",
        "js",
        "myextra-widget",
    );
}
```

Set `myextra.assets_url` from the plugin that [registers the input](Registering_Inputs), or read it from `MODx.config` after you register the setting.

## Options from the server

`select` supports three sources:

- `properties.options`: an array of `{ label, value }` already in the block JSON
- `properties.chunk`: ask the ContentBlocks connector to run a chunk
- `properties.snippet`: ask the connector to run a snippet

Static options need no request. For anything that depends on the database, fetch when the node is first created, show a loading state, and fill the control when the response arrives.

The core select posts to `assets/components/contentblocks/connector.php` with `HTTP_MODAUTH: MODx.siteId`. Do the same against your extra's connector. Share one in-flight request per parameter set on the class, the way `SelectInput._fetchCache` does, so ten copies of the field do not fire ten identical requests.

```javascript
ContentBlocks.registerInput(
    "product",
    class extends ContentBlocks.Input {
        static dataKeys = ["value"];
        static connectorUrl = MODx.config["myextra.assets_url"] + "connector.php";
        static _fetchCache = new Map();

        _container;
        _select;

        render() {
            if (!this._container) {
                this._container = document.createElement("div");

                this._select = document.createElement("select");
                this._select.id = this.inputId;
                this._select.addEventListener("change", () => {
                    this.store.value = this._select.value;
                });

                this._container.appendChild(this._select);
                this.loadOptions();
            }

            return this._container;
        }

        loadOptions() {
            const params = {
                action: "options/getlist",
                HTTP_MODAUTH: MODx.siteId,
                resource: MODx.request.id || "",
            };
            const cacheKey = JSON.stringify(params);

            if (!this.constructor._fetchCache.has(cacheKey)) {
                const body = new URLSearchParams(params);
                const request = fetch(this.constructor.connectorUrl, {
                    method: "POST",
                    body: body,
                }).then((response) => {
                    if (!response.ok) {
                        throw new Error("Failed to load options.");
                    }
                    return response.json();
                });
                this.constructor._fetchCache.set(cacheKey, request);
            }

            this.constructor._fetchCache
                .get(cacheKey)
                .then((data) => this.fillSelect(data.results || []))
                .catch((error) => {
                    this.constructor._fetchCache.delete(cacheKey);
                    this.showError(error.message);
                });
        }

        fillSelect(options) {
            this._select.replaceChildren();
            options.forEach((option) => {
                const el = document.createElement("option");
                el.value = option.value;
                el.textContent = option.label;
                this._select.appendChild(el);
            });
            this.sync();
        }

        sync() {
            if (this.store.value) {
                this._select.value = this.store.value;
            }
        }

        showError(message) {
            this._container.replaceChildren();
            const error = document.createElement("p");
            error.textContent = message;
            this._container.appendChild(error);
        }
    },
);
```

After the options exist, set `this.store.value` from the control's `change` event, then call `sync()` so a value that was saved before the request returned still gets selected.

`chunk` and `snippet` are the larger version of this pattern: they load a list, then a second request for property definitions, and they store the generated element call (`chunk_call` / `snippet_call`) rather than preview HTML.

## Lists and rows

Store the collection on one key and replace the array when it changes.

```javascript
ContentBlocks.registerInput(
    "features",
    class extends ContentBlocks.Input {
        static dataKeys = ["items"];

        _root;
        _list;

        render() {
            if (!this._root) {
                this._root = document.createElement("div");
                this._list = document.createElement("div");

                const add = document.createElement("button");
                add.type = "button";
                add.textContent = "Add";
                add.addEventListener("click", () => {
                    this.addItem();
                });

                this._root.appendChild(this._list);
                this._root.appendChild(add);
            }

            this.renderItems();
            return this._root;
        }

        renderItems() {
            const items = Array.isArray(this.store.items) ? this.store.items : [];
            const inputs = this._list.querySelectorAll("input");

            if (inputs.length !== items.length) {
                this._list.replaceChildren();
                items.forEach((item, index) => {
                    const input = document.createElement("input");
                    input.type = "text";
                    input.value = item.value || "";
                    input.addEventListener("input", () => {
                        const next = (this.store.items || []).slice();
                        next[index] = { value: input.value };
                        this.store.items = next;
                    });
                    this._list.appendChild(input);
                });
                return;
            }

            inputs.forEach((input, index) => {
                const value = items[index].value || "";
                if (input.value !== value) {
                    input.value = value;
                }
            });
        }

        addItem() {
            const items = Array.isArray(this.store.items) ? this.store.items.slice() : [];
            items.push({ value: "" });
            this.store.items = items;
            this.renderItems();
        }
    },
);
```

`list` stores nested rows as `{ value, items }` plus `listType` and `start` as sibling keys. `repeater` stores `rows`, and each row is a nested block (`id`, `block`, `data`). Prefer a plain array of objects unless you actually need nested inputs. If you do need nested inputs, study `repeater` before rebuilding it: it creates a `BlockCollection` inside the input and listens for `add`, `remove`, `move`, and `block:change`.

```twig
<ul>
    {% for item in features.items %}
        <li>{{ item.value }}</li>
    {% endfor %}
</ul>
```

## Nothing stored

`label` and `spacer` exist to arrange the manager form. They set `static dataKeys = []` (the `label` input simply never writes a store). Do not put template output on these types.

```javascript
ContentBlocks.registerInput(
    "spacer",
    class extends ContentBlocks.Input {
        static dataKeys = [];

        _spacer;

        render() {
            if (!this._spacer) {
                this._spacer = document.createElement("div");
                this._spacer.classList.add("cb-input--spacer");
                this.applyStyles(this._spacer, this.props.styles || {});
            }
            return this._spacer;
        }
    },
);
```

A label that should focus another field can point at that field's id. Input ids look like `cb-input-{instance}-{inputKey}`. The core `label` input sets `for` by replacing its own key with `properties.for`:

```javascript
ContentBlocks.registerInput(
    "label",
    class extends ContentBlocks.Input {
        static dataKeys = [];

        _label;

        render() {
            if (!this._label) {
                this._label = document.createElement("label");
                this._label.htmlFor = this.inputId.replace(
                    this.inputKey,
                    this.props.for,
                );
                this._label.textContent = this.props.text || "";
            }

            return this._label;
        }
    },
);
```

Set `id = this.inputId` on the control you want that label to target.

## Tell plugins what happened

Store writes already emit block `change`. Fire a named event when a plugin needs the reason, not only the new value. Prefix block-level events with `this.inputKey`.

```javascript
ContentBlocks.registerInput(
    "icon",
    class extends ContentBlocks.Input {
        static dataKeys = ["value"];

        _button;

        render() {
            if (!this._button) {
                this._button = document.createElement("button");
                this._button.type = "button";
                this._button.id = this.inputId;
                this._button.addEventListener("click", () => {
                    const name = "star";
                    this.store.value = name;
                    this.trigger("picker:select", { value: name });
                    this.Block.trigger(this.inputKey + ":picker:select", {
                        value: name,
                    });
                    this.render();
                });
            }

            this._button.textContent = this.store.value || "Choose";
            return this._button;
        }
    },
);
```

A plugin on the block can listen with `Block.on("score:picker:select", ...)`. See [Dispatcher](../04_Client_Events/Dispatcher).
