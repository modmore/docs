The Commerce front-end and admin are both built with the Twig templating language. 

Twig is similar to the MODX template language, however it's more powerful as it allows conditionals, loops and custom functions. Twig templates are also stored in files, which makes it easier to edit with an IDE like WebStorm, Sublime Text or Notepad++. Files are also easier to include in version control systems like git, making deployments easier. 

## Default Template Files

The default templates for Commerce are stored in `core/components/commerce/templates/default/`. **The files in this folder are overwritten on upgrade.** 

## Overriding Template Files

To override template files, create a new folder in `core/components/commerce/templates/` and create files with the same name as the files in the default folder. Set the `commerce.theme` setting to the name of your directory. 

For example to change the cart, copy the file `core/components/commerce/templates/default/frontend/checkout/cart.twig` to `core/components/commerce/templates/my-theme-name-here/frontend/checkout/cart.twig` and make your changes there.


**Alpha Note**: We have some ideas on adding an interface to manage your theme via the Commerce admin in the MODX manager, however it's unsure if this will be ready before the 1.0 release or not. 

## Custom Theme Folder

To be added. 
