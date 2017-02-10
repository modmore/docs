Before diving into custom tax rate providers, make sure that you've read (and understood) [how taxes work in Commerce](../Taxes). 

With a Custom Tax Rate provider it's possible to set tax rates based on your own business/tax regulation logic. While Tax Rules should be used for the basic logic ("use this tax rate provider for customers from Europe"), the tax rate provider can access any order/address data to return the tax rate (percentage) that needs to be applied to an order.

[TOC]

## High-level Overview

To create a custom tax provider, you need to create an implementation of the abstract `modmore\Commerce\Taxes\RateProvider` class. That class can be found in `core/components/commerce/src/Taxes/RateProvider.php`.

There are 2 primary class methods to implement:

- `public function getModelFields(\comTaxRule $rule)`: to return an array of [Form Fields](Admin/Form_Fields) that make up the rate provider options. They all need a name of `rate_provider_options[KEY]`, and check for a previously saved value in `$rule->get('rate_provider_options')`. 
- `public function determine()`: to determine and return an **array** of `comTaxRate` objects. This method is only called when the tax rules determined that your rate provider needs to be run, but it may run multiple times for multiple products. You can access `$this->order` and `$this->getOption()` to make your determination.

## Determining the comTaxRate

Here's an example, part of the _Manual_ tax rate provider, that shows a simple way of determining and returning a tax rate:

```` php
<?php

namespace modmore\Commerce\Taxes;

use modmore\Commerce\Admin\Widgets\Form\NumberField;
use modmore\Commerce\Admin\Widgets\Form\TextField;

class Manual extends RateProvider {

    public function getModelFields(\comTaxRule $rule)
    {
        $fields = [];
        // ...
        return $fields
    }

    /**
     * @return \comTaxRate[]
     */
    public function determine()
    {
        $percentage = (float)$this->getOption('rate', 0.00);
        $key = $this->getOption('key', 'TAX-' . $percentage);
        $name = $this->getOption('name', $percentage . '% VAT');
        $taxRate = $this->getTaxRateObject($key, $name, $percentage);
        return [$taxRate];
    }

    public function getTaxRateObject($key, $name, $percentage)
    {
        /** @var \comTaxRate $taxRate */
        $taxRate = $this->adapter->getObject('comTaxRate', array(
            'key' => $key,
            'rate_provider' => __CLASS__,
            'percentage' => $percentage,
        ));

        if (!$taxRate) {
            $taxRate = $this->adapter->newObject('comTaxRate', array(
                'key' => $key,
                'rate_provider' => __CLASS__,
                'name' => $name,
                'percentage' => $percentage,
            ));
            $taxRate->save();
        }
        return $taxRate;
    }
}
````

**Note**: Make sure you return **an array of comTaxRate objects** - not the single object. Even if it's just one rate, it needs to be an array.

Within your rate provider, use `$this->order->getBillingAddress()` and `$this->order->getExpectedAddress()` to get the address for the customer. The expected address is filled by modules such as [AutoFillGeoIP](../Modules/Cart/AutoFillGeoIP), and [UserProfileAddress](../Modules/Cart/UserProfileAddress). That address is not yet confirmed by the customer, but can be used to show an initial calculation. 

The percentage set on the tax rate object can have up to 4 decimals. Setting it to `20.123` will charge a `20.123%` tax rate. The order items handle the calculation for both inclusive and exclusive tax rates, so you just have to provide the percentage. 