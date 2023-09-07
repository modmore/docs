## System Events

The OnAgendaBeforeSave, OnAgendaSave and OnAgendaBeforeRemove system events were
introduced in Agenda 1.5.0.

The use of these events allows additional code to be executed before and after
saving and before deleting Agenda database entries.

The following Agenda database objects invoke the system events: AgendaCalendars,
AgendaCategories, AgendaEventCursus, AgendaEventDates, AgendaEventImages,
AgendaEvents, AgendaEventVideos and AgendaLocations.

The following properties can be used in the plugin events:

| Property  | Content                                                                                                                        |
|-----------|--------------------------------------------------------------------------------------------------------------------------------|
| mode      | The state of the Agenda object. It can contain the following states: `modSystemEvent::MODE_NEW` or `modSystemEvent::MODE_UPD`. |
| className | The class name of the saved object.                                                                                            |
| id        | The identifier of the saved object.                                                                                            |
| event     | The plugin event.                                                                                                              |
