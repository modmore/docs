This hook saves FormIt fields as an Agenda event. The hook was introduced with Agenda 1.1.0.

It could update an existing event, if an event ID or a repeating ID is set. This
could be done by FormIt hook properties or by request parameters. The FormIt
hook properties supercede the request parameters.

If no event_id or repeating_id is set, a new event is created.

## FormIt Hook Properties

The hook uses the following hook properties:

Property | Description | Default
---------|-------------|--------
agendaAllowedFields | Comma separated list of fields, that are set by the hook. Per default all fields are allowed. | -
agendaCalendars | Comma-separated list of aliases of calendars to filter the loaded event. | -
agendaCategories | Comma separated list of aliases of categories to filter the loaded event. | -
agendaContexts | Comma separated list of context keys to filter the loaded event. | -
agendaDateformat | Format of the startdate and enddate field, set by the hook. Must contain a [supported date and time format](https://www.php.net/manual/de/datetime.formats.php). | Y-m-d H:i:s
agendaDateformatAllday | Format of the startdate and enddate field, set by the hook, if Must contain a [supported date and time format](https://www.php.net/manual/de/datetime.formats.php). | Y-m-d H:i:s
agendaEvent | ID of one event to load into FormIt. | 0
agendaLocations | Comma separated list of aliases of locations to filter the loaded event. | -
agendaOwnEvent | Load only own events (created by the current user) into FormIt. | false
agendaRepeating | ID of one recurring event to load into FormIt. | 0
agendaUsergroups | Comma separated list of user group names to filter the loaded event. | -
agendaUsers | Comma separated list of user IDs to filter the loaded event. | -

## Hook fields

The following FormIt fields are used in the hook and saved in the Agenda event, when they are allowed.

Field | Description
------------|------------
active | The active status of the saved event.
allday | The all day status of the saved event.
calendar | The alias of the calendar of the saved event.
calendar_id | The id of the calendar of the saved event.
category | The aliases of the categories of the saved event.
content | The content of the saved event.
context_key | The context key of the saved event.
description | The description of the saved event.
enddate | The enddate of the saved event (or the saved recurring event).
event_id | The id of the saved event.
location | The alias of the location of the saved event.
location_id | The id of the location of the saved event.
repeat_enddate | The enddate of the repeats of the saved event.
repeat_interval | The repeat interval of the saved event.
repeat_on | The repeat weekdays of the saved event, when the repeat type is weekly
repeat_ordinal | The repeat ordinal of the saved event, when the repeat type is monthly by weekday
repeat_type | The repeat type of the saved event. (1 = daily , 2 = weekly, 3 = monthly, 4 = yearly, 5 = montly by weekday )
repeat_weekday | The repeat weekday of the saved event, when the repeat type is weekly
repeating | The repeating status of the saved event.
repeating_id | The id of the saved recurring event.
resource_id | The id of the linked resource of the saved event.
startdate | The startdate of the saved event (or the saved recurring event).
title | The title of the saved event.
