---
title: Contributing to the Documentation
description: It's possible to contribute to the modmore documentation through the source markdown files, hosted on GitHub. 
---

The content on this site is written in Markdown, one file per page. These content files are stored on the [modmore/Docs](https://github.com/modmore/docs) repository on GitHub. You'll need a GitHub account to suggest improvements, but little knowledge about using git is necessary. 

## Markdown

The [Mastering Markdown guide on GitHub](https://guides.github.com/features/mastering-markdown/) is a good place to start if you've not worked with Markdown before. 

## Proposing Changes

To propose a change to a page, find the _Edit this page_ link at the bottom of the page. Clicking it will send you straight to GitHub's edit interface for that page. You'll need to login to GitHub if you weren't already.
 
In the edit screen the _Preview changes_ tab is useful to see the rendered Markdown to make sure the syntax is valid. 

When you're happy with the changes you've made, you can propose the change at the bottom of the page. Fill in a simple summary and additional information in the description if needed. You'll then see a summary of the changes. Click the green _Create pull request_ button, and _Create pull request_ again to send the changes for review. 

When the pull request has been created it will start running an automated test on CircleCI. This automated test verifies things like links and basic markdown syntax. The tests take a minute or two to run. If it flags any issues, you can click the _Details_ link to see the full diagnostic output; there will probably be an error in red towards the bottom. 

If the automated test is all green, we'll review your changes and merge it as soon as possible. Once merged it is automatically deployed to [docs.modmore.com](https://docs.modmore.com/) right away. 

## Full Git Workflow

If you have lots of changes to make or just don't want to use the GitHub edit interface, you can also use a full git workflow. This involves forking the repository, cloning it to your machine, pushing changes to a branch on your fork, and then sending a pull request from that.

Having the repository cloned on your machine will also let you build the full site locally with the `./build.sh` command (only tested on Mac/Linux) after an initial `composer install` to install [Daux](http://daux.io).

The [readme on GitHub](https://github.com/modmore/docs/blob/master/README.md) explains the process further. 
