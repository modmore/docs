One of the primary ways to extend Commerce is through Modules. These are simple classes, implementing the `modmore\Commerce\Modules\ModuleInterface` interface (there's an abstract `BaseModule` class in the same namespace which provides some basic handling).

The module contains a couple of methods that define meta data about the module that is used in the back-end Modules configuration. This includes `getName()`, `getAuthor()` and `getDescription()`.

In a module, you will need to define an `initialize` method. This is called when the module is initialised by the Commerce core, and allows you to specify on what events your module needs to run. In Commerce we're using the Symfony2 EventDispatcher module to handle events. 

Every time your module fires, it will receive an `Event` object that contains references to relevant objects, like orders or items.

Here's an example module:

```` php
<?php
namespace ThirdParty\Modules;
use Symfony\Component\EventDispatcher\EventDispatcher;

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
        $dispatcher->addListener(\modmore\Commerce\Frontend\Checkout\Process::BEFORE_PROCESS_STEP, array($this, 'echoHelloWorld'));
    }

    public function echoHelloWorld(\modmore\Commerce\Events\Checkout $event)
    {
        $response = $event->getResponse();
        $response->setMessage('Hello world!');
    }
}
````

For more example code, see the [Example Modules](Example_Modules) section. 

## Loading Modules

The merchant has control over which module is enabled in both test and live modes. This is done via Configuration > Modules in the Commerce admin.

In order for the modules to show up in that list, it must first be registered. This is done by creating a new `comModule` record with the class name and path. This would typically be done in a transport package.

On the `Commerce` service class there is also a `loadModulesFromDirectory` method that accepts a directory, namespace and base path. This will browse the provided directory for classes that implement the ModuleInterface, and automatically create or update the `comModule` record. 

## Module Configuration

If your module requires the merchant to set up some configuration (API keys, feature toggles etc), you can provide [Form Fields](Admin/Form_Fields) that will be added to the module update window. These need to be returned from the `getModuleConfiguration(\comModule $module)` method, where the provided `$module` is the `comModule` object for your module. 
 
Through the `$this->getConfig($key, $default = null)` method inside your module, you can get the configuration values. These are set automatically (by calling `setConfiguration(array $config)`) when your module is constructed by the Commerce core.

