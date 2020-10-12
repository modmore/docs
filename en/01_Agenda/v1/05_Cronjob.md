_Agenda_ could be controlled by a _cronjob command_.

## Executing the cronjob command

The cronjob command could be executed from the command line with

`php /path/to/your/modx/installation/assets/components/agenda/cron.php`

or with an external webcronjob using the following url:

`https://your.domain/assets/components/agenda/cron.php?cronjob_id=xxx`

The value xxx has to be filled with the random string in the MODX system setting
`agenda.cronjob_id`

## The cronjob command tasks

The cronjob command will run two different tasks:

- [refresh the feeds](#refresh-the-feeds-task)
- [refresh the recurring events](#refresh-the-recurring-events-task)

Normally the the feeds and the recurring events are refreshed together. To run a
single task you could use the property `mode=feed` or `mode=repeating` for the
cronjob:

`php /path/to/your/modx/installation/assets/components/agenda/cron.php mode=feed`

or

`https://your.domain/assets/components/agenda/cron.php?cronjob_id=xxx&mode=feed`

### Refresh the feeds task

All active feeds are refreshed. New events of a feed are created, existing
events of a feed are changed and no longer existing events of a feed are
removed.

### Refresh the recurring events task

Per default each recurring event is only repeated to the maximum count of the
`agenda.repeating_max_occurance` system setting. The refresh of the recurring
events creates new repeats from the **current date** until the maximum count of
the `agenda.repeating_max_occurance` system setting. So there will be no
inifinite creation of repeats but the repeats will not stay at the limit, when
the recurring event was created. Only events after the last existing recurring
event are created and old (maybe edited) repeats are not changed.

## Debug the cronjob

To detect cronjob issues, you could enable the Agenda [system
setting](02_Custom_Manager_Page/07_Settings.md) `agenda.debug`. The file
`{core_path}/cache/logs/agenda.log` will then contain a lot of debug
information. Per default cronjob errors are logged in the standard MODX error
log.

