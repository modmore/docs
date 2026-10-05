A custom input is registered in JavaScript with `ContentBlocks.registerInput`. The class has to exist before the canvas is created.

[TOC]

## registerInput

```javascript
ContentBlocks.registerInput("rating", class extends ContentBlocks.Input {
    static dataKeys = ["value"];

    render() {
        // return an element; see Creating Custom Inputs
    }
});
```

`ContentBlocks` is a global object created by `contentblocks.js`. Call `registerInput` after that file has loaded, and before `MODx` fires `ready`. The canvas is created on `ready`.

Rules:

- The name is the `type` string in block JSON. `registerInput("rating", ...)` means `"type": "rating"`.
- Names are case-sensitive and must be unique. Registering a name that already exists logs an error and keeps the original class. Do not reuse a [core type](../../02_Input_Types/index) name such as `text` or `image`.
- The second argument is the class itself, not an instance.
- Unknown type names are allowed in block JSON. You do not add them to a schema enum. Config validation reports a warning (`Unknown input type "rating". Custom input types are allowed`). That warning is expected.
- If the class was not registered in time, the canvas logs `Requested _initBlockInput for non-existent input type` and shows the error input.

## Load the script with ContentBlocks_RegisterInputs

Return the file URLs from a plugin on **ContentBlocks_RegisterInputs**. ContentBlocks prints them from the same place it prints `contentblocks.js` and `main.min.css`: JavaScript first, then your scripts, then stylesheets. That order holds for the resource editor and for any other canvas that loads through `getAssets()`.

```php
<?php
/**
 * Events: ContentBlocks_RegisterInputs
 *
 * @var modX $modx
 * @var ContentBlocks $contentBlocks
 */

$assetsUrl = $modx->getOption(
    'myextra.assets_url',
    null,
    $modx->getOption('assets_url') . 'components/myextra/'
);

if ($modx->controller) {
    $modx->controller->addLexiconTopic('myextra:default');
}

$modx->event->output([
    'rating' => [
        'js' => $assetsUrl . 'js/inputs/rating.js',
        'css' => $assetsUrl . 'css/rating.css',
    ],
]);
```

`$contentBlocks` is the ContentBlocks service. Pass URLs to `$modx->event->output()`. A `return` from the plugin is not picked up.

`rating.js` should call `registerInput` as soon as it loads. Do not wrap that call in `MODx.on('ready', ...)`. A `ready` listener can run after the canvas has already built its inputs.

In the input, read manager lexicon strings with `_('myextra.rating.placeholder')` after `addLexiconTopic` has loaded the topic.

### Several files

List JavaScript in the order it has to run. The same file URL is only included once. A string on its own is treated as JavaScript, which is enough when the input has no stylesheet.

```php
$modx->event->output([
    'rating' => [
        'js' => [
            $assetsUrl . 'js/vendor/widget.js',
            $assetsUrl . 'js/inputs/rating.js',
        ],
        'css' => [
            $assetsUrl . 'css/vendor.css',
            $assetsUrl . 'css/rating.css',
        ],
    ],
    'map' => $assetsUrl . 'js/inputs/map.js',
]);
```

One plugin can also return a single `js` / `css` pair when every file belongs together:

```php
$modx->event->output([
    'js' => $assetsUrl . 'js/inputs/rating.js',
    'css' => $assetsUrl . 'css/rating.css',
]);
```

ContentBlocks adds `cbv` with its own version to each URL so the manager picks up new files after an upgrade. An existing query string is kept (`widget.js?v=1` becomes `widget.js?v=1&cbv=...`).

## OnDocFormPrerender

Adding a script tag from `OnDocFormPrerender` still works on the resource page. Plugin priority decides whether that tag lands after `contentblocks.js`, and the event does not run for other canvas types. Prefer `ContentBlocks_RegisterInputs` so the files are part of ContentBlocks' own asset list.

## Stylesheets and third-party libraries

Ship CSS the input always needs on `ContentBlocks_RegisterInputs`, as in the example above.

For a library that is heavy or only used once an editor opens the field, load it from the input with `ContentBlocks.Input.loadAssets`. The core `code` input does this for Ace, and the `color` input does it for the iro picker. The same `id` is only injected once, even when several fields ask for it.

```javascript
static loadLibrary() {
    const assetsUrl = MODx.config["myextra.assets_url"];
    return ContentBlocks.Input.loadAssets(
        assetsUrl + "js/vendor/widget.js",
        "js",
        "myextra-widget",
    );
}
```

The third argument is `'css'` or `'js'`. The returned promise resolves when the file has loaded. See [Load a library once](Input_Patterns#load-a-library-once).

## PHP input classes

You do not need a PHP input class for a v2 custom input. Front-end HTML comes from the block template. Server work that the field needs (option lists, previews, uploads) belongs in your extra's own connector, called from the input. The `select`, `chunk`, and `link` inputs are the core examples of that split.

`ContentBlocks_RegisterInputs` still accepts a `cbBaseInput` instance for ContentBlocks 1 field classes. The v2 canvas does not draw those classes. Return `js` and `css` URLs instead.
