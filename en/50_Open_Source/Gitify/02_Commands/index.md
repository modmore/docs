When you have Gitify installed, you can use `Gitify list` to get an overview of all available commands, and `Gitify help [command]` to get more information about that specific command. 

````
Gitify version 0.8.0

Usage:
 [options] command [arguments]

Options:
 --help (-h)           Display this help message.
 --verbose (-v|vv|vvv) Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug.
 --version (-V)        Display the Gitify version.

Available commands:
 backup            Creates a quick backup of the entire MODX database. Runs automatically when using `Gitify build --force`, but can also be used manually.
 build             Builds a MODX site from the files and configuration.
 extract           Extracts data from the MODX site, and stores it in human readable files for editing and committing to a VCS.
 help              Displays help for a command
 init              Generates the .gitify file to set up a new Gitify project. Optionally installs MODX as well.
 list              Lists commands
 restore           Restores the MODX database from a database dump created by `Gitify backup`
install
 install:modx      [Deprecated, will be removed in v1] Downloads, configures and installs a fresh MODX installation. 
 install:package   [Deprecated, will be removed in v1] Downloads and installs MODX packages. 
modx
 modx:install      Downloads, configures and installs a fresh MODX installation. [Note: install:modx will be removed in 1.0, use modx:install instead]
 modx:upgrade      Ugrades an already installed MODX installation. 
package
 package:install   Downloads and installs MODX packages. [Note: install:package will be removed in 1.0, use package:install instead]
````
