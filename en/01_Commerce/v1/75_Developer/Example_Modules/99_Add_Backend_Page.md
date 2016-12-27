For a full example of modules adding pages to the dashboard, look at the Coupons module (in core/components/commerce/src/Modules/Coupons.php) and its page definitions (in core/components/commerce/src/Admin/Modules/Coupons/). 

```` php
<?php

namespace modmore\Commerce\Subscriptions;

use modmore\Commerce\Admin\Generator;
use modmore\Commerce\Events\Admin\GeneratorEvent;
use modmore\Commerce\Events\Admin\TopNavMenu as TopNavMenuEvent;
use modmore\Commerce\Modules\BaseModule;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SubscriptionsPage extends BaseModule
{
    public function getName()
    {
        return 'Subscriptions';
    }

    public function getAuthor()
    {
        return 'Mark Hamstra';
    }

    public function getDescription()
    {
        return 'Example of a module that loads an additional page into the menu and generator.';
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(Generator::COLLECT_PAGES_EVENT, array($this, 'loadPage'));
        $dispatcher->addListener(Generator::COLLECT_MENU_EVENT, array($this, 'loadMenuItem'));
    }

    public function loadPage(GeneratorEvent $event)
    {
        $generator = $event->getGenerator();
        $generator->addPage('subscriptions', '\modmore\Commerce\Subscriptions\Overview');
        $generator->addPage('subscriptions/active', '\modmore\Commerce\Subscriptions\ActiveOverview');
        $generator->addPage('subscriptions/expired', '\modmore\Commerce\Subscriptions\ExpiredOverview');
    }

    public function loadMenuItem(TopNavMenuEvent $event)
    {
        $items = $event->getItems();

        $items = $this->insertInArray($items, ['subscriptions' => [
            'name' => 'Subscriptions',
            'key' => 'subscriptions',
            'link' => $this->adapter->makeAdminUrl('subscriptions'),
            'submenu' => [
                [
                    'name' => 'Products',
                    'key' => 'subscriptions',
                    'link' => $this->adapter->makeAdminUrl('subscriptions')
                ],
                [
                    'name' => 'Active Subscriptions',
                    'key' => 'subscriptions/active',
                    'link' => $this->adapter->makeAdminUrl('subscriptions/active')
                ],
                [
                    'name' => 'Expired Subscriptions',
                    'key' => 'subscriptions/expired',
                    'link' => $this->adapter->makeAdminUrl('subscriptions/expired')
                ],
            ]
        ]], 2);

        $event->setItems($items);
    }

    private function insertInArray($array,$values,$offset) {
        return array_slice($array, 0, $offset, true) + $values + array_slice($array, $offset, NULL, true);
    }
}


````