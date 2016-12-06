To know what to do, Gitify Watch needs to know a bit about your environments. This is done by adding an environments property to your .gitify file. That might look something like this:

````
environments:
    modmore.com:
        name: Production
        branch: production
        auto_commit_and_push: true
        commit_delay: 15
    defaults:
        auto_commit_and_push: false
````

In this example we tell it that on the domain modmore.com, we want to push our changes to the production branch, and we want to automatically commit and push changes made every 15 minutes. 

As we do a fair bit of content editing live on the website, with separate staging and development environments primarily for new site features or changes to the provider, it would be too noisy to have it commit every time there is a change.

To make it commit every time, simply set `commit_delay` to `instant` or leave it out as that is the default value.

The name attribute is used in the commit messages. The generic format of commit messages is:

    <name> <created/updated/deleted> <title of page or name of element> on <environment name>

For example:

    Release Robot Robbie updated Extra Updates for Week 36 on Production
    
If there were multiple changes, it will look something like this:

    <name> <created/updated/deleted> <number of objects> objects

With more than one people making changes, it will replace `<name>` with `<count of users>` users, or `<name 1> and <name 2>` if there's only two users involved. Some examples:

    markhamstra and Release Robot Robbie created, edited and updated 8 objects on Production
    3 users created, edited and updated 4 objects on Production

A full chronological list of what was touched by who is also included in the commit description in this case.