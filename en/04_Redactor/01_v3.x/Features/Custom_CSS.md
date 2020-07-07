In certain cases you'll want to load a custom CSS stylesheet for use in the editor. For example when you provide [custom formatting options](Custom_Formatting), [image styles](Image_Styles), [link styles](Link_Styles) or a [completely custom theme](../Themes/Custom).

To do this, create a CSS file in your preferred location (such as `/assets/template/editor.css`) and add a fully qualified link to the `redactor.css` system setting.

If needed, you can add multiple CSS files to the `redactor.css` system setting; simply separate them with a comma. 

**Scope all your custom styles to `.redactor-box` to avoid causing side-effects in the manager.**

For example:

``` css
.redactor-box h3.my_special_class {
    color: #ff9900;
    font-weight: bolder;
}
```

Some HTML structures have a slightly different representation in the editor than their final output and the source view. It can be useful to use the browser developer tools to inspect the way the content is rendered in such cases. 

If you have a common set of styles that you use in the editor, please [share it with others on the forum](https://forum.modmore.com/c/redactor)