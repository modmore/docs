This snippet displays an iCalendar link or download an iCalendar file of an event.

## Properties

It uses the following snippet properties:

| Property   | Description                                                                | Default                       |
|------------|----------------------------------------------------------------------------|-------------------------------|
| calendars  | Comma-separated list of aliases of calendars to filter the iCal download.  | -                             |
| categories | Comma separated list of aliases of categories to filter the iCal download. | -                             |
| contexts   | Comma separated list of context keys to filter the iCal download.          | -                             |
| id         | ID of one event to display the iCal download link for.                     | Request parameter `event`     |
| locations  | Comma separated list of aliases of locations to filter the iCal download.  | -                             |
| tpl        | Name of a chunk that contains the template for the iCal download link.     | tplAgendaEventDetailICalLink  |
| repeating  | ID of one recurring event to display the iCal download link for.           | Request parameter `repeating` |
| usergroups | Comma separated list of user group names to filter the iCal download.      | -                             |
| users      | Comma separated list of user IDs to filter the iCal download.              | -                             |

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
