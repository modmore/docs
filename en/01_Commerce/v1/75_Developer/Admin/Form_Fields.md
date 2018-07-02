The Commerce admin area is built HTML-first, which means that all forms and fields are defined in PHP.

You might need to define forms and fields if you're adding pages to the admin area, or when building [extended models](../Extended_Models) that support the `getModelFields()` method (e.g. [custom shipping methods](../Custom_Shipping_Methods)).

Fields are self-contained classes that are created with options provided in the constructor, which handles validation and providing the markup. 

Here's a simple example of defining a text field. 

````php
$field = new \modmore\Commerce\Admin\Widgets\Form\TextField($this->commerce, [
     'label' => 'My Field Label',
     'name' => 'field_name',
 ]);
````

To define validation rules, provide a `validation` option containing an array of validation classes. For example:


````php
$field = new \modmore\Commerce\Admin\Widgets\Form\TextField($this->commerce, [
     'label' => 'My Field Label',
     'name' => 'field_name',
     'validation' => [
         new modmore\Commerce\Admin\Widgets\Form\Validation\Required(),
         new modmore\Commerce\Admin\Widgets\Form\Validation\Length(3, 250),
     ]
 ]);
````

(Obviously for readability, it'd be best to import those classes with a `use` statement)

### Available Field Types

- **Checkbox** (`modmore\Commerce\Admin\Widgets\Form\CheckboxField`), a simple true-or-false checkbox. 
- **Country** (`modmore\Commerce\Admin\Widgets\Form\CountryField`), a dropdown select field displaying a list of countries.
- **CountryPrice** (`modmore\Commerce\Admin\Widgets\Form\CountryPriceField`), a field for inputting a country and a price for the country.
- **Class** (`modmore\Commerce\Admin\Widgets\Form\ClassField`), a field that acts as either a Select or Hidden field. This field accepts a `parentClass` option (which contains the name of an xPDO class), and it will then prepare a select field with the available derivative classes. For example setting `'parentClass' => 'comShippingMethod'` will show a select with the available shipping methods. If only a single value is available, the field hides itself.
- **Date** (`modmore\Commerce\Admin\Widgets\Form\DateField`), a field for entering a date.
- **DateTime** (`modmore\Commerce\Admin\Widgets\Form\DateTimeField`), a field for entering a date and a time.
- **DeliveryType** (`modmore\Commerce\Admin\Widgets\Form\DeliveryTypeField`), a dropdown select field containing available delivery types.
- **Description** (`modmore\Commerce\Admin\Widgets\Form\DescriptionField`), a field that displays a label and description.
- **Hidden** (`modmore\Commerce\Admin\Widgets\Form\HiddenField`), a simple hidden field.
- **Image** (`modmore\Commerce\Admin\Widgets\Form\ImageField`), an image field allowing selection from a media source or by entering a URL.
- **Number** (`modmore\Commerce\Admin\Widgets\Form\NumberField`), a simple field that only accepts numeric values. 
- **Password** (`modmore\Commerce\Admin\Widgets\Form\PasswordField`), a simple field that accepts any text value while masking the value from the user.
- **ProductQuantity** (`modmore\Commerce\Admin\Widgets\Form\ProductQuantityField`), a field for inputting an existing product from a select field and quantity for the product.
- **Section** (`modmore\Commerce\Admin\Widgets\Form\SectionField`), a separator that can be used for sectioning a form. The `label` value is shown in a heading.
- **Select** (`modmore\Commerce\Admin\Widgets\Form\SelectField`), a dropdown select field. Options are provided in the `options` option in the form of an array. Each element in the array needs a `value` and `label` key.
- **SelectMultiple** (`modmore\Commerce\Admin\Widgets\Form\SelectMultipleField`), a dropdown multi-select field. Options are provided in the `options` option in the form of an array. Each element in the array needs a `value` and `label` key. Returns a comma seperated list of values.
- **TaxRuleCondition** (`modmore\Commerce\Admin\Widgets\Form\TaxRuleConditionField`), a field for inputting a country and a condition to apply to the country.
- **Textarea** (`modmore\Commerce\Admin\Widgets\Form\TextareaField`), a simple textarea field for longer pieces of text.
- **Text** (`modmore\Commerce\Admin\Widgets\Form\TextField`), a simple text field.
- **WeightPrice** (`modmore\Commerce\Admin\Widgets\Form\WeightPriceField`), a field for inputting a weight from and weight until with a price.
- **WeightUnit** (`modmore\Commerce\Admin\Widgets\Form\WeightUnitField`), a field for inputting a weight unit.

### Available Options

The following options are supported on each field:

- `name`: the name that the field with post with.
- `label`: the text to place by the field that tells the merchant what it's for. This doesn't automatically use lexicons, so set it to a value like `$this->adapter->lexicon('my_translated_key')` to get a localised label.
- `description`: a longer description, shown below the field, that explains a bit more context about the field.
- `value`: the current value for the field. It's rarely needed to specify this directly (the `getModelFields()` method is a good exception). If the `name` doesn't match the database column the value is stored in, you can link that by setting the value. 
- `default`: a default value to use in case there is no value otherwise already available.
- `validation`: an array of Validation Rule objects. 

Typically, these values are set via the constructor, like in the previous example:


````php
$field = new \modmore\Commerce\Admin\Widgets\Form\TextField($this->commerce, [
     'label' => 'My Field Label',
     'name' => 'field_name',
     'validation' => [
         new modmore\Commerce\Admin\Widgets\Form\Validation\Required(),
         new modmore\Commerce\Admin\Widgets\Form\Validation\Length(3, 250),
     ]
 ]);
````

It's also possible to use setters. These are `setName`, `setLabel`, `setDescription`, `setValue`, `setDefault` and `setValidationRules`. They all accept the same type of value as the constructor options. For example:


````php
$field = new \modmore\Commerce\Admin\Widgets\Form\TextField($this->commerce, []);
$field->setLabel('My Field Label');
$field->setName('field_name');
$field->setValidationRules([
     new modmore\Commerce\Admin\Widgets\Form\Validation\Required(),
     new modmore\Commerce\Admin\Widgets\Form\Validation\Length(3, 250),
 ]);
````

Generally speaking the constructor options approach is preferred in the core.

### Validation Rules

The following validation classes exist which can be passed to a field.

- **Enum** (`modmore\Commerce\Admin\Widgets\Form\Validation\Enum`) can be used to make sure the value is in a set of accepted values. Not necessary with a select field, that already catches that by default. Provide a simple array of accepted values in the constructor.
- **Length** (`modmore\Commerce\Admin\Widgets\Form\Validation\Length`) can be used to force a specific limit of text size, both a minimum and a maximum. The first constructor parameter is the minimum length, the second parameter is the maximum length. 
- **Regex** (`modmore\Commerce\Admin\Widgets\Form\Validation\Regex`) can be used to make sure the value matches a certain regex pattern. The pattern is the first parameter, and the second parameter lets you set a specific error string (lexicon).  
- **Required** (`modmore\Commerce\Admin\Widgets\Form\Validation\Required`) can be used to mark a field as required. This uses a loose check with `empty()`, so if 0 is an accepted, non-empty value in your scenario, the Required validation rule is not going to be suitable.

### Examples

Most of these examples are copied straight from the Commerce source code, and may need tweaks before they'll work for you.

All classes are assumed to have been imported with a `use` statement.

#### Color regex validation

````php
$fields[] = new TextField($this->commerce, [
    'name' => 'color',
    'label' => $this->adapter->lexicon('commerce.color'),
    'description' => $this->adapter->lexicon('commerce.status.color_description'),
    'validation' => [
        new Required(),
        new Regex('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', 'commerce.status.color_error'),
    ]
]);
````

#### Select field

```` php
$fields[] = new SelectField($this->commerce, [
    'name' => 'state',
    'label' => $this->adapter->lexicon('commerce.state'),
    'options' => [
        ['value' => 'new', 'label' => $this->adapter->lexicon('commerce.state_new')],
        ['value' => 'processing', 'label' => $this->adapter->lexicon('commerce.state_processing')],
        ['value' => 'completed', 'label' => $this->adapter->lexicon('commerce.state_completed')],
        ['value' => 'cancelled', 'label' => $this->adapter->lexicon('commerce.state_cancelled')],
        ['value' => 'refunded', 'label' => $this->adapter->lexicon('commerce.state_refunded')],
    ],
    'description' => $this->adapter->lexicon('commerce.status.state_description'),
    'validation' => [
        new Required(),
        new Enum(['new', 'processing', 'completed', 'cancelled', 'refunded']),
    ],
    'value' => 'processing'
]);
````

#### Checkbox field

```` php
$fields[] = new CheckboxField($this->commerce, [
    'name' => 'enabled_in_test',
    'label' => $this->adapter->lexicon('commerce.enabled_in_test'),
    'value' => true,
]);
````
