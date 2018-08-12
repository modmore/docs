If your shipping costs are dynamically generated based on product weight, size or quantity, and the [standard shipping methods](../Shipping_Methods) in Commerce are not flexible enough, or  if you'd like to integrate with the API of a shipping partner to calculate the right total, you can develop a custom shipping method.

## Basics

A custom shipping method is a derivative of the comShippingMethod object. This derivative would override the `getPrice(comOrder $order, $orderTotal)` method to use its own price logic instead.

You can use a [Module](Modules) to load the package containing your xPDO model. Just call `$this->adapter->loadPackage($name, $path)` in the `initialize` method to make xPDO aware of your derivative. 

## Example

In the annotated example below, we calculate a shipping price where each item in the cart is a flat €5, plus €1 for each quantity of that item. 

This is an unlikely scenario, but just there to give you an idea of how it would work.

First, you'll need to define your [xPDO schema](https://docs.modx.com/xpdo/2.x/getting-started/creating-a-model-with-xpdo/defining-a-schema/defining-the-database-and-tables). It could be located in `core/components/my_shipping_method/schema/` and look somewhat like this:

```` xml
<?xml version="1.0" encoding="UTF-8"?>
<model package="my_shipping_method" baseClass="comSimpleObject" platform="mysql" defaultEngine="MyISAM" version="1.1">
    <object class="mySampleShippingMethod" extends="comShippingMethod" inherit="single" />
</model>
````

Next, [build the model files from the schema](https://docs.modx.com/xpdo/2.x/getting-started/creating-a-model-with-xpdo/generating-the-model-code) using a standard schema build script. 

Once you've done that, you can find your custom shipping method in `core/components/my_shipping_method/model/my_shipping_method/mysampleshippingmethod.class.php`. 

Edit that file and add the `getPriceForShipment` method override. 

```` php
<?php
class mySampleShippingMethod extends comShippingMethod
{
    public function getPriceForShipment(comOrderShipment $shipment)
    {
        // The parent class takes care of calculating the price based
        // on a configured absolute or percentage fee on the shipping method. 
        $price = parent::getPriceForShipment($shipment);

        // Grab the products for this order to determine product weight/dimensions/count
        // For this example we charge €5 per unique item + €1 per quantity of that item
        $items = $shipment->getItems();
        foreach ($items as $item) {
            $price += 500;
            $price += $item->get('quantity') * 100;
        }
        
        // We return the unformatted price in cents
        return $price;
    }
}
````

[Shipments are collections of items in an order](../Orders/Shipments) that have the same delivery type and shipping method. With `$shipment->getItems()` you can access the items assigned to the current shipment. 

You can get an [$order object](Orders) with `$shipment->getOrder()`. That gives you easy access to _all_ order items (`$order->getItems()`), the shipping address (`$order->getShippingAddress()`) and more. To retrieve products, loop over `$order->getItems()` or `$shipment->getItems()` and call `$item->getProduct()`. That will give you the [comProduct instance](Products), which you can use to grab things like the weight (`$product->getWeight()`). 

The total weight for all products in the shipment (as a `Mass` instance) is available with `$shipment->getWeight()`.

If your shipping method needs to define additional options for the merchant to configure, you can do that by providing a getModelFields method. For example like this:

```` php

<?php
class mySampleShippingMethod extends comShippingMethod
{
    // ... other methods ...
    public function getModelFields()
    {
        $fields = [];
        $fields[] = new \modmore\Commerce\Admin\Widgets\Form\TextField($this->commerce, [
            'label' => 'API Key',
            'name' => 'properties[api_key]',
            'value' => $this->getProperty('api_key'),
        ]);
        return $fields;
    }
````

Any field instance can be used, and you can also use the built-in validation. [See Forms & Fields](Admin/Form_Fields) for more information on defining fields. 

Commerce ships with the standard `comShippingMethod` ("Standard Shipping Method"), a country-based `comShippingMethodByCountry` ("Country-Specific Shipping Method"), and the `comShippingMethodByWeight` ("Weight-Specific Shipping Method") shipping method class. These can be useful for inspiration.
