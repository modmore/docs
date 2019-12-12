Using Agenda, you can manage and display dynamic opening hours on your site.
When you've completed this tutorial, you'll have a simple list showing the
opening hours in the next week.

![](img/opening-hours.jpg)

[TOC]

## Basic Setup

First create a new Calendar under Extras > Agenda > Calendars tab. Name it
"Opening Hours" with an alias of "openinghours", or something similar. Make sure
it's active, and give it a recognisable color.

In your events overview, start adding (recurring) events to your new calendar.

If you're **closed** on a certain day, add an **all day event** with what you
want to show as the event title (e.g. "Closed", or "Closed for private party").

If you're **open** on a certain day, add an event with a start and end date,
which corresponds with your opening hours.

Use the recurring events functionality to automatically repeat the opening hours
weekly. Once created, you can edit the start and end date/time of an event from
the Repeats tab, for when the opening hours are different.

**It's important to have an event for each day of the week**. If you're missing
*a day, it wont show up in our list of opening hours at all.

If you add multiple events for a single day (e.g. if the store is open in the
morning and afternoon, but closed during lunch), each one will show separately
in the list.

## Snippets & Chunks

To render the opening hours, we'll use the
[AgendaList](../04_Snippets/01_AgendaList) snippet with some custom chunks and
logic.

Here's our `AgendaList` call; make sure to adjust the `&calendars` filter to
match the alias of your opening hours calendar.

```html
<table>
    <tbody>
        [[!AgendaList? 
            &calendars=`openinghours`
            &tpl=`AgendaOpeningHours`
            &sortby=`{
                "startdate":"ASC"
            }`
            &end=`[[!*id:notempty=`+6 days`:strtotime:date=`%Y-%m-%d`]] 23:59`
        ]]
    </tbody>
</table>
```

We're using a little trick to automatically set the `&end` property 7 days in
advance (which uses `+6 days` as today is the first day), and let Agenda
automatically start on todays' events, sorting by the start date.

Create the **AgendaOpeningHours** chunk with the following:

```html
[[+startdate:strtotime:date=`%Y-%m-%d`:toPlaceholder=`start_ymd`]]
[[+id:notempty=`now`:strtotime:date=`%Y-%m-%d`:toPlaceholder=`today_ymd`]]
<tr class="opening-hours" [[+start_ymd:eq=`[[+today_ymd]]`:then=`style="font-weight: bold;"`:else=``]]>
    <td style="padding: 0 0.5em;">
        [[+startdate:strtotime:date=`%A`:ucfirst]]
    </td>
    <td style="padding: 0 0.5em;">
        [[+startdate:strtotime:date=`%d %b`]]
    </td>
    <td style="padding: 0 0.5em;">
        [[+allday:neq=`1`:then=`
            [[+startdate:strtotime:date=`%H.%M`]]&ndash;[[+enddate:strtotime:date=`%H.%M`]]hr
        `:else=`
            [[+title]]
        `]]
    </td>
</tr>
```

Some notes:

- First we're creating a placeholder `start_ymd` and `today_ymd` dynamically bases on the startdate for the event and the current time respectively. We use those in the wrapping `<tr>` tag to highlight events for today in bold. 
- We parse the startdate into the name of the day in the first cell. If this is in the wrong language, make sure to update the `locale` system setting in MODX to the right value. 
- In the second cell we're outputting the date (e.g. `8 Oct`). You can skip this if you want, but it can be useful to show what exact date the opening hours are for to indicate that they may differ from week to week.
- In the third cell we have the logic that switches between open and closed. If the event is not an all-day event, we output the hours of the event as open hours. For an all-day event, we output the title of the event (e.g. "Closed" or "Closed for private party"). 

