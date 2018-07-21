# Making Custom Products

Commerce provides commonly used fields out the of box for products, however, chances are you will want to add more fields to suit how you manage products on your store. Due to its extendable nature, Commerce makes it a breeze to create custom products and custom product type fields to get you set your custom products set up in no time!

## Setup

The easiest way to get started with any module is to clone the module skeleton through composer. Composer will automatically set up your workspace for making your custom product. If you don't already have composer, read the introduction here https://getcomposer.org/doc/00-intro.md for how to install it.

You'll need to create subdirectory with the name you want your custom product to be called. This name will be used for the file structure and default namespaces in your project. For this example, we are going to use "quadrovariationproduct". Using composer, you will create the project using the package modmore/moduleskeleton and put it into your directory.

```
composer create-project modmore/moduleskeleton quadrovariationproduct
```

After running composer create-project, you can navigate into your subdirectory to see 3 new folders: _bootstrap, _build, and core. These folders serve a few different purposes.

- `_bootstrap`: contains a file, index.php, to get your workspace setup. It will register your module within Commerce, set up system settings (located inside `_build/data/settings.php`), and configure namespaces.
- `_build`: contains two primary files: build.schema.php and build.transport.php. The build schema file parses your schema which can contain definitions to extend built in commerce objects as well as making custom tables. The build transport file is used when you are ready to build a transport package of your module.
- `core/components/commerce_quadrovariationproduct`: contains everything that makes the module work. This is where you'll spend most of your time developing your module.

## Extending comProduct
