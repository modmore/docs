This snippet displays an iCalendar link or download an iCalendar file of an event.

## Properties

It uses the following snippet properties:

| Property       | Description                                                                                         | Default                      |
|----------------|-----------------------------------------------------------------------------------------------------|------------------------------|
| active         | If this option is disabled, the active status of an event is not regarded.                          | 1 (Yes)                      |
| calendars      | Comma-separated list of aliases of calendars to filter the iCal download.                           | -                            |
| categories     | Comma separated list of aliases of categories to filter the iCal download.                          | -                            |
| contexts       | Comma separated list of context keys to filter the iCal download.                                   | -                            |
| descriptionTpl | Name of a chunk that contains the template for the description in the iCal event.                   | -                            |
| id             | ID of one event to retrieve the ical event.                                                         | -                            |
| locale         | The locale for the displayed formatted date. Defaults to the current system/context locale setting. | -                            |
| locations      | Comma separated list of aliases of locations to filter the iCal download.                           | -                            |
| locationTpl    | Name of a chunk that contains the template for the location of the ical event.                      | tplAgendaEventLocationICal   |
| repeating      | ID of one repeating event to retrieve the ical event.                                               | -                            |
| tpl            | Name of a chunk that contains the template for iCal download link.                                  | tplAgendaEventDetailICalLink |
| usergroups     | Comma separated list of user group names to filter the iCal download.                               | -                            |
| users          | Comma separated list of user IDs to filter the iCal download.                                       | -                            |
| where          | **Since 1.5.0** JSON encoded xPDO where clause to filter the ical event.                            | -                            |

## Placeholders

The following placeholders are available in the different (default) chunks. Each
snippet property will be set as placeholder in each template chunk, i.e. a
snippet call ```[[!AgendaDetail? &subtitle=`whatever`]]``` will fill the
placeholder subtitle in each used chunk with the value `whatever`.

**CAUTION:** The default template chunks for both snippets are overwritten
during each package update, so please rename the chunks before editing them.

### tplAgendaEventDetailIcal

| Placeholder | Description                                   |
|-------------|-----------------------------------------------|
| key         | The request key for the iCal download link.   |
| value       | The request value for the iCal download link. |
