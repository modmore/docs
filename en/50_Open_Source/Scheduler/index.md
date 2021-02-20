[Scheduler](https://modmore.com/extras/scheduler/) is an open source (MIT) Extra for MODX Revolution that handles scheduling tasks in the future and other automation. It is meant to provide an easy to integrate and administer scheduling engine or message queue for developers, with a component for admins.

## Configuration

First and foremost, you [will need to setup a cron job](Installation) to make sure Scheduler gets triggered every minute.

You also have a few settings at your disposal:

1. Set up email notifications for tasks that fail. Set a comma separated list of email addresses in the `scheduler.email_failure` system setting.
2. Automatically remove old tasks after a certain time period has passed. Useful to keep your database size under control if you schedule a lot of tasks. To do this, set a strtotime() compatible time string in the `scheduler.delete_tasks_after` system setting. For example set it to `-1 year` or `-2 weeks`. Remember the dash. This will run automatically from the same cron jon as the actual tasks. (v1.3+).

