
When you write documentation, such as the ContentBlocks documentation, it can really be a pain to properly get code to display. Rich text editors eat code, add entities where they shouldn't be and worse of all MODX likes to tag MODX tags, even when they're not supposed to be executed. This leads to a mess of workarounds. But no more, with ContentBlocks and the Code input.

ContentBlocks ships with a Code input that uses the Ace editor to provide a easy way for writing/editing code. Aside from using this field to write custom markup for complex layouts or other fancy stuff, you can also use it to output code nicely, escaping all the right entities and tags for display to the user. We use that here at modmore for our documentation, so we can easily show you pieces of code where we need to.

## The Setup

First, create a new Field with the input type set to _Code_. Give it a name, description and all that goodness and then quickly head over to the Properties tab for the magic. Set the template to a nice wrapper - the general web consensus is that it should be a `<pre>` tag with a `<code>` tag inside, so that's what we use in the example below - and then just stick the `[[+value]]` placeholder in the middle. No output modifiers to escape stuff, just the placeholder.
```` HTML
<pre><code class="language-[[+lang]]">[[+value]]</code></pre>
````
Then enable the Encode Entities option. When this option is enabled, it will process the value to escape HTML entities so they are displayed instead of interpreted by the browser, and it will also change MODX tags to their proper entities to prevent them from being parsed by MODX when the page is requested.

[![](https://assets.modmore.com/uploads/2014/04/1398430219_21e911263f5f5d67fad675fd2e6a746e.png)](https://assets.modmore.com/uploads/2014/04/1398430219_21e911263f5f5d67fad675fd2e6a746e.png)

## Adding Syntax Highlighting

Now that you have the content all encoded, you can use a syntax highlighter to make it more pleasurable for the user to view. The `<pre><code class="language-[[+lang]]">..</code></pre>` format we used is exactly what [Prism.js](http://prismjs.com/) and [highlight.js](http://highlightjs.org/) expect, so that's a simple drop in, but you can also change the template a bit for [SyntaxHighlighter](http://alexgorbatchev.com/SyntaxHighlighter/) or other tools.

## The Result
```` HTML
<!DOCTYPE html>
<html>
<head>
	<link href="themes/prism.css" rel="stylesheet" />
</head>
<body>
	<script src="prism.js"></script>
</body>
</html>
````
## Using with Prism

When you want to syntax highlight using Prism, it's important to note that while the language needs to be set to "html" for Ace to properly highlight things in the manager, it needs to be "markup" for Prism in the frontend. To solve that, we're using a slightly different version of the template on modmore.com, as follows below.
```` HTML
<pre><code class="language-[[+lang:eq=`html`:then=`markup`:else=`[[+lang]]`]]">
  [[+value]]
</code></pre>
````
## Going Beyond

When you have this all set up, you could go beyond and only load the syntax highlight scripts/styles when they are required. How? [With the cbHasField snippet!](Tips_Tricks/Load_Field_Specific_Resources/)
