---
title: Installation 
---

The MODX installer should install the package automatically from the modmore
repository.

A custom manager page called _ConsentFriend_ is installed within the _Extras_
menu.

There are some system settings available in the namespace _ConsentFriend_. These
can also be edited in the [settings](03_Custom_Manager_Page/05_Settings.md) (gear
icon) tab of the _ConsentFriend_ custom manager page.

## Prepare the website

ConsentFriend installs several [default
services](02_Functionality/02_Default_Services.md). Some of them use system/context
settings that you have to create yourself.

After the installation on an existing website, you need to identify the external
services used, such as Google Analytics, Matomo, Google Fonts, etc. If these
services are referenced at the end of the Head or Body section, you can [edit an
existing service or create a new
service](03_Custom_Manager_Page/01_Services.md#createedit) and use the found
code in the Code tab. ConsentFriend will make the necessary changes to the code
for the consent management window.

If you use inline code for external services, you have to [modify it on your
own](02_Functionality/01_Introduction.md#custom-external-services).

## Enable the consent management window

After the preparation you have to enable ConsentFriend with the
`consentfriend.enable` system setting. Then the consent management window will
be shown in the frontend. A context, a user or a usergroup setting would
supersede this system setting and can be used too.
