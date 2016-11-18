Having issues with Gitify? Please read all entries in this guide and search the [issues on Github](https://github.com/modmore/Gitify/issues). If you don't find an answer you might want to [open a new issue](https://github.com/modmore/Gitify/issues/new).

## MySQL errors 

If you're getting MySQL errors when trying to extract or build a site, you'll probably need to add some paths to your PATH so the right binaries are used. See the [Windows](Installation/Windows) or [Mac](Installation/Mac) installation documentation. 

## MIGX

If you're using MIGX configs and the Gitify files for the configs changes after each `build` and `extract` command of Gitify, you might need to pay attention to your order of the MIGX objects in your `.gitify` file. The `migxConfig` should be the last item of the MIGX objects. For more details please read [issue #90](https://github.com/modmore/Gitify/issues/90).