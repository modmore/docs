---
title: modx:install
---

`Gitify modx:install`

Renamed from `Gitify install:modx` in v0.8. Installs the latest version of MODX, or the one you specified, by downloading the zip and running a command line install. Database details and the likes will be asked for interactively.

````
Usage:
 modx:install [modx_version]

Arguments:
 modx_version          The version of MODX to install, in the format 2.3.2-pl. Leave empty or specify "latest" to install the last stable release.

Options:
 --download (-d)       Force download the MODX package even if it already exists in the cache folder.
 --help (-h)           Display this help message.
 --verbose (-v|vv|vvv) Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug.
 --version (-V)        Display the Gitify version.
````