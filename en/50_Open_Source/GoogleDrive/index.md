---
title: Google Drive Media Source
---

_Special thanks to [Catch Media](https://catchmedia.no) for commissioning this extra._

This package includes a MODX Media Source implementation to provide access and standard file management features for Google Drive from within MODX.

The media source requires MODX 3.0+ and PHP 8.0+.

[TOC]

## Set-up

There are a few steps to get up and running with Google Drive.

### 1. Installation

First **install the transport package**, available from MODX.com or [from GitHub](https://github.com/modmore/GoogleDriveMediaSource/tree/main/_packages).

Go to Media > Media Sources and create a new media source, selecting Google Drive as the source type.

### 2. Credentials

[Follow these instructions to create a Client ID and Client Secret](https://github.com/ivanvermeyen/laravel-google-drive-demo/blob/master/README/1-getting-your-dlient-id-and-secret.md).

Set the **Authorized Redirect URIs** to the **full link to the edit media source page in your MODX Manager**, including the action and ID. For example: `https://yoursite.com/manager/?a=source/update&id=2`. You can add multiple allowed redirect URIs.

After that, return to the media source edit page and **expand the description for the `refreshToken` property to make the authorization button visible.

![Screenshot of the refresh token property](refresh-token.jpg)

Click the button and login with your Google account. Note that the Drive integration will inherit the users' permissions, so it may be important to choose who will authorize the integration wisely.

> If you receive the error "Access blocked: Google Drive Media Source’s request is invalid" with "Error 400: redirect_uri_mismatch", you've made a mistake in setting up the redirect URI in the Google Console. Expand the error message details to see the exact redirect URI that was attempted, and copy/paste that into the Google Console.

After returning from Google, the refreshToken will be filled for you.

### 3. Configuration

Now you can choose the **root** for the media source.

The root can be:

- The root of your (user) Drive by selecting the first option, `- root -`.
- A specific folder in the root of your Drive, and its subfolders. It's not possible to select a directory that is NOT itself in the root as root for the media source.
- A Shared Drive, previously known as Team Drive.
- A shortcut located in the root of the user's drive, pointing to a folder elsewhere.

Simply select the desired root in the list, save again.

You can also set the **maxItemsPerLevel** option. This can be set to a value up to 1000 to indicate the maximum number of files or directories to appear on a specific level. The default, 250, is a reasonable trade-off between performance and usability.

### 4. Friendlier URLs

The **urlPattern** lets you configure a friendly URL to the files. All files in the Drive media source are referenced **by their ID** rather than their name.

The default urlPattern, `/assets/components/googledrivemediasource/?s={source}&id={id}`, lets you use the media source with no changes, but results in pretty ugly URLs, while also exposing you use Google Drive. It can also cause compatibility issues with some extras.

It is recommended to configure a rewrite for Apache:

```
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^drive/(.+)$ /assets/components/googledrivemediasource/index.php?s=2&id=$1 [L,QSA]
#                                             change the ID here if needed    ^^^
```

Or for nginx (MODX Cloud):

```nginx
rewrite ^/drive/(.*)$ /assets/components/googledrivemediasource/index.php?s=2&id=$1 last;
#                                          change the ID here if needed    ^^^
# put before the location block
#location / {
#    try_files $uri $uri/ @modx-rewrite;
#}
```

The s=2 parameter indicates the **media source ID**, in this example ID 2. Change that as needed.

The **urlPattern** in the media source can then drop the media source ID and be configured to:

```html
https://yoursite.com/gdrive/{id}
```

> **You should run this proxy with a fully qualified URL in the urlPattern, to maximise compatibility with third party tools**. This could be on a (sub)domain, but has to start with https. Make sure all requests are routed to the index file and that the `s` and `id` parameters are properly set from the request or rewrite.

> For phpthumb and the MODX media browser, it is necessary to set the `phpthumb_nohotlink_enabled` system setting to `No` to see thumbnails. This allows it to handle external files that are not replicated on the local file system.

## Integrations

When using the media source with other extras, you may run into compatibility issues because files and directories are referenced by IDs and cannot be found on the local file system.

We've confirmed the MODX core, Image+, ContentBlocks, and phpthumb, **however you will need to run the friendly URLs proxy from a (sub)domain with a full https url configured**. Otherwise, they may try to find the file locally, where it will be unable of finding any files.

Please do report any incompatibilities **when using a full url** [on GitHub](https://github.com/modmore/GoogleDriveMediaSource/issues).


