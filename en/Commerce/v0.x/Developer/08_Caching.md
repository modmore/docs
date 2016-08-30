If you're in need to cache certain information in Commerce, you can use a caching pool compatible with PSR-6. Commerce ships with the RevolutionCache adapter which implements the [PSR-6 Caching Interface](http://www.php-fig.org/psr/psr-6/) and maps it to the modCacheManager in MODX 2.x. 

To load a cache pool (a collection of cache items), call the `getCacheService($provider, array $options)` method on the [Adapter](MODX_Adapter). The `$provider` is a string representing the provider or cache partition (when using the standard file cache, this is the name of directory under the `core/cache/` folder). The `$options` method allows you to pass additional options to the `xPDOCache` instance. 

Let's say you built a module for taxes and need to cache some tax rates somewhere. Here's how you might do that:

```` php
<?php
$pool = $adapter->getCacheService('commerce_my_tax_module');

$cacheItem = $pool->getItem('rates/new_york');
// If the cacheItem is a hit, it means we have a value. 
if ($cacheItem->isHit()) {
    $taxRates = $cacheItem->get();
}
// If we don't have a hit, we can load the data and write it to cache 
else {
    $taxRates = loadTaxRatesFromSomewhere();
    $cacheItem->set($taxRates)->expiresAfter(3600);
    if (!$pool->save($cacheItem)) {
        // log an error that we were unable of caching the data
    }
}

var_dump($taxRates);
````

It's recommended to use this PSR-6 compatible caching layer rather than interacting with the modCacheManager directly. In the future it might be possible to define a different PSR-6 cache implementation, and we can seamlessly switch out implementations in future versions of MODX like MODX 3. 

## Cache Items

The following methods are available on the Item (retrieved via `$pool->getItem()` or `$pool->getItems()`:

- `getKey()` returns the cache key for the current cache item.
- `get()` returns the value for the cache item. This can be a string, integer, boolean, object, array, or null. 
- `isHit()` returns a boolean true or false to indicate if a value was retrieved for the item.
- `set($value)` updates the value for the item (doesn't matter it was a hit or not). The `get()` immediately returns the new value, however the updated value is not persisted to the cache until you call `$pool->save($item)`. Returns the object itself, so can be chained.
- `expiresAt($expiration)` sets the expiration for the cache entry to the time specified in the `DateTime` instance provided in `$expiration`. Returns the object itself, so can be chained.
- `expiresAfter($time)` sets the expiration time to the current time plus `$time`, provided as an integer representing a number of seconds, or a `DateInterval` instance. Returns the object itself, so can be chained. 

## Pool

The pool is a collection of items, and is responsible for creating the Item instances. 

The following methods are available:

- `getItem($key)` always returns an Item instance. Check `$item->isHit()` to determine if a value was found or not.
- `getItems(array $keys)` with $keys containing an array `['key1', 'key2]`, this will return an array `['key1' => 'value of key1', 'key2' => 'value of key2']`.
- `hasItem($key)` returns a boolean true or false to check if an item exists in the pool. 
- `clear()` empties the entire cache pool. 
- `deleteItem($key)` removes a specific item from the pool. Not all MODX cache drivers support this and may instead empty the entire pool. 
- `deleteItems(array $keys)` with $keys containing an array `['key1', 'key2']` each of the items will be removed from the cache. 
- `save(CacheItemInterface $item)` persists the item with its value to the cache. Returns true or false. 
- `saveDeferred(CacheItemInterface $item)` adds the item to a queue to be persisted when commit() is called. This is not implemented in the RevolutionCache adapter, making it functionality equivalent to calling `save()`.
- `commit()` persists all the deferred items from saveDeferred() to the cache. This is not implemented in the RevolutionCache adapter. 