---
title: Official modmore documentation
---

# Welcome to the modmore documentation

If you're looking for information on using the [Premium Extras from modmore](https://www.modmore.com/extras/), look no further! On this shiny new documentation site, you can read more about how our products work, and what you can make with them.

The navigation on the side allows you to browse the documentation hierarchically. The search at the top is useful if you already know what you're looking for. If you're actually reading _everything_, there's previous and next links at the bottom of the page. 

## Get help

If you still have questions, let us know via support@modmore.com or [post on our community forum](https://forum.modmore.com/). We're here to help! 

## Browse the documentation offline

It's possible to [download a full archive of this website](modmore-documentation.zip) (around 1,5MB) to browse it offline. After downloading, unpack the zip file into a memorable place. 

You'll get the best results when serving the files on a local web server (apache/nginx). This will allow you to use the entire documentation site exactly like it works on [docs.modmore.com](https://docs.modmore.com/), including a functional search. 

**Note**: Not all images are included in the download. This means that if you're actually offline you might not see relevant screenshots. 

## Improve the documentation

If you're already comfortable with our extras (or you just spotted a typo!), you can help us improving this documentation through [GitHub](https://github.com/modmore/docs). You'll need a GitHub account, but very little knowledge about using git is necessary. 

The content on this site is written in Markdown, one file per page. The [Mastering Markdown guide on GitHub](https://guides.github.com/features/mastering-markdown/) is a good place to start if you've not worked with Markdown before. 

To propose a change to a page, find the _Edit this page_ link at the bottom of the page. Clicking it will send you straight to GitHub's edit interface for that page. You'll need to login to GitHub if you weren't already.
 
In the edit screen the _Preview changes_ tab is useful to see the rendered Markdown to make sure the syntax is valid. 

When you're happy with the changes you've made, you can propose the change at the bottom of the page. Fill in a simple summary and additional information in the description if needed. You'll then see a summary of the changes. Click the green _Create pull request_ button, and _Create pull request_ again to send the changes for review. 

When the pull request has been created it will start running an automated test on CircleCI. This automated test verifies things like links and basic markdown syntax. This usually takes a minute or two at most. If it flags any issues, you can click the _Details_ link for more information.

If the automated test succeeds we'll review your changes and merge it as soon as possible. Once merged it will be live on docs.modmore.com within a few minutes. 

If you have any questions about this process, please let us know. If you'd like to preview the changes, or use a full git workflow [find out more in the readme on GitHub](https://github.com/modmore/docs/blob/master/README.md) 
