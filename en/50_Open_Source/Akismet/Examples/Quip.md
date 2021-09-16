---
title: Quip
description: Protecting Quip threads from spam with Akismet
---

TBA

## Basic usage

On your QuipReply snippet call, add the Akismet snippet to the `&preHooks`:

    [[!QuipReply? 
        ...
        &preHooks=`Akismet`
        ...
    ]]

Also add as many of the snippet properties that matches your form names, for example a form with a `username`, `email` and `fullname` field, a hidden `nospam` honeypot field, and while testing:

    &akismetType=`reply`
    &akismetAuthor=`name`
    &akismetAuthorEmail=`email`
    &akismetAuthorUrl=`website`
    &akismetContent=`comment`
    &akismetHoneypotField=`nospam`
