Many interactable objects in ContentBlocks, including all canvas elements, extend the core `ContentBlocks.Dispatcher` class to offer a unified and light-weight event system.

(Note that _internal stores_ do not extend the dispatcher, but those are set up to fire a `change` event on the dispatcher-enabled object they're added to.)

[TOC]

## Methods

The Dispatcher, and thus all descendant objects, have a couple of useful methods:

- `on(ev, callback)` lets you register a listener on a specific event. The callback must be a function. The callback will receive a single `data` object with the data that is relevant for the thing that fired it. Refer to the documentation for specific things (like blocks or layouts) for details.
- `trigger(ev, data)` will trigger an event. For the most part, you will want to avoid manually triggering core events outside of custom input types or plugins, and any custom events should be prefixed with something unique to your extension or functionality to avoid conflicts, e.g. `obj.trigger("coolextension:beforeFire", {"option": "value"})`.
- `bubble(ev, target)` will bubble an event from the current object to the target object when it is called. The target object must also be a Dispatcher implementation.
- `initPlugins` is considered a private method for internal use only.

## Debugging events

If you would like to explore all the events that are fired, you can do so with the console.

Open the browsers' developer console, and run `window.CBLogAllEvents = true;`. All events fired will now be logged with the object it is being fired on, the event name, and the data provided to the callbacks.

To turn it off again, run `window.CBLogAllEvents = false;` in the console again.

This debug mode does not persist across page loads or refreshes.

## Implementing the Dispatcher

Use the `extends` when initialising an object/class to incorporate the dispatcher in custom code.

For example:

```javascript
MyClass = class extends ContentBlocks.Dispatcher {
    constructor() {
        this.on('beforeRender', () => {
            console.log('received beforeRender event');
        })
        this.trigger('beforeRender', {});
    }
}
const instance = new MyClass();
```
