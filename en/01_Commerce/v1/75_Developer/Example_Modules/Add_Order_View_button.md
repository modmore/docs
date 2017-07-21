This example shows how you can add additional action buttons to the top of the order detail view. In this particular example it adds a link to edit the coupon the customer used in the order. 

Other use cases could include adding a "Print" button that links to a different page that is formatted as a printable order receipt/invoice/packing slip, or adding a refund button. 

````
<?php

namespace modmore\Commerce\Modules\Admin;

use modmore\Commerce\Events\Admin\OrderActions;
use modmore\Commerce\Modules\BaseModule;
use Symfony\Component\EventDispatcher\EventDispatcher;

class AddOrderButton extends BaseModule
{
    public function getName()
    {
        return 'Add Coupon Button';
    }

    public function getAuthor()
    {
        return 'Mark Hamstra';
    }

    public function getDescription()
    {
        return 'Adds a button to the order detail view to manage the used coupon.';
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        $dispatcher->addListener(\Commerce::EVENT_ORDER_GET_ACTIONS, array($this, 'addButton'));
    }

    public function addButton(OrderActions $event)
    {
        $order = $event->getOrder();
        if ($coupon = $order->hasCoupon()) {
            $actions = $event->getActions();
            $actions[] = [
                'url' => $this->adapter->makeAdminUrl('coupons/update', ['id' => $coupon->get('id')]),
                'title' => 'Edit coupon used in order',
                'modal' => true
            ];
            $event->setActions($actions);
        }
    }
}
````