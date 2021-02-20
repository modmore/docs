Scheduler can be installed from the modmore.com package provider, as well as via Github. After installing the package, it needs to be configured with a cron job once to make sure it gets triggered and can run the tasks you throw at it.

## Install the Package

Using the modmore.com [Package Provider](https://modmore.com/about/package-provider/) you can install the Scheduler package super easily. Please see the [full instructions for the package install](https://modmore.com/extras/scheduler/download/) for more details.

## Installing from Git

Scheduler is also available from [GitHub](https://github.com/modmore/ContentBlocks/) and can be built from the source if you want to use the very latest code or contribute back to the code.

We'll assume you have a working MODX installation set up, and want to install the package in a separate directory outside the MODX root. Make sure your `session_cookie_path` setting is configured to a slash or a path that also includes where Scheduler will be installed, otherwise you may get permission denied errors.

Start off by [forking the modmore/Scheduler repository on Github](https://github.com/modmore/Scheduler/fork). Then use the command line / bash to move into the parent directory you want the package installed in, and clone the repository using `git clone git@github.com:USERNAME/Scheduler.git Scheduler`.

Once cloned, cd into the Scheduler directory and if needed switch to the branch you want to use with `git checkout branch`.

To quickly set up the necessary stuff, open the `_bootstrap/index.php` file in your **browser** (not the command line). This will install the namespace, set the `core_path` and assets settings and create the database tables included in the package. This saves you a lot of manual set up, and you're now ready to go.

## Set up the Cron Job

To trigger the scheduled tasks, one cron job needs to be set up. How often this needs to trigger depends on what you will be scheduling and how often. If you expect to run a task only a few times a week, you may want to run it every 5 minutes. But if you use it to send emails in the background, or process things in semi-realtime, you would probably run it every minute.

Unfortunately due to the restrictions of cron, you cannot run it more than once per minute. It is possible to hit the url manually.

By default Scheduler only runs one task each time it is triggered. You can change the number of tasks per run with the _scheduler.tasks\_per\_run_ setting if you have a lot of task runs. If you have long-running tasks (in particular tasks that take longer to complete than the time between each run), it would be better to increase the run frequency instead of the tasks per run.

How to set up the cron job depends on your server, but the command you will want to add is the following:


```` html
php -q /home/server\_user/path/to/assets/components/scheduler/run.php
````

If you use an external cron job service, point it to the `assets/components/scheduler/run.php` file.
