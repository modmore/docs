---
title: 'Price Index'
---

With the introduction of the [price types and multi-currency prices in 1.0](Pricing), it became significantly harder to interact with prices in queries. 

That's why 1.0.0-rc4 introduced a new product price index table (`comProductPriceIndex`). The goal of the price index is to give you an easily joined table that contains the current (regular) price for a product, allowing you to query against prices a lot more efficiently.

[TOC]

## Structure

The `comProductPriceIndex` table consists of the following fields of interest:

- `product`: the ID of the product the price is for
- `currency`: the 3-character alphanumeric code for a currency
- `price`: the price, as integer in full subunits


## How it works

The `comProduct->save()` method will automatically write the appropriate price index through the (final) `comProduct->updatePriceIndex()` method. This uses the `comProduct->getPricing()` (which custom product types can influence through `comProduct->getRawPricing()` or `comProduct->getPricingInstance()`, on which it calls `getRegularPrice()`. 

The resulting price is written to the price index, along with its currency and product ID. This means that **there may be multiple price index records for a single product**, which you should consider when querying against it. You may need to define a `GROUP BY` or `DISTINCT`, for example.

## Usage example

Most usage of the price index happens in the core, but you may want to access it when programmatically retrieving product information in snippets or plugins as well.

Consider the following (wrong) code snippet that sorts by the defunct `price` column:

```php
$c = $modx->newQuery('comProduct');
$c->where([
    'removed' => false,
]);

// This is wrong, as the price field is defunct
$c->sortby('price', 'ASC');

foreach ($modx->getIterator('comProduct', $c) as $product) {
    $pi = $product->toArray();
    echo $pi['sku'] . ' => ' . $pi['price_rendered'] . '<br>';
}
```

For shops that were already in existence/development before 1.0, this may result in proper results some of the time, but as soon as you start editing products in 1.0, the `price` column will start getting out of sync with the more powerful [pricing](Pricing). 

The above snippet would need to be corrected in the following way to work correctly:


```php
$c = $modx->newQuery('comProduct');
$c->innerJoin('comProductPriceIndex', 'PriceIndex');
$c->where([
    'removed' => false,
    
    // Restrict to the desired currency, make dynamic like this: $commerce->currency->get('alpha_code')
    'PriceIndex.currency' => 'EUR',
]);

// Sort it by the PriceIndex instead
$c->sortby('PriceIndex.price', 'ASC');

foreach ($modx->getIterator('comProduct', $c) as $product) {
    $pi = $product->toArray();
    echo $pi['sku'] . ' => ' . $pi['price_rendered'] . '<br>';
}
```


