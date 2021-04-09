This snippet displays a list of calendars.

## Properties

It uses the following snippet properties:

Property | Description | Default
---------|-------------|--------
allowedRequestKeys | Comma-separated list of request keys, that could be used to filter the displayed calendars. Defaults to all allowed. Available since Agenda 1.1.0. | -
calendars | Comma-separated list of aliases of calendars to filter the displayed calendars. | -
emptyTpl | Name of a chunk that contains the template for not found calendars. | tplAgendaCalendarsEmpty
limit | Limit the number of calendars in the result. Use `0` for unlimited calendars. | 20
listId | ID of a resource containing an AgendaList snippet call. | System Setting `agenda.list_id`
offset | An offset of calendars returned by the criteria to skip. | 0
outputSeparator | An optional string to separate each tpl instance. | -
resourceTpl | Name of a chunk that contains the template for the linked resource of a calendar. | -
toPlaceholder | If set, the snippet result will be assigned to this placeholder instead of outputting it directly. | -
totalVar | The key of a placeholder that indicates the total number of calendars returned by the criteria. | agendacalendars.total
tpl | Name of a chunk that contains the template for one calendar. | tplAgendaCalendar
wrapperTpl | Name of a chunk that contains the wrapper template for all calendars. | tplAgendaCalendarsWrapper

## Placeholders

The following placeholders are available in the different (default) chunks. Each
snippet property will be set as placeholder in each template chunk, i.e. a
snippet call ```[[!AgendaDetail? &subtitle=`whatever`]]``` will fill the
placeholder subtitle in each used chunk with the value `whatever`.

**CAUTION:** The default template chunks for both snippets are overwritten
during each package update, so please rename the chunks before editing them.

### tplAgendaCalendar

Placeholder | Description
------------|------------
alias | The alias of the calendar.
background | The background color of the calendar of the event.
foreground | The foreground color of the calendar of the event.
name | The name of the calendar.
resource_id | The id of a linked resource of the calendar.
selected | Contains `selected="selected"`, when the calendar request value is equal to the alias of the calendar.

### tplAgendaCalendarsEmpty

Only the current script properties are available as placeholders.

### tplAgendaCalendarsWrapper

Placeholder | Description
------------|------------
count | Count of the calendars filtered by the snippet properties (without limit/offset)
output | All calendars collected by the snippet separated by the string in the outputSeparator property
