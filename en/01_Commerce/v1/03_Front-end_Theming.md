The Commerce front-end and admin are both built with the Twig templating language. 

Twig is similar to the MODX template language, however it's more powerful as it allows conditionals, loops and custom functions. With these features you get more flexibility in output, while drastically reducing the number of individual templates needed. [Learn more about the Twig syntax and features here](http://twig.sensiolabs.org/doc/2.x/templates.html). 

The Commerce templates are stored in files, which makes it easier to edit with an IDE like WebStorm/PhpStorm, Sublime Text or Notepad++. Files are also easier to include in version control systems like git.

[TOC]

## Disabling the Default CSS

Commerce includes a very simple cart and checkout design out of the box. To disable it, set the `commerce.register_checkout_css` system setting to 0. 

## Default Template Files

The default templates for Commerce are stored in `core/components/commerce/templates/default/`. **The files in this folder are overwritten on upgrade**, so do not edit them.  

## Overriding Template Files

To override template files, create a new folder in `core/components/commerce/templates/` and create files with the same name as the files in the default folder. Then set the `commerce.theme` setting to the name of your directory. 

For example you might create a directory `core/components/commerce/templates/premiumshirts/` and set the `commerce.theme` setting to `premiumshirts`.

With the directory in place, you can copy files from their location in the defaults folder, to the same location in your own theme folder. To edit the cart you would copy `core/components/commerce/templates/default/frontend/checkout/cart.twig` to `core/components/commerce/templates/premiumshirts/frontend/checkout/cart.twig` and make your changes there.

## Custom Theme Folder

It's also possible to place your theme folder outside the Commerce directories. This is recommended, but as shown before not necessary.

The setting you'll need to update for this is `commerce.themes_path`. Set this to a fully qualified server path that **contains** your theme directory. It's possible to use `{base_path}` and `{core_path}` values to make the path relative to the base or core path respectively.

To give an example, if you want your theme files in `assets/templates/webshop/`, you would set:

- `commerce.theme` to `webshop`
- `commerce.themes_path` to `{base_path}assets/templates/` - note the trailing slash is required.

## Theme inheritance

Assuming `commerce.theme` is set to `webshop` and `commerce.themes_path` is set to `{base_path}assets/templates/`, Commerce will check for matching template files in the following order. 

1. `{base_path}assets/templates/webshop/`
2. `{core_path}components/commerce/templates/webshop/`
3. `{core_path}components/commerce/templates/default/`

If it finds the requested template file, it stops there, otherwise it checks the next path. This means you only have to copy the templates you're actually customising; any others will simply fall back to the default. 

## Different themes per Context

With Contexts in MODX, you can use different Commerce themes for different contexts. To use this, create `commerce.theme` and/or `commerce.themes_path` context settings for the specific context. 

Note that the Commerce admin area will not use context-specific themes unless you specify the setting on the `mgr` context. We don't recommend making changes to the manager dashboard for now, to ensure things don't break in a weird way while we continue to evolve that.

## Different themes for User (Groups)

Another fun trick is to set specific themes on specific users or user groups in the same way as context settings, by adding the `commerce.theme` and/or `commerce.themes_path` setting to a user or user group.
 
Due to the MODX setting inheritance, user or user group settings will take priority over context and system settings. 

It's not recommended to do this for customer user (groups), however it could be useful for allowing admin users to preview a new theme when the site is live. Keep in mind though that the users need to be logged in to the frontend (e.g. using the Login snippet) for this to work.
