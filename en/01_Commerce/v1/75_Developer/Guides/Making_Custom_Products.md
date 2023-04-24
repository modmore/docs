Commerce provides commonly used fields out the of box for products, however, chances are you will want to add more fields to suit how you manage products on your store. Due to its extendable nature, Commerce makes it a breeze to create custom products and custom product type fields to get you set your custom products set up in no time! 

In this guide we are going to make a simple custom product called Doodles that adds a shirt size select field and shirt color text field to the product form. You can see the [completed module on github](https://github.com/modmore/Commerce_DoodleProduct/).

Before making custom products it helps to have a basic idea of how MODX extras are made. The concepts of making a Commerce module and a MODX extra are very similar.

## Setup

The easiest way to get started with any module is to [clone the module skeleton through composer](https://github.com/modmore/Commerce_ModuleSkeleton). Composer will automatically set up your workspace for making your custom product. If you do not already have composer, [read the introduction here](https://getcomposer.org/doc/00-intro.md) for how to install it on your system.

You will need to create a subdirectory with the name you want your custom product to be called. This name will be used for the file structure and default namespaces in your project. For this example, we are going to use `doodleproduct`. Using composer, you will create the project using the package modmore/moduleskeleton and put it into your directory.

```
composer create-project modmore/moduleskeleton doodleproduct
```

After running composer create-project, you can navigate into your subdirectory to see 3 new folders: `_bootstrap`, `_build`, and `core`. These folders serve a few different purposes.

- `_bootstrap`: contains a file, index.php, to get your workspace setup. It will register your module within Commerce, set up system settings (located inside `_build/data/settings.php`), and configure namespaces.
- `_build`: contains two primary files: `build.schema.php` and `build.transport.php`. The build schema file parses your xPDO schema which can contain definitions to extend built-in commerce objects (such as the product we are making) as well as making custom tables. The build transport file is used when you are ready to build a transport package of your module.
- `core/components/commerce_doodleproduct`: contains everything that makes the module work, such as `src` (for source files), `model` (for your schema and model classes), and `lexicon`. This is where you will spend most of your time developing your module.

You can symlink these directories into your MODX installation, or if you're familiar with building packages for MODX, you can copy the `config.core.php` file from your MODX installation to the root of the skeleton, and point MODX to your own directory with commerce_doodleproduct.core_path and commerce_doodleproduct.assets_url system settings. The bootstrap, which we'll run in a moment, will do that for you automatically.

### Package Details

Once you run the build schema file later on in this guide, it will automatically generate the files to make your product. These files include package details, such as your name and email. This can be customized by editing the `_build/build.schema.php` file and replacing "Copyright YEAR by Your Name \<your@email.com\>" with your name and email address.

### Namespace

The skeleton uses the ThirdParty namespace by default. Currently, there is no way to automatically change this during project creation, so you will need to edit a few files. Let's change the namespace from ThirdParty\Doodleproduct to Doodles\DoodleProduct.

The files that will have to changed are:

- `_bootstrap/index.php` on line 109
- `_build/resolvers/loadmodules.resolver.php` on line 20
- `core/components/commerce_doodleproduct/composer.json` on line 2
- `core/components/commerce_doodleproduct/src/Module.php` on line 3

After changing the namespaces in these files, go into the `core/components/commerce_doodleproduct` directory and run `composer dump-autoload` to refresh the namespace in the Composer vendor files.

### Module Information

When your module is registered inside Commerce it will include the name of the module, the author's name, and a short description. Inside the module's core folder in `src/Modules/Doodleproduct.php` you can configure the author name in the getAuthor function. 

To change the name and description of the module, edit the existing lexicons in `lexicon/en/default.inc.php`(as well as creating other lexicons for any other languages you want to support with your module).

### Bootstrap

Now that you have configured your package details you can run the the file `_bootstrap/index.php` to set up your package and make it visible to Commerce. Make sure to add a `config.core.php` file in the root of your project that points to your MODX installation. You should see the following output if it was successful: 

```
Loading modX...
Initializing manager...
Done.
```

If you need to add more settings again down the line, you can safely re-run it again, it will not duplicate any existing settings or namespaces.

## Extending comProduct

Now that you have your module set up, you can extend comProduct. While extending comProduct may sound scary, it is relatively simple. Extending comProduct allows you to modify built in methods of getting data in Commerce as well as adding new fields to a product. To edit the schema, open the file inside your module's core folder under `model/schema`. This is where you will define your extensions and custom tables.

The schema included with the skeleton has a few examples commented out. For extending comProduct, you will only need to uncomment the line `<!-- <object class="DoodleproductProduct" extends="comProduct" /> -->` and optionally change the name of the class if you wanted. Save the schema file, then run the `build.schema.php` file in your `_build` folder to automatically generate the required files. You will see a new folder, `model/commerce_doodleproduct`, which contains the file `doodleproductproduct.class.php` with an empty class. This file is where you will be adding all your product logic.

Going back to `src/Modules/Doodleproduct.php`, you will need to uncomment these three lines directly underneath "// Add the xPDO package, so Commerce can detect the derivative classes":

```PHP
$root = dirname(dirname(__DIR__));
$path = $root . '/model/';
$this->adapter->loadPackage('commerce_doodleproduct', $path);
```

This allows Commerce to detect and load your extended product.

## Adding Custom Fields

The form field system in Commerce makes it simple to add powerful fields to a product form with its [built in form fields](https://docs.modmore.com/en/Commerce/v1/Developer/Admin/Form_Fields.html). For this product, we are going to add a select field to choose a shirt size and a text field for the color of the shirt.

Inside your `doodleproductproduct.class.php` file, you will want to add a few lines to the top of the file so you can create the form fields without typing the full class name.

### Adding the Fields

```PHP
use modmore\Commerce\Admin\Widgets\Form\SelectField;
use modmore\Commerce\Admin\Widgets\Form\TextField;
use modmore\Commerce\Admin\Widgets\Form\Tab;
```

To define the custom fields you will need to create a new method, getModelFields, inside your class. Inside this method, you will need to call the parent getModelFields function to fetch all parent fields in an array, since we want to inherit all the existing fields of comProduct (name, description, price, etc). So far we have:

```PHP
public function getModelFields()
{
    $fields = parent::getModelFields();
}
```

Next, you can add the new text fields and select fields in a new array inside getModelFields.

```PHP
$newFields = [];

// Add a new tab

$newFields[] = new Tab($this->commerce, [
    'label' => $this->adapter->lexicon('commerce_doodleproduct.shirt_tab')
]);

// Add a select field
$newFields[] = new SelectField($this->commerce, [
    'label' => $this->adapter->lexicon('commerce_doodleproduct.shirt_size'),
    'name' => 'properties[shirt_size]',
    'value' => $this->getProperty('shirt_size'),
    'options' => [
        ['value' => 'S', 'label' => $this->adapter->lexicon('commerce_doodleproduct.shirt_s')],
        ['value' => 'M', 'label' => $this->adapter->lexicon('commerce_doodleproduct.shirt_m')],
        ['value' => 'L', 'label' => $this->adapter->lexicon('commerce_doodleproduct.shirt_l')],
        ['value' => 'XL', 'label' => $this->adapter->lexicon('commerce_doodleproduct.shirt_xl')]
    ]
]);

// Add a text field
$newFields[] = new TextField($this->commerce, [
    'label' => $this->adapter->lexicon('commerce_doodleproduct.shirt_color'),
    'name' => 'properties[shirt_color]',
    'value' => $this->getProperty('shirt_color')
]);
```

**Notice that we are using lexicons, so you will need to define them in your lexicon files for them to show the correct value**. To save time, you can [download the lexicons](https://github.com/modmore/Commerce_DoodleProduct/blob/master/core/components/commerce_doodleproduct/lexicon/en/default.inc.php) from the completed Doodleproduct.

There are a few options you'll have to keep in mind when adding the fields as shown above. 

- label: shows to the left of the input field in the product form. It can be a string, but it is recommended to use lexicons.
- name: property value the field is saved under inside the product.
- value: gets the current value of the field
- options: array of values and labels to display in a dropdown select field. The value gets stored with the product, and the label can be strings, but like labels, it is recommended to use lexicons.

You will also notice we are adding a new tab to hold our shirt options. You do not need to put new fields in a new tab, but it helps for organization.

For more details of available options for fields, [view all the available options](https://docs.modmore.com/en/Commerce/v1/Developer/Admin/Form_Fields.html#page_Available+Options).

### Merging with Existing Fields

Now that you have defined your new fields, you will need to merge them with the existing fields in the fields array and return them. That can be done with a simple array_merge to add the new fields to the end of the array.

```PHP
return array_merge($fields, $newFields);
```

If you would like to insert fields at specific locations, instead of appending them at the end, you can use PHP's `array_shift` functions to shuffle things around. [An example of this can be found in the RandomlyPricedProduct sample](https://github.com/modmore/Commerce_RandomlyPricedProduct/blob/master/core/components/commerce_randomlypricedproduct/model/commerce_randomlypricedproduct/randomlypricedproduct.class.php#L68).

## Adding Products

All the fields are now added to your product; next you need to enable your module in the Commerce dashboard => configuration => Modules. Look for your module in the list and click it to enable it in test in the modal that appears.

Your extended product will now appear when adding products under the "Type" dropdown in the product form. Since we added a new tab, the new shirt size and shirt color fields will be in the shirt tab you created above.

## Making a Transport Package

To make a transport package of your product, you will need to run the the file `_build/build.transport.php`. This will generate a transport package inside the `_packages` folder in your MODX directory.

One thing to keep in mind when making a transport package is if you have any settings defined. If you do not have any settings defined, you will have to modify your transport file, otherwise it will fail. You can take a look at the completed Doodleproduct [example build transport script](https://github.com/modmore/Commerce_DoodleProduct/blob/master/_build/build.transport.php#L64) to get an idea of how to modify it.

## Displaying your Product

After you have entered a few products, you are probably going to need to display them on the front end. Using the included `commerce.get_product` snippet you can get products as well as the custom fields you added.

In the example below, the custom fields you added are accessible in the `item.properties` placeholder.

```HTML
[[commerce.get_product? &product=`1` &toPlaceholders=`item`]]

<p>Name: [[+item.name]]</p>
<p>Description: [[+item.description]]</p>
<p>T-Shirt Size: [[+item.properties.shirt_size]]</p>
<p>T-Shirt Color: [[+item.properties.shirt_color]]</p>
```

## Support

If you have questions or got stuck on this tutorial, post on our [community forum](https://forum.modmore.com/c/commerce) or chat with us on the [MODX Slack](https://modx.org) (#modmore). We are here to help!
