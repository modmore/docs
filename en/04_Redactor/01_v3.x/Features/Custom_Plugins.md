With Redactor 3 for MODX you can also use [custom Redactor.js plugins](https://imperavi.com/redactor/examples/creating-plugins/sample-plugin/). 

## Loading custom plugins

To load a plugin you need to do two things.

- Add the URL to your plugin.js file to the `redactor.js` system setting. That system setting support comma-separating URLs, if you need multiple files. 
- In the configurator, under Miscellaneous, add the name (only the name!) of your plugin to the Additional Plugins option. 

If your plugin requires custom CSS, you can use the `redactor.css` setting to load that. Make sure to scope your CSS appropriately as it will be loaded automatically across the MODX manager. [Learn more about custom styling](Custom_CSS).

## Building custom plugins

We're not going to cover all it takes to build a Redactor.js plugin. But here's an example of adding a button that pops up an alert:

```js
(function($R)
{
    $R.add('plugin', 'alert', {
        init: function(app)
        {
            this.toolbar = app.toolbar;
            this.source = app.source;
        },

        start: function() {
            var pos = this.toolbar.buttons.indexOf('alert'),
                prev = null;
            if (pos >= 1) {
                prev = this.toolbar.buttons[pos - 1];
            }
            var $button = this.toolbar.addButtonAfter(prev, 'alert', {
                title: 'Alert',
                api: 'plugin.alert.doAlert'
            });
            $button.setIcon('<i class="icon icon-warning"></i>');
        },

        doAlert: function() {
            window.alert('You\'ve now been alerted!')
        }
    });
})(Redactor);
```

While a little more verbose than the examples offered by Imperavi, the code above makes sure that the user can decide where the button is inserted in the toolbar rather than only being appended to the end.
