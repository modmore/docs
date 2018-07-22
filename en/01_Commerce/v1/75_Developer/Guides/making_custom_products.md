# Making Custom Products

Commerce provides commonly used fields out the of box for products, however, chances are you will want to add more fields to suit how you manage products on your store. Due to its extendable nature, Commerce makes it a breeze to create custom products and custom product type fields to get you set your custom products set up in no time! In this guide we are going to make a simple custom product called Doodles that adds a text field and select field to the product form.

## Setup

Before making custom products it helps to have a basic idea of how MODX extras are made. The concepts of making a Commerce module and a MODX extra are very similar.

The easiest way to get started with any module is to clone the module skeleton through composer. Composer will automatically set up your workspace for making your custom product. If you don't already have composer, read the introduction here https://getcomposer.org/doc/00-intro.md for how to install it.

You'll need to create subdirectory with the name you want your custom product to be called. This name will be used for the file structure and default namespaces in your project. For this example, we are going to use "doodleproduct". Using composer, you will create the project using the package modmore/moduleskeleton and put it into your directory.

```
composer create-project modmore/moduleskeleton doodleproduct
```

After running composer create-project, you can navigate into your subdirectory to see 3 new folders: _bootstrap, _build, and core. These folders serve a few different purposes.

- `_bootstrap`: contains a file, index.php, to get your workspace setup. It will register your module within Commerce, set up system settings (located inside `_build/data/settings.php`), and configure namespaces.
- `_build`: contains two primary files: build.schema.php and build.transport.php. The build schema file parses your schema which can contain definitions to extend built in commerce objects as well as making custom tables. The build transport file is used when you are ready to build a transport package of your module.
- `core/components/commerce_doodleproduct`: contains everything that makes the module work. This is where you'll spend most of your time developing your module.

### Package Details

When you run the build schema file, it will automatically generate the files needed. These files include package details, such as your name and email. This can be customized by editing the build schema file and replacing "Copyright 2018 by Your Name \<your@email.com\>" with your details.

### Namespace

The skeleton uses the ThirdParty namespace by default. Currently, there is no way to automatically change this during project creation, so you will need to edit a few files. Let's change the namespace from ThirdParty\Doodleproduct to Doodles\DoodleProduct.
The files that will have to changed are:

- `_bootstrap/index.php` on line 108
- `_build/resolvers/loadmodules.resolver.php` on line 20
- `core/components/commerce_doodleproduct/composer.json` on line 7
- `core/components/commerce_doodleproduct/vendor/composer/autoload_psr4.php` on line 9
- `core/components/commerce_doodleproduct/vendor/composer/autoload_static.php` on line 12 and 17
- `core/components/commerce_doodleproduct/src/Modules/Doodleproduct.php` on line 2

### Module Information

When your module is registered inside Commerce it will include the name of the module, the author's name, and a short description. Inside the module's core folder in `src/Modules/Doodleproduct.php` you can configure the author name in the getAuthor function. To change the name and description, edit the existing lexicons in `lexicon/en/default.inc.php`(as well as any other languages you want to support with your lexicons).

## Extending comProduct

Now that you have your module set up, you can extend comProduct. Extending comProduct allows you to modify built in methods of getting data in Commerce as well as adding new fields to a product. To edit the schema, open the file inside your module's core folder under `model/schema`. This is where you'll define your extensions and custom tables.

The schema included with the skeleton has a few examples commented out. For extending comProduct, you will need to uncomment the line `<object class="DoodleproductProduct" extends="comProduct" />`.
