---
title: Auto-linked Headers with ContentBlocks
---

One great thing about separating content from the markup, is that you can make the markup do complex stuff easily.

For example, the heading input is super simple, right? Simply choose the level, and type in the header. But with a clever template, you can make all inserted headings automatically get an added ID and wrap it with an anchor tag, so that without any effort from your editor the heading is clickable and bookmarkable. This is actually in use on this modmore.com website, which means that all headings we inserted via ContentBlocks are clickable.. how awesome is that?

## The Setup

Edit your Heading field or create a new one to begin and make sure the input is set to _Heading_. On the Properties tab, set the template to the following:
```` HTML
<[[+level]] id="jump_[[+value:strtolower:replace=` ==_`]]">
    <a href="[[*uri]]#jump_[[+value:strtolower:replace=` ==_`]]">[[+value]]</a>
</[[+level]]>
```` 
Let's break that down to see what it's doing.

First, the wrapping tag is set to `<[[+level]]>...</>`. This is what the default template does as well, and makes use of the level dropdown to dynamically create the right tag.

Next the heading receives an ID. We're starting it with "jump\_" to make sure it doesn't conflict with any CSS definitions, and then we add the value. To clean it up a bit, we make it lower case and replace spaces with an underscore.

On line 2 we wrap the value in a link, using the resource url value to make sure the link functions properly when using the `<base>` tag in the site header, and then adding the anchor (starting with the # symbol) in the exact same way we created the ID on the line before.

## The Result

Clickable headings without any work for your editors. Like the two headings in this article, but surely you tried them out already :)