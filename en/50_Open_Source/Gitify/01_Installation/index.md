New as of v0.2 is that dependencies are managed via [Composer](https://getcomposer.org/), most notably it has been rebuilt on top of Symfony's Console component to provide a more feature-packed base to build from. [Follow these instructions if you haven't installed Composer before](https://getcomposer.org/doc/00-intro.md)

To get started with Gitify, it's easiest to set up a local clone of this repository. It doesn't matter in which folder clone it to. On Unix/Linux systems you can choose your home directory. After that, run Composer to download the dependencies, and finally make the Gitify file executable to run it.

````
git clone https://github.com/modmore/Gitify.git Gitify
cd Gitify
# If you haven't installed composer, yet, you can do this to install the composer.phar:
# curl -sS https://getcomposer.org/installer | php
composer install --no-dev 
# or: php composer.phar install --no-dev
chmod +x Gitify
````

At this point you should be able to type `./Gitify` and get a response like the following:

```` 
Gitify version 0.2.0

Usage:
  [options] command [arguments]

Options:
  --help           -h Display this help message.
  --verbose        -v|vv|vvv Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug.
  --version        -V Display the Gitify version.

Available commands:
  build          Builds a MODX site from the files and configuration.
  extract        Extracts data from the MODX site, and stores it in human readable files for editing and committing to a VCS.
  help           Displays help for a command
  init           Generates the .gitify file to set up a new Gitify project. Optionally installs MODX as well.
  list           Lists commands
install
  install:modx   Downloads, configures and installs a fresh MODX installation.
````

If that's working as expected, the next step is to add the Gitify executable to your PATH so you can run Gitify in any directory. Edit your `~/.bash_profile`, `~/.zshrc` or `~/.profile` file and add the following, with the right path to the Gitify **directory** (not the executable file):

````
export PATH=/path/to/Gitify/:$PATH
````

Restart your terminal and you should be good to go.

For successfull installing of MODX by `Gitify install:modx` command you should have installed **unzip** command in your system. For Debian/Ubuntu you can use `sudo apt-get install unzip`.
