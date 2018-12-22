In Commere 0.12 we introduced a new Order Fields concept. These are values stored with an order, of a specific type. 

These order fields are handled by modules. 

A simple example of adding an order field:

````php
$fld = new \modmore\Commerce\Order\Field\Text($this->commerce, 'some_key', 'My Value');
$order->setOrderField($fld);
````

## Summary

Each field needs the following properties in the constructor:

- The `\Commerce` instance
- The name (key) of the field
- The value of the field, which could be different things depending on the type of field. 

When calling `$order->setOrderField`, if a field with the same name (key) was already added, its value will be overwritten by what you've provided.

To remove an order field, call `$order->removeOrderField($name)`.

To get an existing order field, call `$order->getOrderField($name)`. Alternatively, `$order->getOrderFields()` contains a `name => instance` array with all order fields.

## Field Types

- `\modmore\Commerce\Order\Field\Text`, simple text
- `\modmore\Commerce\Order\Field\Link`, a link. For the value, provide an array with a `link` and `title` key. Make sure the link is a fully qualified URL. (You can also call `setLink($link)` and `setTitle($title)` on the instance instead.)
- `\modmore\Commerce\Order\Field\AdminLink`, similar to the Link order field type, but the link is only available to back-end users and not the customer (on, say, a My Orders section)
- `\modmore\Commerce\Order\Field\Coupon`, used by the Coupons module to record the used coupon and link to its configuration.
- `\modmore\Commerce\Order\Field\Currency`, provided an integer value, this will format it with the current currency.

You can create your own field types too. Implement the `\modmore\Commerce\Order\Field\FieldInterface` interface and look at the `\modmore\Commerce\Order\Field\AbstractField` for inspiration. Make sure that your custom class is available, for example by including it in the autoloader that you ship with a module.

## Display

Custom order fields are automatically displayed in the order view.

To show custom order fields in a "my orders" section, see [the commerce.get_order snippet](../Snippets/get_order).