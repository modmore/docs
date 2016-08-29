New in the Redactor 2 toolbar is the Uploadcare button. With it you can allow editors to use the [Uploadcare service](http://uploadcare.com) to insert images from over 9 different services such as Facebook, Google Drive, Dropbox, Instagram, and even your webcam!

 [ ![UploadCare in Redactor 2.0](https://assets.modmore.com/uploads/2015/06/uploadcare.png)](https://assets.modmore.com/uploads/2015/06/uploadcare.png "UploadCare in Redactor 2.0")

### Getting your API Key

To start using Uploadcare with Redactor you'll first need to obtain your public API Key. You can get that by [creating an Uploadcare account](https://uploadcare.com/). Once you've got your API key head to your System Settings page and set your `redactor.uploadcare_pub_key` Setting to your new key.

You can use Uploadcare for testing with the default `demopublickey` testing API key but files will be deleted after a few hours.

### Configuring your Tabs

By default Uploadcare will display all the available tabs. This includes Facebook, Google Drive, Dropbox, Instagram, Evernote, Flickr, OneDrive, Box, VK, uploading local files, importing from webcam, as well as inserting an image from any URL.

You can configure which tabs are displayed using your `redactor.uploadcare_tabs` System Setting. Set this to a space separated list of services to use in Uploadcare Upload Panel.

### Cropping

By default Uploadcare supports "free" cropping which enables the user to select an area of an image. Cropping can be configured by editing the redactor.uploadcare\_crop System Setting. This should be a strip with one or more crop presets. Presets are divided by commas. When more than one preset is defined, user can pick any of them on crop step. Each preset consists of a size definition and optional keyword.

- "disabled" — crop is disabled. Can't be combined with other presets;
- "" or "free" — crop enabled and the user will be able to select any area on an image;
- "2:3" — user will be able to select an area with aspect ratio 2:3;
- "300x200" — same as previous, but if the selected area is bigger than 300x200, it will be scaled down to these dimensions;
- "300x200 upscale" — same as previous, but the selected area will be scaled even if it is smaller than the specified size;
- "300x200 minimum" — user will not be able to select an area smaller than 300x200. If uploaded image is smaller than 300x200 itself, it will be upscaled.

## Localisation

UploadCare supports localisation via the `redactor.uploadcare_locale` System Setting. Like any MODX System Setting, this setting can be overridden on the user level.
