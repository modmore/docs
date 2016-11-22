modmore documentation
=====================

This repository contains the Markdown source for the modmore documentation. Eventually this will live at docs.modmore.com and will be the canonical place for documentation on all modmore extras.

Contributions to this documentation are very welcome!

This documentation is provided and maintained under the [CC BY-SA 4.0 license](https://creativecommons.org/licenses/by-sa/4.0/). 

## Folder Structure

This repository has a fairly deep folder structure. This is because we'd like to eventually add different languages and version specific documentation, even if those aren't available here now.

The basic structure is:

`/Language/Topic/v{Major Version}.x/Documentation.md`

The documentation can be further split up. This will be shown on the documentation website in a tree view. 

For example `/en/ContentBlocks/v1.x/Fields.md` or `/ru/Commerce/v0.x/Modules/EUVat.md`. 

## File Format

If needed, a custom title can be set per page by using [Front matter](http://daux.io/Features/Front_Matter) at the top of a file. 

## Contributing

You're invited to help us improve the documentation. For this we use git and pull requests on github to manage changes. If you're new to git and need a bit more help getting set up, don't hesitate to ask for help. 

When suggesting content changes, please limit yourself to one extra per pull request so we can more easily review the changes. For typos a single pull request across different sections is fine. 

## Building the static site

Turning the markdown files into a static site is done with [Daux](http://daux.io/). When you have the repository checked out or downloaded locally, install Daux by running `composer install` in the root of the repository. This uses [composer](https://getcomposer.org/) which is assumed to be installed globally.

With Daux installed, you can run `./build.sh`. This script will call Daux with the right parameters to build the documentation into the `html/` directory. This build step usually takes no more than a few seconds. 

From there you can preview the site by pointing your browser to the html directory.

## Building assets

The site uses NPM scripts for compiling sass into css, and compiling a couple of small javascript files. All asset related source files can be found in the `src` folder of the repository, and write distribution files to `themes/modmore/dist/`. 

The first time you want to build the assets, you'll need to run `npm install` in the root of the repository. This process may take some time. 

When building the site with `./build.sh`, it will create a symlink between html/themes/ and /themes/, allowing you view changes to the dist files without requiring to rebuild the site on every change. 

To build the CSS and to preview the changes, run `npm run build:css`. Likewise `npm run build:js` will build the javascript and `npm run build` will build all different things managed with npm. 

