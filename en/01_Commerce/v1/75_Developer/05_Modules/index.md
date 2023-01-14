One of the primary ways to extend Commerce is through Modules.

Modules are simple definition classes that implement the `modmore\Commerce\Modules\ModuleInterface` interface (there's an abstract `BaseModule` class in the same namespace which provides some basic handling).

The module defines metadata about the module that is used in the back-end Modules configuration. This includes `getName()`, `getAuthor()` and `getDescription()`.

In a module, you define an `initialize` method. This is called when the module is initialised by the Commerce core, and allows you to specify on what events your module needs to run. Commerce uses the Symfony EventDispatcher module to handle events. All core events can be found as constants on the `\Commerce` class.

> As of Commerce 1.3, we're [replacing the Symfony EventDispatcher with a Commerce-native class](../../80_Upgrades/v2.0/EventDispatcher.md). The code samples in the documentation have been updated.

Every time your module fires, it will receive an `Event` object that contains references to relevant objects, like orders or items. Each type of event will have its own event class, [a full list of events and classes can be found here](Events.md).

## Basic example

Here's an example module class showing the basic structure:

```` php
<?php
namespace ThirdParty\Modules;

use modmore\Commerce\Dispatcher\EventDispatcher;
// For modules that need to support 1.2 or before, replace with:
// use Symfony\Component\EventDispatcher\EventDispatcher;

class TestModule extends \modmore\Commerce\Modules\BaseModule {

    public function getName()
    {
        return 'Third Party Namespaced Module';
    }

    public function getAuthor()
    {
        return 'Not Mark Hamstra';
    }

    public function getDescription()
    {
        return 'A third party namespaced loaded module that sets a message "Hello World" on the checkout page.';
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(\Commerce::EVENT_CHECKOUT_BEFORE_STEP, array($this, 'echoHelloWorld'));
    }

    public function echoHelloWorld(\modmore\Commerce\Events\Checkout $event)
    {
        $response = $event->getResponse();
        $response->setMessage('Hello world!');
    }
}
````

When registered and enabled, this module runs the `echoHelloWorld` method on the `\Commerce::EVENT_CHECKOUT_BEFORE_STEP` event. It sets a message that will be shown in the checkout.

For more example module classes, see the [Examples](Examples) section. [A full list of events and event classes can be found here](Events). We strongly recommend using a PHP IDE like PhpStorm when developing to take full advantage of autocomplete and being able of easily inspecting the relevant source.

## Building modules tutorial

There is more that goes into building a module or extension than just the module class itself. There is a module skeleton we offer via Composer to help with that.

[Start your module building adventure here](../Guides/01_Bootstrapping_a_Module.md)

## Loading Modules

The merchant has control over which modules are enabled in both test and live modes. This is done via Configuration > Modules in the Commerce admin.

In order for the modules to show up in that list, it must first be registered. This is done by creating a new `comModule` record with the class name and path. This would typically be done in a transport package.

On the `Commerce` service class there is also a `loadModulesFromDirectory` method that accepts a directory, namespace and base path. This will browse the provided directory for classes that implement the ModuleInterface, and automatically create or update the `comModule` record.

## Module Configuration

If your module requires the merchant to set up some configuration (API keys, feature toggles etc), you can provide [Form Fields](../Admin/Form_Fields) that will be added to the module update window.

These need to be returned as an array from the `getModuleConfiguration(\comModule $module)` method, where the provided `$module` is the `comModule` object for your module.

Through the `$this->getConfig($key, $default = null)` method inside your module, you can get the configuration values. These are set automatically (by calling `setConfiguration(array $config)`) when your module is constructed by the Commerce core.

