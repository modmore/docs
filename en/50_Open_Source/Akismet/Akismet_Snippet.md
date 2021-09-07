The Akismet snippet can be used as a **hook** (in FormIt) or **preHook** (in Login/Register). 

You need to instruct Akismet what fields to use. For this, add properties prefixed with `akismet` to the FormIt or Register snippet call.

> Akismet works better the more information you provide. So look through the list of properties below and, if your form has a matching field, provide its name so it can be provided to Akismet.
> 
> The snippet already automatically provides the IP, user agent, referrer, URL, etc.

[TOC]

## All Properties

- `&akismetAuthor` - The author's name.
- `&akismetAuthorEmail` - The author's email.
- `&akismetAuthorUrl` - The author's URL if they provided one.
- `&akismetContent` - The message content.
- `&akismetType` - The type of form submitted. Available types include *comment*, *forum-post*, *reply*, *blog-post*, *contact-form*, *signup*, *message*, and more. Read more [here](https://blog.akismet.com/2012/06/19/pro-tip-tell-us-your-comment_type/).
- `&akismetUserRole` - The type of user e.g. *visitor*, or *member*. If set to *Administrator*, the form will never be blocked.
- `&akismetTest` - Set this to `1` while developing so the AI knows it is just a test submission.
- `&akismetHoneypotField` - If you use a hidden honeypot field in your form, set the name of it here.
- `&akismetRecheckReason` - If you have a form where the same submission needs to be checked more than once, include the reason for it here.
- `&akismetError` - The error message to set when the form failed the spam check. By default, this will use the `akismet.message_blocked` lexicon, which you may edit via System > Lexicon Management > akismet (select in the namespace dropdown), or you can provide the snippet property with a different message entirely. 

For example, if you have a contact form that has input fields like this:

```html
<input type="text" name="sender" value="[[!+fi.sender]]">
<input type="email" name="sender_email" value="[[!+fi.sender_email]]">
```

Then you need to set at least the following properties:

```html
[[!FormIt / Register?
    &hooks=`akismet,email,redirect`
    ...
    &akismetType=`contact-form`
    &akismetAuthor=`sender`
    &akismetAuthorEmail=`sender_email`
    ...
]]
```

## Use with FormIt

Add the snippet to the hooks:

[See a full FormIt example](Examples/FormIt)

## Use with Register

On your register resource, add the akismet snippet to the `&preHooks` on the Register snippet call:

    [[!Register? 
        ...
        &preHooks=`akismet`
        ...
    ]]

Also add as many of the snippet properties that matches your form names, for example a form with a `username`, `email` and `fullname` field, a hidden `nospam` honeypot field, and while testing: 

    &akismetTest=`1`
    &akismetType=`signup`
    &akismetAuthor=`username`
    &akismetAuthorEmail=`email`
    &akismetContent=`fullname`
    &akismetHoneypotField=`nospam`

[See a full Register example](Examples/Register)


