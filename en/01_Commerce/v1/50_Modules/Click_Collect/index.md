---
title: Click & Collect
---

Click & Collect is a shipping method implementation that allows merchants to manage available timeslots for pickup (or delivery, but not both simultaneously). 

It can be installed for free through the modmore package provider and is covered by standard support.

[TOC]

## Installation

First install the package via the package manager. It's free.

Next enable the module in Commerce > Configuration > Modules. You'll now find the Click & Collect top menu item to be available.

## Managing time slots

Managing available slots is a two-step process in Commerce > 

1. Set up "Schedules" that cover your standard opening hours and the time slots customers can choose from. You can also think of Schedules as "blueprints" in that you configure them once, and then reuse them over and over. 

2. Apply a "Schedule" to a specific date on the "Planning" tab. This copies the slots from the schedule and allows you to make changes to slots on specific dates. 

As a suggestion, consider creating a "weekday" and "weekend" schedule and apply those to the next few days before continuing onwards. 

## Create the shipping method

In Commerce > Configuration > Shipping Methods, choose to create a new Click & Collect shipping method, assigned to your delivery type. 

You can have multiple shipping methods, but they all share the same planning and schedules, so that's not necessarily very useful. 

On the shipping method you can set the maximum number of days a customer can place an order for ahead of time. That rolls over at midnight each day. The minimum time between placing an order and a pickup slot is configured on individual slots in the schedule ("Lead time", in minutes) or planning ("Closes after", specific timestamp). 

## Set-up the status change action

To make sure placing an order reduces the amount of reservations that can be placed within a single slot, go to Commerce > Configuration > Statuses and edit your "Payment Received" status change.

Add the "Reserve Click & Collect Slot" status change action. 

## Customising the front-end

By default the available dates and slots are shown in a similar way as different payment gateways show their options, which has some basic styling attached in both the default theme and the Red starter page. 

You can apply your own CSS to make it fit your brand, or you can [replace the template to build something completely different](Template). 


