
ContentBlocks is available in English (default), German, French, Dutch, Polish, Russian and Swedish, [which we manage through CrowdIn](https://crowdin.net/project/modmore-contentblocks). This covers all core text, including instructions, buttons, labels, settings and more.

The data you define through the component (fields, layouts and templates) also supports translations since v1.1. This allows you to present different names and descriptions for your users depending on their manager language. We support lexicons on field, layout and template names and descriptions, as well as field and layout settings and properties on select input types (chunk, snippet and chunk selector).

[TOC]

## The Lexicon Files

To load the lexicon, you will need to create a namespace and add a "lexicon" directory inside the namespace its core path.

In there, you would have a directory for each language (`en`, `fr`, `de`, etc) and a file in each of those (e.g. `default.inc.php`). Within the file, you would add the lexicon entries to a `$_lang` variable. An example of a lexicon file is shown below.

````PHP
<?php
$_lang['my_richtext_field'] = 'Rich Text';
$_lang['my_class'] = 'foobar';
````

The entries (`my_richtext_field` and `my_class` in the example above) need to match the text you want to replace. This can be one of the following:

- Field names (both for display in the content canvas, as well as the "Add Content" modal)
- Field descriptions (in the Add Content modal tooltip)
- Layout names (both for display in the content canvas, as well as the "Add Layout" modal)
- Layout descriptions (in the Add Layout modal tooltip)
- Field and Layout Settings name (for modal and exposed settings)
- Field and Layout Setting Options display values (for modal and exposed settings)

For example, if you named a field "Headline", your lexicon entry would be `$_lang['Headline'] = 'Headline translation';`

## Loading the Lexicon Topic

To use your lexicon keys, it is important to load the lexicon topic into the manager. There are several ways to do that, but one way we will cover here is by using a small plugin that runs independently of ContentBlocks.

The plugin will fire on the **OnDocFormRender** event, and contains the following:

```` PHP
<?php
$modx->controller->addLexiconTopic('mynamespace:default');
````

Just that one line. Replace `mynamespace` with the name of your namespace, and `default` with the name of your lexicon topic (file).

To check if it's working, open up the source view for the resource update page, and look for the line that loads the lang.js.php with a whole bunch of topics separated by commas. It looks something like this: <`script src="/connectors/lang.js.php?ctx=mgr&topic=topmenu,file,resource...">` Your lexicon entry should be in that list.

If it isn't, double check if you enabled the **OnDocFormRender** event, or try clearing the cache and refreshing.
