When trying to add custom _behavior_ to the manager canvas, a plugin is likely your first stop. Plugins are added to blocks, layouts, or the entire canvas and interact with events and utilities provided by ContentBlocks.

Note:

- If you're trying to add a new type of media or content, you may not need a plugin but a custom input type. To determine if a plugin or input type is the appropriate implementation route, ask yourself if what you're adding is _content_ or _behavior_. Think of behavior as some interaction in the manager that you compose on top of data.

All plugins must be added to the global `ContentBlocks.Plugins` as an **instance** of a class extending `ContentBlocks.Plugin`. The `Plugin` base class provides an idea of how it may be initialised in different circumstances.

[TOC]

## Registering on Blocks, Layouts, or Canvases

The Plugin class starts by defining where it can be used. Plugins can be initialised on specific **blocks**, **layouts**, or at the **canvas level**.

If your plugin is intended to run on _everything_ in the canvas, even if that means every block or every layout, instantiating on the Canvas level would be preferable for performance and simplicity. For example, something like the built-in Full Screen plugin is not block-specific and is typically applied on the canvas as a whole - even if it adds the button to all blocks and layouts.

For flexibility of configuration, it is also worth making your plugin able to run on any level that makes sense for the use case.

## Example init functions

When building your plugin, you can define any or all of the functions `initBlock(Block, options)`, `initLayout(Layout, options)`, and `initCanvas(Canvas, options)`.


```js
ContentBlocks.Plugins.AddSparkles = new class extends ContentBlocks.Plugin {
    initBlock(Block, options) {
        super.initBlock(Block, options);
        console.log(Block, options);
    }

    initLayout(Layout, options) {
        super.initBlock(Layout, options);
        console.log(Layout, options);
    }

    initCanvas(Canvas, options) {
        super.initBlock(Canvas, options);
        console.log(Canvas, options);
    }
}
```

In the users' configuration for a specific block/layout/canvas, the plugin name (in the example above `AddSparkles`) would be added to the `plugins` object with any additional `options` you may want to support.

```json
{
    ...
    "plugins": {
        "AddSparkles": {
            "numberOfSparkles": 20
        }
    }
}
```

## Handling Events

Similarly, for layout-level support:

```js
ContentBlocks.Plugins.AddSparkles = new class extends ContentBlocks.Plugin {
}
```

In the configuration for a specific block, the plugin name (in the example above `AddSparkles`) would be added to the `plugins` object with any additional `options` you may want to support.

```json
{
    "inputs": {
        "text": { "type": "textarea" }
    },
    "plugins": {
        "AddSparkles": {
            "numberOfSparkles": 20,
        }
    }
}
```
