---
title: Time Slots
---

Time Slots is a shipping method implementation that allows merchants to manage available timeslots for pickup or delivery at specific times during the day. Customers can reserve a slot through the front-end.

It can be installed for free through the modmore package provider and is covered by standard support.

**The Time Slots extension is currently in private beta and expected to be more widely released in a matter of days. Thank you for your patience. If you wish to join the beta, please email support@modmore.com.**

[TOC]

## Installation

First install the package via the package manager. It's free.

Next enable the module in Commerce > Configuration > Modules. You'll now find the Time Slots top menu item to be available.

## Commerce 1.2.0-rc2 or earlier

The package requires a fix that ships with 1.2.0-rc3. For older versions, please patch the following.

File: `core/components/commerce/model/commerce/comordershipment.class.php`
Line: approx 286

Change the following `setShippingMethod` function from:

````php 
    public function setShippingMethod(comShippingMethod $method, array $data = [])
    {
        $this->set('method', $method->get('id'));
        $this->set('fee', 0); // Reset the fee so it doesn't affect anything
        $this->calculate(); // Recalculate the totals and the fee
        return true;
    }
````

to:

````php
    public function setShippingMethod(comShippingMethod $method, array $data = [])
    {
        $this->set('method', $method->get('id'));
        $this->set('fee', 0); // Reset the fee so it doesn't affect anything
        
        // Allow the shipping method to receive the data and process things accordingly
        $success = $method->setShippingInformation($this->getOrder(), $this, $data);

        // Recalculate the totals and the fee
        $this->calculate();

        return $success;
    }
````

Without this fix, submitting the shipping method will show an error (and/or redirect back to the checkout; some JS enhancements don't show the error immediately).

We don't normally recommend editing core files, however (1) this module was built on a tight time frame to accommodate shops being allowed to reopen for pickup, (2) this is an easy fix, (3) the fix is already included in a future release so you wont lose the patch once you upgrade to 1.2.0-rc3 or above.

## Managing time slots

Managing available slots is a three-step process in Commerce: 

1. Create at least one shipping method in Commerce > Configuration of the type "Time Slot Shipping Method". Only need to do this once per type of delivery you want to offer.
   
2. Set up "Schedules" that cover your standard opening hours and the time slots customers can choose from. You can also think of Schedules as "blueprints" in that you configure them once, and then reuse them over and over. 

3. Apply a "Schedule" to a specific date for a specific shipping on their planning tab. This copies the slots from the schedule and allows you to make changes to slots on specific dates. If you have multiple shipping methods created of the time slot type, each shipping method will get its own planning tab and therefore can have its own planning, slots, and prices. 

As a suggestion, consider creating a "weekday" and "weekend" schedule and apply those to the next few days before continuing onwards. 

## Create the shipping method

In Commerce > Configuration > Shipping Methods, choose to create a new Time Slot shipping method, assigned to your delivery type. 

You can have multiple shipping methods, each with their own planning and slots. 

On the shipping method you can configure the maximum number of days a customer can place an order for ahead of time. That rolls over at midnight (server time) each day. The minimum time between placing an order and the start of a slot is configured on individual slots in the schedule ("Lead time", in minutes) or planning ("Closes after", specific timestamp). 

## Set-up the status change action

To make sure placing an order reduces the amount of reservations that can be placed within a single slot, go to Commerce > Configuration > Statuses and edit your "Payment Received" status change.

Add the "Reserve Time Slot" status change action. 

## Customising the front-end

By default the available dates and slots are shown in a similar way as different payment gateways show their options, which has some basic styling attached in both the default theme and the Red starter page. 

You can apply your own CSS to make it fit your brand, or you can [replace the template to build something completely different](Shipping_Template).
