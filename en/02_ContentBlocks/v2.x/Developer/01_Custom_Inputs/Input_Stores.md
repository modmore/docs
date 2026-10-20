Every input gets a store when the canvas creates it.

The store is a small reactive object: assigning a tracked key fires a change, which bubbles up to the block and higher up in the canvas. An external force (like a plugin or user) making a change to the store calls the `render()` function on an input, which reads from the store and updates the visible representation.

For the store to work properly, each input needs to define the `dataKeys` it needs to track. This is a static list of keys that will get the special behavior.

[TOC]

## Declare the keys

```javascript
ContentBlocks.registerInput(
    "heading",
    class extends ContentBlocks.Input {
        static dataKeys = ["value", "level"];

        render() {
            // ...
        }
    },
);
```

`dataKeys` defaults to `["value"]`. On init, ContentBlocks calls `store.track()` for each key. Assigning a tracked key is what editors, templates, and the save payload see:

```javascript
this.store.value = "Introduction";
this.store.level = "h2";
```

Saved under the input key `heading`, that becomes:

```json
{
    "heading": {
        "value": "Introduction",
        "level": "h2"
    }
}
```

Twig reads `{{ heading.value }}` and `{{ heading.level }}`. A `.tpl` template reads `[[+heading.value]]` and `[[+heading.level]]`.

Keys you did not list are **not** tracked. Assigning them does not fire a change. Put every unique key you want to keep in `dataKeys`.

The block store holds one nested store per input key. `block.store.heading` is the heading input's store, not a plain string. Plugins that listen for block `change` receive `inputKey`, `valueKey`, `newValue`, `oldValue`, and `inputStore`. See [Block Events](../04_Client_Events/Block_Events).

## Array manipulation

The store notices `this.store.items = nextItems`, but it does not notice `this.store.items.push(row)`.

When working with arrays, make a copy (or new array) with the full values, and assign that to the store when something changes:

```javascript
const items = Array.isArray(this.store.items) ? this.store.items.slice() : [];
items.push({ value: "" });
this.store.items = items;
```

The stored value can still be an array or object.

## Defaults

A missing value arrives as `undefined`. Write a default only when the editor has not saved one yet, and write it once. Setting the store during render marks the canvas changed.

```javascript
applyDefault() {
    if (this._defaultApplied) {
        return;
    }
    this._defaultApplied = true;

    if (this.store.value !== undefined && this.store.value !== null) {
        return;
    }

    if (this.props.default !== undefined) {
        this.store.value = this.props.default;
    }
}
```

The `toggle` input uses this so an unchecked box still saves its unchecked value, and so reopening a block does not overwrite a saved `"0"`.

## Keep the field in sync

**The store does not call `render()` by itself.** Only when an external force (like a plugin, or a drag & drop re-order) affects the input it will automatically call `render()` again.

If you change a value from a modal or a media browser, call `render()` to update the DOM with the selected value.

## Events from the input

Store changes already bubble up into the block's `change` event, which bubbles to a `block:change` event into the layout and canvas.

For anything else a plugin might care about, it's worth triggering events through the input's [dispatcher](../04_Client_Events/Dispatcher).

```javascript
this.trigger("picker:select", { value: this.store.value });
```

To fire on the block, make sure to prefix the event with the input key so two fields on the same block do not collide:

```javascript
this.Block.trigger(this.inputKey + ":picker:select", {
    value: this.store.value,
});
```
