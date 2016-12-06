Developing a task for Scheduler is as simple as making a PHP file or a MODX Snippet. These can be [added to Scheduler](Adding_a_Task) when you need them. This document will go into a few things that may be familiar if you do MODX development more often.

### File, Snippet or Processor?

The first thing to decide is wether you want to make your tasks file or snippet based, or even re-use a processor. File based has the benefit of being possible to incorporate into version control directly, while snippets are easier to edit within the manager if that's more your thing and could be reused in the front-end too. Processors are class based, which can be useful for complex tasks. Either way the task can do the same thing, and the code you write is pretty much the same.

### Passing data to the Task

The [schedule API](Scheduling_a_Task) allows you to pass a `$data` variable for runtime data to pass to the file or snippet. In the file or snippet, these options are available through the `$scriptProperties` variable and we suggest using the `$modx->getOption` method of accessing these.

### Logging errors to Scheduler

If something goes wrong in your processing file/snippet (for example you're missing a required variable), you can log errors back to the Scheduler component. Adding an error will also mark the task run as failed. Here's an example:


    $run->addError('random_error', array(
        'random_number' => rand(0, 99999)
    ));

This will result in an error being logged to the scheduler of type "random_error" with a random nummer as additional data and the task to be marked as failed.

### Returning a result

Simply return a string (which could be JSON, or basic HTML if that's your fancy) to have it logged to the component. Using echo or print will not be logged, so you shouldn't do that.

## Processor Tasks

When your task runs a Processor, you can access the data with the $this->getProperty() method from within the class based processor. This also counts for the run and task objects, which you can load like this:

   
```` php
<?php
$task = $this->getProperty('task');
$run = $this->getProperty('run');
````  