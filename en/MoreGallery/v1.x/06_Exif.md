---
title: Dealing with EXIF Data
---

Whenever an image is uploaded or imported, MoreGallery extracts the [EXIF data](https://en.wikipedia.org/wiki/Exchangeable_image_file_format) and stores it in the image `exif` field. 

Exif data typically includes information about the device or software that created an image, but may also contain geographic, orientation and other technical information.

MoreGallery parses this data to ensure it only contains valid UTF-8 characters (so no binary or hidden characters), and provides the information in a single dimensional array. 

As EXIF is fairly loosely defined, there is no guarantee a certain field is available, so using this data should be done carefully.

[TOC]

## Identifying available data

Since MoreGallery 1.4, we provide two new placeholders, `[[+exif_dump]]` and `[[+exif_json]]`, that allow you to inspect all available exif data for an image. 

This allows you to add the following to your mgGetImages chunk to see what data the image exposes.

```` html   
<pre>[[+exif_dump]]</pre>
````   

The result of that for a photo created by a digital camera might be something like this:


```` html   
Array
(
    [FileName] => OriginalNameOfMyFile.jpg
    [FileDateTime] => 1436869879
    [FileSize] => 316081
    [FileType] => 2
    [MimeType] => image/jpeg
    [SectionsFound] => ANY_TAG, IFD0, THUMBNAIL, EXIF
    [COMPUTED] => Array
        (
            [html] => width="906" height="604"
            [Height] => 604
            [Width] => 906
            [IsColor] => 1
            [ByteOrderMotorola] => 0
            [ApertureFNumber] => f/2.8
            [Copyright] => mywebsite.com
            [Thumbnail.FileType] => 2
            [Thumbnail.MimeType] => image/jpeg
        )

    [Make] => Canon
    [Model] => Canon EOS 5D Mark III
    [XResolution] => 240/1
    [YResolution] => 240/1
    [ResolutionUnit] => 2
    [Software] => Adobe Photoshop Lightroom 5.6 (Macintosh)
    [DateTime] => 2014:10:14 14:40:48
    [Copyright] => mywebsite.com
    [Exif_IFD_Pointer] => 246
    [THUMBNAIL] => Array
        (
            [Compression] => 6
            [XResolution] => 72/1
            [YResolution] => 72/1
            [ResolutionUnit] => 2
            [JPEGInterchangeFormat] => 904
            [JPEGInterchangeFormatLength] => 18562
        )

    [ExposureTime] => 1/250
    [FNumber] => 28/10
    [ExposureProgram] => 1
    [ISOSpeedRatings] => 100
    [UndefinedTag:0x8830] => 2
    [UndefinedTag:0x8832] => 100
    [ExifVersion] => 0230
    [DateTimeOriginal] => 2014:09:13 16:20:30
    [DateTimeDigitized] => 2014:09:13 16:20:30
    [ShutterSpeedValue] => 7965784/1000000
    [ApertureValue] => 2970854/1000000
    [ExposureBiasValue] => 0/1
    [MaxApertureValue] => 3/1
    [MeteringMode] => 5
    [Flash] => 16
    [FocalLength] => 120/1
    [SubSecTimeOriginal] => 29
    [SubSecTimeDigitized] => 29
    [ColorSpace] => 1
    [FocalPlaneXResolution] => 52428800/32768
    [FocalPlaneYResolution] => 52428800/32768
    [FocalPlaneResolutionUnit] => 3
    [CustomRendered] => 0
    [ExposureMode] => 1
    [WhiteBalance] => 0
    [SceneCaptureType] => 0
    [UndefinedTag:0xA431] => 023021008904
    [UndefinedTag:0xA432] => Array
        (
            [0] => 70/1
            [1] => 200/1
            [2] => 0/0
            [3] => 0/0
        )

    [UndefinedTag:0xA434] => EF70-200mm f/2.8L IS II USM
    [UndefinedTag:0xA435] => 0000c1625b
)
````

However, for an image created with PhotoShop, it might look like this:


```` html   
Array
(
    [FileName] => some-photoshopped-image.jpg
    [FileDateTime] => 1458598890
    [FileSize] => 1935184
    [FileType] => 2
    [MimeType] => image/jpeg
    [SectionsFound] => ANY_TAG, IFD0, THUMBNAIL, EXIF
    [COMPUTED] => Array
        (
            [html] => width="3359" height="2084"
            [Height] => 2084
            [Width] => 3359
            [IsColor] => 1
            [ByteOrderMotorola] => 1
            [Thumbnail.FileType] => 2
            [Thumbnail.MimeType] => image/jpeg
        )

    [Orientation] => 1
    [XResolution] => 720000/10000
    [YResolution] => 720000/10000
    [ResolutionUnit] => 2
    [Software] => Adobe Photoshop CS2 Windows
    [DateTime] => 2007:10:13 06:34:48
    [Exif_IFD_Pointer] => 164
    [THUMBNAIL] => Array
        (
            [Compression] => 6
            [XResolution] => 72/1
            [YResolution] => 72/1
            [ResolutionUnit] => 2
            [JPEGInterchangeFormat] => 302
            [JPEGInterchangeFormatLength] => 4292
        )

    [ColorSpace] => 1
    [ExifImageWidth] => 3359
    [ExifImageLength] => 2084
) 
````

It's also possible for an image to not have any exif data at all. Only JPEG or TIFF images support exif, and even those are not guaranteed to contain any. 

## EXIF data in your &imageTpl Chunks

Once you know you have exif data available, you can access it with the `exif.EXIF_KEY_HERE` placeholders. For example if you want to show the DateTime exif data, you could add the following to the chunk used for your imageTpl property:


```` html
[[+exif.DateTime:notempty=`<p>Photo taken on <b>[[+exif.DateTime]]</b>`]]
````

## Processing EXIF Data in a Snippet

If you'd like to do a bit more complex things with the EXIF data on an image, you can pass all the exif data to a snippet using the `exif_json` placeholder. This contains a JSON encoded object of all exif data, which is then easily decoded using `json_decode($data, true)`.
