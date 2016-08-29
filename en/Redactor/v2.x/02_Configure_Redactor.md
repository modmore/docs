---
title: Redactor Configuration Options 
---

With 150 or so settings, there is a lot you can configure with Redactor. On this page you will find a complete list of all these settings, what they do and links to additional relevant documentation where applicable.

All of these settings are created automatically when installing Redactor. They can also be added manually to Users, User Groups or Contexts to override their values for specific users or contexts. To do that, add a new setting with the mentioned key (including the `redactor.` prefix!) and the desired value.

[TOC]

## Configuration: Advanced

### Additional Plugins (`redactor.additionalPlugins`) 

Define as a comma separated list of "pluginname:pluginfile" to load additional Redactor plugins.

### Advanced Attributes (`redactor.advAttrib`) (tv)

If enabled attributes such as class, id, and title will be available when editing links and images.

**Default:**`false`

### Clean File Names (`redactor.cleanFileNames`) 

When enabled, special characters will be removed from files on upload.

**Default:**`true`

### Counter Words per Minute (`redactor.counterWPM`) 

Words per minute used by counter plugin to estimate reading time.

**Default:**`275`

### Formatting Add (`redactor.formattingAdd`) 

This setting allows to select tags and styles for the formatting dropdown. formattingAdd can only be applied to p, pre, blockquote and header tags. Each formatting tag gets a CSS class that allows to customize style of each element. [See more](Custom_Formatting).

### Fullpage (`redactor.fullpage`) (tv)

Allows editing of a complete HTML-page (including html, head, body and other tags) in iframe and fullpage mode.

### Link Protocol (`redactor.linkProtocol`) (tv)

The protocol (`http://`, `https://` or leave empty) to build links with.

### Sanitize Pattern (`redactor.sanitizePattern`) 

A RegEx pattern applied when sanitizing names of uploaded files.

### Sanitize Replace (`redactor.sanitizeReplace`) 

The replacement character used when sanitizing names of uploaded files.

**Default:**`_`

### Speech Pitch (`redactor.speechPitch`) 

Pitch at which voice should be spoken by Speek Plugin when reading aloud.

**Default:**`1`

### Speech Rate (`redactor.speechRate`) 

Rate at which voice should be spoken by Speek Plugin when reading aloud.

**Default:**`1`

### Speech Voice (`redactor.speechVoice`) 

Voice to be used by Speek Plugin when reading aloud.

### Speech Volume (`redactor.speechVolume`) 

Volume to be used by Speek Plugin when reading aloud.

### Stylesheet (`redactor.css`) 

Put in a full URL to a CSS file to use your own styling for formatting.

### Text Expander (`redactor.textexpander`) 

Enter a short snippet of text or a word and this plugin will replace it to a frequently used predefined text. For example, enter "addrr" to have it replaced with your mailing address.

 

 

## Configuration: Editor

### Add Shortcuts (`redactor.shortcutsAdd`) 

This setting add your custom shortcuts to Redactor. [See more](http://imperavi.com/redactor/docs/settings/#set-shortcutsAdd).

### Anchor Links (`redactor.linkAnchor`) 

When enabled, the _insert link_ modal will include a tab for inserting links to anchors.

**Default:**`false`

### Autoresize (`redactor.autoresize`) (tv)

When enabled, the editor will automatically grow as big as needed to show all the text without having any scroll.

**Default:**`true`

### CodeMirror (`redactor.codemirror`) (tv)

If set to 'true', CodeMirror will be used for syntax highlighting in source mode, regardless of plugin\_syntax setting.

**Default:**`true`

### Enter Key (`redactor.enterKey`) 

This setting allows to prevent use of Return key.

**Default:**`true`

### Focus (`redactor.focus`) 

By default, Redactor doesn't receive focus on load, because there may be other input fields on a page. However, to set focus to Redactor, you can use this setting.

**Default:**`false`

### Focus End (`redactor.focusEnd`) 

When enabled sets focus after the last character in Redactor.

**Default:**`false`

### Image Link (`redactor.imageLink`) 

Turns on the ability to add a link to an image via edit modal window.

**Default:**`true`

### Image Position (`redactor.imagePosition`) 

This setting allows to set image position (float alignment) in relation to the text.

**Default:**`true`

### Image Resizable (`redactor.imageResizable`) 

Turns on visual image resizing.

**Default:**`true`

### Linebreaks (`redactor.linebreaks`) 

This setting turns on markup with line breaks instead of paragraphs when user presses Return key.

**Default:**`false`

### Link No Follow (`redactor.linkNoFollow`) 

This setting will add nofollow attribute to the links added via Redactor.

**Default:**`false`

### Link to Email (`redactor.linkEmail`) 

When enabled, the _insert link_ modal will include a tab for inserting mailto: links.

**Default:**`true`

### Link Size (`redactor.linkSize`) 

Maximum number of characters when displaying a URL.

**Default:**`50`

### Link to Resource (`redactor.linkResource`) 

When enabled, the _resource link_ modal will include a tab for inserting links to other MODX Resources.

**Default:**`true`

### Link Tooltip (`redactor.linkTooltip`) 

Set to true to allow follow/edit links by putting cursor to the link right in Redactor.

**Default:**`true`

### Load Introtext (`redactor.loadIntrotext`) 

When enabled, adds Redactor to the introtext field on the resource.

**Default:**`false`

### Minimum Height (`redactor.minHeight`) (tv)

Used together with the `Autoresize` option, the Min Height configuration lets you set either a minimum (when autoresize is enabled) or fixed (when autoresize is disabled) height for the text area. The height is in pixels and only needs the integer numbers added in the setting.

**Default:**`200`

### Observe Images (`redactor.imageEditable`) 

When enabled you can click an image to change the alignment and alt/title text.

**Default:**`true`

### Paste as Plain Text (`redactor.pastePlainText`) 

This setting turns on pasting as plain text. The pasted text will be stripped of any tags, line breaks will be marked with tag. With this set to 'true' and 'enterKey' set to 'false', line breaks will be replaced by spaces.

**Default:**`true`

### Placeholder (`redactor.placeholder`) 

Optional placeholder text to initially display when no other text is available to display.

### Shortcuts (`redactor.shortcuts`) 

This setting add your custom shortcuts to Redactor. [See more](http://imperavi.com/redactor/docs/settings/#set-shortcutsAdd).

**Default:**`true`

### Tabifier (`redactor.tabifier`) 

Sets indent for code when using code.toggle or code.get.

**Default:**`true`

### Tab Index (`redactor.tabindex`) 

The tab index order of the text editing field.

 0 ### Predefined Links (`redactor.predefinedLinks`) 

This setting allowing to add a list of predefined links in "Add link" modal. [See more](http://imperavi.com/redactor/docs/settings/#set-predefinedLinks).

### Scroll Target (`redactor.scrollTarget`) 

This setting allows to set a parent layer when Redactor is placed inside of layer with scrolling. When this is set, scroll will return to correct position when a user pastes some text.

### tabSpaces (`redactor.tabSpaces`) 

Set to true to use space instead of margins for Chinese language.

**Default:**`false`

### Typewriter (`redactor.typewriter`) (tv)

Stress-free typewriter mode. [See more](http://imperavi.com/redactor/examples/typewriter/).

**Default:**`false`

### Visual (`redactor.visual`) 

When disabled launches Redactor in code view mode by default.

**Default:**`true`

### WYM (`redactor.wym`) (tv)

WYM ("What you mean", aka Visual Structure) mode is a special mode in which through the use of background colors and indentation, the markup structure is made visible. If you want to train your editors to make clean markup, this is a great option to enable. [View an example.](http://imperavi.com/redactor/examples/wym/)

**Default:**`false`

### Limiter Character Count (`redactor.limiter`) 

Used with the Limiter plugin, this setting controls how many characters are allowed in the editor.

 

 

## Configuration: Internationalisation

### Direction (`redactor.direction`) 

Sets the default text direction. This can be overridden on block level using the textdirection plugin.

**Default:**`ltr`

**Options:**

- ltr (left-to-right)
- rtl (right-to-left)

### Language (`redactor.lang`) (tv)

The language to use for Redactor. By default, this will inherit the MODX Manager Language, but can be overridden here.

**Default:**`Manager language`

 

 

## Configuration: Markup

### Allowed Attributes (`redactor.allowedAttr`) 

This setting allows to set attributes that will not be removed from the code.

### Allowed Tags (`redactor.allowedTags`) 

Either use the Allowed Tags setting, or the Denied Tags setting - not both! When using the Allowed Tags setting, you can whitelist accepted tags in the content - others will be stripped.

### Cleanup (`redactor.cleanup`) (tv)

When enabled, any time text is pasted into the editor it will be parsed and cleaned up to only leave the important markup.

**Default:**`true`

### Clean Spaces (`redactor.cleanSpaces`) (tv)

Removes extra space in pasted text when true and leave extra spaces when 'false'.

**Default:**`true`

### Clean Styles on Enter (`redactor.cleanStyleOnEnter`) 

When enabled this setting will prevent new paragraph from inheriting styles, classes and attributes form a previous paragraph.

**Default:**`false`

### Convert Divs (`redactor.convertDivs`) (tv)

With Convert Divs enabled, Redactor will automatically replace `
` tags with `
` tags.

**Default:**`true`

### Convert Links (`redactor.convertLinks`) (tv)

When Convert Links is enabled, Redactor will automatically parse links in the content, and add the proper anchor tags into the markup.

**Default:**`true`

### Denied Tags (`redactor.deniedTags`) (tv)

Either use the Allowed Tags setting, or the Denied Tags setting - not both! When using the Denied Tags setting, you can blacklist tags that are not allowed in the markup.

**Default:**`html, head, link, body, meta, script, style, applet`

### Margin Float Left (`redactor.marginFloatLeft`) 

When positioning images as left or right, Redactor lets you put in a_CSS class_ or _margins_ to prevent the image from colliding with the text floating around it. You can define the margin or CSS class for the left align with this setting. Either provide the margin like the value part of a CSS declaration: `0 10px 10px 0` or provide a class name prefixed with a dot: `.imageFloatLeftInContent`. If you want multiple classname, only prefix the first with a dot.

**Default:**`0 10px 10px 0`

### Margin Float Right (`redactor.marginFloatRight`) 

When positioning images as left or right, Redactor lets you put in a_CSS class_ or _margins_ to prevent the image from colliding with the text floating around it. You can define the margin or CSS class for the right align with this setting. Either provide the margin like the value part of a CSS declaration: `0 0 10px 10px` or provide a class name prefixed with a dot: `.imageFloatRightInContent`. If you want multiple classname, only prefix the first with a dot.

**Default:**`0 0 10px 10px`

### Paragraphize (`redactor.paragraphize`) 

When linebreaks setting is not set, new and pasted text will be processed by a paragraph markup function. All pasted text and all newly entered text will be marked up with paragraphs to preserve proper text formatting.

### Pre Spaces (`redactor.preSpaces`) 

This setting allows to set the number of spaces that will be applied when a user presses Tab key inside of preformatted blocks. If set to 'false', Tab key will apply tabulation instead of spaces inside of preformatted blocks.

### Remove Attributes (`redactor.removeAttr`) 

This setting allows to set attributes that will be removed from the code.

### Remove Comments (`redactor.removeComments`) 

If set to 'true', all HTML comment will be removed from code.

### Remove Data Attributes (`redactor.removeDataAttr`) 

When enabled, Redactor will remove all data attributes in the code.

### Remove Empty Tags (`redactor.removeEmptyTags`) 

This setting allows to turn on and off removing of empty tags.

**Default:**`p`

### Replace Styles (`redactor.replaceStyles`) 

This setting allows to set which span styles will be replaced by tags.[See more](http://imperavi.com/redactor/docs/settings/clean/#setting-replaceStyles).

### Replace Tags (`redactor.replaceTags`) 

By default,  tag will always be replaced with . You can set your own array of tags to be replaced. [See more](http://imperavi.com/redactor/docs/settings/clean/#setting-replaceTags).R

 

 

## Configuration: Media

### Browse Files (`redactor.browse_files`) 

When enabled, allows browsing the filesystem to select uploaded fields.

**Default:**`true`

### Convert Image Links (`redactor.convertImageLinks`) 

Converts inserted links to images into `` tags on return.

**Default:**`false`

### Convert Video Links (`redactor.convertVideoLinks`) 

Convert added links to YouTube into an embedded player.

**Default:**`false`

### Date Files (`redactor.date_files`) 

Enable this setting to have file uploads prefixed with a full timestamp.

**Default:**`false`

### Date Images (`redactor.date_images`) 

Enable this setting to have image uploads prefixed with a full timestamp.

**Default:**`false`

### Drag Upload (`redactor.dragUpload`) 

This setting allows users to drag and drop images from their computers into Redactor and upload these images to server. This feature works in all latest browsers, except for IE.

**Default:**`true`

### Drag Image Upload (`redactor.dragImageUpload`) 

When disabled, turns off the ability to upload files using drag and drop.

**Default:**`truer`

### Dynamic Thumbs (`redactor.dynamicThumbs`) 

When enabled, dynamic thumbnails will be generated for previewing images.

**Default:**`true`

### Eureka Plugin (`redactor.plugin_eureka`) 

When enabled uses the Eureka media browser to choose images.

**Default:**`true`

### Eureka Plugin Shiv IE 9 (`redactor.plugin_eureka_shivie9`) 

When enabled includes polyfills to hack IE9 support.

**Default:**`false`

### Eureka Upload (`redactor.eurekaUpload`) 

When enabled, files can be uploaded to current directory within the Insert Image Choose Tab.

**Default:**`false`

### File Browse Path (`redactor.file_browse_path`) (tv)

The path to browse when choosing files, relative to the root of the media source as defined by the `Media Source` setting, in which files should be available through the insert file modal window.

**Default:**`assets/uploads/`

### File Media Source (`redactor.file_mediasource`) (tv)

Choose (or provide the ID of) a Media Source to use for uploading and browsing files. This can be any type of Media Source that implements uploading and browsing of images.

### File Upload Path (`redactor.file_upload_path`) 

The path, relative to the root of the media source as defined by the `Media Source` setting, in which file uploads should be placed. See [Managing Media](Managing_Media).

**Default:**`assets/uploads/`

### Image Browse Path (`redactor.image_browse_path`) (tv)

The path to browse when choosing images, relative to the root of the media source as defined by the `Media Source` setting, in images which should be browsed through the choose image modal window.

**Default:**`assets/uploads/`

### Image Media Source (`redactor.mediasource`) (tv)

Choose (or provide the ID of) a Media Source to use for uploading and browsing images and files. This can be any type of Media Source that implements uploading and browsing of images.

### Image Upload Path (`redactor.image_upload_path`) (tv)

 The path, relative to the root of the media source as defined by the `Media Source` setting, in which image uploads should be placed. See [Managing Media](Managing_Media).

**Default:**`assets/uploads/`

### Max Directory Depth (`redactor.max_directory_depth`) 

Maximum Numbers of directories to recursively fetch when browsing media.

**Default:**`5`

### Parse Parent Path (`redactor.parse_parent_path`) 

When enabled, the parent resource is parsed into placeholders in the upload or browse paths. See [Managing Media](Managing_Media).

### Increment File Names (`redactor.increment_file_names`) 

When enabled, this option will prevent duplicate files getting overwritten by appending a numeric index to the file name.

This option only supports file media sources.

**Default:**`true`

### Parse Parent Path Height (`redactor.parse_parent_path_height`) 

The height (or depth) to search for a resources' ultimate parent.

**Default:**`10`

### Show Dimensions on Resize (`showDimensionsOnResize`) 

When enabled image dimensions will be displayed beneath images as they are resized.

 

 

## Configuration: Plugins

### Breadcrumb Plugin (`redactor.plugin_breadcrumb`) (tv)

When enabled visually displays a breadcrumb navigation of the DOM node or nodes being edited.

**Default:**`false`

### Contrast Plugin (`redactor.plugin_contrast`) (tv)

When enabled hit F5 to invert editor screen contrast.

**Default:**`false`

### Counter Plugin (`redactor.plugin_counter`) (tv)

Adds a character counter to the bottom right of the editor.

**Default:**`false`

### Download Plugin (`redactor.plugin_download`) (tv)

When enabled adds a toolbar button to download editor code.

**Default:**`false`

### Eureka Plugin (`redactor.plugin_eureka`) (tv)

When enabled uses the Eureka media browser to choose images.

**Default:**`true`

### Font Color Plugin (`redactor.plugin_fontcolor`) (tv)

Adds the ability to set the text color and/or text background color in the toolbar.

**Default:**`false`

### Font Family Plugin (`redactor.plugin_fontfamily`) (tv)

Choose a font family for selected text via the toolbar.

**Default:**`false`

### Font Size Plugin (`redactor.plugin_fontsize`) (tv)

Change the font size specified in pixels. Bigger sometimes is better.

**Default:**`false`

### Limiter (`redactor.plugin_limiter`) (tv)

Limit the number of characters a user can enter.

**Default:**`false`

### Listen Plugin (`redactor.plugin_speek`) (tv)

When enabled and in supported browsers adds a toolbar button which reads editor content aloud.

**Default:**`false`

### Image Dimensions Plugin (`redactor.plugin_imagepx`) (tv)

When enabled adds options to set and preview image dimensions in the Image Edit modal window.

**Default:**`false`

### Norphan Plugin (`redactor.plugin_norphan`) (tv)

When enabled attempts to prevent orphans by replacing the last space between words of block elements with a non-breaking space.

**Default:**`false`

### Replacer Plugin (`redactor.plugin_replacer`) (tv)

When enabled use CTRL+F to trigger a simple Find and Replace tool.

**Default:**`true`

### Syntax Plugin (`redactor.plugin_syntax`) (tv)

When enabled adds Ace syntax highlighter to Redactor source mode. If you prefer CodeMirror, enable the `redactor.codemirror` setting instead.

**Default:**`false`

### Table Plugin (`redactor.plugin_table`) (tv)

Insert and format tables with ease.

**Default:**`true`

### Text Direction Plugin (`redactor.plugin_textdirection`) (tv)

Easily change the direction of the text in a block element (paragraph, header, blockquote etc.) via the toolbar.

**Default:**`true`

### Text Expander Plugin (`redactor.textexpander`) (tv)

Enter a short snippet of text or a word and this plugin will replace it to a frequently used predefined text. For example, enter "addrr" to have it replaced with your mailing address.

**Default:**`false`

### Uploadcare Plugin (`redactor.plugin_uploadcare`) (tv)

When enabled adds Uploadcare to the toolbar.

**Default:**`false`

### Video Plugin (`redactor.plugin_video`) 

Enrich text with embedded video.

**Default:**`true`

### Zoom Plugin (`redactor.plugin_zoom`) (tv)

When enabled adds a keyboard shortcut to enlarge and decrease font size in content area. Use CTRL + and CTRL -.

**Default:**`false`

 

 

## Configuration: Resource Typeahead

### Include Introtext (`redactor.include_introtext`) 

When enabled, the typeahead will include the introtext for each of the resources, providing you with more information about the resource.

**Default:**`true`

### Prefetch TTL (`redactor.prefetch_ttl`) 

Used in the Resource search typeahead, the prefetch contains the top level resources that are published and not deleted. This data is preloaded when the typeahead field is instantiated, providing very quick access to important resources that may be requested, however the typeahead will continue to search further down the resource tree when the users start typing. The prefetch TTL is how long (in microseconds) the prefetch data should be considered valid and stored in the users\\' LocalStorage.

**Default:**`3600000`

 

 

## Configuration: Toolbar

### Active Buttons (`redactor.activeButtons`) 

This setting allows to set which buttons will become active if the cursor is positioned inside of a respectively formatted text. activeButtons should always be used with activeButtonStates.

**Default:**`deleted, italic, bold, underline, unorderedlist, orderedlist, alignleft, aligncenter, alignright, justify`

### Active Button States (`redactor.activeButtonStates`) 

This setting allows to set which tags make buttons active. activeButtonStates should always be used with activeButtons.

**Default:**`{ b: 'bold', strong: 'bold', i: 'italic', em: 'italic', del: 'deleted', strike: 'deleted', ul: 'unorderedlist', ol: 'orderedlist', u: 'underline' }`

### Buttons (`redactor.buttons`) (tv)

Contains a comma separated list of the buttons to show in the Redactor toolbar.

**Default:**`html, formatting, bold, italic, deleted, unorderedlist, orderedlist, outdent, indent, image, link, alignment, horizontalrule`

### Clips JSON (`redactor.clipsJson`) (tv)

If set and a [valid JSON String](http://jsonlint.com), adds the Redactor Clips plugin to the toolbar.

### Hide Buttons (`redactor.buttonsHide`) 

This setting allows certain buttons to be hidden on launch.

### Hide Buttons on Mobile (`redactor.buttonsHideOnMobile`) (tv)

This setting allows certain buttons to be hidden on mobile devices.

### Colors (`redactor.colors`) (tv)

The colors (hexcodes) that are available with the `fontcolor` and `backcolor` toolbar buttons.

**Default:**`#ffffff,#000000,#eeece1,#1f497d,#4f81bd,#c0504d,#9bbb59,#8064a2,#4bacc6,#f79646,#ffff00,#f2f2f2,#7f7f7f,#ddd9c3,#c6d9f0,#dbe5f1,#f2dcdb,#ebf1dd,#e5e0ec,#dbeef3,#fdeada,#fff2ca,#d8d8d8,#595959,#c4bd97,#8db3e2,#b8cce4,#e5b9b7,#d7e3bc,#ccc1d9,#b7dde8,#fbd5b5,#ffe694,#bfbfbf,#3f3f3f,#938953,#548dd4,#95b3d7,#d99694,#c3d69b,#b2a2c7,#b7dde8,#fac08f,#f2c314,#a5a5a5,#262626,#494429,#17365d,#366092,#953734,#76923c,#5f497a,#92cddc,#e36c09,#c09100,#7f7f7f,#0c0c0c,#1d1b10,#0f243e,#244061,#632423,#4f6128,#3f3151,#31859b,#974806,#7f6000`

### Commemorate Rebecca (`redactor.commemorateRebecca`) 

Commemorates [Rebecca Meyer](http://www.zeldman.com/2014/06/10/the-color-purple/) by setting the Redactor toolbar to **her favorite color** the seventh of each June.

**Default:**`false`

### Formatting Tags (`redactor.formattingTags`) (tv)

The options you get when clicking the formatting button in the Redactor toolbar. Defaults to: p, blockquote, pre, h1, h2, h3, h4 which are the only currently supported formatting tags. 

**Default:**`p,blockquote,pre,h1,h2,h3,h4`

### Fullscreen Button (`redactor.buttonFullScreen`) (tv)

When enabled, a fullscreen button will be located in the right of the toolbar.

**Default:**`true`

### Source Button (`redactor.buttonSource`) (tv)

This setting adds an HTML code view button to the toolbar.

**Default:**`true`

### Toolbar Fixed (`redactor.toolbarFixed`) (tv)

If this option is turned on, Redactor's toolbar will remain in view at all times, by sticking to the top of the window when scrolling down.

**Default:**`true`

### Toolbar Overflow (`redactor.toolbarOverflow`) (tv)

With this option, you can specify a toolbar button to build only one row on mobile devices.

**Default:**`false`

 

 