---
title: Undo/Redo Buttons Plugin
---

If you'd like to add undo/redo buttons to the Redactor toolbar, you can use the plugin below to do so. 

Copy/paste the contents below into a javascript file, for example `assets/components/redactor/plugins/bufferbuttons.js`. 
```` js
if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.bufferbuttons = function()
{
    return {
        init: function()
        {
            var undo = this.button.addFirst('undo', 'Undo');
            var redo = this.button.addAfter('undo', 'redo', 'Redo');

            this.button.addCallback(undo, this.buffer.undo);
            this.button.addCallback(redo, this.buffer.redo);
        }
    };
};
````

Next, add the plugin to the `redactor.additionalPlugins` system setting. This follows the format `pluginname:path/to/file.js`, so with the example above you would add:

`bufferbuttons:/assets/components/redactor/plugins/bufferbuttons.js`



