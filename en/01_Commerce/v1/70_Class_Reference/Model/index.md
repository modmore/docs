The **Model** in Commerce is all the data that is stored in the database. It's an xPDO model, so you can [retrieve](https://docs.modx.com/current/en/extending-modx/xpdo/retrieving-objects), [create](https://docs.modx.com/current/en/extending-modx/xpdo/creating-objects), and [manipulate](https://docs.modx.com/current/en/extending-modx/xpdo/setting-object-fields) them like any other model in MODX.

All Commerce objects extend from [`comSimpleObject`](comSimpleObject).

It is preferred to use the [adapter](https://docs.modmore.com/en/Commerce/v1/Developer/MODX_Adapter.html) over `$modx` or `$xpdo` instances directly; that makes sure we can keep your code compatible with future versions of MODX automatically.

**Not all models are meant to be interacted with outside of Commerce core, and you may corrupt data or connections when you do so regardless. Please reach out to support@modmore.com if you're not 100% sure if your use case is supported.**

To interact with models, first load the Commerce service class and adapter if you don't already have it.

```php
<?php
$path = $modx->getOption('commerce.core_path', null, MODX_CORE_PATH . 'components/commerce/') . 'model/commerce/';
$params = ['mode' => $modx->getOption('commerce.mode')];
/** @var \Commerce $commerce */
$commerce = $modx->getService('commerce', 'Commerce', $path, $params);
if (!($commerce instanceof Commerce)) {
    return '<p class="error">Oops! Could not load Commerce.</p>';
}

$adapter = $commerce->adapter;
```

## Deleting Data

While each object has a `remove` method, in some cases that will only set a soft-remove flag (`removed = 1`) and not actually remove the object. **That's probably for a good reason, so don't bypass that.**


