MoreGallery comes with a couple of options for uploading or importing images into the gallery. This page explains them, and their main differences.

[TOC]

## Upload Button

Most users will be uploading images. This is possible with the Upload button which will open the users' file browser to select images. Multiples can be selected with the <kbd>ctrl</kbd>/<kbd>cmd</kbd> or <kbd>shift</kbd> keys. 

The upload function requires `moregallery_upload` [permission](Permissions).

## Drag & Drop Upload

MoreGallery is also drag-and-drop upload enabled. Simply drag files from your computer into the gallery panel, and they will be uploaded. Also requires `moregallery_upload` permission.

## Import

The _Import_ button will open the standard MODX File Browser. This will let you select an existing file to add to the gallery. The image will be copied to the gallery folder. 

Note that it's not possible at the moment to select more than one file at the same time. 

The import function requires `moregallery_import` [permission](Permissions).

## Import from Media

Added in 1.6, with the _Import from Media_ button you can use Sterc's Media Manager to select an image. The media manager needs to be installed for the button to be available. 

With the media manager integration, the image is not moved, but is kept in its original place. Additional placeholders are also available in the front-end templates. 

The import from Media Manager function requires `moregallery_import_media` [permission](Permissions).

## Add Video

With _Add Video_ you can paste in a link to a YouTube or Vimeo video, and it will be loaded into the gallery. The video thumbnail is automatically loaded, which can be used with the [cropping](Cropping) feature. [More information about the video feature can be found here.](Video)

The video function requires `moregallery_video` [permission](Permissions).