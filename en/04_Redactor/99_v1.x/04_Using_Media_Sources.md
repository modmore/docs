The page you're currently looking at contains information related to Redactor 1.x. Please visit [Managing Media](../v2.x/Managing_Media) for the relevant information for Redactor 2.x.

---





Redactor is fully Media Source enabled, which means that all of its handling of files (uploading and browsing images for example) is handled through the MODX Media Source API. This means that Redactor doesn't really care about where your files are stored - it could be on the local server, but it could also be on Amazon S3, Dropbox or whatever media source driver is used.

This brief tutorial will discuss how you can configure Redactor to use the right media source and paths.

### Create the Media Source

Out of the box, Redactor will use the Media Source with ID 1 - on a regular MODX installation this is a file system media source pointing to the root of your MODX site. Redactor will also use a subdirectory within that media source, as defined by the **redactor.image_upload_path** and **redactor.file_upload_path** settings. These default to `assets/uploads/`, which means that in a standard situation, Redactor will place images in `/assets/uploads/`, relative to the root of your website.

If you want to, you can create a separate media source all together (maybe making use of a CDN like Amazon S3 or CloudFront). [You can review how to create a new media source in the official MODX Documentation](http://rtfm.modx.com/display/revolution20/Adding+a+Media+Source).

### Point Redactor to the right Media Source

Now head over to System > System Settings. Choose "redactor" in the namespace dropdown (the one that defaults to "core") and find the **redactor.mediasource** setting under advanced. Double click its value and choose the right media source from the dropdown. (If you have installed an earlier beta version of Redactor, enter the media source ID here). Click elsewhere to trigger the save.

### Change the upload paths within the Media Source

Now that Redactor knows what media source to use, we can adjust where it puts the files. Still in System > System Settings > Redactor, find the **redactor.image_upload_path** and **redactor.file_upload_path**. These settings are relative to the root of the media source, so if you have your media source use a base url of "`/assets/`", you would set the \*_upload_path settings to "`uploads/`" to make sure that the images end up in "`/assets/uploads/`".

As the names indicate, you can configure a different path for images and files (attachments) if you so desire.

You can use certain placeholders in the image_upload_path and file_upload_path settings, such as `` and ``, to make sure uploads are automatically organised. For example `assets/uploads///` will automatically place images inside a folder with the context key and a folder with the year. Please review the [configuration](Configuration) for more information about available placeholders.

### Change the browse paths within the Media Source

If you want, you can also update the **redactor.image_browse_path** and **redactor.file_browse_path** system settings to a folder relative of your media source root. This is very useful when you include a date-based placeholder in the upload path settings, but you want to be able of browsing all of them when using the _Choose_ tabs in the insert link or insert image modal windows. This feature was added in Redactor 1.1.0.