---
title: Akismet 
---


[Akismet](https://akismet.com/) is an advanced spam protection service that uses AI to analyse form submissions. It learns from spam patterns around the web in real-time, and is extremely effective at blocking spam without hindering the user experience with CAPTCHAs.

Originally developed for Wordpress, this open source package integrates Akismet with the MODX extras
[FormIt](https://docs.modx.com/current/en/extras/formit/index) and [Login](https://docs.modx.com/current/en/extras/login/index) (specifically the [Register](https://docs.modx.com/current/en/extras/login/login.register) snippet).

Akismet is free for personal sites or blogs, and requires a paid subscription for use on commercial websites. [Learn more about Akismet's subscription model](https://akismet.com/plans/).

[Donations to support our open source work are much appreciated](https://modmore.com/extras/akismet/donate/).

[TOC]

## Getting Started

Install Akismet via the [modmore package provider](https://modmore.com/about/package-provider/). 

[Sign up for an Akismet account](https://akismet.com/plans/), then copy and paste the provided *API Key* into the new `akismet.api_key` system setting.

Next, [implement the Akismet snippet](Akismet_Snippet) as either a hook (FormIt) or preHook (Register, QuipReply) into your form. If you have a custom form-handling snippet, [see the standalone instructions](Examples/Standalone).

## Personal information

Because personal information is sent to a third party, using the Akismet package touches on GDPR and similar regulation. 

As spam protection is a "legitimate interest" its usage does not require specific consent. That said, it's worth adding a notice in your Privacy Policy, and/or adding a line like this to your forms:

> This site uses Akismet to reduce spam. Learn how your comment data is processed.

[Learn more about Akismet and the GDPR.](https://akismet.com/gdpr/)

## Automatic cleanup (v1.1+)

Spam checks are automatically removed after 30 days. This time period can be adjusted with the `akismet.cleanup_days_old` system setting; giving it a value of 0 disables the cleanup.

The cleanup does not require a cron job, but runs automatically when form submissions are checked for spam.

## 

## Learn More

- [Akismet snippet reference and usage instructions](Akismet_Snippet)
- [FormIt example](Examples/FormIt)
- [Register example](Examples/Register)
