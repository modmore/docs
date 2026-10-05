---
title: Troubleshooting Custom Inputs
---

The browser console is the first place to look. A missing registration is logged as an error when the canvas builds the block. With verbose logging, a successful `registerInput` also logs `Received {name} input type`.

If these notes do not match what you see, contact support@modmore.com with a copy of your code.

[TOC]

## The block shows the error input

The canvas could not find a class for the `type` on that field. The console error is `Requested _initBlockInput for non-existent input type`.

Check, in order:

1. Check the `type` in the block JSON matches the `registerInput` name, case sensitive.
2. Check if your script actually loads on the resource update page. View source and confirm the `<script src>` is present and returns JavaScript, not a 404.
3. Check the script is passed to the [ContentBlocks_RegisterInputs](Registering_Inputs) event with `$modx->event->output()`, not with `return`. In the page source it should appear after `contentblocks.js`.
4. Check that the script calls `registerInput` immediately. A call inside `MODx.on('ready', ...)` or other boilerplate can run _after_ the canvas has already built its inputs.

`ContentBlocks.InputTypes.yourInputKeyHere` in the console should contain your class after the page has loaded. If it is `undefined`, registration did not work.

## Console: that input type already exists

`registerInput` refuses a name that is already taken, including core names like `text` and `image`. Pick a name that belongs to your extra, preferably with a prefix like your company name.

## The value never reaches the template

The template key has to match `dataKeys` and the input key in the block JSON.

For an input registered as `"rating"` with `static dataKeys = ["value"]`, used as `"score": { "type": "rating" }`, the template variable is `score.value` (`{{ score.value }}` or `[[+score.value]]`). `{{ score }}` is the store object, not the string.

Also check:

- The key you assign is listed in `dataKeys`. Other keys are not tracked.
- Arrays and objects were replaced (`this.store.items = items`), not only pushed to. In-place edits do not fire a change, so the save payload can keep the previous value. See [Input Stores](Input_Stores).

## The field resets, loses focus, or ignores updates

`render()` must return the same DOM node it created the first time. `render()` will be called again when a block is dropped, but it does not insert the element you return on that second call so your input should keep a reference and update that from the store during `render()`.

If every `render()` does `document.createElement(...)`, the listeners and the typed value stay on a node that is no longer the one on screen. Keep `this._root` (or `this._input`) and only fill in values from the store on later calls.

Writing `this.store.value = ...` from a modal does not redraw the field immediately; call `this.render()` after the assignment.

## A default overwrites a saved value

Only write `this.store.value = this.props.default` when the stored value is still `undefined` or `null`, and only do it once per instance. An empty string can be a real saved value (the `toggle` input uses `""` for unchecked). Treat "missing" and "empty" as different cases when empty is valid.
