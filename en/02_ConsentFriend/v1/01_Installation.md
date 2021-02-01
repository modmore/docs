The MODX installer should install the package automatically from the modmore
repository.

A custom manager page called _ConsentFriend_ is installed within the _Extras_
menu.

There are some system settings available in the namespace _ConsentFriend_. These
can also be edited in the [settings](03_Custom_Manager_Page/03_Settings.md) (gear
icon) tab of the _ConsentFriend_ custom manager page.

## Prepare the website

After the installation on an existing website, you have to identify the used
external services like Google Analytics, Matomo, Google Fonts etc. If those
services are referenced at the end of the head or the body section, you could
[edit an existing service or create a new
service](03_Custom_Manager_Page/01_Services.md#createedit) and use the found
code in the code tab. ConsentFriend will do the needed code changes for the
consent management window.

If you use inline code for external services, you have to [modify it on your
own](02_Functionality/01_Introduction.md#custom-external-services).

## Enable the consent management window

After the preparation you have to enable ConsentFriend with the
`consentfriend.enable` system setting. Then the consent management window will
be shown in the frontend. A context, a user or a usergroup setting would
supersede this system setting and can be used too.
