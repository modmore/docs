This hook retrieves Agenda events with as faceted search in SimpleSearch. The
hook was introduced with Agenda 1.2.1.

It fills the facet `events` in SimpleSearch.

## SimpleSearch Hook Properties

The hook uses the following hook properties:

Property | Description | Default
---------|-------------|--------
agendaStartdate | The start date to filter the searched events. Must contain a [supported date and time format](https://www.php.net/manual/de/datetime.formats.php). | today 0:00
agendaEnddate | The end date to filter the displayed events. Must contain a [supported date and time format](https://www.php.net/manual/de/datetime.formats.php). | +99 year 0:00
agendaSearchLocation | Search the location address. When disabled, only the location title is searched. | true
agendaCategoryTpl | Name of a chunk that contains the template of one category in the category list of an event. | tplAgendaEventCategory
agendaImageTpl | Name of a chunk that contains the template of one image in the image list of an event. | tplAgendaEventImage
agendaVideoTpl | Name of a chunk that contains the template of one video in the video list of an event. | tplAgendaEventVideo
agendaLocationTpl | Name of a chunk that contains the template for the location of an event. | tplAgendaEventLocation
agendaResourceTpl | Name of a chunk that contains the template for the linked resource of an event. | tplAgendaEventResource
agendaEventExtractTpl | Name of a chunk that contains the template for the search extract of an event. | tplAgendaEventSearchExtract
