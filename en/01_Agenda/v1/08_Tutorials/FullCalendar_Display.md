You could use the FullCalendar 3 script in the frontend with the following steps.

[TOC]

## Basic Setup

First rename the file assets/components/agenda/_overview.php to overview.php. 
Afterwards edit it and remove the exit(); in line 12.

The Agenda backend uses FullCalendar 3 for the calendar display. You have to
create a working FullCalendar script according to the
[documentation](https://fullcalendar.io/docs/v3/installation)

## Restrict the request

If you need to restict the overview connector to a special calendar, category,
time range etc., you could apply your own request variables after the line 29 in
the overview connector.

## Call the frontend scripts

Finally you have to initialize the FullCalendar script with the following code:

```js
$('#fullcalendar').fullCalendar({
    events: {
        url: 'assets/components/agenda/overview.php',
        type: 'POST',
        startParam: 'startdate',
        endParam: 'enddate',
        data: function () {
            return {
                //calendars: calendars || 0,
                //categories: categories || 0,
                //query: query || '',
                limit: 0
            };
        }
    }
});
```

Maybe it is possble to make this work with FullCalendar 4 or 5, but thats not
part of this instruction.
