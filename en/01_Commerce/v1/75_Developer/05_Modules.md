One of the primary ways to extend Commerce is through Modules. These are simple classes, implementing the `modmore\Commerce\Modules\ModuleInterface` interface (there's also an abstract `BaseModule` class in the same namespace which provides `$this->commerce` and `$this->adapter`).

The module contains a couple of methods that define meta data about the module that is used in the back-end Modules configuration. This includes `getName()`, `getAuthor()` and `getDescription()`.

In a module, you can define a `registerListeners` method. This is called when the module is initialised by the Commerce core, and allows you to specify on what events your module needs to run. In Commerce we're using the Symfony2 EventDispatcher module to handle events. 

Every time your module fires, it will receive an Event object that contains relevant objects, like orders or items.

Here's an example module:

```` php
<?php

namespace modmore\Commerce\Modules\Cart;

use modmore\Commerce\Modules\BaseModule;
use Symfony\Component\EventDispatcher\EventDispatcher;

class MyOrderRelatedModule extends BaseModule {
    public function getName()
    {
        return 'My Order Related Module';
    }

    public function getAuthor()
    {
        return 'Mark Hamstra';
    }

    public function getDescription()
    {
        return 'Does something with your cart when it is calculated. ';
    }

    public function registerListeners(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(\comOrder::EVENT_BEFORE_CALCULATE, array($this, 'doSomething'));
    }

    public function doSomething(modmore\Commerce\Events\Order $event) {
        $order = $event->getOrder();

        // Only fire on cart orders; we don't want this module updating any completed or processing carts
        if ($order->getState() === \comOrder::STATE_CART) {
            // Get all items in this order
            $items = $order->getItems();
            
            // Do something with it...
            
            // Refresh the internal items cache if we did something with the items
            $order->getItems(false);
        }
    }
}
````

## Loading Modules

The merchant has control over which module is enabled in both test and live modes. This is done via Configuration > Modules in the Commerce admin.

In order for the modules to show up in that list, it must first be registered. If you place your modules in `core/components/commerce_modules/`, and make sure it follows the right naming, it can be picked up automatically when the merchant hits the "Search for Modules" button. This process will go through several folders looking for modules. When it finds one, it creates a `comModule` record containing the class name and path to the file, while calling the various methods to collect the meta data.

**1.0 Alpha Note**: We're still working on the final method for third party modules to be loaded. This section will be updated once the exact mechanics are determined. 

If your module is not enabled in a certain mode, it will not be loaded into memory.











