We're collecting the questions we get most often into a FAQ. If your question is
not in the list, please reach out to us via treehillstudio-support@modmore.com,
and we would be glad to help.

[TOC]

## How are events displayed on the website?

To render events to your visitors, you can use the provided snippets:

- [AgendaList](04_Snippets/01_AgendaList) used for rendering a list of events
- [AgendaCalendar](04_Snippets/02_AgendaCalendar) used for rendering events in a list divided into intervals (i.e. days)
- [AgendaDetail](04_Snippets/03_AgendaDetail) used for showing one specific event on a detail page

There are other snippets to help you render calendars, categories, and locations. 

## How can an event repeat more than 100 times?

By default, repeating events are scheduled for 100 recurrences.

You have two possibilitiesto change that:

- [Set up a cron job](05_Cronjob) to refresh recurring events for up to 100 repeats in the future from the current date.
- Increase the `agenda.repeating_max_occurance` [system setting](02_Custom_Manager_Page/07_Settings) to a larger value.

## Can events, categories, calendars or locations be connected to a resource? 

Yes!

Agenda comes with a number of [system
settings](02_Custom_Manager_Page/07_Settings). Configure them with a comma
separated list of resource IDs to use as parent resources. When set up, a new
resource selection field will be added to the edit windows in the manager.

- For events: `agenda.parents_event`
- For categories: `agenda.parents_category`
- For calendars: `agenda.parents_calendar`
- For locations: `agenda.parents_location`

## How often is an event feed refreshed?

When creating the [feed](02_Custom_Manager_Page/06_Feeds) for events to be
imported, you can set how often the feed should be checked for new or updated
events, with a minimum interval of once a minute.
   
You also need to set up the cron job to fire often enough for the feed refreshes
to happen at the right time.

## Can a map be used in the location address tab?

Yes, you will need to enter a [Google Maps API
Key](https://developers.google.com/maps/documentation/javascript/get-api-key) in
the `agenda.google_maps_api_key` system setting to use the map.
   
In the project in the Google Cloud Platform console, activate the Maps
JavaScript API and the Geocoding API.

# What's the difference between a calendar and a category?

They're both ways of organising your events into logical sections, and can be
filtered on in the [AgendaList](04_Snippets/01_AgendaList) snippet.

A Calendar is best seen as the "owner" or "target" for an event. For example a
conference center could use calendars for organising events as "Public events",
"Private parties" and "Staff-only events", which are then shown in different
sections of the website. An event must have one Calendar.

A Category is then the type of event, which could be a sub-filter on the detail
pages. For example "Weddings", "Conference", "Expo", "Training/workshops". An
event could have many categories.

For events grouped into a location or room, you can use the Locations
functionality as well. That can also be used with maps, ideal for businesses
with different venues or events hosted in varying places.

## Is the cron job required?

If you use Feeds or recurring events, yes, the cron job is required for Agenda
to work as expected.

If your server doesn't allow you to configure cron jobs, you can trigger it
through web requests as well using online cron job services.

## Can the cron job log more information?

Yes, enable the `agenda.debug` [system
setting](02_Custom_Manager_Page/07_Settings). A new log will be created in
`{core_path}/cache/logs/agenda.log` with a lot of debug information.

By default, errors are logged to the standard MODX error log.

## I can't use my own daterange format in the lexicon or in the snippet properties

|The format string has to use exactly 7 parts separated by `|`. The description|
of the formatting rules could be found below the placeholder descriptions on the
[AgendaList](04_Snippets/01_AgendaList#range-placeholder-format) snippet description.
