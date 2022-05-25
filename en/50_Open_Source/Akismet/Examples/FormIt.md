---
title: FormIt 
description: Protecting FormIt forms against spam with Akismet
---

Here's a full contact form powered by FormIt, [based on the example from the MODX Documentation](https://docs.modx.com/current/en/extras/formit/formit.tutorials-and-examples/examples.simple-contact-page), adapted to include the [Akismet hook](../Akismet_Snippet) to protect against spam instead of Recaptcha.

After installing FormIt, you can place this full form on a resource or in a chunk/template.

> To learn more about FormIt, [see the official docs](https://docs.modx.com/current/en/extras/formit).

```html 
[[!FormIt?
    &hooks=`Akismet,email,redirect`
    &emailTpl=`MyEmailChunk`
    &emailTo=`user@example.com`
    &emailUseFieldForSubject=`1`
    
    &akismetTest=`1`
    &akismetType=`contact-form`
    &akismetAuthor=`name`
    &akismetAuthorEmail=`email`
    &akismetContent=`text`
    &akismetHoneypotField=`nospam`
    
    &redirectTo=`6`
    &validate=`nospam:blank,
      name:required,
      email:email:required,
      subject:required,
      text:required:stripTags`
]]


[[!+fi.validation_error_message:notempty=`<p>[[!+fi.validation_error_message]]</p>`]]
[[!+fi.error.akismet:notempty=`<p>[[!+fi.error.akismet]]</p>`]]

<form action="[[~[[*id]]]]" method="post" class="form">
    <input type="hidden" name="nospam" value="" />

    <label for="name">
        Name:
        <span class="error">[[!+fi.error.name]]</span>
    </label>
    <input type="text" name="name" id="name" value="[[!+fi.name]]" />

    <label for="email">
        Email:
        <span class="error">[[!+fi.error.email]]</span>
    </label>
    <input type="text" name="email" id="email" value="[[!+fi.email]]" />

    <label for="subject">
        Subject:
        <span class="error">[[!+fi.error.subject]]</span>
    </label>
    <input type="text" name="subject" id="subject" value="[[!+fi.subject]]" />

    <label for="text">
        Message:
        <span class="error">[[!+fi.error.text]]</span>
    </label>
    <textarea name="text" id="text" cols="55" rows="7" value="[[!+fi.text]]">[[!+fi.text]]</textarea>

    <br class="clear" />

    <div class="form-buttons">
        <input type="submit" value="Send Contact Inquiry" />
    </div>
</form>
```

When you're done testing, make sure to remove the ```&akismetTest=`1` ``` property from the snippet.

Also create the chunk for the email content named **MyEmailChuk**:

```html
This is the Formit Email Chunk.

<br />[[+name]] ([[+email]]) Wrote: <br />

[[+text]]
```


