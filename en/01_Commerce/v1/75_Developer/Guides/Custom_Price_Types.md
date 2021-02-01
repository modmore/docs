As of Commerce 1.0, we have flexible [pricing based on Price Types](../Products/Pricing) that allow users to add different types of prices to a product. The underlying architecture is quite powerful, and extendable too.

In this guide, we're going to add a custom Price Type for products that gives logged in users a different price. 

[TOC]

## Bootstrap a module

Before getting into custom pricing, you'll need a working module.

[Learn about how to create a module with the Module Skeleton &raquo;](Bootstrapping_a_Module.md)

Make sure to use the composer autoloader when setting up the module, rather than manually creating the module in the database, as we will be using the autoloader for our custom classes.

If you used the Skeleton, your module should already have the following line in it as well as the right PSR4 definition in the `composer.json` file:

```php
require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';
```

## Creating the custom Price Type

If you haven't read the [details about product pricing](../Products/Pricing) yet, it's very strongly recommended to start there to understand the different concepts and jargon. 

We'll create a new class `LoggedInPriceType` in  `core/components/commerce_yourmodulename/src/Pricing/LoggedInPriceType.php`. 

For this purpose we'll call the class `LoggedInPriceType`, which will implement two interfaces: `PriceTypeInterface` and `ItemPriceTypeInterface`. The [details about product pricing](../Products/Pricing) explains in more detail why those two interfaces.

Let's add the boilerplate code matching those interfaces, along with some `use` statements so we can use short names. Make sure to give it the right namespace at the top that matches your autoloader and make sure that the class name matches the file name.


``` php
?php
namespace ThirdParty\YourModuleName\Pricing;

use modmore\Commerce\Pricing\Price;
use modmore\Commerce\Pricing\Interfaces\PriceInterface;
use modmore\Commerce\Pricing\PriceType\Interfaces\PriceTypeInterface;
use modmore\Commerce\Pricing\PriceType\Interfaces\ItemPriceTypeInterface;
use modmore\Commerce\Pricing\Exceptions\InvalidPriceTypeDataException;

final class LoggedInPriceType implements PriceTypeInterface, ItemPriceTypeInterface
{
    /**
     * @param \comOrderItem $item
     * @return PriceInterface|false
     */
    public function getPriceForItem(\comOrderItem $item)
    {
        // @todo implement this method
    }

    public function serialize()
    {
        // @todo implement this method
    }

    public static function unserialize(\comCurrency $currency, $data)
    {
        // @todo implement this method
    }
}
```

That's 3 methods we need to implement, but we can add more if we want and if it fits the needs. 

Let's start by defining what data we need to get into the class by adding a constructor. In this case, the merchant will enter a discounted price, so we'll accept a PriceInterface and store it in a private variable. To get access to the price, even when the price is not valid for an order, we can add a getPrice method too.

```php
    /** @var PriceInterface */
    private $price;
    
    public function __construct(PriceInterface $price)
    {
        $this->price = $price;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
```

Next, we'll implement the important logic that determines if our customer gets a different price or not. This goes into the `getPriceForItem` method, which needs to return an implementation of `PriceInterface` or `false` if the price is not valid.

```php
    /**
     * @param \comOrderItem $item
     * @return PriceInterface|false
     */
    public function getPriceForItem(\comOrderItem $item)
    {
        $order = $item->getOrder();
        if ($order instanceof comOrder && $order->get('user') > 0) {
            return $this->price;
        )
        return false;
    }
```

That should do the trick!

We'll also need to tell Commerce how to save and load the data for a price type, which happens with the `serialize` and static `unserialize` methods. While the exact format this uses is up to you, storing data as JSON is typically fine. As the PriceType is always stored in a currency-specific `PricingInterface` implementation, you do not have to store the currency. 

```php
    public function serialize()
    {
        return json_encode([
            'amount' => $this->price->getInteger(),
        ]);
    }

    public static function unserialize(\comCurrency $currency, $data)
    {
        $details = json_decode($data, true);
        if (!is_array($details)) {
            throw new InvalidPriceTypeDataException('Could not decode JSON "' . $data .'" for LoggedIn Price Type');
        }

        $amount = array_key_exists('amount', $details) ? (int)$details['amount'] : 0;
        $price = new Price($currency, $amount);

        return new static($price);
    }
```

We're throwing an exception here if the JSON can't be decoded, but you could also have it default to a specific value instead. 

Putting it all together, that gives us the following PriceType:

``` php
?php
namespace ThirdParty\YourModuleName\Pricing;

use modmore\Commerce\Pricing\Price;
use modmore\Commerce\Pricing\Interfaces\PriceInterface;
use modmore\Commerce\Pricing\PriceType\Interfaces\PriceTypeInterface;
use modmore\Commerce\Pricing\PriceType\Interfaces\ItemPriceTypeInterface;
use modmore\Commerce\Pricing\Exceptions\InvalidPriceTypeDataException;

final class LoggedInPriceType implements PriceTypeInterface, ItemPriceTypeInterface
{
    /** @var PriceInterface */
    private $price;
    
    public function __construct(PriceInterface $price)
    {
        $this->price = $price;
    }
    
    /**
     * @param \comOrderItem $item
     * @return PriceInterface|false
     */
    public function getPriceForItem(\comOrderItem $item)
    {
        $order = $item->getOrder();
        if ($order instanceof comOrder && $order->get('user') > 0 {
            return $this->price;
        )
        return false;
    }
    
    public function getPrice()
    {
        return $this->price;
    }

    public function serialize()
    {
        return json_encode([
            'amount' => $this->price->getInteger(),
        ]);
    }

    public static function unserialize(\comCurrency $currency, $data)
    {
        $details = json_decode($data, true);
        if (!is_array($details)) {
            throw new InvalidPriceTypeDataException('Could not decode JSON "' . $data .'" for Simple Price Type');
        }

        $amount = array_key_exists('amount', $details) ? (int)$details['amount'] : 0;
        $price = new Price($currency, $amount);

        return new static($price);
    }
}
```

## Telling Commerce about the Price Type

Now that we have a custom price type, we need to register it with Commerce so it can automatically show it when editing product prices. 

We use our module for that, by adding a listener to the `\Commerce::EVENT_DASHBOARD_GET_PRICE_TYPES` event, and passing it the name of our custom Price Type. 

```php
    public function initialize(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(\Commerce::EVENT_DASHBOARD_GET_PRICE_TYPES, [$this, 'registerPriceType']);
    }
    
    public function registerPriceType(modmore\Commerce\Events\Admin\PriceTypes $event)
    {
        $event->registerPriceType(ThirdParty\YourModuleName\Pricing\LoggedInPriceType::class);
    }
```

That tells Commerce all it needs to start making your price type available. Magical!

## Other custom pricing classes

It's also possible to use custom classes for other parts of the pricing mechanism, like a custom `PricingInterface`/`ItemPricingInterface` or `PriceInterface` implementation, but that **should not** be needed in the vast majority of cases, and we'd love to hear from you via our standard support channels if you've come across a use case that you think can't be solved without that. 

Most of the Pricing-related classes have been marked as `final` to prevent them from being extended, so you'll need to implement the various interfaces that are available instead. When building custom `PricingInterface` implementations, you'll also need to have an extended `comProduct->getPricing()` method (and potentially `comProduct->savePricing()` too) to handle your custom implementation, as we do not currently allow you to swap those out in configuration. 

