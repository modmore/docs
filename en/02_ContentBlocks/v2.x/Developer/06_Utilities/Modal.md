The Modal utility provides a flexible implementation of modal windows for a variety of purposes in ContentBlocks. While ContentBlocks v2 is intended to be more visual than v1, a modal is useful when the canvas should stay small and more advanced controls need to be in a window. In the core, this is used by the icon, color, video, and chunk inputs, as well as the windows to add blocks or layouts.

The main functionality for modals is included in `ContentBlocks.Modal` (a single window) and `ContentBlocks.ModalMgr` (to control what is open and closed, allowing windows to stack).

You build the body of the modal yourself. The header, buttons in the footer, and blocking the background are added automatically.

Opening a modal from a modal opens it on top of the other one. Only the modal currently at the top can be interacted with.

[TOC]

## Basic Example

To create a modal, you must provide a DOM fragment for the body, an object of buttons to add to the footer, and create a Modal instance from those things.

The Modal instance is then passed to the ModalMgr to open it.

For example, create a DOM fragment:

```js
const body = document.createRange().createContextualFragment(`
    <p>This is a test modal.</p>
`);
```

Create a Modal instance, providing a title, the body DOM element, and at least a Cancel button that returns `true` to indicate it should automatically close the modal on click:

```js
const modal = new ContentBlocks.Modal({
    title: "Add block",
    body: body,
    buttons: {
        Cancel: () => {
            return true;
        },
    },
});
```

Pass the Modal to the ModalMgr to open it:

```js
ContentBlocks.ModalMgr.open(modal);
```

Or, everything in a single call:

```js
ContentBlocks.ModalMgr.open(
    new ContentBlocks.Modal({
        title: "Add block",
        body: document.createRange().createContextualFragment(`
            <p>This is a test modal.</p>
        `),
        buttons: {
            Cancel: () => {
                return true;
            },
        },
    })
);
```

## Opening a Modal

`ContentBlocks.ModalMgr` owns the open windows, allowing modals to stack consistently.

`ContentBlocks.ModalMgr.open()` takes a `ContentBlocks.Modal` as argument, and renders it to the page:

```javascript
ContentBlocks.ModalMgr.open(
    new ContentBlocks.Modal({
        title: "Choose a badge",
        body: body,
        buttons: {
            Cancel: () => true,
        },
    }),
);
```

`ContentBlocks.ModalMgr.close()` removes the window on top. The header close button and a click on the dimmed backdrop do the same.

Opening a modal while another is already open stacks the new one on top, a little offset for each layer under it. `ContentBlocks.ModalMgr.close()` only closes the **top** window, so the one underneath stays as it was.

The `onOpen` callback on a Modal runs when the modal has opened. You can use it to focus the first field, initialise heavier inputs, etc.

The `onClose` callback on a Modal runs when the modal is closed. That includes the header close button, the backdrop, and the `close()` function. This runs just before the node is removed, so you can still access the body briefly.

## Modal options

| Option | What it is |
|--------|------------|
| `title` | Header text. Inserted as HTML, so pass a plain string. Defaults to "Untitled modal window". |
| `body` | DOM node placed in the body. Defaults to an empty `div`. |
| `buttons` | Map of button label to click function. Always pass this. |
| `onOpen` | Called after the modal is in the document. |
| `onClose` | Called when the top modal closes, before it is removed. |
| `innerClass` | Extra class on `.cb-modal-inner`, if you want to target additional styling. |

## Closing modals

To close the modal, call the `close()` method on the ModalMgr. That always closes the modal currently at the top.

```js
ContentBlocks.ModalMgr.close();
```

Returning anything other than `false` from a button function will also close the modal.

The function runs immediately. A promise does not delay the close. If you need to wait on a request, return `false` first, and then call `ContentBlocks.ModalMgr.close()` when the result is in. The [Buttons](#buttons) section shows that pattern.

## Build the content

Build the body **before** you call `open()`, and pass a node as `body`. The manager appends it into `.cb-modal-body`. Keep references to the fields so you can read them from the callbacks.

Inputs, textareas, and selects inside the body already get the modal field styles: full width, a light border, and a focus color. Add `cb-visual-input` to a custom control when needed.

The panel is at least 450px wide and at most 800px. A wider body widens the window up to that maximum. Pass `innerClass: "cb-modal-inner--wide"` when the body should use the full 800px, like the color picker and the block picker do. For any other width, pass your own class and style it.

```javascript
const body = document.createElement("div");

const label = document.createElement("label");
label.htmlFor = `${this.inputId}-caption`;
label.textContent = "Caption";

const caption = document.createElement("input");
caption.type = "text";
caption.id = `${this.inputId}-caption`;
caption.value = this.store.value || "";

body.append(label, caption);
```

A `DocumentFragment` from `document.createRange().createContextualFragment("html fragment")` also works. Its children move into the body. Working with nodes is easier to hold onto references, e.g. when Save needs to read the form.

## Buttons

`buttons` is an object containing the buttons in the footer of the modal window. Each key is the **label**, each value is the **click function**. Keys are shown in the order you write them, aligned to the right of the footer, so put Cancel first and the confirming action last. Labels are plain text.

Return `false` in the callback to leave the modal open. Any other return value closes it, including `true` and a function that returns nothing.

```javascript
buttons: {
    "Cancel": () => true,
    "Save": () => {
        if (!caption.value.trim()) {
            error.hidden = false;
            error.textContent = "Enter a caption.";
            return false;
        }

        this.store.value = caption.value.trim();
        this.render();
        return true;
    }
}
```

The function runs immediately. A promise does not delay the close. If you need to make an AJAX request, send the asynchronous request, return false, and then call `ContentBlocks.ModalMgr.close()` when the result is in:

```javascript
buttons: {
    "Cancel": () => true,
    "Save": () => {
        this.lookup(query.value).then((match) => {
            if (!match) {
                error.hidden = false;
                error.textContent = "Nothing matched.";
                return;
            }

            this.store.value = match.id;
            this.render();
            ContentBlocks.ModalMgr.close();
        });
        return false;
    }
}
```

The header close button and the backdrop only call the `onClose` callback.

Writing `this.store` does not redraw the field immediately; call `this.render()` so the node already on the canvas shows the new value. See [Creating Custom Inputs](../01_Custom_Inputs/Creating_Custom_Inputs).

## Example: a picker

This input shows the current badge on the canvas. The modal lists the choices. Clicking one writes the store, updates the button, and closes the window. Cancel, the header close button, and the backdrop leave the store unchanged, because nothing is written until a choice is clicked.

```javascript
ContentBlocks.registerInput(
    "badge",
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

            this._button.textContent = this.store.value || "Choose a badge";
            return this._button;
        }

        openPicker() {
            const list = document.createElement("div");

            ["New", "Updated", "Featured"].forEach((name) => {
                const choice = document.createElement("button");
                choice.type = "button";
                choice.textContent = name;
                choice.addEventListener("click", () => {
                    this.store.value = name;
                    this.render();
                    ContentBlocks.ModalMgr.close();
                });
                list.appendChild(choice);
            });

            ContentBlocks.ModalMgr.open(
                new ContentBlocks.Modal({
                    title: "Choose a badge",
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

## Example: a settings form

This input stores a caption and a credit. The modal is a form. Save validates, writes both keys, and closes. Cancel returns `true` without writing, so the field stays as it was. `chunk` uses this confirm-on-save shape for its property form.

`onOpen` focuses the first field once the modal is on the page.

```javascript
ContentBlocks.registerInput(
    "caption",
    class extends ContentBlocks.Input {
        static dataKeys = ["value", "credit"];

        _button;

        render() {
            if (!this._button) {
                this._button = document.createElement("button");
                this._button.type = "button";
                this._button.id = this.inputId;
                this._button.addEventListener("click", () => {
                    this.openSettings();
                });
            }

            const caption = this.store.value || "Add a caption";
            const credit = this.store.credit ? ` (${this.store.credit})` : "";
            this._button.textContent = caption + credit;
            return this._button;
        }

        openSettings() {
            const body = document.createElement("div");

            const caption = document.createElement("input");
            caption.type = "text";
            caption.value = this.store.value || "";
            caption.placeholder = "Caption";

            const credit = document.createElement("input");
            credit.type = "text";
            credit.value = this.store.credit || "";
            credit.placeholder = "Credit";

            const error = document.createElement("p");
            error.hidden = true;

            body.append(caption, credit, error);

            ContentBlocks.ModalMgr.open(
                new ContentBlocks.Modal({
                    title: "Caption",
                    body,
                    onOpen: () => {
                        caption.focus();
                    },
                    buttons: {
                        Cancel: () => true,
                        Save: () => {
                            const nextCaption = caption.value.trim();
                            if (!nextCaption) {
                                error.hidden = false;
                                error.textContent = "Enter a caption.";
                                return false;
                            }

                            this.store.value = nextCaption;
                            this.store.credit = credit.value.trim();
                            this.render();
                            return true;
                        },
                    },
                }),
            );
        }
    },
);
```

```twig
{% if caption.value %}
    <figcaption>
        {{ caption.value }}
        {% if caption.credit %}<span>{{ caption.credit }}</span>{% endif %}
    </figcaption>
{% endif %}
```
