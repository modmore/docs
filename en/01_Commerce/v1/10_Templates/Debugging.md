Twig comes with a useful `dump` function that lets you see exactly what values are available.

To enable it, enable (or create) the `commerce.debug` system setting. 

After that, you can use `{{ dump() }}` or `{{ dump(placeholder) }}` in any twig template to see what values are available.