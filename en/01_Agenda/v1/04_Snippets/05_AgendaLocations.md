This snippet displays a list of locations.

## Properties

It uses the following snippet properties:

Property | Description | Default
---------|-------------|--------
locations | Comma-separated list of aliases of locations to filter the displayed locations. | -
emptyTpl | Name of a chunk that contains the template for not found locations. | tplAgendaLocationsEmpty
limit | Limit the number of locations in the result. Use `0` for unlimited locations. | 20
outputSeparator | An optional string to separate each tpl instance. | -
toPlaceholder | If set, the snippet result will be assigned to this placeholder instead of outputting it directly. | -
tpl | Name of a chunk that contains the template for one location. | tplAgendaLocation
useRequest | Use the request value of `location` to filter the displayed locations. | Yes
wrapperTpl | Name of a chunk that contains the wrapper template for all locations. | tplAgendaLocationsWrapper

## Placeholders

The following placeholders are available in the different (default) chunks. Each
snippet property will be set as placeholder in each template chunk, i.e. a
snippet call ```[[!AgendaDetail? &subtitle=`whatever`]]``` will fill the
placeholder subtitle in each used chunk with the value `whatever`.

**CAUTION:** The default template chunks for both snippets are overwritten
during each package update, so please rename the chunks before editing them.

### tplAgendaLocation

Placeholder | Description
------------|------------
address | The address of the location.
alias | The alias of the location.
center_lat | The latitude of the center of a map of the location.
center_lng | The longitude of the center of a map of the location.
description | The description of the location.
lat | The latitude of the location.
lng | The longitude of the location.
name | The name of the location.
resource_id | The id of a linked resource of the location.
selected | Contains `selected="selected"`, when the location request value is equal to the alias of the location.
zoom | The zoom level of a map of the location.

### tplAgendaLocationsEmpty

Only the current script properties are available as placeholders.

### tplAgendaLocationsWrapper

Placeholder | Description
------------|------------
count | Count of the locations filtered by the snippet properties (without limit/offset) 
output | All locations collected by the snippet separated by the string in the outputSeparator property
