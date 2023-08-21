This snippet displays a list of locations.

## Properties

It uses the following snippet properties:

| Property           | Description                                                                                                                                                                                                  | Default                   |
|--------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------|
| ajax               | **Since 1.4.0** If set, the snippet output will be directly output as JSON result to the browser when the page is requested with the same value in the ajax request parameter.                                | 0 (No)                    |
| allowedRequestKeys | Comma-separated list of request keys, that can be used to filter the displayed locations. Defaults to all allowed.                                                                                           | -                         |
| emptyTpl           | Name of a chunk that contains the template for not found locations.                                                                                                                                          | tplAgendaLocationsEmpty   |
| filterByEvents     | **Since 1.5.0** If this option is set, the locations with no future events are filtered from the result.                                                                                                     | 0 (No)                    |
| limit              | Limit the number of locations in the result. Use "0" for unlimited locations.                                                                                                                                | 20                        |
| listId             | ID of a resource containing an AgendaList snippet call.                                                                                                                                                      | -                         |
| locations          | Comma-separated list of aliases of locations to filter the displayed locations.                                                                                                                              | -                         |
| offset             | The offset of locations to skip.                                                                                                                                                                             | -                         |
| outputSeparator    | An optional string to separate each tpl instance.                                                                                                                                                            | -                         |
| selected           | Comma separated list of calendar aliases, that have the placeholder selected filled.                                                                                                                         | -                         |
| sortby             | **Since 1.5.0** Sort field for sorting the output. It could also contain a JSON object to sort the ouput by multiple fields like <pre>{"AgendaLocations.name":"ASC","AgendaLocations.address":"DESC"}</pre>. | sortindex                 |
| sortdir            | **Since 1.5.0** Sort direction for sorting the output. Unused when the sortby property contains a valid JSON object.                                                                                         | ASC                       |
| toPlaceholder      | If set, the snippet result will be assigned to this placeholder instead of outputting it directly.                                                                                                           | -                         |
| totalVar           | The key of a placeholder that indicates the total number of locations.                                                                                                                                       | agendalocations.total     |
| tpl                | Name of a chunk that contains the template for one location.                                                                                                                                                 | tplAgendaLocation         |
| where              | **Since 1.5.0** JSON encoded xPDO where clause to filter the locations.                                                                                                                                      | -                         |
| wrapperTpl         | Name of a chunk that contains the wrapper template for all locations.                                                                                                                                        | tplAgendaLocationsWrapper |

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
