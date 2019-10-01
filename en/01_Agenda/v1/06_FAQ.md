We're collecting the questions we get most often into a FAQ. If your question is
not in the list, please reach out to us via support@modmore.com and we would be
glad to help.

[TOC]

## I'd like to have more than 100 repeats of a recurring event

You have two possibilities:

- Setup a [cronjob](05_Cronjob.md), that refreshes the recurring events up to 100 repeats in the future from the current date.
- Increase the Agenda [system setting](02_Custom_Manager_Page/07_Settings.md) `agenda.repeating_max_occurance` to a value, that would cover all repeats.

## I want to connect an event, category, calendar or location with a resource 

Fill the Agenda [system setting](02_Custom_Manager_Page/07_Settings.md)
`agenda.parents_calendar`, `agenda.parents_category`, ` agenda.parents_event` or
`agenda.parents_location` with a comma separated list of parent resources to
make the resource select input appear in the form.

## The map does not show up in the location address tab 

Enter a [Google Maps API
Key](https://developers.google.com/maps/documentation/javascript/get-api-key) in
the Agenda [system setting](02_Custom_Manager_Page/07_Settings.md)
`agenda.google_maps_api_key`. You have to activate the Maps JavaScript API and
the Geocoding API in the created Google Cloud Platform project.

## Is there an error log for Agenda? 

To detect cronjob issues, you could enable the Agenda [system
setting](02_Custom_Manager_Page/07_Settings.md) `agenda.debug`. The file
`{core_path}/cache/logs/agenda.log` will then contain a lot of debug
information. Per default cronjob errors are logged in the standard MODX error
log.


