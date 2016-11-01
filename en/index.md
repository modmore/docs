---
title: Official modmore documentation
---

# Welcome to the modmore documentation

If you're looking for information on using the [Premium Extras from modmore](https://www.modmore.com/extras/), look no further! On this shiny new documentation site, you can read more about how our products work, and what you can make with them.

The navigation on the side allows you to browse the documentation hierarchically. The search at the top is useful if you already know what you're looking for. If you're actually reading _everything_, there's previous and next links at the bottom of the page. 

## Get help

If you still have questions, let us know via support@modmore.com. We're here to help! 

## Browse the documentation offline

It's possible to [download a full archive of this website](modmore-documentation.zip) (around 1,5MB) to browse it offline. After downloading, unpack the zip file into a memorable place. 

You'll get the best results when serving the files on a local web server (apache/nginx). This will allow you to use the entire documentation site exactly like it works on [docs.modmore.com](https://docs.modmore.com/), including a functional search. 

Alternatively, you can also browse the site by just opening the html files in your browser. This uses the `file://` protocol, which has some restrictions. Most notably the search function will not work, and some images and other assets may not show up. 

When relying on a local copy of the documentation, be sure to update the files every now and then.

**Note**: Not all images are included in the download. This means that if you're actually offline you might not see relevant screenshots. 

## Improve the documentation

If you're already comfortable with our extras (or you just spotted a typo!), you can help us improving this documentation through [GitHub](https://github.com/modmore/docs). 

To propose changes, you will need a GitHub account, but you don't have to know much about git.

All pages you can browse are maintained as Markdown files. Markdown is a simple text format, which we automatically convert into the website. If you're new to markdown, the [Mastering Markdown guide on GitHub](https://guides.github.com/features/mastering-markdown/) is a good place to start. 

Here's how it works.

1. First, find the Markdown file for the page you want to edit. They're all in the [modmore/docs](https://github.com/modmore/docs) repository. [The source for this page can be found here](https://github.com/modmore/docs/blob/master/en/index.md). There's a link at the bottom of each page on the site that takes you straight to the edit page (step 3, below). 

2. GitHub already previews the markdown file. At the top right of that preview are a couple of buttons and icons. By clicking the second-to-last one showing a pencil, you can edit a file directly on GitHub. Click it. 

3. In the edit view you can make your changes. Use the Preview Changes tab to see how the markdown gets rendered. (_Note_: there are some subtle changes between how GitHub renders Markdown and how we do it; GitHub offers some more advanced features. If you stick to the [basic markdown syntax](https://daringfireball.net/projects/markdown/basics), you'll be fine.)

4. When you're done editing, scroll to the bottom where it says _Commit Changes_. Enter a descriptive summary (something like _Add missing property for mgGetImages_), and click _Propose file change_. The name of the branch that is created is not really important. This will save your changes in your personal copy of the documentation source.
 
5. You're now in the _Open a Pull Request_ window with some information pre-filled. This is where you can send your changes back to us. Feel free to add more information in the comment, or just hit _Create pull request_.

6. With the pull request created, we've been notified about your changes and some automatic tests will run that verify if links are correct and that the markdown is valid. If the tests fail, you can click through for more information. 
 
7. Once we've reviewed your changes, we'll accept the Pull Request. Within a few minutes after that your changes will be live on the site!
