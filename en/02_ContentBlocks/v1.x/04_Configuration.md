---
title: Configuration
---

Most configuration for ContentBlocks is done through the Component (through the [fields](Fields), [layouts](Layouts) and [templates](Templates) that makes available), however there are also a number of System Settings available that can be used to change the way ContentBlocks works.

All of these settings are created automatically when installing ContentBlocks. They can also be added manually to Users, User Groups or Contexts to override their values for specific users or contexts. To do that, add a new setting with the mentioned key (including the `contentblocks.` prefix!) and the desired value.

[TOC]

## Core

### Accepted Resource Types (`contentblocks.accepted_resource_types`) 

Comma separated list of the resource types ContentBlocks should be enabled on. There are built in resource types in MODX like modDocument, but other extras may also provide them in a way that ContentBlocks can support. This includes for example MoreGallery, [Collections](http://modx.com/extras/package/collections), [GoodNews](http://www.bitego.com/extras/goodnews) and [SimpleCart](https://modmore.com/simplecart/).

For instructions about using ContentBlocks on custom resource types, please visit the [Custom Resources](Custom_Resources) documentation.

**Default:** `modDocument, mgResource, Article, CollectionContainer, GridContainer, GoodNewsResourceContainer, GoodNewsResourceMailing, scCategoryResource, scProductResource`

### Clear Cache after Rebuild (`contentblocks.clear_cache_after_rebuild`) 

When Rebuilding Content via the ContentBlocks component, you may find that the content of a number of resources are changed due to changes in your fields or layouts. These changes wont be reflected in the frontend of your website until the cache is cleared, which ContentBlocks will do for you automatically if this setting is enabled.

**Default:** `True`

### Custom Icon Path (`contentblocks.custom_icon_path`) 

If you'd like to use custom icons ([see the default set here](https://modmore.com/contentblocks/custom-inputs/icons/)), you can set the (server) path here. The {assets\_path} placeholder will be replaced with the full path to your assets directory. Also make sure to set the Custom Icon URL to match the path provided here.

### Custom Icon URL (`contentblocks.custom_icon_url`) 

Used alongside the Custom Icon Path setting, this setting should contain the (web accessible) url to the custom icons directory you would like to use.

### Debug (`contentblocks.debug`) 

When enabled ContentBlocks will load unminified assets to help debug issues. Typically you wont have to use this, unless you're experience a javascript or css related bug. In which case please let us know via support@modmore.com.

### Disabled (`contentblocks.disabled`) 

When this setting is turned on, ContentBlocks will no longer be used. This setting in particular is useful to only selectively enable ContentBlocks per context, as you can disable ContentBlocks globally through this system setting, and then enable it on a specific context by adding a context setting with the same key.

**Default:** `0 (false)` (means ContentBlocks is enabled)

#### Enable/Disable by template

**To enable or disable ContentBlocks by template**, you previously needed to create a custom plugin to override the per-resource `contentblocks._isContentBlocks` flag in the properties. That's a flexible approach that will still work, and also allows you to go beyond simple template conditionals if needed. 

As of ContentBlocks v1.10, you can also configure this through the template properties. 

1. First decide if you want to _whitelist_ templates (in which case you disable ContentBlocks globally, and then enable it per-template), or _blacklist_ them (in which you enable ContentBlocks globally, but disable specific templates). Set the `contentblocks.disabled` system (or context) setting accordingly.   
2. Edit the template you want to enable/disable. Navigate to the Properties tab.
3. Unlock the default properties by clicking the "Default Properties Locked" button in the grid. (While for snippets and plugins you would typically create a custom property set, that's not currently possible for templates.)
4. Create a new property with key `contentblocks.disabled` - please make sure to check your spelling. Set the value to 1 if you want to allow ContentBlocks on this template, set the value to 0 (or an empty string) to disallow it. 
5. Repeat for other templates you are whitelisting/blacklisting.

This way of enabling/disabling ContentBlocks takes priority over the per-resource flag. Just like context-level restrictions, if ContentBlocks is disabled, it will not show up at all on the resource.

[All ways of enabling or disabling ContentBlocks are summarised here.](https://support.modmore.com/article/71-can-i-enable-disable-contentblocks-system-wide-per-context-per-resource-or-based-on-other-factors)

### Hide Logo (`contentblocks.hide_logo`) 

There's a subtle modmore logo included in the ContentBlocks Component (bottom right) with a link back to the ContentBlocks section of the site. If you don't want that, you can enable this setting and all is well.

**Default:** `0 (false)`

### Implode String (`contentblocks.implode_string`) 

ContentBlocks glues together individual field and layout instances with the value in this setting. It's set to a \\n line break by default, but if you're using ContentBlocks to generate something that isn't HTML (which we haven't done yet, but would be a really cool experiment!) you might need to change this to a different value and rebuild the content.

**Default:** `line break (\n)`

### Include Introtext in Typeahead (`contentblocks.typeahead.include_introtext`) 

The resource typeahead used in the [Link input type](Input_Types/Link) and setting type will search through resources for you. If this setting is enabled, it wil also show the introtext for a resource if it has one.

**Default:** `1 (true)`

---

## Defaults

The setting in the Defaults area are used as a fallback if no [Default Templates](Default_Templates) are specified or can be applied to the current (new) resource.

### Default Field (`contentblocks.default_field`) 

The ID of a Field to insert into the layout defined by the Default Layout setting. This field will be provided any content that may have already existed prior to ContentBlocks was installed, so typically this would be configured to either a Rich Text, Textarea or Code field.

If set to 0 or to a non-existent ID, ContentBlocks will use a fake rich text field to ensure content is not lost, but you should make sure to place that in a different field to ensure you can control the template and such.

 0 ### Default Layout (`contentblocks.default_layout`) 

The ID of a fallback layout if no Default Templates are applicable. If this is not a valid layout, your content canvas may be partially broken.

**Default:** `1`

### Default Column (`contentblocks.default_layout_part`) 

The key (reference) of a column inside the layout defined by the default\_layout setting. The field defined by the default\_field setting will be inserted into this column.

**Default:** `main`

---

## Input: Code

### Code Theme (`contentblocks.code.theme`) 

The Ace theme to use for the code input. [See the full list of available themes here](https://github.com/ajaxorg/ace/tree/master/lib/ace/theme), and use the [Ace Kitchen Sink](https://ace.c9.io/build/kitchen-sink.html) to preview them.

**Default:** `chrome`

---

## Input: Image

Most of the settings related to image uploads will also have an effect on the gallery and file input types. Also check the field properties for possibilities to override these values per field instance.

### Base URL Mode (`contentblocks.base_url_mode`)

ContentBlocks will treat image URLs differently based on the value of this setting. In most cases the default value, `relative` is what you need as it makes image URLs in the front-end relative to your site's `<base>` tag. 

Here are the different modes, the examples assume that your site's base_url is `/modx/` on the domain `site.dev`.

- `relative`: the output url is set to `assets/foo/bar.png`, making it relative from your site's `<base>` tag if set. This is the most portable option, and the default.
- `absolute`: the output url is set to `/modx/assets/foo/bar.png`, making it suitable if your site does not use a base tag. But this does mean you'll need to edit and save your resource again (rebuild content does not work) if you ever need to move the site to a different directory. 
- `full`: the output url is set to `http://site.dev/modx/assets/foo/bar.png`. Not portable at all.

**Default:** `relative`

### Hash Name (`contentblocks.image.hash_name`) 

When enabled, uploaded image file names will be hashed so the original name is obfuscated.

**Default:** `0 (false)`

### Prefix Time (`contentblocks.image.prefix_time`) 

If enabled each uploaded image will be prefixed with the unix timestamp for the upload time. This could be used to ensure file names are unique, however ContentBlocks also automatically makes sure filenames are unique if you use a local file media source by checking what files exist, and adding \_1, \_2, \_3 etc to the end of the file name until it was new.

**Default:** `9 (false)`

### Sanitize (`contentblocks.image.sanitize`) 

When enabled (**highly encouraged**), uploaded file names will be sanitised before they are uploaded. This makes sure that there are no special characters in the image file name. See the Sanitize area for more relevant settings to control how things are uploaded.

As of ContentBlocks 1.3.0-rc6, you can also use ContentBlocks side by side with extras like FileSluggy that further sanitise the file names. Prior to that release they could cause conflicts where uploads wouldn't work.

**Default:** `1 (true)`

### Source (`contentblocks.image.source`) 

The default media source to use for image uploads and browsing. This can be overridden per field instance.

**Default:** `1 (Filesystem)`

### Upload Path (`contentblocks.image.upload_path`) 

The default upload path for images. This path is relative to the base url and path set in the used media source.

The upload path can contain a number of different placeholders (in the format `[[+value`), including:

- `[[+year]]`: the current year (date() format Y)
- `[[+month]]`: the current month (date() format m)
- `[[+day]]`: the current day of the month (date() format d)
- `[[+user]]`: the ID of the currently logged in user
- `[[+username]]`: the username of the currently logged in user
- `[[++assets_url]]`: the full assets url for the current context (1.3+) or MODX installation (<1.3)
- `[[++site_url]]`: the full site url for the current context (1.3+) or MODX installation (<1.3)
- `[[++base_url]]`: the base url for the current context (1.3+) or MODX installation (<1.3)
- `[[+resource]]`: the ID of the current resource
- `[[+ultimate_parent_alias]]`: the alias of the top-level resource parent. Empty if the resource is in the root.
- `[[+ultimate_parent]]`: the ID of the top-level resource parent.
- `[[+parent_alias]]`: the alias of the resource parent. Empty if the resource is in the root.

You can also use any resource fields (such as `[[+pagetitle]]`, `[[+alias]]` and `[[+description]]`), as well as TV values by prefixing the TV name with `tv.`, for example `[[+tv.my_awesome_tv]]`.

**Default:** `assets/uploads/`

--- 

## Input: Link

### Link Detection Pattern (`contentblocks.link.link_detection_pattern`) 

The regex pattern used to identify is a link is a valid web location. If the link does not match this pattern, it will be prefixed with `http://` automatically.

An alternative pattern that also accepts MODX setting tags, `mailto:` and relative anchor links is `^((?:tel:|https?:|mailto:|\#|\[\[\+\+.*\]\]).*?)$`

**Default:** `^(?:f|ht)tps?:\/\/`

---

## Sanitize

### Sanitize Pattern (`contentblocks.sanitize_pattern`) 

The regex pattern used to identify valid characters in uploaded file names.

**Default:** `/([[:alnum:]_\.-]*)/`

### Sanitize Replacement (`contentblocks.sanitize_replace`) 

The string to use in replacing invalid characters, as identified with the Sanitize Pattern setting.

**Default:** `-`

### Transliteration (`contentblocks.translit`) 

Transliteration is the process of replacing certain complex characters into different simple characters. For example the German `ß` can be transliterated into `ss`. Valid values include "none", "iconv" and the name of third party provided transliteration classes. For example when installing the [translit](http://modx.com/extras/package/translit) package from MODX.com, you can use "noaccents", "german" and "russian".

When this setting is left empty, it will load its value from the `friendly_alias_translit` system setting.

### Translit Class (`contentblocks.translit_class`) 

The name of the class to use for transliteration. When left empty, this will get its value from the `friendly_alias_translit_class` system setting.

### Translit Class Path (`contentblocks.translit_class_path`) 

The path to the transliteration class. When let empty, this will get its value from the `friendly_alias_translit_class_path` system setting.
