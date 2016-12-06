Gitify Watch needs to know where you have installed Gitify. Unfortunately just adding Gitify to your PATH is not sufficient for Gitify Watch as it interacts with it via the PHP API, rather than the command line interface.

If you're not sure where your Gitify is installed, you can execute the `which Gitify` command to find out. For example it might return `/home/user/Gitify/Gitify`. 

In this case you can see the path includes the executable. GitifyWatch just wants to know the path, so you can take off the second `Gitify`, which means in this example the path Gitify Watch needs to know is `/home/user/Gitify/`

This path needs to be entered into the `gitifywatch.gitify_path` system setting of your MODX installation. Make sure it includes a trailing slash.

## Pointing to the Git Executable

If your git executable is not at `/usr/bin/git`, you will also need to create a new setting called `gitify.git_path` that points to the executable instead. In this case, make it the full path to the executable, including the executable itself.

## Keeping settings outside your gitify data

The two settings on this page are most likely specific to the environment, meaning you might not want them inside your gitify data directory, even if you do have the other system settings included. For that, you can add a where statement to your `.gitify` file, like this:

````
data:
  system_settings:
    class: modSystemSetting
    primary: key
    exclude_keys:
      - editedon
    where:
      - 'key:NOT IN':
        - 'gitifywatch.gitify_path'
        - 'gitify.git_path'
````

After adding that, the setting values will not be changed by Gitify build, nor will files for it be created by Gitify extract.
