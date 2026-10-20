The block and layout toolbars are dynamically rendered on load, and when focused or expanded.

Plugins add or remove items by listening for `toolbar` on a single block or layout, or for `block:toolbar` and `layout:toolbar` on the canvas when the button should appear on every block or layout.

Because these listeners run often, keep them light. Do not do heavy computation or AJAX requests here.

`data.items` is a reference and should be manipulated in place. `unshift()` adds a button on the left. `push()` adds one on the right. `splice(index, 0, {...})` inserts one in the middle. `splice(index, 1)` removes an item.

Each item is an object with:

- `key`, a unique id
- `icon`, a Font Awesome icon name
- `title`, the hover title
- `text`, optional button text
- `handler`, a function called on click
- `renderer`, an optional function that turns the item into a DOM element, for custom markup or finer event control

[TOC]

## On a block

```js
ContentBlocks.Plugins.CopyPaste = new class extends ContentBlocks.Plugin {
    initBlock(Block, options) {
        super.initBlock(Block, options);
        Block.on("toolbar", (data) => {
            data.items.unshift({
                key: 'copy-block',
                icon: 'copy',
                title: 'Copy block content',
                handler: () => {
                    window._copied = Block.serialize();
                    alert('copied');
                }
            });
        });
    }
}
```

The block is the one this plugin was initialised on, so the handler can close over it.

## On a layout

The layout toolbar uses the same `toolbar` event. For example:

```js
ContentBlocks.Plugins.CopyPaste = new class extends ContentBlocks.Plugin {
    initLayout(Layout, options) {
        super.initLayout(Layout, options);
        Layout.on("toolbar", (data) => {
            data.items.push({
                key: 'copy-layout',
                icon: 'copy',
                title: 'Copy layout content',
                handler: () => {
                    window._copied = Layout.serialize();
                    alert('copied');
                }
            });
        });
    }
}
```

Layout toolbars are re-rendered when any layout on the canvas changes, so this listener runs more often than a block toolbar listener.

## On every block or layout

Initialise the plugin on the canvas when the button belongs on everything, the way Full Screen does. Listen for `block:toolbar` to reach every block toolbar, and `layout:toolbar` to reach every layout toolbar. You only need the event that matches where the button should appear.

The payload is the same `items` array, plus the instance that is rendering: `data.block` or `data.layout`.

```js
ContentBlocks.Plugins.CopyPaste = new class extends ContentBlocks.Plugin {
    initCanvas(Canvas, options) {
        super.initCanvas(Canvas, options);

        Canvas.on("block:toolbar", (data) => {
            data.items.push({
                key: 'copy-block',
                icon: 'copy',
                title: 'Copy block content',
                handler: () => {
                    window._copied = data.block.serialize();
                    alert('copied');
                }
            });
        });

        Canvas.on("layout:toolbar", (data) => {
            data.items.push({
                key: 'copy-layout',
                icon: 'copy',
                title: 'Copy layout content',
                handler: () => {
                    window._copied = data.layout.serialize();
                    alert('copied');
                }
            });
        });
    }
}
```

`block:toolbar` is fired by the block after its own `toolbar` listeners have run, then bubbled up to the canvas. `layout:toolbar` is fired on the canvas the same way. Both receive the `items` array those earlier listeners already changed.

If the plugin can also be attached to an individual block or layout, skip the button when that `key` is already present so it is not added twice:

```js
Canvas.on("block:toolbar", (data) => {
    if (data.items.some((item) => item.key === "copy-block")) {
        return;
    }
    data.items.push({ /* ... */ });
});
```
