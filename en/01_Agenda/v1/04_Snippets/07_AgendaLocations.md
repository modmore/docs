This snippet displays a list of locations.

## Properties

It uses the following snippet properties:

| Property           | Description                                                                                                                                                             | Default                         |
|--------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------|
| ajax               | If enabled, the snippet output will be directly output as JSON result to the browser when the page is requested by Ajax (XMLHttpRequest). Available since Agenda 1.4.0. | No                              |
| allowedRequestKeys | Comma-separated list of request keys, that could be used to filter the displayed locations. Defaults to all allowed. Available since Agenda 1.1.0.                      | -                               |
| emptyTpl           | Name of a chunk that contains the template for not found locations.                                                                                                     | tplAgendaLocationsEmpty         |
| limit              | Limit the number of locations in the result. Use `0` for unlimited locations.                                                                                           | 20                              |
| listId             | ID of a resource containing an AgendaList snippet call.                                                                                                                 | System Setting `agenda.list_id` |
| locations          | Comma-separated list of aliases of locations to filter the displayed locations.                                                                                         | -                               |
| offset             | An offset of locations returned by the criteria to skip.                                                                                                                | 0                               |
| outputSeparator    | An optional string to separate each tpl instance.                                                                                                                       | -                               |
| selected           | Set the selected placeholder to `selected="selected"`, when the value is equal to the location alias.                                                                   | -                               |
| toPlaceholder      | If set, the snippet result will be assigned to this placeholder instead of outputting it directly.                                                                      | -                               |
| totalVar           | The key of a placeholder that indicates the total number of locations returned by the criteria.                                                                         | agendalocations.total           |
| tpl                | Name of a chunk that contains the template for one location.                                                                                                            | tplAgendaLocation               |
| wrapperTpl         | Name of a chunk that contains the wrapper template for all locations.                                                                                                   | tplAgendaLocationsWrapper       |

## Placeholders

The following placeholders are available in the different (default) chunks. Each
snippet property will be set as placeholder in each template chunk, i.e. a
snippet call ```[[!AgendaDetail? &subtitle=`whatever`]]``` will fill the
placeholder subtitle in each used chunk with the value `whatever`.

**CAUTION:** The default template chunks for both snippets are overwritten
during each package update, so please rename the chunks before editing them.

### tplAgendaLocation

| Placeholder | Description                                                                                            |
|-------------|--------------------------------------------------------------------------------------------------------|
| address     | The address of the location.                                                                           |
| alias       | The alias of the location.                                                                             |
| center_lat  | The latitude of the center of a map of the location.                                                   |
| center_lng  | The longitude of the center of a map of the location.                                                  |
| description | The description of the location.                                                                       |
| lat         | The latitude of the location.                                                                          |
| lng         | The longitude of the location.                                                                         |
| name        | The name of the location.                                                                              |
| resource_id | The id of a linked resource of the location.                                                           |
| selected    | Contains `selected="selected"`, when the location request value is equal to the alias of the location. |
| zoom        | The zoom level of a map of the location.                                                               |

### tplAgendaLocationsEmpty

Only the current script properties are available as placeholders.

### tplAgendaLocationsWrapper

| Placeholder | Description                                                                                    |
|-------------|------------------------------------------------------------------------------------------------|
| count       | Count of the locations filtered by the snippet properties (without limit/offset)               |
| output      | All locations collected by the snippet separated by the string in the outputSeparator property |
