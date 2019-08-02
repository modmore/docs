The page you're currently looking at contains information related to Redactor 1.x. Please visit [Component Usage](../v2.x/Component_Usage) for the relevant information for Redactor 2.x.

---

 1.2.0, you can easily load Redactor in your custom components as well in a few simple steps. The steps below will likely also work when you want to include other MODX editors in components, and depend on the which\_editor setting in your site.

## 1. Invoke the OnRichTextEditorInit event

This calls the Redactor plugin which prepares the HTML and loads the necessary assets. The return value from the invokeEvent method needs to be inserted into your page; the easiest way to do that is in your **controller,** and to set the placeholder and make sure it is inserted into your template.

PHP inside your Controller:


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

Make sure to call the method when you want to load the editor. It helps, trust me. 

Next, you need to make sure that the output of the event ($onRichTextEditorInit) is inserted into the page. In the code example above we're using the `setPlaceholder` method of the manager controller to store a placeholder. We'll need to reference that placeholder in our template, which uses Smarty by default.

Here's an example template file for the Controller:


```` html   
<div id="some-div-id-for-your-extjs"></div>
{$onRichTextEditorInit}
````   
## 2. Call MODx.loadRTE(elements)

The second step is to call the loadRTE method. Redactor will make this method available when it is loaded. Simply specify an element by its ID, or pass an array of IDs to the function. As Redactor is based on jQuery, it will transform the elements value into a selector that jQuery understands by prefixing it with the hash (#), so make sure you pass IDs without the hash and that the element has an ID set.


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

## 3. There's no step 3.

Sorry, that's all it takes.

Do note that this requires at least Redactor 1.2; it will not work with older versions of Redactor. This method should also work for other editors (including TinyMCE), but obviously we have only tested with Redactor and your mileage may vary.

Extras that support Redactor:

- faqMan
- MoreGallery
- Articles
- mxCalendar
- ContentBlocks

Let us know if your Extra supports Redactor too, and we'll gladly add it to the list.

## Version Detection

One of the [several improvements in Redactor 1.5](https://modmore.com/blog/2014/announcing-redactor-1.5/) introduced the ability to check the current version of Redactor through our API. We do **not** recommend using version detection, however if you absolutely must it is possible through `$redactor->version`.


```` php   
<?php
// Get the redactor service
$corePath = $modx->getOption('redactor.core_path', null, 
    $modx->getOption('core_path').'components/redactor/');
$redactor = $modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');

// Get specific parts of the version number 
$major = $redactor->version->major; // 1
$minor = $redactor->version->minor; // 5
$patch = $redactor->version->patch; // 0
$release = $redactor->version->release; // pl
$float = $redactor->version->float; // 1.5.0
$full = $redactor->version; // 1.5.0-pl

// output some stats
$s = "You are running Redactor " . $redactor->version;
if($patch == 0) {
    $s .= "This is the first patch release in this minor release cycle. ";
}

if($release == 'pl') {
    $s .= "You are running a stable version";
}
else {
    $s .= "Welcome to the bleeding edge. ";
}

return $s;
````   
Assuming you were running Redactor 1.5.0, the above snippet would return:

> You are running Redactor 1.5.0-pl. This is the first patch release in this minor release cycle. You are running a stable version.

The `$redactor->version` object has five public properties and one method. Major, minor, and patch releases are expressed as individual integers respectively. The "release" such as "pl" is defined as a string, optionally with a number like rc2. There is also a `$float` property that returns the version numbers stringed together, ex: "1.5.0". By reading the object as string you will get the full version signature, for example "1.5.0-pl".