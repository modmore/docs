If your shipping costs are dynamically generated based on product weight, size or quantity, the standard shipping method in Commerce which offers fixed or percentage prices may not be flexible enough. Or perhaps you'd like to integrate with the API of a shipping partner to calculate the right total.

At that point you'll need to look at developing a custom shipping method. 

## Basics

A custom shipping method is a derivative of the comShippingMethod object. This derivative would override the `getPrice(comOrder $order, $orderTotal)` method to use its own price logic instead.

Loading your custom shipping method class is done with a [Module](Modules).

## Example

In the annotated example below, we calculate a shipping price where each item in the cart is a flat €5, plus €1 for each quantity of that item. This is an unlikely scenario, but just there to give you an idea of how it would work.

```` php
<?php
class comShippingMethodSample extends comShippingMethod
{
    public function getPrice(comOrder $order, $orderTotal = 0)
    {
        // The parent class takes care of calculating the price based on a configured absolute or percentage fee
        // for the shipping method. 
        $price = parent::getPrice($order, $orderTotal);

        // Grab the products for this order to determine product weight/dimensions/count
        // For this example we charge €5 per unique item + €1 per quantity of that item
        $items = $order->getItems();
        foreach ($items as $item) {
            $price += 500;
            $price += $item->get('quantity') * 100;
        }
        
        // We return the unformatted price in cents
        return $price;
    }
}
````