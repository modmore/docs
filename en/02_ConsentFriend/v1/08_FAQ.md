---
title: FAQ
hide:
    - toc
---

We're collecting the questions we get most often into a FAQ. If your question is
not in the list, please reach out to us via treehillstudio-support@modmore.com
and we will be glad to help.

[TOC]

## How can I convert an exisiting Google Analytics implementation in a MODX site to ConsentFriend?  

1. Locate the usage of Google Analytics in your template or in the dependent
chunk calls.
2. Copy the Google Analytics ID (a string starting with `G-`) in
the template or chunk and create a system setting `google_analytics_id`
with that value.
3. Disable that chunk (i.e. by renaming it) or the template
part (i.e. by surrounding it with `[[-` and `]]`).
4. Enable ConsentFriend in the frontend.
5. Clear the MODX cache.

## Can I use different Google Analytics IDs in different contexts?

Thats possible. The default Google Analytics service uses the MODX
system/context setting tag `[[++google_analytics_id]]`. So you have to create a
context setting `google_analytics_id` with the value of the Google Analytics ID.

Please make sure that the ConsentFriend plugin has a higher priority than the
context routing plugin in the onHandleRequest event. You have to edit the
ConsentFriend plugin for this. In the System Events tab you have to update the
OnHandleRequest plugin event and fill the priority value of ConsentFriend with a
higher value than the routing plugin.

## Can I use different privacy policies in different contexts?

This is possible with a context setting. For this you have to set the
`consentfriend.privacy_policy_id` context setting differently in each context.
Please also make sure that the ConsentFriend plugin has a higher priority in the
onHandleRequest event than the context routing plugin. See the FAQ entry above
for more information.

## The consent modal displays only lexicon keys instead of translated strings

Thats a result of different language detection. MODX uses the cultureKey
system/context setting and ConsentFriend uses the html lang attribute. So you
have to fill the html lang attribute with the cultureKey system/context setting:
`<html lang="[[++cultureKey]]">`.

## I would like to change the texts of ConsentFriend

This can be done with the ConsentFriend [lexicon](07_Lexicon.md).

## How can I create an own theme for ConsentFriend?

If you want to create your own theme, you can import the file
`assets/components/consentfriend/scss/consentfriend.scss` in your scss workflow. There
are a few scss variables available in
`assets/components/consentfriend/scss/vars.scss` that can be overridden
before. To disable the default styling of the modal afterwards, please set the
system setting consentfriend.js_url to
`/assets/components/consentfriend/js/web/consentfriend-no-css.js`.

## How can I redisplay the consent management window on a page?

If you want to allow the user to change his consent settingsm, you can add a
link to the consent management window using the following code:

```
<a onclick="klaro.show(window.consentFriendConfig, { modal: true });return false;">[[%consentfriend.services.change_setting? &namespace=`consentfriend`]]</a>
```

## How can I change external html code automatically for ConsentFriend?

It is possible to replace the html code of i.e. YouTube videos in a placeholder
with the following output filter. Create a snippet FilterConsentFriendVideo with
the following code and use it on the placeholder with
`[[+placeholder:FilterConsentFriendVideo]]`

Snippet FilterConsentFriendVideo
```php
<?php
// Replace youtube iframe attributes with ConsentFriend compatible attributes
return preg_replace(
    '~<iframe(.*?)src="https://www\.youtube\.com/embed/(.*?)"(.*?)width="(.*?)"(.*?)</iframe>~m',
    '<iframe$1data-name="youtube" data-src="https://www.youtube.com/embed/$2"$3></iframe>',
    $input
);
```

Feel free to create your own output filter for other external services.

## Is it possible to use Google Consent Mode v2 with ConsentFriend?

Yes, the consent mode v2 can be set with ConsentFriend for Google Analytics. It
is now built into the default Google Analytics service configuration. In already
existing installations you can install the new code by importing the [Google
Analytics service YAML file](yaml/consentfriend_googleAnalytics.yml) or just
add the
[callbacks](https://docs.treehillstudio.de/en/consentfriend/02_Functionality/02_Default_Services/#callbacks)
on your own.
