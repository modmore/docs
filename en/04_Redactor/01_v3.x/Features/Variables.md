Variables lets you define non-editable placeholders to insert into the content. 

Once a variable is insert, it can be changed to other variables or removed, but their text remains fixed.

This is useful when users want to add (simple) MODX tags (e.g. `[[*pagetitle]]`, `[[$something.else]]`) in a way that prevents them from accidentally breaking it.

To specify variables, enter them in your configuration set under **Text Utilities > Variables**, separating each variable with a comma.

Variables are saved with a `<span data-redactor-type="variable">` wrapper to make sure that the variable remains uneditable when the page is reloaded.