---
title: Registering a Payment Gateway
---

A module like the following can be used to load a [custom payment gateway](../Payment_Gateways).

```` php
<?php

namespace modmore\Commerce\Modules\Gateways;

use modmore\Commerce\Events\Gateways;
use modmore\Commerce\Modules\BaseModule;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GatewayName extends BaseModule
{
    public function getName()
    {
        return 'GatewayName';
    }

    public function getAuthor()
    {
        return 'My Name';
    }

    public function getDescription()
    {
        return 'Description of GatewayName';
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        // Listen to the event
        $dispatcher->addListener(\Commerce::EVENT_GET_PAYMENT_GATEWAYS, array($this, 'registerGateways'));
        
        // Also include your autoloader, or do a `require_once` to make your gateway class available in memory
        // While you could also do it at the top of the module file, doing it in the initialize method
        // allows finer control over when it is included.
    }

    public function registerGateways(Gateways $event)
    {
        // Add the GatewayName gateway, and log an error if the class couldn't be found.
        if (!$event->addGateway('modmore\Commerce\Gateways\GatewayName', 'GatewayName')) {
            $this->adapter->log(1, 'Could not add GatewayName - the class was probably not found');
        }
    }
}
````