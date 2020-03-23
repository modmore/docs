Formatters are generalised functions that take in a raw value, and output a formatted value in a way that people would expect the value to be rendered.

They are called automatically for many fields in the model, available as `<field>_formatted` in templates and code.

To call a formatter from a model (taking into account the currency specified in the currency field, if it exists), use:

```php
return $this->formatValue($value, 'name-of-formatter');
```

From external code, such as snippets, you can also call the `formatValue` method on the `Commerce` service class.

```php
return $commerce->formatValue($value, 'name-of-formatter');
```

For financial formatting where you have the relevant currency object, you can also use `$currency->format($amountInCents)`.


