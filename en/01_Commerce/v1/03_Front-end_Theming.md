The Commerce front-end and admin are both built with the Twig templating language. 

Twig is similar to the MODX template language, however it's more powerful as it allows conditionals, loops and custom functions. With these features you get more flexibility in output, while drastically reducing the number of individual templates needed. [Learn more about the Twig syntax and features here](http://twig.sensiolabs.org/doc/2.x/templates.html). 

The Commerce templates are stored in files, which makes it easier to edit with an IDE like WebStorm/PhpStorm, Sublime Text or Notepad++. Files are also easier to include in version control systems like git.

[TOC]

## Disabling the Default CSS

Commerce includes a very simple cart and checkout design out of the box. To disable it, set the `commerce.register_checkout_css` system setting to 0. Keep in mind that the default template files are made to look decent with these styles.

The default CSS consists of two files, `style.simple.css` and `layout.simple.css`. The source Sass files can be found in `assets/components/commerce/frontend/` - feel free to copy those into your own workflow to get a head-start at customising the design. This folder is overwritten on upgrade.

## Default Template Files

The default templates for Commerce are stored in `core/components/commerce/templates/default/`. **The files in this folder are overwritten on upgrade**, so do not edit them.  

## Overriding Template Files

To override template files, you have two settings at your disposal:

- `commerce.theme` contains the name of the theme directory, like `default`, `premiumshirts`, or `awesomeevents`. 
- `commerce.themes_path` contains the path to the directory that holds themes. You may use placeholders like `{base_path}` and {core_path} here.

So if you set `commerce.theme` to `blueshoes` and `commerce.themes_path` to `{base_path}assets/templates/`, then Commerce will look for template files in `/assets/templates/blueshoes/`. 

Note that the `themes_path` setting must end in a slash.

With that directory in place, you can copy files from their location in the defaults folder, to the same location in your own theme folder. For example, to edit the cart you would copy `core/components/commerce/templates/default/frontend/checkout/cart.twig` to `core/components/commerce/templates/premiumshirts/frontend/checkout/cart.twig` and make your changes there.

**Note: Do NOT copy all directories and files into your own templates folder blindly; only copy the files you're actually changing.** That saves you effort and makes it crystal clear what files are different from the default and may need changes, while also automatically giving you fixes in the default templates where possible.  

**Note2: Do NOT copy/overwrite the admin template directory**. While it's technically possible to change the admin templates the same way as front-end templates, we do not currently support custom admin templating and may at any time introduce backwards incompatible changes if you do copy/change admin templates. Just don't.

## Theme inheritance

Assuming `commerce.theme` is set to `webshop` and `commerce.themes_path` is set to `{base_path}assets/templates/`, Commerce will check for matching template files in the following order. 

1. `{base_path}assets/templates/webshop/`
2. `{core_path}components/commerce/templates/webshop/`
3. `{core_path}components/commerce/templates/default/`

If it finds the requested template file, it stops there, otherwise it checks the next path. This means you only have to copy the templates you're actually customising; any others will simply fall back to the default. 

### Multiple themes (v1.1+)

As of Commerce v1.1, you can define multiple comma-separated themes and theme paths. This is useful when combined with a [starter pack](https://modmore.com/commerce/extensions/theme-red/) or if you have a complex setup with multiple similar themes that still need specific overrides per context (see below). 

Themes and theme paths are checked in the order they are defined, so the left-most option is checked first. 

Assuming `commerce.theme` is set to `webshop, ctred` and `commerce.themes_path` is set to `{base_path}assets/templates/, {core_path}components/commercetheme_red/templates/`, Commerce will check for matching template files in the following order. 

1. `{base_path}assets/templates/webshop/`
2. `{core_path}components/commercetheme_red/templates/webshop/`
3. `{core_path}components/commerce/templates/webshop/`
4. `{base_path}assets/templates/ctred/`
5. `{core_path}components/commercetheme_red/templates/ctred/`
6. `{core_path}components/commerce/templates/ctred/`
7. `{core_path}components/commerce/templates/default/`

Only paths that exist are included in the inheritance. 

If modules have added additional theme paths, to include their own templates into the inheritance tree, those will be checked **after the user-defined theme(s)**, but **before the default**. That allows you to override module-provided template paths, while modules can override defaults. 

### Different themes per Context

With Contexts in MODX, you can use different Commerce themes for different contexts. To use this, create `commerce.theme` and/or `commerce.themes_path` context settings for the specific context. 

Note that the Commerce admin area will not use context-specific themes unless you specify the setting on the `mgr` context. We don't recommend making changes to the manager dashboard, to ensure things don't break in a weird way while we continue to evolve that.

### Different themes for User (Groups)

Another fun trick is to set specific themes on specific users or user groups in the same way as context settings, by adding the `commerce.theme` and/or `commerce.themes_path` setting to a user or user group.
 
Due to the MODX setting inheritance, user or user group settings will take priority over context and system settings. 

It's not recommended to do this for customer user (groups), however it could be useful for allowing admin users to preview a new theme when the site is live. Keep in mind though that the users need to be logged in to the frontend (e.g. using the Login snippet) for this to work.

## Debugging templates

Sometimes you may want to know what exact information is available to you in a specific template. 

First, create or change the `commerce.debug` system setting, and set it to 1. 

Then, in your template, you can use the [dump function](https://twig.symfony.com/doc/2.x/functions/dump.html). For example:

````html
{{ dump() }}
{{ dump(order) }}
````

When you've launched your shop, set `commerce.debug` to 0 to make sure no stray dump functions are used in your templates.
