_Agenda_ can be controlled by a _cronjob command_.

## Executing the cronjob command

The cronjob command can be executed from the command line with

`php /path/to/your/modx/installation/assets/components/agenda/cron.php`

or with an external webcronjob using the following url:

`https://your.domain/assets/components/agenda/cron.php?cronjob_id=xxx`

The value xxx has to be filled with the random string in the MODX system setting
`agenda.cronjob_id`

## The cronjob command tasks

The cronjob command will run three different tasks:

- [refresh the feeds](#refresh-the-feeds-task)
- [refresh the repeating events](#refresh-the-repeating-events-task)
- [import events](#import-events-task)

Normally the feeds and the repeating events are refreshed together when no
property is set for the cronjob command. To run a single task you can use the
property `mode=feed` or `mode=repeating` for the cronjob:

`php /path/to/your/modx/installation/assets/components/agenda/cron.php mode=feed`

or

`https://your.domain/assets/components/agenda/cron.php?cronjob_id=xxx&mode=feed`

### Refresh the feeds task

All active feeds are refreshed. New events of a feed are created, existing
events of a feed are changed and no longer existing events of a feed are
removed.

### Refresh the repeating events task

Per default each repeating event is only repeated to the maximum count of the
`agenda.repeating_max_occurance` system setting. The refresh of the repeating
events creates new repeats from the **current date** until the maximum count of
the `agenda.repeating_max_occurance` system setting. So there will be no
inifinite creation of repeats but the repeats will not stay at the limit, when
the repeating event was created. Only events after the last existing repeating
event are created and old (maybe edited) repeats are not changed.

### Import events task

With the property `mode=import` new events can be imported into Agenda with a
cronjob. The cronjob call has to use the full filepath in the file property. 

`php /path/to/your/modx/installation/assets/components/agenda/cron.php mode=import file=/path/to/the/file`

or

`https://your.domain/assets/components/agenda/cron.php?cronjob_id=xxx&mode=import&file=/path/to/the/file`

The import uses the same code as the import events button in the [events
tab](02_Custom_Manager_Page/02_Events.md) of the custom manager page. The import
mode is append. The import can be overridden in an [Agenda
module](02_Custom_Manager_Page/07_Modules.md).

## Debug the cronjob

To detect cronjob issues, you can enable the Agenda [system
setting](02_Custom_Manager_Page/08_Settings) `agenda.debug`. The file
`{core_path}/cache/logs/agenda.log` will then contain a lot of debug
information. Per default cronjob errors are logged in the standard MODX error
log.

