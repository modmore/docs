---
title: Upgrading from Redactor 1.x to 2.0
---

Redactor 2.0 is a major release, which brings with it major changes. New features and improvements have been added, but some older features have also been removed or replaced. While we've tried to make the upgrade as seamless as possible, some breaking changes have been inevitable. This document discusses the removed or replaced features. For more information about all the new and improved features, please review the [2.0 announcement blog](https://modmore.com/blog/2015/announcing-redactor-2.0/).

Before upgrading to Redactor 2.0, we recommend making a backup of the Redactor files and your system settings database table, just in case you need to revert.

## Iframe mode has been removed

The iframe mode (`redactor.iframe`) has been completely removed. This feature was source of a lot of duplicated code and user experience woes, so Imperavi decided to remove this entirely.

There are generally two reasons someone might have been using iframe mode in Redactor:

1. As a simple means of scoping custom CSS to the Redactor instance. In this case, you will need to edit your CSS file and properly scope each definition to `.redactor_editor`. If your MODX manager looks freaky after the upgrade to 2.0, this is probably why.
2. As our recommendation for dealing with broken images after migrating from TinyMCE or other editors that are built inside an iframe by default. In this case, our new [magical base url feature](Images_and_Base_URLs) should kick in and no further action is required on your part.

## New Custom Formatting feature replaces Styles Plugin

When we first released Redactor for MODX, the Imperavi team hadn't made any custom formats feature available so JP developed the Custom Styles plugin. In Redactor v10 they added an alternative to the Redactor core. As the Custom Styles plugin could be buggy, we have removed it and are instead providing the ability to use the new built-in version.

During the upgrade from 1.5 to 2.0, any existing formats will be automatically moved to the new syntax, stored in the redactor.formattingAdd setting. The old `redactor.stylesJson` setting is also removed automatically.

Please read the [Custom Formats documentation](Custom_Formatting) for more information.

## Air Mode has been removed

Rarely used, and since its development this has been replaced with a sticky toolbar instead.

## A new Media Browser

In 2.0 there's a brand new media browser powered by [Eureka.js](https://github.com/jpdevries/eureka) for browsing files and images. This media browser allows the editor to more intuitively browse the filesystem and other media sources to choose an image to insert.

By default Eureka can only be used to browse existing files. To also enable uploading from the Browse tab, you can set the `redactor.eurekaUpload` system setting to true.

## Removed Settings

The following settings will be removed on upgrading to 2.0:

- air
- airButtons
- iframe
- formattingPre
- boldTag
- italicTag
- imageTabLink
- mobile
- observeImages
- observeLinks
- modalOverlay
- tidyHtml
- toolbarFixedBox
- browse\_recursive
- displayImageNames
- tabSpaces

For a list of settings in the current version of Redactor, see the [Configuration documentation](Configure_Redactor).