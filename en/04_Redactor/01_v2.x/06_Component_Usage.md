---
title: Using Redactor in Custom Components
---

It's easy to load Redactor in your custom components in a few simple steps. The steps below will also work when you want to include other MODX editors in components, and which editor is actually used depends on the which\_editor setting in your site.

## Invoke the OnRichTextEditorInit event

The OnRichTextEditorInit event calls the Redactor plugin which prepares the HTML and loads the necessary assets. The return value from the invokeEvent method needs to be inserted into your page; this contains instantiation logic for Redactor. The easiest way to do that is in your **controller,** set the placeholder there, and make sure it is inserted into your template.

Add this method inside your Controller:


```` php   
<?php
abstract class MyManagerController extends modExtraManagerController {
    /** ... */
    public function loadRichTextEditor()
    {
        $useEditor = $this->modx->getOption('use_editor');
        $whichEditor = $this->modx->getOption('which_editor');
        if ($useEditor && !empty($whichEditor))
        {
            // invoke the OnRichTextEditorInit event
            $onRichTextEditorInit = $this->modx->invokeEvent('OnRichTextEditorInit',array(
                'editor' => $whichEditor, // Not necessary for Redactor
                'elements' => array('foo'), // Not necessary for Redactor
            ));
            if (is_array($onRichTextEditorInit))
            {
                $onRichTextEditorInit = implode('', $onRichTextEditorInit);
            }
            $this->setPlaceholder('onRichTextEditorInit', $onRichTextEditorInit);
        }
    }
    
    public function process()
    {
        // ...
        // Your other stuff here
        // ...
        
        // Call your method to grab the editor 
        $this->loadRichTextEditor();
    }
}
  
````
Make sure to call the loadRichTextEditor method from your process() method! 

Next, you need to make sure that the output of the event (`$onRichTextEditorInit`) is inserted into the page. In the code example above we're using the `setPlaceholder` method of the manager controller to store a placeholder. We'll need to reference that placeholder in our template, which uses Smarty.

Here's an example template file for the Controller:

```` html   
<div id="some-div-id-for-your-extjs"></div>
{$onRichTextEditorInit}
````
## Call MODx.loadRTE(elements)

The second step is to call the loadRTE method. Redactor will make this method available when it is loaded. Simply specify an element by its ID, or pass an array of IDs to the function. Don't include the hash (#) when specifying the ID.


```` javascript   
if (MODx.loadRTE) {
    // Will transform the textarea with ID "description" to a RTE
    MODx.loadRTE('description'); 
    // MODx.loadRTE(['description1','description2']);
}
````

If you're loading the editor in an ExtJS modal window, you can hook into the "show" or "activate" events for the Window to call MODx.loadRTE. Have a look at the [faqMan source](https://github.com/josht/faqMan/blob/develop/assets/components/faqman/js/mgr/widgets/items.grid.js#L271) to see this integration in action and context. Here's an example:

```` javascript   
this.on('activate', function() {
    if (MODx.loadRTE) {
        MODx.loadRTE('id-of-the-field-to-be-richtext');
    }
});
````

Also you should add this option to your MODx.Window to prevent Redactor from double initialization.
```javascript
closeAction: 'close'
```

## Done!

This requires at least Redactor 1.2. This method should also work for other editors that are available for MODX, however your mileage may vary. Consult the documentation or ask the developer to see if other editors you prefer to use supports this approach. Or, you know, [buy Redactor](https://modmore.com/redactor/pricing/). ;)

We have tested the Redactor integration in, among others, FAQ Manager, MoreGallery, Articles, mxCalendar and ContentBlocks.
