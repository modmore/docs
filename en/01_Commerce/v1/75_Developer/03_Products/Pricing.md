This document explains how Pricing works in Commerce from a technical point of view, primarily meant for developers building custom products or looking to integrate/import with products that need to support price types. It's not a step-by-step guide, but more of a background of how things work and why things work a certain way. 

If you're implementing Commerce, [visit the implementation documentation on price types](../../Products/Price_Types) instead.

**Note that this document often refers to interfaces and classes by their imported name, instead of their fully qualified name, and may skip the relevant `use` and `namespace` definitions when showing examples.**

On this page:

[TOC]

## Definitions

There will be a lot of price-related jargon on this page, which may seem similar but are actually responsible for very different things. 

Here's the most important ones that you should know about before getting started with custom pricing.

### Price

A Price is a single amount that a product (or other entity) is valued at. It consists of a currency, an amount, and potentially a "Regular Price". 

The Pricing and Price Type classes all return a Price object.

- Interface: `\modmore\Commerce\Pricing\Interfaces\PriceInterface`
- Typical implementation: `\modmore\Commerce\Pricing\Price`

Important: before v1, Commerce used `\modmore\Commerce\Product\Price` as a simple price object, which is still returned from the `comProduct->getPrice()` method. However, that class is **deprecated** and should be ignored except for a couple of backwards compatibility measures. When we talk about a Price object in the context of this document, it usually refers to an implementation of the `PriceInterface`. 

### Regular Price (aka Retail Price, aka Price)

The Regular Price is sometimes referred to as the Retail Price, or just Price in the merchant interfaces. It is a standard `PriceInterface` implementation (with a currency and an amount), but its significance is that it's the price _before_ any Price Types have been evaluated. 

When you receive (or create) a Price object, you can use the `hasRegularPrice()`, `getRegularPrice`, and `setRegularPrice` methods to check for, get, or set the regular price. 

When using the `PriceRenderer`, the Regular Price may be used to show a before/after price. 

### Pricing

Pricing is ambiguous in the sense that's it's both the generic concept of determining prices, and the technical implementation of it. 

In the context of this developer documentation, we refer to pricing as a `\modmore\Commerce\Pricing\Interfaces\PricingInterface` implementation.

Commerce ships with 2 interfaces and 2 implementations of the PricingInterface.  

- Interface `\modmore\Commerce\Pricing\Interfaces\PricingInterface` defines the overall contract of a Pricing class, handling the connection to Price Types, and is implemented in a generic `\modmore\Commerce\Pricing\Pricing` 
- Both `\modmore\Commerce\Pricing\Interfaces\PricingInterface` and `\modmore\Commerce\Pricing\Interfaces\ItemPricingInterface`, which defines the method for to retrieve the best price for a specific order item, are implemented in the more specific `\modmore\Commerce\Pricing\ProductPricing`.

We'll discuss these interfaces and implementations in more detail, with examples, in a bit. 

Pricing instances are always specific to one currency. 

### Price Types

The purpose of a price type is to, potentially out of a long list of options, return a single Price that is available. A PriceType instance is always specific to one currency.

Technically, Price Types are implementations of one or more of the following interfaces: 

- `\modmore\Commerce\Pricing\PriceType\Interfaces\PriceTypeInterface`, which sets the contract for how a PriceType is serialized
- `\modmore\Commerce\Pricing\PriceType\Interfaces\ItemPriceTypeInterface`, which sets the contract for how a price type should interact with an order item
- `\modmore\Commerce\Pricing\PriceType\Interfaces\RelativePriceTypeInterface`, which tells Commerce about a `setRegularPrice` method so your price type can do calculations with an original price
- `\modmore\Commerce\Pricing\PriceType\Interfaces\TimeBoundPriceTypeInterface`, which provides a `getFromDate()` and `getUntilDate()` method for determining/rendering if a price type is valid for the provided date. 

There are presently 5 Price Type implementations in Commerce:

- `\modmore\Commerce\Pricing\PriceType\Sale` is a price type that either returns a single defined Price or not, based on a start (from) and expiration (until) DateTime. 
- `\modmore\Commerce\Pricing\PriceType\PercentageSale` is a price type that either returns a single defined Price or not, based on a start (from) and expiration (until) DateTime. Compared to the Sale PriceType, the SalePercentage lets the user enter a percentage discount and it then calculates the new price from that.
- `\modmore\Commerce\Pricing\PriceType\Quantity` gives the merchant a way to define bulk pricing between different brackets. This PriceType contains different prices
- `\modmore\Commerce\Pricing\PriceType\User` (added in v1.1) gives user-specific prices by entering the username and adding the price.
- `\modmore\Commerce\Pricing\PriceType\UserGroup` (added in v1.1) gives usergroup specific prices by selecting the usergroup and adding the price.

We'll get to more details and some examples in a minute.

## Why the multiple Price Type and Pricing interfaces?

While this document is focused on Products, none of the concepts here are, technically speaking, exclusively available to Products/Items. 

The Price Types, Pricing and Prices are all generic, with additional Product-specific interfaces and implementations that connect the two.

For example, the PriceTypeInterface defines how a PriceType can be statically instantiated from serialized data, and how to serialize it again:

``` php
interface PriceTypeInterface {
    /**
     * @return string
     */
    public function serialize();

    /**
     * @param \comCurrency $currency
     * @param string $data
     * @return self
     */
    public static function unserialize(\comCurrency $currency, $data);
    
    // ... a couple more methods for rendering the price type ...
}
```

However, the ItemPriceTypeInterface extends that to also provide the contract to determine the Price for a specific `comOrderItem`:

``` php
interface ItemPriceTypeInterface extends PriceTypeInterface {
    /**
     * @param \comOrderItem $item
     * @return PriceInterface|false
     */
    public function getPriceForItem(\comOrderItem $item);
}
```

When building an implementation for a price type that defines a product price, you would combine those interfaces into a single implementation:

```php
final class Example implements PriceTypeInterface, ItemPriceTypeInterface
{    
    public function getPriceForItem(\comOrderItem $item)
    {
        // ...
    }
    
    public function serialize()
    {
        // ...
    }
    
    public static function unserialize(\comCurrency $currency, $data)
    {
        // ...
    }
    
    // ...
}
```

(Technically you can skip providing `PriceTypeInterface` when providing `ItemPriceTypeInterface` because that extends the former, but to better communicate intent we recommend keeping them both.)

(At this point you don't have any further logic, but we recommend that you add a `__construct` method that takes in whatever values your PriceType needs, using that in `getPriceForItem`, and adding additional getters/setters as needed.)

By architecting it this way, we're leaving room for future implementations of other types of pricing. For example we'll likely implement price types into Shipping Methods at some point using an interface like this:

```php 
interface ShippingPriceTypeInterface extends PriceTypeInterface {
    /**
     * @param \comOrderShipment $shipment
     * @param \comShippingMethod $method
     * @return PriceInterface
     */
    public function getPriceForShipment(\comOrderShipment $shipment, \comShippingMethod $method);
}
```

which you could then integrate into existing PriceType implementations by adding the interface and the provided methods:

```php
final class Example implements PriceTypeInterface, ItemPriceTypeInterface, ShippingPriceTypeInterface
{    
    public function getPriceForItem(\comOrderItem $item)
    {
        // ...
    }
    
    public function getPriceForShipment(\comOrderShipment $shipment, \comShippingMethod $method)
    {
        // ...
    }
    
    public function serialize()
    {
        // ...
    }
    
    public static function unserialize(\comCurrency $currency, $data)
    {
        // ...
    }
    
    // ...
}
```

The same thing is true for the `PricingInterface` and `ItemPricingInterface`. The `PricingInterface` defines what a generic `Pricing` class should do:

```php
interface PricingInterface {
    /**
     * @param \comCurrency $currency
     * @param PriceInterface $regularPrice
     */
    public function __construct(\comCurrency $currency, PriceInterface $regularPrice);

    /**
     * @return PriceInterface
     */
    public function getRegularPrice();

    /**
     * @return \comCurrency
     */
    public function getCurrency();

    /**
     * @param PriceTypeInterface $priceType
     * @return void
     */
    public function addPriceType(PriceTypeInterface $priceType);

    /**
     * @return PriceTypeInterface[]
     */
    public function getPriceTypes();

    /**
     * @param \comCurrency $currency
     * @param PriceInterface $regularPrice
     * @param array $data
     * @return static
     * @throws InvalidPriceTypeException
     */
    public static function unserialize(\comCurrency $currency, PriceInterface $regularPrice, array $data);

    /**
     * Serialize the Pricing instance to an array of primitives that can be encoded.
     *
     * @return array
     */
    public function serialize();
}
```

The `ItemPricingInterface` adds to that the method needed specific for getting the price for any given `comOrderItem` instance:

```php
interface ItemPricingInterface extends PricingInterface {
    /**
     * @param \comOrderItem $item
     * @return PriceInterface
     */
    public function getPriceForItem(\comOrderItem $item);
}
```

Similar to the example before related to shipping, we could in the future add a `ShippingPricingInterface` if we were to implement this pricing into the shipping methods:

```php
interface ShippingPricingInterface extends PricingInterface {
    /**
     * @param \comOrderShipment $shipment
     * @param \comShippingMethod $method
     * @return PriceInterface
     */
    public function getPriceForShipment(\comOrderShipment $shipment, \comShippingMethod $method);
}
```

At that point, you would add the interface to a PricingInterface implementation, along with the `getPriceForShipment` method, and the implementation would then be valid for both those types, and not just products.

## Getting the applicable price from a product

If you have a `comProduct` instance loaded, and want to get the price from that, there are a few methods at your disposal with the word price (or pricing) in it: 

- `$product->getPrice() : \modmore\Commerce\Product\Price` - this is the old method of getting a price back for a product. Note that this `\modmore\Commerce\Product\Price` object is **not** an implementation of `\modmore\Commerce\Pricing\Interfaces\PriceInterface` (which would be the `\modmore\Commerce\Pricing\Price` class). This method primarily served to turn the `price` field on the product into something that resembles a price with a currency, but that implementation turns out to have been a bit short-sighted, and has been deprecated. Unfortunately as the `Product\Price` and `Pricing\PriceInterface` are not compatible and we have been encouraging people to override getPrice in custom products, we have to keep them both around for a little while. 
- `$product->getPricing(comCurrency $currency) : ProductPricing` this always returns a `ProductPricing` instance (which implements both `PricingInterface` and `ItemPricingInterface`) with all pricing information for the product in the provided currency, including the retail price and the various price types that are configured on the product. 

So typically you'll get the full pricing information with `$product->getPricing(comCurrency $currency)`, and interact with that to get the standard or alternative prices. 

The current currency object is available on all `comSimpleObject` instances through `$object->getCurrency()`, through `$commerce->currency`, or `$commerce->getCurrency($threeLetterAlphaCode)`. 

When you call `$pricing = $product->getPricing($currency)`, you get a new `ProductPricing` object. 

To get the best (cheapest) price for a `comOrderItem` object, you can provide it to `$pricing->getPriceForItem(comOrderItem $item)` to get a `PriceInterface` instance back. This is guaranteed to return a `PriceInterface` implementation, but do note it is possible for that price to be 0 if no price was configured (or if the data was corrupt). 

You can also get all the price types that are available on the `ProductPricing` object with `$pricing->getPriceTypes()` (returns an array of `PriceTypeInterface` instances). 

Other notable methods on the `ProductPricing` object:

- `getCurrency() : comCurrency`
- `getRegularPrice() : PriceInterface`
- `addPriceType(PriceTypeInterface $priceType) : void`

## Adding price types programmatically

If you're looking to import product prices, you'll need to interact with the classes mentioned in this document to make that work. The rough workflow would look like this:

1. Create a comProduct object, optionally giving it the regular price (integer) in the `price` field. Save the product to the database (`$product->save()`). 
2. Get a `ProductPricing` object for the product/currency combination: `$pricing = $product->getPricing($currency)`. Even if you just created the product, this is guaranteed to always return a `ProductPricing` instance. 
3. Call `$pricing->setRegularPrice()` to set the regular price, and add your price types with the `addPriceType` method. 
4. Save the `ProductPricing` by calling `$product->savePricing($pricing)`. This **overwrites** the pricing data for the currency. Internally this will serialize and save it to the `pricing` column in the products database, but always use the `savePricing` method instead of the `pricing` column to make sure your code doesn't break if we change how data is stored.

Repeat steps 2-4 for each currency you need to import.

Different price types are initialised in different ways. Some examples:

- **Sale** (`\modmore\Commerce\Pricing\PriceType\Sale`) expects a `PriceInterface`, and optionally a `\DateTime` for the start and expiration times. When there is no start or no expiration time, provide `null` or omit the argument.

```php
$pricing->addPriceType(
    new Sale(
        new Price($currency, 5900),
        (new \DateTime())->modify('-3 days'),
        (new \DateTime())->modify('+4 days')
    )
);
```

(Tip, to get a DateTime object from a unix timestamp, use `new \DateTime('@' . $timestamp)`)

- **PercentageSale** (`\modmore\Commerce\Pricing\PriceType\PercentageSale`) expects a discount provided as a float with up to 2 decimals (e.g. `20.50`), and optionally a `\DateTime` for the start and expiration times. When there is no start or no expiration time, provide `null` or omit the argument.

```php
$pricing->addPriceType(
    new PercentageSale(
        12.50,
        (new \DateTime())->modify('-3 days'),
        (new \DateTime())->modify('+4 days')
    )
);
```

- **Quantity** (`\modmore\Commerce\Pricing\PriceType\Quantity`) expects the currency in the constructor, and subsequent calls to `add(int $min, int|null $max, int $amountInCents)` to add the quantity brackets. The `add` method can be chained. If you don't want to set a maximum quantity, provide a `null`.

```php
$pricing->addPriceType(
    (new Quantity($currency))
    ->add(5, 9, 6900)
    ->add(10, 20, 5500)
    ->add(20, null, 4900)
);
```

- **User** (`\modmore\Commerce\Pricing\PriceType\User`, added v1.1) expects the currency in the constructor, and subsequent calls to `add(string $username, int $amount)` to add the prices. 

```php
$pricing->addPriceType(
    (new User($currency))
    ->add('admin', 1990)
    ->add('editor', 2450)
);
```

- **UserGroup** (`\modmore\Commerce\Pricing\PriceType\UserGroup`, added v1.1) expects the currency in the constructor, and subsequent calls to `add(int $userGroupID, int $amount)` to add the prices. 

```php
$pricing->addPriceType(
    (new UserGroup($currency))
    ->add(1, 5300)
    ->add(5, 4900)
);
```


## Updating or removing price types

It's not natively possible to update, remove or replace a PriceType directly, as it does not have an ID or another unique key to target them by. 

To programmatically update/remove/replace a PriceType, create a new (empty) ProductPricing instance, add the PriceType's you want to keep, and save that to the product.

```php
$currency = $commerce->getCurrency('EUR');
$currentPricing = $product->getPricing($currency);
$retailPrice = $currentPricing->getRegularPrice();

$newPricing = new ProductPricing($currency, $retailPrice);

foreach ($currentPricing->getPriceTypes() as $priceType) {
    // Determine if you want to keep the price type or not
    if (rand(0,1)) {
        $newPricing->addPriceType($priceType);
    }
}

$product->savePricing($newPricing);    
```

If you want to find a specific price type, you can use instanceof to test the price type inside the `foreach` loop. For example to only keep a Sale price type:

```php
foreach ($currentPricing->getPriceTypes() as $priceType) {
    if ($priceType instanceof \modmore\Commerce\Pricing\PriceType\Sale) {
        $newPricing->addPriceType($priceType);
    }
}
```

## Loading Price Types in a custom product

Prior to 1.0, you would override `getPrice` and return a simple price object. That has been deprecated and will be removed in 1.3. 

To define custom pricing now, you have two options at your disposal:

- Override `getRawPricing()` and `setRawPricing()` if you only need to change **where** the pricing data is stored. `getRawPricing()` needs to return an array in the format `[ "USD" => ["regular_price" => 1000, "price_types" => []] ]`, and `setRawPricing` should accept an array in that format, serialize, and save it.
- Override `getPricingInstance(comCurrency $currency)` (1.0.0-rc2+) and `savePricing(ItemPricingInterface $pricing)` if you want to manually construct a `ProductPricing` instance and handle its serialisation. If `getPricingInstance()` returns `null`, the `comProduct` will construct a pricing instance from the `getPrice()` method.

The first approach is typically recommended for product types that work similar to the Resource Product, where information is loaded from elsewhere. 

The second approach can allow you more flexibility in creating the pricing instance directly. If you do not also implement `setRawPricing()` or `savePricing()` however, programmatic interaction with your product type may not work 100% the same as a built-in product.

To make sure that other interactions with the pricing work as expected you'll likely also want to override the `savePricing` method to control how pricing information provided by a programatic interface is saved for your product.  
