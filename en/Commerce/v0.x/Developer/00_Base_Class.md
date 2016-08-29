title: Base Class
summary: Every object in Commerce extends the comSimpleObject class. This provides a number of convenience methods and features.
-----

Every data object in Commerce extends the `comSimpleObject` object. This extends the `xPDOSimpleObject` class, but provides various convenience methods and under-the-hood magic to make the code easier to maintain and more flexible.

The `comSimpleObject` object also uses feature of xPDO to allow derivative objects (basically, sub-classes of the models). This is done by setting the derivative `class_key` field on an object instance, available on every object in Commerce, which then automatically loads the right object based on the class key when it is retrieved. The most common example of this feature is the `modResource` object which has `modDocument`, `modWebLink` and other derivatives.

The `comSimpleObject` - and thus all derivatives - also has a `properties` field which will store a serialised array of data. This is primarily meant for extended objects that need to store _some_ extra information, but don't need  filtering/searching on that information, where a separate table would be more appropriate and performant. See the section _Dealing with Properties_ below.

The base object provides easy access to the Commerce service class through `$this->commerce` and the [MODX adapter](MODX_Adapter) via `$this->adapter`. While it also has `$this->xpdo` available, we recommend using the adapter as much as possible.

## Value Formatting

For consistency in output, value formatting is done automatically in the `comSimpleObject` class and its derivatives. 

For applicable fields, the schema defines a `formatter` which is automatically run when all object values are loaded with `$object->toArray()`. The automatically formatted values are always suffixed with `_formatted`, so a key of `price` would be available as `price_formatted`. `$object->get('price_formatted')` will also return the formatted price value. 

It is also possible to manually format a value through `$object->formatValue($value, $formatter)`, where `$formatter` is one of the formattes mentioned below.

- **financial**: formats a number that represents a price. The value needs to be in cents. This method uses the php native `number_format` function, where the currency sign, decimal point and thousands separator are configurable through the Commerce system settings (`commerce.currency_sign`, `commerce.decimal_point` and `commerce.thousands_separator` respectively). A value of `1234` would in the default situation result in a formatted value of `€12.34`.

- **percentage**: formats a number that represents a percentage. The value is expected to be a float or a string with a period (.) to separate the decimal numbers. If the decimals are zero, it will return only the percentage (e.g. `15.00` becomes `15%`), otherwise they are included with as many decimals as the provided value (e.g. `15.123` becomes `15.123%`).

- **boolean**: returns a translated "yes" or "no" value for a boolean-ish value (e.g. 1 or 0).

- **filesize**: formats a number in bytes into a more human readable file size. This will look at the size to determine the right unit (GB, MB etc) and uses the `commerce.decimal_point` setting to determine the decimal sign.

- **datetime**: formats a unix timestamp into a full date and time string, respecting the systems locale. The default format is `%Y-%m-%d at %H:%M:%S %Z` and can be configured to any [strftime compatible format](https://php.net/strftime) with the `commerce.datetime_format` setting.

- **date**: formats a unix timestamp into a full date string, without the time, respecting the systems locale. The default format is `%Y-%m-%d` and can be configured to any [strftime compatible format](https://php.net/strftime) with the `commerce.date_format` setting.

- **time**: formats a unix timestamp into a time string, respecting the systems locale. The default format is `%H:%M:%S %Z` and can be configured to any [strftime compatible format](https://php.net/strftime) with the `commerce.time_format` setting.

## Dealing with Properties
**Do not interact with the properties field directly**, to ensure that if we decide to move it to a dedicated table (for, say, better indexing and searchability) your code wont break. 

Instead, use the following convenience methods available on every object.

- `getProperty($key, [$default = null])`: gets a single property as indicated by `$key`, or the `$default` value if it is not set.

- `getProperties()`: returns an array of all properties that apply to the current object.

- `setProperty($key, [$value = null])`: set a property `$key` with value `$value`.

- `setProperties($properties, [$merge = true])`: sets an array of properties on the current object. When `$merge` is set to false, it will overwrite existing properties. When `$merge = true`, it will first array_merge the current properties.

- `unsetProperty($key)`: unsets the property indicated by `$key`. This returns the value - if any - the key had prior to being unset.

- `unsetProperties($keys)`: unsets - if set - the specified keys. `$keys` should be defined like `array('key1', 'key2', 'key3')`. This method will return an array of `$key => $value` pairs for each of the keys with their prior values if they had one.

If an extended object needs to store a lot of data, or if that data needs to be easily searchable or quick to filter on, it's better to define an extra object to hold that additional data, providing convenience methods (or a touch of magic in `$object->toArray()`) to retrieve the data.

