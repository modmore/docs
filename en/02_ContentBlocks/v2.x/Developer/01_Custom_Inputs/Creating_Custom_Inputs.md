Create a custom input when editors need a new type of value in the manager. The input draws that field, writes the value into its [store](Input_Stores), and the block template turns the stored value into front-end HTML.

ContentBlocks 2 does not render custom inputs with a PHP `process()` method. The block template reads the same keys the input writes to its store.

[TOC]

## A complete input

This rating input stores a single `value`. It is the same shape as the core `text`, `number`, and `toggle` inputs: one tracked key, one DOM node created once, and the node updated whenever `render()` runs again.

```javascript
ContentBlocks.registerInput(
    "rating",
    class extends ContentBlocks.Input {
        static dataKeys = ["value"];

        _root;

        getMax() {
            const max = parseInt(this.props.max, 10);
            return max > 0 ? max : 5;
        }

        render() {
            if (!this._root) {
                this._root = document.createElement("div");
                this._root.classList.add("cb-input--rating");
                this._root.id = this.inputId;

                for (let score = 1; score <= this.getMax(); score++) {
                    const button = document.createElement("button");
                    button.type = "button";
                    button.dataset.value = String(score);
                    button.textContent = String(score);
                    button.addEventListener("click", () => {
                        this.store.value = String(score);
                        this.sync();
                    });
                    this._root.appendChild(button);
                }
            }

            this.sync();
            return this._root;
        }

        sync() {
            const current = String(this.store.value || "");
            this._root.querySelectorAll("button").forEach((button) => {
                button.classList.toggle(
                    "is-active",
                    button.dataset.value === current,
                );
            });
        }
    },
);
```

Return that file from `ContentBlocks_RegisterInputs` so it loads after `contentblocks.js`. See [Registering Inputs](Registering_Inputs).

## Use it in a block

The `type` string must match the name passed to `registerInput`.

```json
{
    "title": "Review",
    "inputs": {
        "score": {
            "type": "rating",
            "width": 30,
            "properties": {
                "max": 5
            }
        },
        "quote": {
            "type": "textarea",
            "width": 70
        }
    }
}
```

`properties` is passed to the input as `this.props`. `width` is applied by the block wrapper (`30` means 30%). Use `"auto"` or `"fill"` when the field should size with its content or take the remaining row. The same input definition works in `inputs`, `drawer`, and `modal`.

## Render it

Block templates receive one object per input key. With `static dataKeys = ["value"]`, the rating is `score.value`.

```twig
{% if score.value %}
    <p class="review-score">{{ score.value }} / 5</p>
{% endif %}
{{ quote.value }}
```

```tpl
[[+score.value:notempty=`<p class="review-score">[[+score.value]] / 5</p>`]]
[[+quote.value]]
```

See [Templating](../../04_Templating/index) for the full placeholder rules.

## What the input receives

The canvas constructs each input as `new YourInput(block, store, inputDef, inputId)`.

| Property | What it is |
|----------|------------|
| `this.Block` | The block (or layout) that owns the field. From a block you can reach `this.Block.Canvas`, `this.Block.Layout`, and `this.Block.Column`. |
| `this.store` | The reactive value object. Write tracked keys here. |
| `this.props` | The `properties` object from the block JSON. Always an object. Keys you expect may be missing, so default them in the input. |
| `this.inputKey` | The key in the block JSON, such as `"score"`. It is not unique on the page. |
| `this.inputId` | A unique id for this instance, such as `cb-input-123-score`. Set this as the `id` of the primary control so a [label](../../02_Input_Types/Label) can point at it. |
| `this.width` | The configured width: a number, `"auto"`, or `"fill"`. |
| `this.inputDef` | The definition object passed in (`properties`, `width`, `key`). |

## render()

`render()` must return an `Element`.

ContentBlocks calls it when the block is first drawn. It calls it again after the block is dropped, and **discards the return value**. Return the same node every time. If you create a new element on the second call, the field on screen stays the old node and your update is thrown away.

```javascript
render() {
    if (!this._root) {
        this._root = document.createElement("input");
        this._root.type = "text";
        this._root.id = this.inputId;
        this._root.addEventListener("input", () => {
            this.store.value = this._root.value;
        });
    }

    this._root.value = this.store.value || "";
    return this._root;
}
```

That is the `text` input. Build the listeners once. On every later `render()`, copy the store back onto the control so a move or an outside update does not leave the field stale.

Writing to the store does not redraw the input. If a modal, browser, or fetch changes the store, update the DOM yourself (call `this.render()`, which updates the existing node).

## dataKeys

```javascript
static dataKeys = ["value"];
```

List every top-level key the input will save. The default is `["value"]`. Only listed keys are tracked, and only tracked keys fire change events up to the block and canvas.

Templates read those keys by name: `{{ score.value }}`, or `{{ heading.value }}` and `{{ heading.level }}` when you declare more than one. Details and the rules for arrays and objects are in [Input Stores](Input_Stores).

## Where to go next

- [Registering Inputs](Registering_Inputs) for the plugin that loads your script
- [Input Patterns](Input_Patterns) for media browsers, extra libraries, and server-loaded options
- [Modals](../06_Utilities/Modal) for picker windows and settings forms
- [Troubleshooting](Troubleshooting) when the field does not appear or the value does not save
