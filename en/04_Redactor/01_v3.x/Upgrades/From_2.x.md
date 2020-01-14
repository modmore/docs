---
title: Upgrading from Redactor 2.x
---

When upgrading from 2.x, expect a new and refreshed editor. Many features will be familiar, but some have also been removed or operate differently now. And of course, there's a lot of new features for you to use as well.

## First Upgrade

During the first upgrade to Redactor 3, your v2 system settings will automatically be converted into a [configuration set](../Configuration_Sets) named "Imported from Redactor 2". 

This imported set will be as close as a match to your old configuration as possible, but keep in mind not every old setting has a new option. 

**Your imported set is not automatically enabled.** Navigate to Extras > Redactor Configuration to find it. Open it and make sure it was properly imported and works the way you expect it to. 

When all looks good, you can enable it from either the configuration sets grid (right click it in the list) or [the system settings](../Usage/Content).

**Important:** downgrading from 3 to 2 is **not supported**. If you're not sure yet if you want to start using Redactor 3 right away, start by upgrading on a development site and only upgrade production when you're happy. 

Old system settings from v2, with a few exceptions, are removed on the first upgrade to v3.

## Tip: start fresh

While the automatic import is useful, we do recommend configuring Redactor 3 from scratch. Take a good tour of the new configuration sets to find out what Redactor 3 can do and use this as an opportunity to refresh your configuration.

[The Redactor 3 Quickstart](../Quickstart) takes you through the highlights.

## Dropped or changed features

Please note this list may be incomplete

- Allowed/denied tags and cleanup in general works differently now. See the Cleanup tab for details of what you can configure in v3.
- The image float margin from v2 has changed. Previously you would set a margin for left and right floats separately, in v3 you set a single margin (in the Media tab) which will automatically be applied to the right side of the image.
- Source code highlighting with Ace is no longer supported. Only Codemirror is now available (enabled by default).
- The syntax for some plugins (like Clips) has changed. In most cases these will be automatically converted by the configurator. See the configurator for details.
- Changing the available colors for the fontcolor plugin is no longer supported.

The following custom plugins are no longer supported. Let us know if you think we should rebuild them for v3.

- replacer (find & replace window)
- speek (read content out loud)
- contrast
- zoom
- imagepx
- imageurl
- breadcrumb
