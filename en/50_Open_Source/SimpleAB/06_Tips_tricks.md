---
title: Tips & Tricks
---

A miscellanious collection of tips and tricks for managing your A/B tests with SimpleAB, and A/B Testing in general.

### [Debug Placeholders](#debugplaceholders)

Because things happen in the background, it can be tricky to see that SimpleAB is actually working! There's a couple of placeholders you can use to see what SimpleAB did. They are in no particular order (replacing "ID" with the ID of the test, of course):

- `[[!+simpleab.test_ID.pick]]` Shows the ID of the variation that was chosen.
- `[[!+simpleab.test_ID.mode]]` Displays the mode that was used for selectiong the variation. This can be one of the following: _random_ (randomly picked variation), _previous_ (the visitor has seen this test before, so we show the same variation again), _bestpick_ (when the [Auto Optimizer](Auto_Optimizer) decided the best variation) or _preview_ (admin preview mode was enabled).
- `[[!+simpleab.test_ID.variation.id]]` The variation ID.
- `[[!+simpleab.test_ID.variation.name]]` Name of the variation that was used.
- `[[!+simpleab.test_ID.variation.description]]` The variation description.
- `[[!+simpleab.test_ID.variation.element]]` The ID of the element (chunk or template) that was loaded.

If you want to collect additional information, you could easily use these placeholders with [Google Analytics Custom Variables](https://developers.google.com/analytics/devguides/collection/gajs/gaTrackingCustomVariables) so you can take advantage of the wealth of data Google collects as well. 

### [Random Mode](#random)

The default behavior of SimpleAB is to only pick a random variation when the user has not seen a variation belonging to the current test (as stored in their session). This is great, cause users will then always see the same variation and wont get confused if you have very different variations.

But if you want to demo SimpleAB to a client, you may want it to randomly show one of the variations. Luckily, there's a setting for that!

In your MODX Manager, head over to _System_ » _System Settings_ and choose _simpleab_ in the namespace dropdown (the one that defaults to core). By setting the `simpleab.use_previous_picks` setting to _no_, you will make sure it defaults to using a random one. The [Auto Optimizer](Auto_Optimizer) might still override the selection, in which case you can simply disable it for the test, or increase the conversion threshold.

### Lock down Test management

Use the `simpleab.admin_groups system` setting to define groups that are considered Administrators and need to be able of managing tests. If a user is a so-called _Sudo User_, all test management functionalities are available as well.

When a user is not an Admin, only report functionalities are available in the component and editing powers are taken away.

### [Hide mod**more** Logo](#logo)

At the bottom right of the component, we display the mod**more** logo by default, with a link to the [SimpleAB Documentation](https://www.modmore.com/extras/simpleab/documentation/), because we want you to remember us while you deliver awesomeness to your client. Are we stuck in your brain already? Great! Head over to _System_ » _System Settings_ and choose _simpleab_ in the namespace dropdown (the one that defaults to core), and set `simpleab.hide_logo` to _yes_.