Time Slot uses a template in `clickcollect/frontend/shipping_form.twig` for rendering its options for customers.

When replacing this with your own theme, make sure that you provide `name="shipment_details[{{ shipment.id }}][date]` with the selected date in Y-m-d format, and that `name="shipment_details[{{ shipment.id }}][slot]` contains the ID of the selected timeslot.

[TOC]

## Available placeholders

```` 
array (size=5)
  'shipment' => 
    array (size=32)
      'id' => int 19876
      'class_key' => string 'comOrderShipment' (length=16)
      'properties' => null
      'test' => boolean true
      'order' => int 8978
      'delivery_type' => int 1
      'status' => int 0
      'method' => int 1749
      'tracking_reference' => string '' (length=0)
      'currency' => string 'EUR' (length=3)
      'product_quantity' => int 3
      'product_value' => int 3591
      'product_value_ex_tax' => int 3420
      'weight' => float 300
      'weight_unit' => string 'g' (length=1)
      'fee' => int 0
      'is_inclusive' => boolean false
      'tax_group' => int 1791
      'tax_rate' => int 0
      'tax_percentage' => float 0
      'fee_ex_tax' => int 0
      'tax_amount' => int 0
      'fee_incl_tax' => int 0
      'product_value_formatted' => string '€35.91' (length=8)
      'product_value_ex_tax_formatted' => string '€34.20' (length=8)
      'fee_formatted' => string '€0.00' (length=7)
      'tax_percentage_formatted' => string '0%' (length=2)
      'fee_ex_tax_formatted' => string '€0.00' (length=7)
      'tax_amount_formatted' => string '€0.00' (length=7)
      'fee_incl_tax_formatted' => string '€0.00' (length=7)
      'weight_formatted' => string '300 g' (length=5)
      'tracking_url' => string '' (length=0)
  'order' => 
    array (size=43)
      'id' => int 8978
      'class_key' => string 'comCartOrder' (length=12)
      'properties' => ...
      'secret' => string '...' (length=64)
      'test' => boolean true
      'status' => int 1
      'currency' => string 'EUR' (length=3)
      'context' => string 'web' (length=3)
      'reference' => string '' (length=0)
      'reference_incr' => int 0
      'subtotal' => int 3800
      'discount' => int 380
      'shipping' => int 0
      'transaction' => int 0
      'total_before_tax' => int 3420
      'total_ex_tax' => int 3420
      'tax' => int 171
      'total' => int 3591
      'total_due' => int 3591
      'total_quantity' => int 3
      'created_on' => int 1612029813
      'received_on' => int 0
      'last_updated_on' => int 1612394678
      'status_updated_on' => int 0
      'created_by' => int 1
      'last_updated_by' => int 1
      'status_updated_by' => int 0
      'shipping_method' => int 0
      'parent' => int 0
      'user' => int 1
      'subtotal_formatted' => string '€38.00' (length=8)
      'discount_formatted' => string '€3.80' (length=7)
      'shipping_formatted' => string '€0.00' (length=7)
      'transaction_formatted' => string '€0.00' (length=7)
      'total_before_tax_formatted' => string '€34.20' (length=8)
      'total_ex_tax_formatted' => string '€34.20' (length=8)
      'tax_formatted' => string '€1.71' (length=7)
      'total_formatted' => string '€35.91' (length=8)
      'total_due_formatted' => string '€35.91' (length=8)
      'created_on_formatted' => string '2021-01-30 at 19:03:33 CET' (length=26)
      'received_on_formatted' => string '' (length=0)
      'last_updated_on_formatted' => string '2021-02-04 at 00:24:38 CET' (length=26)
      'status_updated_on_formatted' => string '' (length=0)
  'options' => 
    .... see below ....
  'selected_date' => string '2021-02-04' (length=10)
  'selected_slot' => int -1
````

## Options placeholders

The options contain all the slots that match the current configuration, i.e. all slots in the date range currently allowed.

The default template filters the output on only dates with at least one available slot, and unavailable slots are also hidden, but you can change this if you'd like to provide the customer with information that a certain date is full or that the store is closed that day.

The default template uses a markup/interface structure along the lines of an accordion. With some customisation and javascript (or some creative CSS!) it would also be possible to instead use double selects. 

All this is in the `{{ options }}` structure, which might look something like this:

````
array (size=11)
  '2021-02-04' => 
    array (size=6)
      'locale_day' => string 'Thursday' (length=8)
      'locale_day_short' => string 'Thu' (length=3)
      'locale_date_preferred' => string '02/04/21' (length=8)
      'locale_date_tz' => string 'CET' (length=3)
      'available_slots' => int 0
      'slots' => 
        array (size=2)
          0 => 
            array (size=21)
              'id' => int 5
              'class_key' => string 'ctsDateSlot' (length=12)
              'properties' => null
              'for_date' => int 2
              'base_slot' => int 10
              'schedule' => int 3
              'time_from' => int 1612432800
              'time_until' => int 1612436400
              'closes_after' => int 1612375200
              'max_reservations' => int 50
              'available_reservations' => int 50
              'date_id' => string '2' (length=1)
              'date_class_key' => string 'ctsDate' (length=8)
              'date_properties' => null
              'date_for_date' => string '2021-02-04' (length=10)
              'date_schedule' => string '3' (length=1)
              'time_from_formatted' => string '2021-02-04 at 11:00:00 CET' (length=26)
              'time_until_formatted' => string '2021-02-04 at 12:00:00 CET' (length=26)
              'closes_after_formatted' => string '2021-02-03 at 19:00:00 CET' (length=26)
              'available' => boolean false
              'closes_after_sameday' => boolean false
          1 => 
            array (size=21)
              'id' => int 6
              'class_key' => string 'ctsDateSlot' (length=12)
              'properties' => null
              'for_date' => int 2
              'base_slot' => int 11
              'schedule' => int 3
              'time_from' => int 1612436400
              'time_until' => int 1612447200
              'closes_after' => int 1612431000
              'max_reservations' => int 40
              'available_reservations' => int 40
              'date_id' => string '2' (length=1)
              'date_class_key' => string 'ctsDate' (length=8)
              'date_properties' => null
              'date_for_date' => string '2021-02-04' (length=10)
              'date_schedule' => string '3' (length=1)
              'time_from_formatted' => string '2021-02-04 at 12:00:00 CET' (length=26)
              'time_until_formatted' => string '2021-02-04 at 15:00:00 CET' (length=26)
              'closes_after_formatted' => string '2021-02-04 at 10:30:00 CET' (length=26)
              'available' => boolean true
              'closes_after_sameday' => boolean true
  '2021-02-05' => 
    array (size=6)
      'locale_day' => string 'Friday' (length=6)
      'locale_day_short' => string 'Fri' (length=3)
      'locale_date_preferred' => string '02/05/21' (length=8)
      'locale_date_tz' => string 'CET' (length=3)
      'available_slots' => int 0
      'slots' => 
        array (size=5)
          0 => 
            array (size=21)
              'id' => int 11
              'class_key' => string 'ctsDateSlot' (length=12)
              'properties' => null
              'for_date' => int 3
              'base_slot' => int 10
              'schedule' => int 3
              'time_from' => int 1612512000
              'time_until' => int 1612522800
              'closes_after' => int 1612506600
              'max_reservations' => int 50
              'available_reservations' => int 48
              'date_id' => string '3' (length=1)
              'date_class_key' => string 'ctsDate' (length=8)
              'date_properties' => null
              'date_for_date' => string '2021-02-05' (length=10)
              'date_schedule' => string '2' (length=1)
              'time_from_formatted' => string '2021-02-05 at 09:00:00 CET' (length=26)
              'time_until_formatted' => string '2021-02-05 at 12:00:00 CET' (length=26)
              'closes_after_formatted' => string '2021-02-05 at 07:30:00 CET' (length=26)
              'available' => boolean true
              'closes_after_sameday' => boolean true
          1 => 
            array (size=21)
              'id' => int 19
              'class_key' => string 'ctsDateSlot' (length=12)
              'properties' => null
              'for_date' => int 3
              'base_slot' => int 8
              'schedule' => int 2
              'time_from' => int 1612528200
              'time_until' => int 1612530000
              'closes_after' => int 1612523700
              'max_reservations' => int 10
              'available_reservations' => int 10
              'date_id' => string '3' (length=1)
              'date_class_key' => string 'ctsDate' (length=8)
              'date_properties' => null
              'date_for_date' => string '2021-02-05' (length=10)
              'date_schedule' => string '2' (length=1)
              'time_from_formatted' => string '2021-02-05 at 13:30:00 CET' (length=26)
              'time_until_formatted' => string '2021-02-05 at 14:00:00 CET' (length=26)
              'closes_after_formatted' => string '2021-02-05 at 12:15:00 CET' (length=26)
              'available' => boolean true
              'closes_after_sameday' => boolean true
          2 => 
            array (size=21)
              'id' => int 20
              'class_key' => string 'ctsDateSlot' (length=12)
              'properties' => null
              'for_date' => int 3
              'base_slot' => int 2
              'schedule' => int 2
              'time_from' => int 1612531800
              'time_until' => int 1612533600
              'closes_after' => int 1612527300
              'max_reservations' => int 10
              'available_reservations' => int 10
              'date_id' => string '3' (length=1)
              'date_class_key' => string 'ctsDate' (length=8)
              'date_properties' => null
              'date_for_date' => string '2021-02-05' (length=10)
              'date_schedule' => string '2' (length=1)
              'time_from_formatted' => string '2021-02-05 at 14:30:00 CET' (length=26)
              'time_until_formatted' => string '2021-02-05 at 15:00:00 CET' (length=26)
              'closes_after_formatted' => string '2021-02-05 at 13:15:00 CET' (length=26)
              'available' => boolean true
              'closes_after_sameday' => boolean true
          3 => 
            array (size=21)
              'id' => int 21
              'class_key' => string 'ctsDateSlot' (length=12)
              'properties' => null
              'for_date' => int 3
              'base_slot' => int 1
              'schedule' => int 2
              'time_from' => int 1612533600
              'time_until' => int 1612535400
              'closes_after' => int 1612530000
              'max_reservations' => int 5
              'available_reservations' => int 5
              'date_id' => string '3' (length=1)
              'date_class_key' => string 'ctsDate' (length=8)
              'date_properties' => null
              'date_for_date' => string '2021-02-05' (length=10)
              'date_schedule' => string '2' (length=1)
              'time_from_formatted' => string '2021-02-05 at 15:00:00 CET' (length=26)
              'time_until_formatted' => string '2021-02-05 at 15:30:00 CET' (length=26)
              'closes_after_formatted' => string '2021-02-05 at 14:00:00 CET' (length=26)
              'available' => boolean true
              'closes_after_sameday' => boolean true
          4 => 
            array (size=21)
              'id' => int 22
              'class_key' => string 'ctsDateSlot' (length=12)
              'properties' => null
              'for_date' => int 3
              'base_slot' => int 7
              'schedule' => int 2
              'time_from' => int 1612535400
              'time_until' => int 1612540800
              'closes_after' => int 1612530000
              'max_reservations' => int 50
              'available_reservations' => int 50
              'date_id' => string '3' (length=1)
              'date_class_key' => string 'ctsDate' (length=8)
              'date_properties' => null
              'date_for_date' => string '2021-02-05' (length=10)
              'date_schedule' => string '2' (length=1)
              'time_from_formatted' => string '2021-02-05 at 15:30:00 CET' (length=26)
              'time_until_formatted' => string '2021-02-05 at 17:00:00 CET' (length=26)
              'closes_after_formatted' => string '2021-02-05 at 14:00:00 CET' (length=26)
              'available' => boolean true
              'closes_after_sameday' => boolean true
  '2021-02-06' => 
    array (size=6)
      'locale_day' => string 'Saturday' (length=8)
      'locale_day_short' => string 'Sat' (length=3)
      'locale_date_preferred' => string '02/06/21' (length=8)
      'locale_date_tz' => string 'CET' (length=3)
      'available_slots' => int 0
      'slots' => 
        array (size=0)
          empty
````

Note: above is missing `price` and `price_formatted` on each slot, was added after preparing that example. 
