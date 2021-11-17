ContentBlocks was built with custom input types in mind - custom inputs are developed in the exact same way as core input types, with the exception of the plugin to register custom input types to the system. This document will walk you through developing a custom plugin.

[TOC]

## In a Nutshell

A custom ContentBlocks input requires the following pieces:

1. A PHP class that extends cbBaseInput. This class handles processing the raw values into markup using templates, it defines the available properties and it registers the necessary assets.
2. A JavaScript file containing the input type's logic in the manager and an `init` and `getData` function.
3. A template prepared for the tmpl library which is used to create the input type markup in the manager when adding the field.
4. A plugin that creates a new instance of your input type class and returns it to ContentBlocks.

All these pieces are required for a custom input type to function, we will talk about each of them below.

If you wish to distribute the input type, you will also need to create a build to generate a transport package. If you build a really great custom input type, we might be interested in distributing it through our provider as separate package (with the proper credits, of course). If that sounds interesting, please get in touch with support. [You can also find a full example in the oEmbed input type on Github.](https://github.com/modmore/ContentBlocks_oEmbed)

 

## Input Class (PHP)

The Input Class brings together all of the other pieces and is therefore quite possibly the most important part of your custom input. It contains logic on what files to load for in the manager, it prepares the template and it is also responsible for parsing the raw data into markup. Finally it can also provide the properties that are available when creating a field with your input type.

Some rules:

1. Your class must extend the `cbBaseInput` class. There is no need to require/include that class, ContentBlocks will make sure it is loaded.
2. The name of your class should end with `Input`, for example `MyAwesomeInput`.
3. The class should be in a file which ends in .class.php, for example `myawesomeinput.class.php`. The file can be anywhere, but it's recommended to put it in a directory like `core/components/myawesomeinput/elements/inputs/`.

To dive right into the code, here's an example of an input class with the most common features.
```` PHP
<?php

class MyAwesomeInput extends cbBaseInput {
    public $defaultIcon = 'chunk_A';
    public $defaultTpl = '<p class="fabulous">[[+value]]</p>';

    /**
     * @return array
     */
    public function getJavaScripts() {
        $assetsUrl = $this->modx->getOption('myawesomeinput.assets_url', null, MODX_ASSETS_URL . 'components/myawesomeinput/');
        return array(
            $assetsUrl . 'js/inputs/my_awesome_input.js',
        );
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = array();
        
        // Grab the template from a .tpl file
        $corePath = $this->modx->getOption('myawesomeinput.core_path', null, MODX_CORE_PATH . 'components/myawesomeinput/');
        $template = file_get_contents($corePath . 'templates/my_awesome_input.tpl');
        
        // Wrap the template, giving the input a reference of "my_awesome_input", and
        // add it to the returned array.
        $tpls[] = $this->contentBlocks->wrapInputTpl('my_awesome_input', $template);
        return $tpls;
    }
}
````
Important things to note in this class:

- The javascript file we refer to is stored in assets/components/myawesomeinput/js/inputs/my\_awesome\_input.js
- The template file we refer to is stored in core/components/myawesomeinput/templates/my\_awesome\_input.tpl
- We pass it a default template and a default icon which will be prefilled/preselected when a new field is created and the custom input is chosen.
- This input has a reference of "my\_awesome\_input" - see line 30 where we call `$this->contentBlocks->wrapInputTpl('my_awesome_input', $template)`. This means that we need to consistently refer to my\_awesome\_input. This will be used in the javascript (`ContentBlocks.fieldTypes.my_awesome_input`) and in the plugin (`$modx->event->output(array('my_awesome_input' => $instance));`). The naming of _files_ you refer to in the PHP class is not fixed and can be anything (you may want to combine multiple custom inputs into one javascript file, for example) but being consistent at this point helps understand the way it works.
- As we have not overridden the `process()` function, the input type will grab the Field's template and parse the values returned from the javascript `getData` method through it. This works for most simple input types, but be sure to check out the Gallery or List input classes for inspiration on dealing with more complex fields.

### Defining the Name & Description

After you added the plugin, the input type will show up in the input type drop down when editing a field. The name and description for this are loaded from the PHP class by calling the `getName()` and `getDescription()` methods. In the `cbBaseInput` class these methods try to find the lexicon value from the ContentBlocks lexicon, but in your custom inputs that wont work and result in names like "`contentblocks.myawesomeinput`".

To fix this, define the `getName()` and `getDescription()` methods in your class, as in the example below. While you can hardcode the name/description, it's of course better to use lexicons - especially if you're thinking about distributing the input type.
```` PHP
<?php
class MyAwesomeInput extends cbBaseInput {
    /* ... */
    
    public function getName()
    {
        return 'My Awesome Input'; 
        // return $this->modx->lexicon('myawesomeinput.input_name');
    }
    
    public function getDescription()
    {
        return 'With My Awesome Input you can manage awesome content awesomely.'; 
        // return $this->modx->lexicon('myawesomeinput.input_description');
    }
}
````
### Adding Input Properties

By defining properties on the Input class, users will be given options to fill out when they add/edit fields using your custom input. By default there is always a template property, but to make your input as flexible as possible you will probably want to define some more properties. This is done with the getFieldProperties method, which expects an array of arrays with - essentially - ExtJS configs. See the example below.
```` PHP
<?php

class MyAwesomeInput extends cbBaseInput {
    /* ... */
    
    public function getFieldProperties()
    {
        return array(
            array(
                'key' => 'some_property',
                'fieldLabel' => $this->modx->lexicon('myawesomeinput.some_property'),
                'xtype' => 'textfield',
                'default' => 'Normal',
                'description' => $this->modx->lexicon('myawesomeinput.some_property.description')
            ),
            array(
                'key' => 'another_property',
                'fieldLabel' => $this->modx->lexicon('myawesomeinput.another_property'),
                'xtype' => 'textfield',
                'default' => '',
                'description' => $this->modx->lexicon('myawesomeinput.another_property.description')
            ),
        );
    }
}
````
It is important to give a `key` for the property. Do NOT specify a `name` directly, ContentBlocks generates this based on the key to make sure it is properly stored in the database. You will use the key to refer to the property in the javascript file or input class process function.

The `fieldLabel` option defines the label, which in this case is a lexicon but could theoretically be a hardcoded string, too. The `description` allows you to define a nice tooltip with extra information about the field: what it does, how it works or what placeholders are available. We strongly recommend you do this, so your input type is a bit self-documenting.

With the `xtype` you can define the input type - the standard xtypes in MODX/ExtJS are all available. If you pass an xtype of "code", ContentBlocks will try to use Ace for syntax highlighting when it is installed, and fall back to a simply textarea if not.

The `default` option lets you specify a default value for the property.

## The JavaScript

The JavaScript file is called when editing a resource when your input type is being added to the canvas. It boils down to an init function, called when your input's template was inserted, and a getData function, which should return an object with the value(s) from the field. The rest is up to you.

There's a bit of a boilerplate to wrap around your javascript, and it has to add itself to the ContentBlocks.fieldTypes object with the same reference as your template and the reference passed in the plugin.

Here's an example:
```` JS
// Wrap your stuff in this module pattern for dependency injection
(function ($, ContentBlocks) {
    // Add your custom input to the fieldTypes object as a function
    // The dom variable contains the injected field (from the template)
    // and the data variable contains field information, properties etc.
    ContentBlocks.fieldTypes.my_awesome_input = function(dom, data) {
        var input = {
            // Some optional variables can be defined here
        };
        
        // Do something when the input is being loaded
        input.init = function() {
            console.log('init', dom, data);
        };
        
        // Get the data from this input, it has to be a simple object.
        input.getData = function() {
            return {
                value: dom.find('input').val()
            }
        };
        
        // Always return the input variable.
        return input;
    }
})(vcJquery, ContentBlocks);
```` 
Each of the individual content blocks that are inserted into the canvas are created as separate instances of your JavaScript function. This means that you can persist data to `this` (`input`) between interactions.

When something changes in your Input that changes the height of the field, you will need to call `ContentBlocks.fixColumnHeights()`; function so the column heights are re-calculated. If a value that is not in an `<input>`, `<textarea>` or `<select>` changes, you will also need to call `MODx.fireResourceFormChange();` to make sure the save button is enabled.

### Modal Windows

If you need to open a modal window, you can use the super simplistic ContentBlocks modals. These are opened with the `ContentBlocks.openModal()` function and closed with `ContentBlocks.closeModal()`. There can only ever be a single ContentBlocks modal open, any modals not yet closed before a next call to openModal will be closed.
```` JS
var html = '<p>This is a modal! <a href="#" class="go-away">Close</a></p>',
    title = 'My First Modal',
    options = {
        width: '100px', // defaults to 70%
        initCallback: function(modal, options) {
            // modal contains the inserted DOM, useful for initiating listeners
            modal.find('.go-away').on('click', ContentBlocks.closeModal);
        }
    };
ContentBlocks.openModal(title, html, options);
````
## The Template

 We already saw the template being loaded in the Input Class, but we haven't defined it yet. The Input Class was looking in core/components/myawesomeinput/templates/my\_awesome\_input.tpl so create a new file there. This template will be compiled and used with the [tmpl javascript template library](https://github.com/blueimp/JavaScript-Templates). The [readme contains syntax instructions here](https://github.com/blueimp/JavaScript-Templates#templates-syntax), but it mostly boils down to:

- Use `{%=o.field_something_here%}` to refer to field data. For example `{%=o.name%}` or `{%=o.value%}` or `{%=o.properties.some_property%}`
- To insert data _without_ escaping entities (i.e. to insert actual html instead of interpreting it as text) use `{%#o.field_something_here%}` (note the # instead of =).
- To use lexicon values, use `{%=_('contentblocks.lexicon_key')%}` - the lexicon topic it is in has to be loaded into the manager.

 Below you'll find a simple example of a template.
```` HTML
<div class="contentblocks-field contentblocks-field-text">
    <div class="contentblocks-field-actions"></div>
    <label for="{%=o.generated_id%}_textfield">{%=o.name%}</label>
    {% if (o.content_desc) { %}
        <p class="content-field-description">{%=o.content_desc%}</p>
    {% } %}
    <div class="contentblocks-field-text contentblocks-field-text-input">
        <input type="text" id="{%=o.generated_id%}_textfield" value="{%=o.value%}">
    </div>
</div>
````
 There are a couple of important classes/divs that you NEED to include:

- The outermost `<div>` needs to have a class of `contentblocks-field`
- As first div inside the `.contentblocks-field` div, you need to have a `.contentblocks-field-actions` div. If you have no special actions to show in the top right you can leave the div empty, otherwise you can add `<a>` tags to it. ContentBlocks will automatically add a button for deleting the field and managing field settings (if there are any) to this div.

On top of the required markup, there are some useful classes/hooks you can use as well, depending on what your input will do.

- Adding an `<a class="contentblocks-field-button">` will create a nice button. Optionally also add a `big` class to it as well will make it a bigger button.
- Add a `contentblocks-drop-target` class to the `.contentblocks-field` div if your input accepts files to be dropped on it. This will add a background to the field when a drag is detected, and a different color background when the drag is actually over the input. You still need to handle the drop even yourself; depending on the use case we suggest using the (included) [jQuery File Upload Plugin](https://github.com/blueimp/jQuery-File-Upload). Look at the image or Gallery input types for inspiration.
- If you need to load data over AJAX when the field is added, you can add a `<div class="contentblocks-loader"></div>` BEFORE the `.contentblocks-field` div. In your init javascript function call `dom.addClass('contentblocks-field-loading')`, and remove that class again with `dom.removeClass('contentblocks-field-loading')` when everything is loaded. See the snippet or chunk input types for inspiration.
- If you have a form in a modal, the styling is not automatically applied. You can either add a `.contentblocks-modal-field` class to a wrapping div in the modal, or add the `.contentblocks-input` class to the input itself.
- To prevent a part of your input from being a drag target (for reordering fields in the content), simply add the `.prevent-drag` class to that part or a wrapper div. Be sure not to add that class to the outmost `.contentblocks-field` as then users wont be able of changing the position of your input type.

To show the content description, added in v1.12, you will need to add the following in the correct place. Typically this is inserted between the label and an input type, but you may chosoe a more appropriate location based on the type of input type.

```html
{% if (o.content_desc) { %}
    <p class="content-field-description">{%=o.content_desc%}</p>
{% } %}
```

If you're replicating (part of) what other inputs are doing, be sure to check out the source code of that input to see if there are any other specific classes/methods you can use to achieve the same effect. Chances are there is. All core inputs are located in assets/components/contentblocks/js/inputs/ - the unminified files are there as well - and templates in core/components/contentblocks/templates/inputs/.

## The Plugin

The final piece of the puzzle! The Plugin lets ContentBlocks know about your input type by hooking into the ContentBlocks\_RegisterInputs event, and responding with an array of custom input types.

In your plugin, you will need to instantiate your custom input class and, passing your custom input reference as key, output an array to the event. Here's how it's done:
```` PHP
<?php
/**
 * @var modX $modx
 * @var ContentBlocks $contentBlocks
 * @var array $scriptProperties
 */
if ($modx->event->name == 'ContentBlocks_RegisterInputs') {
    // Load your own class. No need to require cbBaseInput, that's already loaded.
    $path = $modx->getOption('myawesomeinput.core_path', null, MODX_CORE_PATH . 'components/myawesomeinput/');
    require_once($path . 'elements/inputs/my_awesome_input.class.php');
    
    // Create an instance of your input type, passing the $contentBlocks var
    $instance = new MyAwesomeInput($contentBlocks);
    
    // Pass back your input reference as key, and the instance as value
    $modx->event->output(array(
        'my_awesome_input' => $instance
    ));
}
````