In Commerce 1.3, we upgraded from `symfony/event-dispatcher` v2.8 to v4.4.

v4.4 is the highest version of `symfony/event-dispatcher` we are able of using in Commerce 1.x due to breaking changes and their impact on Commerce extensions.

[TOC]

## Summary of breaking changes

Symfony decided that the EventDispatcher's dispatch() method needed a change.

Before, it used the syntax `dispatch(string $eventName, Event $eventObject)`. That changed in Symfony 4.3 to `dispatch(Event $eventObject, ?string $eventName = null)`; flipping the order of the event object and the event name.

The dispatcher includes a compatibility layer in 4.3 and 4.4 to allow it to accept both signatures. This compatibility layer was removed in Symfony 5.0.

We could implement a custom translation layer if not for one historic mistake on our part: instructing developers building modules to expect the Symfony EventDispatcher class in the `initialize()` method of their modules.

```php
<?php

//   v   v   v
use \Symfony\Component\EventDispatcher\EventDispatcher;

class MyModule extends \modmore\Commerce\Modules\BaseModule
{
    // ...                         v   v   v
    public function initialize(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener($eventName, $listener)
    }
}
```

This tight coupling means that, whatever we do, we must provide all modules ever built with a Symfony EventDispatcher instance. This means a proxy class would need to _extend_ the EventDispatcher to be compatible, but it is impossible to do that and also keep the legacy syntax on the dispatch() method.

While the breaking change is in the dispatch() method which is mostly used internally by Commerce, it is also possible (and we know a few modules that do this) to have custom events inside modules that are fired in the same way. We cannot provide a suitable upgrade path for this without a breaking change in Commerce.

## Changes in Commerce v1.3

In Commerce 1.3 (dev7), we upgraded the Symfony dispatcher to 4.4, and added a new Commerce-native wrapper class for it.

The new `\modmore\Commerce\Dispatcher\EventDispatcher` and `\modmore\Commerce\Dispatcher\Event` classes extend their Symfony counter-parts, and our EventDispatcher flips around the order of the parameters on the dispatch() method so that continues to work without deprecation warnings or errors.

The next step is for  **all modules and extensions to update the references to these new classes**. This is a simple search & replace operation, and means increasing the minimum supported version of your module to 1.3.

## Changes in Commerce v2.0

In Commerce 2.0, we will no longer extend the Symfony EventDispatcher classes in `\modmore\Commerce\Dispatcher\EventDispatcher` and `\modmore\Commerce\Dispatcher\Event`.

**This is a breaking change that will cause a fatal error for modules which have NOT updated the EventDispatcher references to the Commerce-native EventDispatcher and Event classes.**

> Commerce 2.0 won't be available for a while; we're not yet actively working on a 2.0 release. So while there is no rush to fix this today, we do encourage being prepared and fixing extensions sooner rather than later. The next time you sit down to work on a module, update its references and bump its requirement to 1.3.

When we no longer extend the Symfony classes directly, we'll be able to once again upgrade the Symfony EventDispatcher to a newer release. With that, we can then turn our EventDispatcher into a proxy class that can properly map from the old syntax to the new.

We'll be able to re-implement the public methods currently available on the EventDispatcher, so all modules that have updated the EventDispatcher and Event references will not experience a breaking change at that point. (Of course, unless we include other breaking changes at the same time.)

## Could we have just kept using the old version?

No, because eventually PHP support and dependency conflicts will make this a pressing issue.

Moving away from the tight coupling we mistakenly implemented all those years ago is the only way forward, but we do want to do so sensibly and give you the chance to be "forward compatible" by adopting these new classes now.
