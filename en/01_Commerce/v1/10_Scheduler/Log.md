---
title: Scheduler task log
---

In Commerce > Configuration > Scheduled Tasks you can find a list of tasks.

The first table, Scheduled Tasks, shows active recurring tasks. Any module that runs nightly, for example, will show up in the first table.

The second table, Task Log, will show only _failed_ recurring tasks, and any individually scheduled tasks.K

## Deleting old tasks

By default, Commerce will delete any completed and failed task records after 90 days. If you wish to change that, change the `commerce.scheduler_delete_tasks_before` system setting to a string that [strtotime](https://www.php.net/manual/en/function.strtotime.php) understands. For example `30 days ago`.

The old task deletion is invoked every 30 minutes automatically.
