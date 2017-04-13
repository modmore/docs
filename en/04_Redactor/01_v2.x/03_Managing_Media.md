---
Title: Managing Media with Redactor
---

How your editors interact with media is up to you. Through Redactor's Configurations you can control where images and file are uploaded to, default browse and upload locations for images and files alike, and more. Images and Files can easily be assigned to separate Media Sources. You can also configure the behavior of Redactor's new "Eureka" Media Browser.

### Media Related Settings

These settings may be worth having a look at if you are interested in configuring media:

- [Browse Files](Configure_Redactor)
- [Date Files](Configure_Redactor)
- [Date Images](Configure_Redactor)
- [Dynamic Thumbs](Configure_Redactor)
- [Eureka Plugin](Configure_Redactor)
- [Eureka Plugin Shiv IE 9](Configure_Redactor)
- [Eureka Upload](Configure_Redactor)
- [File Browse Path](Configure_Redactor)
- [File Media Source](Configure_Redactor)
- [File Upload Path](Configure_Redactor)
- [Image Browse Path](Configure_Redactor)
- [Image Media Source](Configure_Redactor)
- [Image Upload Path](Configure_Redactor)
- [Max Directory Depth](Configure_Redactor)
- [Increment File Names](Configure_Redactor)

### Basic Uploading

Redactor 1.x offered basic uploading support. Users could set System Settings with dynamic tags that would determine where files should be uploaded to as well as browsed for. Redactor 2.x has the same options, but also adds the ability to add any resource field or template variable to the upload paths.

Additional uploading and browsing features are available via the Eureka Media Browser and [Uploadcare plugin](Uploadcare).

The [File Upload](Configure_Redactor) and [Image Upload](Configure_Redactor) Settings support the following placeholders:

- `[[+any resource field]], for example [[+id]], [[+pagetitle]], [[+alias]] and [[+parent]]`
- `[[+tv.any tv name]], for example [[+tv.my_tv]]`
- `[[+year]]`
- `[[+month]]`
- `[[+day]]`
- `[[+user]]`
- `[[+username]]`
- `[[+parent_alias]]`
- `[[+ultimate_parent]]`
- `[[+ultimate_parent_alias]]`

### Browsing

The [Browse Files](Configure_Redactor) and [Browse Images](Configure_Redactor) Settings are depreciated as they only effect the legacy browser. By default the Eureka Media Browser is used. To disable the Eureka Media Browser and instead use the legacy browse set [Eureka Plugin](Configure_Redactor) to No.

### Dynamic Thumbnails

By default Redactor will attempt to dynamically generate thumbnail previews of images. This feature can be slow or even broken on some environments. To disable it set [Dynamic Thumbs](Configure_Redactor) to No. If you're using remote media sources such as Amazon S3 or Rackspace Cloud Files, you will likely need to disable the `phpthumb_nohotlink_enabled` core system setting for images to show up.

### Eureka Media Browser

 ![Eureka Media Browse as seen in Redactor 2.0 for MODX](https://assets.modmore.com/uploads/2015/08/Screen%20Shot%202015-08-06%20at%203.59.10%20PM.png)

Redactor 2.0 introduces a new Media Browser powered by [Eureka](https://github.com/jpdevries/eureka#eureka). By default the Eureka Media Browser is just used for browsing, but it supports uploading as well. Set the [Eureka Upload](Configure_Redactor) Setting to Yes and users will be able to upload files and images to any directory.

Eureka will restore its previous state by opening up to the last browsed media source and directory. Therefore, the directory or media source it opens to may not always coincide with the [File Browse Path](Configure_Redactor) or [Image Browse Path](Configure_Redactor) Settings. Local Storage prefixes are keyed off the Resource ID and if applicable Template Variable ID of the associated Redactor instance. So, if you are return to edit Template Variable 3 within Resource 5 it will open up to same spot as the last time you edited _that_ template variable within _that_ resource.

Eureka supports several [keyboard shortcuts](Configure_Redactor) that you may want to take a look at. You can also have a look at Eureka's Accessibility Support in [this short video](https://vimeo.com/128895951) of using Eureka entirely with a keyboard and VoiceOver.

Eureka has to load some polyfills in order to support IE 9. If your users aren't concerned with IE 9 support you can set [Eureka Plugin Shiv IE 9](Configure_Redactor) to No.

### Uploadcare

 [ ![Uploadcare as seen in Redactor 2.0 for MODX](https://assets.modmore.com/uploads/2015/06/uploadcare.png)](https://assets.modmore.com/uploads/2015/06/uploadcare.png "Uploadcare as seen in Redactor 2.0 for MODX")

See our [Uploadcare Docs](Uploadcare) page to get started using Uploadcare, a third party service that makes dealing with images from all sorts of services easy.
