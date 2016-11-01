The page you're currently looking at contains information related to Redactor 1.x. Please visit [Configure Redactor](https://www.modmore.com/redactor/documentation/configuration/) for the relevant information for Redactor 2.x.

---

Redactor comes with a whole bunch of configuration options, so you can customize the look of the editor, the available functionality and some nifty tricks that Redactor offers.

These configurations are stored as System Settings, and can be found by visiting _System_ » _System Settings_ and choosing _redactor_ in the namespace dropdown (that's the one that defaults to "core"). It is also possible to create [Redactor Template Variables instances](https://www.modmore.com/extras/redactor/documentation/template-variable/), in which case you can override many of the settings for each template variable.

+tv Options marked with a "+" in the overview, or with the blue "+tv" label below, are options that can be configured for individual [Redactor template variables](https://www.modmore.com/extras/redactor/documentation/template-variable/).

[TOC]



## User Specific Settings

Redactor for MODX takes advantage of MODX Revolution’s ability to override System Settings with User Settings. This means that you can do things like control what buttons in the toolbar are available for different editors of your site. Maybe you only want some of them have the Source Button. Maybe different colors should be available. Maybe files should be uploaded to user specific folders. Who knows! It’s up to you.



## Editor

The settings in the Editor category allow you to customize functionality related to the editing experience.

#### Air-Mode (+tv)  


When enabled, Redactor will hide the regular toolbar and instead show a smaller toolbar when you select text inside the edit panel. To change the available buttons with Air-Mode enabled, see the `airButtons` configuration option.



**Default**: no  

#### Additional Shortcuts   


This setting add your custom shortcuts to Redactor. [More info](http://imperavi.com/redactor/docs/settings/#set-shortcutsAdd).



**Default**: =  

#### Autoresize (+tv)  


When enabled, the editor will automatically grow as big as needed to show all the text without having to scroll inside the frame.



**Default**: yes  

#### Anchor Links (+tv)  


When enabled, the _insert link_ modal will include a tab for inserting anchor links.



**Default**: no  

#### Email Links (+tv)  


When enabled, the _insert link_ modal will include a tab for inserting `mailto:` links.



**Default**: no  

#### Min Height (+tv)  


Used together with the `Autoresize` option, the Min Height configuration lets you set either a minimum (when autoresize is enabled) or fixed (when autoresize is disabled) height for the text area. The height is in pixels and only needs the integer numbers added in the setting.



**Default**: 200  

#### Modal Overlay   


When enabled, an overlay will prevent clicking other things when Redactor opens a modal window (for links, uploads etc.)



**Default**: yes  

#### Placeholder   


When not 0, this lets you set a placeholder text for the editor if no content is available for the editor yet.



**Default**: 0  

#### Predefined Links (+tv)  


**Added in 1.5.0**  
This setting allows you to add a list of predefined links in "Add link" modal. [More info](https://www.modmore.com/extras/redactor/documentation/creating-predefined-links/).





#### Shortcuts   


When enabled, you can use the following shortcuts when editing with Redactor:

- **ctrl + z** Undo typing/action
- **ctrl + shift + z** Redo typing/action
- **ctrl + m** Remove formatting
- **ctrl + b** Bold text
- **ctrl + i** Italicize text
- **ctrl + j** Insert unordered list
- **ctrl + k** Insert ordered list
- **ctrl + h** Superscript
- **ctrl + l** Subscript
- **tab** Indent text
- **shift + tab** Outdent text

Of course the MODX shortcuts like **ctrl + s** to save still work when using Redactor.





#### Tab Index   


The tab index order of the text editing field.



**Default**: 0 (disabled)  

#### Visual   


When this setting is enabled, the editor starts in visual mode (with the toolbar and all that goodness), but when it is disabled the code (HTML) view is the default. Very useful as a user setting!



**Default**: yes  

#### WYM (Visual Structure) (+tv)  


WYM ("What you mean", aka Visual Structure) mode is a special mode in which through the use of background colors and indentation, the markup structure is made visible. If you want to train your editors to make clean markup, this is a great option to enable. [View an example.](http://imperavi.com/redactor/examples/wym/)



**Default**: no  

#### Link Resource   


**Added in 1.1.0**  
When enabled, a Resource Tab will appear in the insert link modal window



**Default**: yes  

#### Observe Links   


**Added in 1.3.0**  
When enabled, follow/edit links by putting cursor to the link right in Redactor.



**Default**: no  

#### Tidy HTML   


**Added in 1.3.0**  
Set to false to turn off nice output code formatting.



**Default**: yes  

#### Typewriter (+tv)  


**Added in 1.5.0**  
Stress-free typewriter mode. [More info](http://imperavi.com/redactor/examples/typewriter/).



**Default**: no  

## Internationalization

#### Direction (+tv)  


Sets the text direction, either `ltr` (left-to-right) or `rtl` (right-to-left).



**Default**: ltr  

#### Language (+tv)  


Sets the language for the editor itself. The following languages are included in the package:

- ar (Arabic)
- bg (Bulgarian)
- by (Belarusian Belarus)
- cs (Czech)
- da (Danish)
- de (German)
- en (English)
- es (Spanish)
- fi (Finnish)
- fr (French)
- he (Hebrew)
- id (Indonesian)
- it (Italian)
- ja (Japanese)
- nl (Dutch)
- no\_NB (Norwegian Bokm?l)
- pl (Polish)
- ru (Russian)
- sv (Swedish)
- ua (Ukrainian)
- zh\_cn (Chinese)
- az (Azerbaijani)
- ba (Bosnian)
- ca (Catalan)
- el (Greek)
- eo (Esperanto)
- es\_ar (Argentinian Spanish)
- fa (Persian)
- ge (Georgian)
- hr (Croatian)
- hu (Hungarian)
- ko (Korean)
- lt (Lithuanian)
- lv (Latvian)
- mk (Macedonian)
- pt\_br (Brazilian Portuguese)
- pt\_pt (Portuguese)
- ro (Romanian)
- sk (Slovak)
- sl (Slovenian)
- sq (Albanian)
- sr-cir (Serbian (Cyrillic))
- sr-lat (Serbian (Latin))
- th (Thai)
- tr (Turkish)
- vi (Vietnamese)
- zh\_tw (Chinese Traditional)

Additional languages are [available from the Imperavi website](http://imperavi.com/redactor/docs/languages/) and can be uploaded to the `assets/components/redactor/lang/` directory.



**Default**: Manager language  

#### Tab Spaces   


**Added in 1.3.0**  
When enabled, uses spaces instead of tabs for Chinese language.



**Default**: no  

## Markup

Using the markup settings, you can optimize and tweak the outputted markup from Redactor.


#### Allowed Tags (+tv)  


Either use the Allowed Tags setting, or the Denied Tags setting - not both! When using the Allowed Tags setting, you can whitelist accepted tags in the content - others will be stripped.





#### Bold Tag   


The HTML tag to use for bold pieces of content. Either `b` or `strong`.



**Default**: strong  

#### Cleanup (+tv)  


When enabled, any time text is pasted into the editor it will be parsed and cleaned up to only leave the important markup.



**Default**: yes  

#### Clean Spaces (+tv)  


**Added in 1.5.0**  
Removes extra space in pasted text when set to yes. Leaves extra spaces when set to no.



**Default**: no  

#### Convert Divs (+tv)  


With Convert Divs enabled, Redactor will automatically replace `
` tags with `<p>` tags.



Default: yes




#### Convert Links (+tv)



When Convert Links is enabled, Redactor will automatically parse links in the content, and add the proper `` tags into the markup.



Default: yes




#### Denied Tags 



Either use the Allowed Tags setting, or the Denied Tags setting - not both! When using the Denied Tags setting, you can blacklist tags that are not allowed in the markup.



Default: html,head,link,body,meta,script,style,applet




#### Formatting in Pre 



When this setting is enabled, you can use formatting options (like bold, italics etc) within `` tags.



Default: no




#### Italic Tag 



The HTML tag to use for italic pieces of content. Either `i` or `em`.



Default: em




#### Linebreaks 



When enabled, line breaks will be processed as `

` tags instead of new paragraphs. Note that enabling linebreaks mode will automatically disable `Paragraphy` mode.



Default: no




#### Float Left Margin 



When positioning images as left or right, Redactor lets you put in a _CSS class_ or _margins_ to prevent the image from colliding with the text floating around it. You can define the margin or CSS class for the left align with this setting. Either provide the margin like the value part of a CSS declaration: `0 10px 10px 0` or provide a class name prefixed with a dot: `.imageFloatLeftInContent`. If you want multiple classname, only prefix the first with a dot.



Default: 0 10px 10px 0




#### Float Right Margin 



When positioning images as left or right, Redactor lets you put in a _CSS class_ or _margins_ to prevent the image from colliding with the text floating around it. You can define the margin or CSS class for the right align with this setting. Either provide the margin like the value part of a CSS declaration: `0 0 10px 10px` or provide a class name prefixed with a dot: `.imageFloatRightInContent`. If you want multiple classname, only prefix the first with a dot.



Default: 0 0 10px 10px




#### Paragraphy 



When enabled, all stuff will be put inside `
` tags (paragraphs). Note that if you enable the `Linebreaks` setting, the paragraphy mode will be disabled.





Default: yes



## Advanced


Stuff that you probably wont be editing unless you know what you're doing.


#### Adv Attributes (+tv)



**Added in 1.4.0**  
Adds class and id fields to link and image edit windows.  
**As of 1.5.0** adds a title field as well.








#### Additional Plugins 



**Added in 1.2** Specify a comma separated list of "name:file" pairs to add additional Redactor plugins to the editor. This can be [a custom plugin](http://imperavi.com/redactor/docs/creatingplugins/), or one of the [available plugins for Redactor](http://imperavi.com/redactor/plugins/). (Note: do not use Clips as we have already included it)   
Example: `fontfamily:/path/to/fontfamily.js, otherplugin:/path/to/otherplugin.js`   
To load the fontcolor plugin (included in the package): `fontcolor:/assets/components/redactor/lib/fontcolor.js`









#### Stylesheet 



Formerly Iframe CSS, this Setting was renamed in 1.2.3. Put in a full URL to a CSS file to use your own styling for formatting. Prior to 1.2.3 this only has effect if `Iframe` is enabled. (This is what TinyMCE calls the "Editor CSS".)








#### Iframe 



When enabled, the editor will be placed inside an iframe. Prior to 1.2.3, this allows you to use the `Stylesheet` setting to use your own CSS for the editor, though as of 1.2.3 that setting also works without iframe mode. As of 1.2.0 using iframe mode will insert a `



Default: no




#### Protocol (+tv)



The protocol (`http://`, `https://` or leave empty) to build links with.








#### Link No Follow (+tv)



**Added in 1.4.0**  
Adds nofollow attribute to the links added via Redactor.








#### Mobile (+tv)



When enabled and the user visits on an identified phone or tablet (using barebones UA sniffing), Redactor will provide a simplified version of the editor in the form of a regular textarea instead of contenteditable fields.



Default: yes




#### Observe Images 



When enabled, clicking an image in the edit area will open up a model window letting users change the alignment and add alt/title attributes.



Default: yes




#### Clean Files Names 



**Added in 1.1.0**  
When enabled, special characters will be removed from files on upload.



Default: yes



## Media


Controls various options as to how media is handled by Redactor. Check out the Media Source tutorial too.


#### Browse Recursive 



When enabled the image browser will recursively show subfolders of the image\_upload\_path in the media source. You may want to disable this if you have a large number of subfolders that are not used for browsing.



Default: yes




#### Date Files 



Enable this setting to have file uploads prefixed with a full timestamp to make sure file uploads are unique.



Default: no




#### Date Images 



Enable this setting to have image uploads prefixed with a full timestamp to make sure image uploads are unique.



Default: no




#### File Upload Path (+tv)



The path, relative to the root of the media source as defined by the `Media Source` setting, in which file uploads should be placed. You can use the following placeholders (no output filters, please):

- `` numeric representation (4 digits) of the current year: _2016_
- `` numeric representation (2 digits) of the current month with leading zero: _11_
- `` numeric representation (2 digits) of the current day in the month: _01_
- `` the ID of the currently logged in user.
- `` the username of the currently logged in user.
- `` if available, the ID of the current resource. **Added in 1.2.7**
- `` if available, the pagetitle of the current resource. **Added in 1.4.0**
- `` if available, the alias of the current resource. **Added in 1.4.0**
- `` if available, the context\_key of the current resource. **Added in 1.4.0**
- `https://www.modmore.com/` Your MODX site\_url. **Added in 1.5.0**
- `/assets/` Your MODX assets\_url. **Added in 1.5.0**

Also see `Image Upload Path`, `Media Source` and [Using Media Sources with Redactor](https://www.modmore.com/extras/redactor/documentation/media-sources/)



Default: assets/uploads/




#### Image Upload Path (+tv)



The path, relative to the root of the media source as defined by the `Media Source` setting, in which image uploads should be placed. You can use the following placeholders (no output filters, please):

- `` numeric representation (4 digits) of the current year: _2016_
- `` numeric representation (2 digits) of the current month with leading zero: _11_
- `` numeric representation (2 digits) of the current day in the month: _01_
- `` the ID of the currently logged in user.
- `` the username of the currently logged in user.
- `` if available, the ID of the current resource. **Added in 1.2.7**
- `` if available, the pagetitle of the current resource. **Added in 1.4.0**
- `` if available, the alias of the current resource. **Added in 1.4.0**
- `` if available, the context\_key of the current resource. **Added in 1.4.0**
- `https://www.modmore.com/` Your MODX site\_url. **Added in 1.5.0**
- `/assets/` Your MODX assets\_url. **Added in 1.5.0**

Also see `File Upload Path`, `Media Source` and [Using Media Sources with Redactor](https://www.modmore.com/extras/redactor/documentation/media-sources/)



Default: assets/uploads/




#### Image Browse Path 



**Added in 1.1.0**  
The path to browse when choosing images, relative to the root of the media source as defined by the `Media Source` setting, in which images should be browsed through the choose image modal window.



Default: assets/uploads/




#### Image Tab Link (+tv)



**Added in 1.5.0**  
With this option you can enable/disabled a tab with insert image as link.



Default: true




#### Search Images 



**Added in 1.1.2**  
When enabled, a search bar can be used to filter images in the choose image modal window.



Default: no




#### Dynamic Thumbs 



**Added in 1.1.0**  
When enabled, thumbnails will be generated using PhpThumb for previewing images. Sometimes disabling this setting can result in a better performance as there's no additional processing required for each image.



Default: yes




#### Display Image Names 



**Added in 1.1.0**  
When enabled, file names will be displayed when browsing for images.



Default: yes




#### File Browse Path 



**Added in 1.1.0**  
The path to browse when choosing images, relative to the root of the media source as defined by the `Media Source` setting, in which files should be available through the insert file modal window.



Default: yes




#### Browse Files 



**Added in 1.1.0**  
When enabled, allows uploaded files to be selected.



Default: yes




#### Media Source (+tv)



Choose (or provide the ID of) a Media Source to use for uploading and browsing images and files. This can be any type of Media Source that implements uploading and browsing of images.

Also see `File Upload Path`, `Image Upload Path` and [Using Media Sources with Redactor](https://www.modmore.com/extras/redactor/documentation/media-sources/)



Default: 1 (Filesystem)



## Resource Typeahead


Options for the Resource Typehead which is available when you insert a link into the content.


#### Prefetch TTL 



Used in the Resource search typeahead, the prefetch contains the top level resources that are published and not deleted. This data is preloaded when the typeahead field is instantiated, providing very quick access to important resources that may be requested, however the typeahead will continue to search further down the resource tree when the users start typing. The prefetch TTL is how long (in microseconds) the prefetch data should be considered valid and stored in the users' LocalStorage.



Default: 3600000 (1 hour)




#### Include Introtext 



When enabled, the typeahead will include the introtext for each of the resources, providing you with more information about the resource.



Default: yes



Toolbar


All sorts of options for the Toolbar.


#### Button Full Screen (+tv)



**Added in 1.1.0**  
When enabled, a fullscreen button will be located in the right of the toolbar.



Default: yes



#### Air Buttons (+tv)



The buttons, separated by commas, that should be used in the toolbar which is visible when Air Mode is enabled and text is selected. See `Buttons` for the options. Use a `|` (pipe) to add a separator.

Defaults to: `formatting, |, bold, italic, deleted, |, unorderedlist, orderedlist, outdent, indent, |, fontcolor, backcolor`









#### Source Button (+tv)



When disabled, the source button (`html` in the buttons configuration) will be removed.



Default: yes




#### Buttons (+tv)



The buttons that appear in the Redactor toolbar. Note that when using `Air Mode` you should configure `Air Buttons` instead. Use a `|` (pipe) to add a separator.

Defaults to:     html, |, formatting, |, bold, italic,
    deleted, |, unorderedlist, orderedlist, outdent,
    indent, |, image, video, file, table, link, |, 
    alignment, |, horizontalrule

Additional buttons that are available:         underline, alignleft, aligncenter, alignright, justify










#### Commemorate Rebecca 



**Added in 1.5.0**  
Paints Redactor's toolbar [Rebecca Meyer's](http://www.zeldman.com/2014/06/10/the-color-purple/) **favorite color** the seventh of each June.



Default: no





#### Clips JSON (+tv)



**Added in 1.2.0**  
If set and a valid JSON String, adds the Redactor Clips plugin to the toolbar.  

Clips adds a drop-down list of pre-defined "clips" (or "snips") that you can create to save time, such as intro or footer text.  

Use JSON in the format below to manage your clips.
  
```
[{"title":"$ Dollar Sign","clip":"$"},
{"title":"€ Euro Sign","clip":"€"},
{"title":"¢ Cent Sign","clip":"¢"},
{"title":"£ Pound Sign","clip":"£"},
{"title":"¤ Currency Sign","clip":"¤"},
{"title":"¥ Yen Sign","clip":"¥"},
{"title":"ƒ Florin Sign","clip":"ƒ"}]
```


#### Formatting Tags (+tv)

The options you get when clicking the `formatting` button in the Redactor toolbar.

Defaults to: `p, blockquote, pre, h1, h2, h3, h4` which are the only currently supported formatting tags.

#### Hidden Mobile Buttons (+tv)



**Added in 1.5.0**  
With this option, you can specify which buttons of the toolbar can be hidden on mobile devices.









#### Styles JSON (+tv)



**Added in 1.2.0**  
If set and a valid JSON String, adds the Redactor Styles plugin to the toolbar.  

Styles adds custom formatting capability. Each custom format must have a name and at least one of the following: - `className` CSS Class applied to the dropdown option under the Styles button.
- `wrap` HTML tag to wrap the formatted text with.
- `spanClass` CSS class to be applied to the foramtted text.


Use JSON in the format below to manage your custom formats:  

```
[{"btnName":"Note",
"className":"redactor_format_note",
"wrap":"div",
"spanClass":"note"},
{"btnName":"Warning",
"className":"redactor_format_warning",
"wrap":"p",
"spanClass":"warning"}]
```








#### Toolbar Overflow (+tv)



**Added in 1.5.0**  
With this option, you can specify a toolbar button to build only one row on mobile devices.



Default: no





#### Toolbar Fixed (+tv)



**Added in 1.5.0**  
If this option is turned on, Redactor's toolbar will remain at the top of the browser\\'s window at all times. To disable you may need to set redactor.toolbarFixedBox to No.



Default: yes





#### Toolbar Fixed Box (+tv)



**Added in 1.5.0**  
This option makes a fixed toolbar to the width of the editor.



Default: yes
