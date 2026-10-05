The `ContentBlocks.Store` class is a very simple reactive object implementation. 

That means it mostly behaves as a standard JavaScript object, but tracked keys will fire a change event that can cause things to automatically update. 

An example implementation of the store may look like this:

```js 
class MyCustomThing extends ContentBlocks.Dispatcher {
    store;
    constructor() {
        // Create a store and track the keys we are interested in
        this.store = new ContentBlocks.Store(); 
        this.store.track('textValue');
        // Create an input field that users will type in
        this.rootNode = new document.createElement("input");
        this.rootNode.setAttribute("type", "text");
        // When typing in the field, update the store's textValue key (the key we tracked)
        this.rootNode.addEventListener("input", () => {
            this.store.textValue = this.rootNode.value;
        });
        // The store has its own onChange function to define a callback when the value is changed.
        // We can use this onChange function directly, but it's a good idea to bump that event up into
        // our own events system (powered by the Dispatcher). 
        this.store.onChange((data) => {
            this.trigger("customthing:change", data);
        });
        // Listen to the event so we can respond to it
        this.on("customthing:change", (data) => {
            console.log(data.valueKey, data.newValue, data.oldValue);
        });
    }
}
```

In the above hypothetical example, simply doing our changes in the rootNode's listener is certainly a possibility, but that doesn't allow others to easily hook into the change. With the store and dispatcher events, we open it up for future use. 

Depending on the use case, it's common to hook into the store to propagate changes to the interface.
