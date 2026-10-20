`ContentBlocks_RegisterInputs` tells ContentBlocks which JavaScript and CSS to load for custom inputs. Unlike v1, inputs in v2 do not have a server-side component like `cbBaseInput`.

The files are printed by `getAssets()` wherever a canvas is loaded. Scripts come after `contentblocks.js`. Stylesheets come after `main.min.css`. The script can call `ContentBlocks.registerInput` immediately.

```php
<?php
/**
 * Events: ContentBlocks_RegisterInputs
 *
 * @var modX $modx
 */

$assetsUrl = $modx->getOption(
    'myextra.assets_url',
    null,
    $modx->getOption('assets_url') . 'components/myextra/'
);

$modx->event->output([
    'rating' => [
        'js' => $assetsUrl . 'js/inputs/rating.js',
        'css' => $assetsUrl . 'css/rating.css',
    ],
]);
```

Full registration rules, multiple files, and the JavaScript class are in [Registering Inputs](../01_Custom_Inputs/Registering_Inputs).
