Before you can Schedule a task, you will need to add it to the Scheduler database. You can do this via the component, or you can put it in a build script, package, or just a temporary snippet like this:


```` php   
<?php
/** @var Scheduler $scheduler */
$path = $modx->getOption('scheduler.core_path', null, $modx->getOption('core_path') . 'components/scheduler/');
$scheduler = $modx->getService('scheduler', 'Scheduler', $path . 'model/scheduler/');

$task = $modx->newObject('sFileTask');
$task->fromArray(array(
    'class_key' => 'sFileTask',
    'content' => 'elements/tasks/name_of_my_task.php',
    'namespace' => 'my_namespace',
    'reference' => 'name_of_my_task',
    'description' => 'Does something really cool.'
));
if (!$task->save()) {
    return 'Error saving Task';
}
````   

## Different Task Types

Scheduler supports running Snippets, Files and Processors. Each of these methods has their own sTask derivative:

- `sFileTask`: run a PHP file, where content is set to either an absolute path, a path relative from the namespace its core path, relative to the MODX root or relative to the MODX core (in that order). The $modx, $task, $run and $data variables are available in a file task.
- `sSnippetTask`: runs a snippet, where content is set to a snippet name or snippet ID. $task and $run are available in the snippet; the data is added to $scriptProperties.
- `sProcessorTask`, runs a processor, where content is set to the action and the `processors_path` is either the core processors folder, or the core path of your namespace + processors/. To get the `$task` and `$run` objects, use `$this->getProperty('task')` and `$this->getProperty('run')`.

Which of the task type is right for you depends on your use case. File tasks are very easy, in some cases you may be able of reusing a snippet in both the front-end and a Scheduler task, and processors have the benefit of being class-based which makes more complex tasks easier to execute.
