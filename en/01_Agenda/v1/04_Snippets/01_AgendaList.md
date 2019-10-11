This snippet displays events in a list view.
 
## Properties
 
It uses the following snippet properties:

Property | Description | Default
---------|-------------|--------
calendars | Comma-separated list of aliases of calendars to filter the displayed events. | -
categories | Comma separated list of aliases of categories to filter the displayed events. | -
categoryTpl | Name of a chunk that contains the template of one category in the category list of an event. | tplAgendaEventCategory
contexts | Comma separated list of context keys to filter the displayed events. | -
daterangeFormat | Format of the daterange displayed in an event. | Lexicon `agenda.php_format_daterange`. The format string has to contain exactly 7 parts. The [format rules](#range-placeholder-format) are described below.
daterangeSeparator | Separator in the daterange displayed in an event. | Lexicon `agenda.php_format_separator`
detailId | ID of a resource containing an AgendaDetail snippet call. | System Setting `agenda.detail_id`
durationParts | Number of detail parts of the event duration output. With the value `1` the duration will be shortened as i.e. `1 month`, with the value `2` the duration will be shortened as i.e. `1 month 2 days`, | 1
emptyTpl | Name of a chunk that contains the template for an empty list of events. | tplAgendaEventEmpty
end | The end date to filter the displayed events. | -
imageTpl | Name of a chunk that contains the template for one image in the image list of an event. | tplAgendaEventImage
limit | Limit the number of events in the result. Use `0` for unlimited events. | 20
listId | ID of a resource containing an AgendaList snippet call. | System Setting `agenda.list_id`
locale | The locale for the displayed formatted date. | System/Context setting `locale`
locations | Comma separated list of aliases of locations to filter the displayed events. | -
locationTpl | Name of a chunk that contains the template for the location of an event. | tplAgendaEventLocation
outputSeparator | An optional string to separate each tpl instance. | -
start | The start date to filter the displayed events. | -
sortby | Sort field for sorting the output. It could also contain a JSON object to sort the output by multiple fields like `{"AgendaEvents.title":"ASC","all_startdate":"ASC"}`. | all_startdate
sortdir | Sort direction for sorting the output. Unused when the sortby property contains a valid JSON object. | ASC
toPlaceholder | If set, the snippet result will be assigned to this placeholder instead of outputting it directly. | -
tpl | Name of a chunk that contains the template for one event. | tplAgendaEventRow
usergroups | Comma separated list of user group names to filter the displayed events. | -
users | Comma separated list of user IDs to filter the displayed events. | -
videoTpl | Name of a chunk that contains the template for one video in the video list of an event. | tplAgendaEventVideo
wrapperTpl | Name of a chunk that contains the wrapper template for all events. | tplAgendaEventWrapper

## Placeholders

The following placeholders are available in the different (default) chunks. Each
snippet property will be set as placeholder in each template chunk, i.e. a
snippet call ```[[!AgendaDetail? &subtitle=`whatever`]]``` will fill the
placeholder subtitle in each used chunk with the value `whatever`.

**CAUTION:** The default template chunks for both snippets are overwritten
during each package update, so please rename the chunks before editing them.

### tplAgendaEventRow

Placeholder | Description
------------|------------
allday | Contains 1 if the event is an all day event (otherwise 0).
calendar_background | The background color of the calendar of the event.
calendar_foreground | The foreground color of the calendar of the event.
calendar_name | The calendar name.
categories | All categories of the event formatted by the chunk set with the categoryTpl property
description | The title of the event.
detail_url | The url that shows the event detail. Will be generated with the system/context setting `agenda.detail_id`. This resource should contain an AgendaDetail snippet call.
duration | The formatted duration of the event. The details of the duration could be set with the `durationParts` snippet property.
idx | The number of the event starting with 1.
images | All images of the event formatted by the chunk set with the imageTpl property
imageurls | An array of all image urls. The placeholder [[+imageurls.1]] contains the url of the first image
location | The location of the event formatted by the chunk set with the locationTpl property
range | The formatted date range of the event. The format is defined with the lexicon entries `agenda.php_format_daterange` and `agenda.php_format_separator`. The [format rules](#range-placeholder-format) are described below.
repeating | Contains 1 if the event is an recurring event (otherwise 0).
resource_id | The id of a linked resource of the event.
title | The title of the event.
videos | All videos of the event formatted by the chunk set with the videosTpl property
videourls | An array of all video urls. The placeholder [[+videourls.1]] contains the url of the first video

### tplAgendaEventWrapper

Placeholder | Description
------------|------------
count | Count of the events filtered by the snippet properties (without limit/offset) 
output | All events collected by the snippet separated by the string in the outputSeparator property

### tplAgendaEventEmpty

Only the current script properties are available as placeholders.

### tplAgendaEventCategory

Placeholder | Description
------------|------------
alias | The alias of the category.
background | The background color of the category of the event.
foreground | The foreground color of the category of the event.
name | The name of the category.
resource_id | The id of a linked resource of the category.
selected | Contains `selected="selected"`, when the category request value is equal to the alias of the category.
url | The url that shows the event list filtered by the displayed category. Will be generated with the system/context setting `agenda.list_id`. This resource should contain an AgendaList snippet call.

### tplAgendaEventImage

Placeholder | Description
------------|------------
description | The description of the image.
idx | The number of the image starting with 1.
title | The title of the image.
url | The url that shows the event image.

### tplAgendaEventLocation

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

### tplAgendaEventVideo

Placeholder | Description
------------|------------
description | The description of the video.
idx | The number of the video starting with 1.
title | The title of the video.
url | The url that shows the event video.

## Range placeholder format

The `range` placeholder could be formatted with the lexicon entries
`agenda.php_format_daterange` and `agenda.php_format_separator` or the snippet
properties `daterangeFormat` and `daterangeSeparator`. The format string has to
use exactly 7 parts separated by `|`. The default english lexicon entry is `j.|
F |Y|, |g|:i a|`.

The daterrange is formatted with the following rules: 

- If both dates are different and the hour/minute of start and end is 0, parts
4-7 are removed from start and end date.
- If both dates are different and the hour/minute of start and end is 0 and year
of start and end is equal, parts 4-7 are removed from start and end date and
part 3 is removed from start date.
- If both dates are different and the hour/minute of start and end is 0 and year
and month of start and end are equal, parts 4-7 are removed from start and end
date and parts 2-3 are removed from start date.
- If both dates are different and the hour/minute of start and end is 0 and
year, month and day of start and end are equal, parts 4-7 are removed from start
and end date and parts 1-3 are removed from start date.
- If both dates are different and the hour/minute of start and end is not 0 and
one detail of year, month and day of start and end is not equal, all parts are
used in the start and end date.
- If both dates are different and the hour/minute of start and the hour of end
is 0 and all details of year, month and day of start and end are equal, parts
4-7 are removed from start date.
- If both dates are different and the hour or minute of start or the hour of end
not 0 and all details of year, month and day of start and end are equal, part 7
is removed from start date.
- If both dates are equal and the hour/minute of start is 0, part 4-7 is
removed from the start date and separator and end date are removed.
- If both dates are equal and the hour/minute of start is not 0, separator and
end date are removed.
