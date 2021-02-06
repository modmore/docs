Once the customer has chosen a time slot (or Commerce pre-selected the Click & Collect shipping method, and the first available slot was automatically selected), you will have access to the slot information to show to the customer.

[TOC]

## General

Information about the chosen slot is stored in the shipment. The basic method to access that information is by iterating over the shipments. To avoid trying to access or render information that isn't there, make sure to check the class key on the chosen method, as well as the presence of a `clickcollect_slot_info` property. For example:

```` 
{% for shipment in shipments %}
    {% if shipment.method %}
        {{ shipment.method.name }}

        {% if shipment.method.class_key == 'ClickCollectShippingMethod' and shipment.properties.clickcollect_slot_info %}
        
            {# This is where you'll find the goodies! %}
            {{ shipment.properties.clickcollect_date.locale_day }}
            {{ shipment.properties.clickcollect_slot_info.time_from|date('H:i') }}
            {{ shipment.properties.clickcollect_slot_info.time_until|date('H:i') }}
        {% endif %}
    {% endif %}
{% endif %}
````

The shipping method will set 4 properties on the shipment:

- `shipment.properties.clickcollect_slot`: the ID of the slot.
- `shipment.properties.clickcollect_slot_info`: an object with all information about the selected slot. See the bottom of this page for an example or call `{{ dump(shipment.properties.clickcollect_slot_info) }}`.
- `shipment.properties.clickcollect_slot_autoselected`: boolean indicating if the customer chose the slot, or if the slot was automatically selected (as the first slot with availability).
- `shipment.properties.clickcollect_date`: the date in Y-m-d format the customer selected.
- `shipment.properties.clickcollect_date_info`: an object containing information about the selected note. Notably, you can use this to easily access locale-aware datestamps including `locale_day` (`%A`, eg Wednesday), `locale_day_short` (`%a`, eg Wed), `locale_date_preferred` (`%x`, eg 15/2/21) and `locale_date_tz` (`%Z`, eg `CET`).

## In the checkout summary

The following, when placed in the summary block of your checkout (eg by default `frontend/checkout/partial/summary.twig`) right below the name (aroundline 70 in the default), very simply shows the selected day (eg Wednesday) and time window. 

```` 
{% if shipment.method.class_key == 'ClickCollectShippingMethod' and shipment.properties.clickcollect_slot_info %}
    <br>
    <span style="font-weight: normal; opacity: 0.85;">
        {{ shipment.properties.clickcollect_date_info.locale_day }},
        {{ shipment.properties.clickcollect_slot_info.time_from|date('H:i') }}&ndash;{{ shipment.properties.clickcollect_slot_info.time_until|date('H:i') }}
    </span>
{% endif %}
````

Note that if you allow reserving timeslots longer than 6 days in advance (which is configurable on the shipping method), using the `locale_day` may be ambigious: if today is Tuesday, but the shown date is "Tuesday" - is that today or next week? If you allow timeslots further in the future than a week, make sure to also render the date.

You can use any [DateTime formatting value](https://www.php.net/manual/en/datetime.format.php) when passing `time_from`, `time_until` or `closes_after` to the `|date` filter.

## Example dump of properties

```` 
array (size=5)
  'clickcollect_date' => string '2021-02-07' (length=10)
  'clickcollect_slot_info' => 
    array (size=21)
      'id' => int 31
      'class_key' => string 'clcoDateSlot' (length=12)
      'properties' => null
      'for_date' => int 5
      'base_slot' => int 10
      'schedule' => int 3
      'time_from' => int 1612684800
      'time_until' => int 1612695600
      'closes_after' => int 1612679400
      'max_reservations' => int 50
      'available_reservations' => int 50
      'date_id' => string '5' (length=1)
      'date_class_key' => string 'clcoDate' (length=8)
      'date_properties' => null
      'date_for_date' => string '2021-02-07' (length=10)
      'date_schedule' => string '3' (length=1)
      'time_from_formatted' => string '2021-02-07 at 09:00:00 CET' (length=26)
      'time_until_formatted' => string '2021-02-07 at 12:00:00 CET' (length=26)
      'closes_after_formatted' => string '2021-02-07 at 07:30:00 CET' (length=26)
      'available' => boolean true
      'closes_after_sameday' => boolean true
  'clickcollect_slot_autoselected' => boolean false
  'clickcollect_slot' => string '31' (length=2)
  'clickcollect_date_info' => 
    array (size=5)
      'locale_day' => string 'Sunday' (length=6)
      'locale_day_short' => string 'Sun' (length=3)
      'locale_date_preferred' => string '02/07/21' (length=8)
      'locale_date_tz' => string 'CET' (length=3)
      'available_slots' => int 2
````

