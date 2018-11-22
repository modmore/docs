
It is possible to use the Component to schedule a task to run, but Scheduler was primarily intended to be used as tool for developers, providing a simple message queue of sorts that lets you asynchronously process stuff.

Scheduling a task programmatically to run at a certain point is super easy and boils down to just a couple lines of code. Here's an example:

```` php   
<?php
// Load the Scheduler service class
$path = $modx->getOption('scheduler.core_path', null, $modx->getOption('core_path') . 'components/scheduler/');
$scheduler = $modx->getService('scheduler', 'Scheduler', $path . 'model/scheduler/');
if (!($scheduler instanceof Scheduler)) {
    return 'Oops, could not get Scheduler service.';
}

/**
 * Get the task with reference "dosomething" in the "mycmp" namespace.
 * This task should have been added earlier via a build or the component. 
 */
$task = $scheduler->getTask('mycmp', 'dosomething');
if ($task instanceof sTask) {
    // Schedule a run in 10 minutes from now
    // We're passing along an array of data; in this case a client ID.
    $task->schedule('+10 minutes', array(
        'client' => 15
    ));
}
````

All you have to do to schedule a task to run is give it a time (either a UNIX timestamp, or time in the future like `+10 minutes` or `+14 days`) and an optional array of data. It will create a new sTaskRun object which will be executed by the scheduler cron job you set up before when the time rolls by. As of Scheduler 1.1, `$task->schedule()` will return the new task run object.

To create an sTask object you might need a bit more code, but you only have to do that **once**, preferably in a build or bootstrap script. The task object holds details about what to run (a file, snippet or processor), the namespace and the reference.
