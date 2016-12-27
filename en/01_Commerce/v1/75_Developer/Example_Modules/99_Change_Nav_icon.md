This module sample shows how you can change a navigation icon in the manager. This module changes the icon for the Modules subnav under Configuration.

````
<?php

namespace modmore\Commerce\Modules\Admin;

use modmore\Commerce\Admin\Generator;
use modmore\Commerce\Events\Admin\TopNavMenu as TopNavMenuEvent;
use modmore\Commerce\Modules\BaseModule;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ChangeIcon extends BaseModule
{
    public function getName()
    {
        return 'Change Icon';
    }

    public function getAuthor()
    {
        return 'Mark Hamstra';
    }

    public function getDescription()
    {
        return 'Changes the menu items to suit Isaac\'s preferences better.';
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(Generator::COLLECT_MENU_EVENT, array($this, 'loadMenuItem'));
    }

    public function loadMenuItem(TopNavMenuEvent $event)
    {
        $items = $event->getItems();

        foreach ($items['configuration']['submenu'] as &$subitem) {
            if ($subitem['key'] === 'configuration/modules') {
                $subitem['icon'] = 'icon icon-bars';
            }
        }

        $event->setItems($items);
    }
}
````