This snippet displays a list of categories.

## Properties

It uses the following snippet properties:

Property | Description | Default
---------|-------------|--------
categories | Comma-separated list of aliases of categories to filter the displayed categories. | -
emptyTpl | Name of a chunk that contains the template for not found categories. | tplAgendaCategoriesEmpty
limit | Limit the number of categories in the result. Use `0` for unlimited categories. | 20
listId | ID of a resource containing an AgendaList snippet call. | System Setting `agenda.list_id`
outputSeparator | An optional string to separate each tpl instance. | -
toPlaceholder | If set, the snippet result will be assigned to this placeholder instead of outputting it directly. | -
tpl | Name of a chunk that contains the template for one category. | tplAgendaCategory
useRequest | Use the request value of categories to filter the displayed categories. | Yes
wrapperTpl | Name of a chunk that contains the wrapper template for all categories. | tplAgendaCategoriesWrapper

## Placeholders

The following placeholders are available in the different (default) chunks. Each
snippet property will be set as placeholder in each template chunk, i.e. a
snippet call ```[[!AgendaDetail? &subtitle=`whatever`]]``` will fill the
placeholder subtitle in each used chunk with the value `whatever`.

**CAUTION:** The default template chunks for both snippets are overwritten
during each package update, so please rename the chunks before editing them.

### tplAgendaCategory

Placeholder | Description
------------|------------
alias | The alias of the category.
background | The background color of the category of the event.
foreground | The foreground color of the category of the event.
name | The name of the category.
resource_id | The id of a linked resource of the category.
selected | Contains `selected="selected"`, when the category request value is equal to the alias of the category.
url | The url that shows the event list filtered by the displayed category. Will be generated with the system/context setting `agenda.list_id`. This resource should contain an AgendaList snippet call.

### tplAgendaCategoriesEmpty

Only the current script properties are available as placeholders.

### tplAgendaCategoriesWrapper

Placeholder | Description
------------|------------
count | Count of the categories filtered by the snippet properties (without limit/offset) 
output | All categories collected by the snippet separated by the string in the outputSeparator property
