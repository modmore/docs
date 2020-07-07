The source mode is shown when clicking the HTML icon in the toolbar and lets you see/change the raw HTML source for the content.

## Enable source mode

To enable it, make sure "Allow Source Mode" is enabled in the Source section of the configurator, and add `html` to your toolbar buttons under Toolbar where you want the button to be available. 

## Syntax highlighting

If desired, you can enable CodeMirror syntax highlighting for easier use of the source. Under the "Source" section of the configurator, make sure "Enable CodeMirror" is enabled.

## Beautifying source code

By enabling _Beautify source code_ in the Source section, the markup can be reformatted for you, adding the proper indentation and newlines and such. This uses [js-beautify](https://github.com/beautify-web/js-beautify). 

Beautifying the markup will happen at most once every 3 seconds while editing content. It can also be forced by toggling the source view. If you're experiencing performance issues on large pages, please contact support.
