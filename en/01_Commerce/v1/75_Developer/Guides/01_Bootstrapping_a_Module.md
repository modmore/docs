Extending Commerce always starts with a [module](../Modules). Even if you're not going to be doing anything that's [event-based](../Modules/Events), a Module is a way to load custom models and register custom classes.

In this guide we walk you through using the Module Skeleton to bootstrap the module. At the end of this guide you'll have a module that logs a Hello World. From that point on, you can use the rest of the documentation and projects on the modmore github organisation as inspiration for making amazing extensions.

On this page:

[TOC]

## Setup

The easiest way to get started with any module is to [clone the module skeleton through composer](https://github.com/modmore/Commerce_ModuleSkeleton). Composer will automatically set up your workspace for making your custom product. If you do not already have composer, [read the introduction here](https://getcomposer.org/doc/00-intro.md) for how to install it on your system.

You will need to create a subdirectory with the name you want your custom product to be called. This name will be used for the file structure and default namespaces in your project. For this example, we are going to use `myfirstmodule`. Using composer, you will create the project using the package modmore/moduleskeleton and put it into your directory.

```
composer create-project modmore/moduleskeleton myfirstmodule
```

After running composer create-project, you can navigate into your subdirectory to see 3 new folders: `_bootstrap`, `_build`, and `core`. These folders serve a few different purposes.

- `_bootstrap`: contains a file, index.php, to get your workspace setup. It will register your module within Commerce, set up system settings (located inside `_build/data/settings.php`), and configure namespaces.
- `_build`: contains two primary files: `build.schema.php` and `build.transport.php`. The build schema file parses your xPDO schema which can contain definitions to extend built-in commerce objects (such as the product we are making) as well as making custom tables. The build transport file is used when you are ready to build a transport package of your module.
- `core/components/commerce_myfirstmodule`: contains everything that makes the module work, such as `src` (for source files), `model` (for your schema and model classes), and `lexicon`. This is where you will spend most of your time developing your module.

To hook this up to your MODX installation, copy the `config.core.php` from your MODX installation into the root of the project folder, and create/update the `commerce_myfirstmodule.core_path` and `commerce_myfirstmodule.assets_url` system settings to point to the right directories. The bootstrap, which we'll run in a moment, will do that for you automatically.

Alternatively, it's also possible to use symlinks to copy your directories into the MODX installation. 

### Namespace

The skeleton uses the ThirdParty namespace by default. Currently, there is no way to automatically change this during project creation, so you will need to edit a few files. Let's change the namespace from ThirdParty\Myfirstmodule to Doodles\MyFirstModule.

The files that will have to changed are:

- `_bootstrap/index.php` on line 108
- `_build/resolvers/loadmodules.resolver.php` on line 20
- `core/components/commerce_myfirstmodule/composer.json` on line 7
- `core/components/commerce_myfirstmodule/src/Modules/Myfirstmodule.php` on line 2

The skeleton also comes with a composer autoloader, based on the composer.json file you just edited. Navigate to `core/components/commerce_myfirstmodule/` on the command line and run `composer dumpautoload` to refresh that. Or manually edit: 

- `core/components/commerce_myfirstmodule/vendor/composer/autoload_psr4.php` on line 9
- `core/components/commerce_myfirstmodule/vendor/composer/autoload_static.php` on line 12 and 17

### Package Details

If you'll be adding an xPDO model/package to your extension, you should edit `_build/build.schema.php` to replace the "Copyright 2018 by Your Name \<your@email.com\>" notice before running the build.

### Module Information

When your module is registered inside Commerce it will include the name of the module, the author's name, and a short description. Inside the module's core folder in `src/Modules/Myfirstmodule.php` you can edit the author name in the getAuthor function. 

This file is also where you'll initialize the module, load your custom models, and more, but let's not get ahead of ourselves.

To change the name and description of the module, edit the existing lexicons in `lexicon/en/default.inc.php`, as well as creating other lexicons for any other languages you want to support with your module. 

### Bootstrap

Now that you have configured your package details, run the file `_bootstrap/index.php` to set up your package and make it visible to Commerce. Make sure to add a `config.core.php` file in the root of your project that points to your MODX installation first. 

It's possible to run the bootstrap from both the command line and by opening it in the browser. Note that when using the command line, the `commerce_myfirstmodule.assets_url` is likely incorrect, so you'll need to manually correct that. 

A successful execution looks like this:

```
Loading modX...
Initializing manager...
Done.
```

If you need to add more settings again down the line, you can safely re-run it again, it will not duplicate any existing settings or namespaces.

## And... done!

That should get your module up and running!

Navigate to Extras > Commerce > Configuration > Modules and find your module in the list. If it's not there, there may be an issue with the Composer autoloaderor your module naming (see the step about editing the namespace). If you're not comfortable with Composer, you don't have to use the autoloader, but you'll need to manually add the module to the modx_commerce_modules database table in that case. 

Assuming your module showed up, and you enabled it, let's make it do something. Some ideas...

### Log "Hello World" to the MODX log

Just as a proof of concept, you can log to the MODX log whenever your module is initialized. 

In the `initialize` method in `core/components/commerce_myfirstmodule/src/Modules/Myfirstmodule.php`, add the following line:

```php
$this->adapter->log(1, 'Hello World! This is ' . __FILE__  . ' calling.');
```

### Load an xPDO Model

If you've created an xPDO Model you want to use in Commerce, you should load it in your module's initialize method.

The skeleton provides you with some files to get started with an xPDO model, including:

- A sample schema file in `core/components/commerce_myfirstmodule/model/schema/commerce_projectname.mysql.schema.xml`
- A schema build script, ready to run, in `_build/build.schema.php`

When you've built your schema into model files, add (or uncomment, as it should already be there) the following lines:

``` php
$root = dirname(dirname(__DIR__));
$path = $root . '/model/';
$this->adapter->loadPackage('commerce_myfirstmodule', $path);
```

Those paths match the default locations included in the skeleton, and should work out of the box. 

### Listen to an event

Many actions in Commerce trigger [events](../Modules/Events) that you can interact with from a module. That works by registering a listener on the EventDispatcher that is provided to your module. When registering a listener, you provide it a `callable`, which typically is a method on your Module class.

Let's say we want to know when a customer adds an item to their cart. The event for that is `\Commerce::EVENT_ITEM_ADDED_TO_CART`, so we can add a listener like this:

```php
    public function initialize(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(\Commerce::EVENT_ITEM_ADDED_TO_CART, [$this, 'onItemAddedToCart']);
    }
```

Next, create a new method in your class that matches the callable, in the above example that's `onItemAddedToCart`. That method will be called with an `Event` object, which in this case is `modmore\Commerce\Events\Cart\Item`, which we can typehint for:

```php
    public function onItemAddedToCart(modmore\Commerce\Events\Cart\Item $event)
    {
        $item = $event->getItem();
        $this->adapter->log(1, 'Customer added product ' . $item->get('name') . ' to their cart.');
    }
```

You can see we fetch the `comOrderItem` that was added with `$event->getItem()` and then log the item's name to the MODX error log for testing.

Depending on the event, different data is available. In certain cases you can also return information to an event through setters, but others are "read only". 

## Building a Transport Package

When you're done with your extension, you can build it into a transport package to share it with others. The provided build script in `_build/build.transport.php` covers system settings (see `_build/data/settings.php`), a requirements validator, the files in your core directory (to also include assets, uncomment lines 91-94), and your license, readme, and changelog files. 

If you need to include other data, like snippets or other elements, you can [learn more about build scripts in the MODX documentation](https://docs.modx.com/revolution/2.x/developing-in-modx/advanced-development/package-management/creating-a-3rd-party-component-build-script). 

(If you prefer to use MyComponent, GitPackageManagement, or other build tools, you are of course free to do so. Make sure to include the `_build/resolves/loadmodules.resolver.php` resolver if you build any other way.)

After you built a package and wrote some documentation, you can upload it to MODX.com to share with others. If you're looking to release your extension as a paid extra and can guarantee support and continued development, then we'd also be happy to discuss a potential release on modmore.com. 

## Support

If you have questions or got stuck building a module, please do post on our [community forum](https://forum.modmore.com/c/commerce) or chat with us and the rest of the community on the [MODX Slack](https://modx.org) (#modmore). We are here to help!
