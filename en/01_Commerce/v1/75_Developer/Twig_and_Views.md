Prior to Commerce 1.1, you would regularly see (or write!) `$commerce->twig->{some twig method}`, which is a rather tight coupling. In Commerce 1.1, a new `\modmore\Commerce\View\ViewInterface` interface was added, along with a `\modmore\Commerce\View\TwigView` implementation. The legacy direct access to `$commerce->twig` has been deprecated and will be removed in 1.3. 

The `ViewInterface` lets you use the following methods:

- `render(string $template, array $placeholders)` for rendering a twig template file 
- `renderString(string $template, array $placeholders)` for rendering a parsed string template (previously accomplished with twig's createTemplate() and processing that)
- `addTemplatesPath($fullPath)` to add additional template directories to the template inheritance

The instantiated view is accessed through `Commerce::view()` (note that's a method and not a property, unlike the legacy `Commerce::$twig`), so depending on the context you're calling from, either `$commerce->view()` or `$this->commerce->view()`.  

The `view()` method is guaranteed to return an in-memory `\modmore\Commerce\View\ViewInterface` implementation, so you can chain it immediately and call it repeatedly.

[TOC]

## render

Use for rendering a template file.

Arguments:

- string `$template`: the theme-directory-relative path and filename to the template to parse, e.g. `frontend/checkout/cart.twig`
- array `$placeholders`: key => value pair array of additional values/placeholders/context to provide into the template. 

Return value:

- a parsed template

Throws:

- `\modmore\Commerce\Exceptions\ViewException` if an error occurred with parsing the template. This may contain the original exception thrown by Twig. Can happen if the filename is incorrect or if the template contains invalid syntax.

Example:

```php
<?php
try {
    return $commerce->view()->render('frontend/price.twig', [
        'integer' => 1234,
        'formatted' => '€12,34',
        'currency' => [
            'alpha_code' => 'EUR',
        ]
    ]);
}
catch (\modmore\Commerce\Exceptions\ViewException $e) {
    return $e->getMessage();
}
```

## renderString

Use for rendering a literal template string. Note that this does **not** automatically process MODX tags; only twig syntax. 

Arguments:

- string `$template`: a string template (*not* a file, but the literal template string) to process e.g. `<p>Hello {{ world }}</p>`. 
- array `$placeholders`: key => value pair array of additional values/placeholders/context to provide into the template. 

Return value:

- a parsed template

Throws:

- `\modmore\Commerce\Exceptions\ViewException` if an error occurred with parsing the template. This may contain the original exception thrown by Twig. Can happen if the template contains invalid syntax.

Example:

```php
<?php
try {
    return $commerce->view()->renderString('<p>Hey {{ name }}, how are you doing?</p>', [
        'name' => 'John',
    ]);
}
catch (\modmore\Commerce\Exceptions\ViewException $e) {
    return $e->getMessage();
}
```

## addTemplatesPath

Use to register additional template directories into the inheritance tree. Templates registered this way will take precedence over the default template, but is overridden by the user-configured theme.

Arguments:

- string `$fullPath`: the full, absolute, path to a directory that holds template files.

Return value:

- `true` if the directory exists and was added to the template inheritance; `false` if not.

Example:

```php
<?php
$commerce->view()->addTemplatesPath('/path/to/templates/');
```
