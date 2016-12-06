To trigger an extract, all you have to do is edit a resource or element. After that you should see the `gitifywatch:extract` task being scheduled within the Scheduler component, along with data about the triggers.

If it's not triggering, it might not be recognising the domain name, or your .gitify file. In most cases you will see more information about such errors in the MODX error log, though in rare circumstances errors will also be logged to your PHP error log.

When the extract task is triggered, it can sometimes fail to recognise the environment because it doesn't know the domain name. In that case, double check if your `core/config/config.inc.php` file contains the right hostname. 
