This snippet displays a list of calendars.

## Properties

It uses the following snippet properties:

Property | Description | Default
---------|-------------|--------
calendars | Comma-separated list of aliases of calendars to filter the displayed calendars. | -
emptyTpl | Name of a chunk that contains the template for not found calendars. | tplAgendaCalendarsEmpty
limit | Limit the number of calendars in the result. Use `0` for unlimited calendars. | 20
outputSeparator | An optional string to separate each tpl instance. | -
toPlaceholder | If set, the snippet result will be assigned to this placeholder instead of outputting it directly. | -
tpl | Name of a chunk that contains the template for one calendar. | tplAgendaCalendar
useRequest | Use the request value of calendars to filter the displayed calendars. | Yes
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
