Gitify Watch can only be used if your server/setup meets the following requirements:

- Gitify is installed inside a PHP-accessible directory; at least Gitify 0.11 but latest preferred.
- The root of your MODX site is also the root of a git repository which is set up with password-less authentication (i.e. a git push command needs to function without being prompted for a password). Typically this means setting up public key authentication with a deploy key that allows to push and pull.
- There's a valid .gitify file in the root of your MODX site.

Gitify Watch is primarily meant for use on staging or production environments where you want to extract your data automatically whenever a change to a resource or element is made. It does not currently trigger on other actions (e.g. user or system setting changes), so if you want it to also fire on those actions you will need to extend Gitify Watch.

These are the steps needed to set up Gitify Watch, which are explained in a bit more detail if you follow the link:

1. [Download and install Scheduler](../Scheduler/Installation) in MODX (and [install Gitify on your server](../Gitify/Installation) if it isn't there yet)
2. [Download and install Gitify Watch](https://modmore.com/gitifywatch/download/)
3. [Point Gitify Watch to your Gitify installation](Link_Gitify)
4. [Configure your environments in the .gitify file](Configure_Environments)
5. [Make sure the git repository is set up properly](Repository_Setup)
6. [Edit a resource or element to trigger an extract](Trigger_Extract)