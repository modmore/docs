---
title: Google Tag Manager 
---

You can integrate ConsentFriend with the Google Tag Manager (GTM) quite easy and
control consents for Google Analytics with ConsentFriend via the GTM. The demo
callback scripts in the googleTagManager service already contain the necessary
code for this.

First, change the googleAnalytics service and delete the code block there. This
also applies to other existing and newly defined services that you want to
control via the GTM. You only need to list the cookies that these services set.

Now create a Google Analytics tag in the GTM web UI. As a trigger, create a
[custom event trigger](https://support.google.com/tagmanager/answer/7679219)
named `consentfriend-googleAnalytics-accepted`. This will ensure that GTM only
loads the Google Analytics service if the user has given consent for it via
ConsentFriend. And that's it!

ConsentFriend now manages GTM and ensures that only services that the user has
given consent for via ConsentFriend are loaded.

> Important! To add another service via GTM, first enable or create a service in
ConsentFriend and simply define a custom event trigger of the form
`consentfriend-[service-name]-accepted`, where `[service-name]` is the name of the
service in the ConsentFriend configuration.
