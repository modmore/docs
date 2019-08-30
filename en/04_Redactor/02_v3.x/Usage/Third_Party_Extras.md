Third-party extras can also use Redactor.

Third party extras can support a generic rich text editor implementation, which works for Redactor, TinyMCE and CKEditor from the same code, or they can use a Redactor-specific implementation that allows defining the configuration set to use. 

Most extras use the generic approach, which will cause it to use the system default configuration set.

[TOC]

## Supported third party extras

- FaqMan
- MoreGallery
- ContentBlocks (also see [the custom Redactor input type](ContentBlocks))
- Agenda
- Articles
- mxCalendar

Please note that this list is incomplete. 

## Implementing rich text editing

This section is only for developers looking to implement Redactor and/or other editors into their extras. 

### Step 1. Invoke the OnRichTextEditorInit event

The OnRichTextEditorInit event calls the Redactor plugin which prepares the HTML and loads the necessary assets. 

The return value from the invokeEvent method needs to be inserted into your page; this contains instantiation logic for Redactor. 

The easiest way to do that is in your **controller,** set the placeholder there, and make sure it is inserted into your template.

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
        // Call your method to grab the editor code
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

### Call MODx.loadRTE(elements) or MODx.loadRedactorConfigurationSet(elements, set)

The second step is to call the javascript method that initiates the editor. For this, you have two options.

1. Use `MODx.loadRTE(elements)` for the generic RTE integration, which will also work for other rich text editors. 
2. Use `MODx.loadRedactorConfigurationSet(elements, set)` for the Redactor-specific integration, which allows you to pass the ID of a configuration set to use. 

In both cases, `elements` is a comma-separated list of textarea IDs (without hash `#`) that should be enhanced. 

#### Basic example

For example: 

````javascript
if (MODx.loadRTE) {
    // Will transform the textarea with ID "description" to a RTE
    MODx.loadRTE('description'); 
}
````

You can also choose to use the Redactor approach when available, and fallback to the generic one when it is not. 

```` javascript   
if (MODx.loadRTE) {
    var initialise = MODx.loadRedactorConfigurationSet || MODx.loadRTE,
        redactorSet = 4;
    // Will transform the textarea with ID "description" to a RTE
    initialise('description', redactorSet); 
}
````

It is theoretically possible for other editors to expect a different second parameter for MODx.loadRTE, so make sure to test this with the editors you wish to support. 

#### Window example

If you're loading the editor in an ExtJS modal window, you can hook into the "show" or "activate" events for the Window to call MODx.loadRTE. Have a look at the [faqMan source](https://github.com/josht/faqMan/blob/develop/assets/components/faqman/js/mgr/widgets/items.grid.js#L271) to see this integration in action and context. Here's an example:

```` javascript   
this.on('activate', function() {
    if (MODx.loadRTE) {
        MODx.loadRTE('id-of-the-field-to-be-richtext');
    }
});
````

Also add this option to your MODx.Window to prevent Redactor from double initialization.

```javascript
closeAction: 'close'
```

### Allow customer to select a configuration set

If you went with the Redactor-specific (or hybrid) approach, you'll want to offer your user the ability to select a configuration set. You can make this available as a system setting for example.

To incorporate the selection into an ExtJS based component, you can use the provided combo box. 

To load it, add the following to a controller or plugin:

```php
<?php
$assetsUrl = $modx->getOption('redactor.assets_url', null, MODX_ASSETS_URL . 'components/redactor/');
$modx->controller->addJavascript($assetsUrl . 'configuration/widgets/combo.configsets.js');

$connectorUrl = $assetsUrl . 'connector.php';
$modx->controller->addHTML(<<<HTML
<script type="text/javascript">
if (!window.RedactorConfiguration) {
    window.RedactorConfiguration =  {
        config: {
            connectorUrl: '{$connectorUrl}'
        }
    }
}
</script>
HTML
);
```

Now you can use the `redactor-configsets` xtype. 
