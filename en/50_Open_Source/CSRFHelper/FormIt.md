CSRFHelper can protect your FormIt forms against CSRF attacks.

[TOC]

## Adding the token to the form

In your form, add the following hidden field:

     <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`simple-form`]]">

**&raquo; Note:** the `&key` property needs to match the `&csrfKey` property we add to the FormIt snippet call in a minute.

For sensitive forms, you can also add a `&singleUse` property with value 1 that ensures each request gets a unique CSRF token. If you leave this out, the token for the form is the same for up to 24 hours. 

To show the error when the CSRF token does not match, or if it can't be securely generated on your server, add the following in an appropriate place in your form:

     [[!+fi.error.csrf_token:notempty=`<div class="error">[[!+fi.error.csrf_token]]</div>`]]

## Validating the token with a hook

Now that we're submitting the token, we should also validate it. We do this with the `csrfhelper_formit` hook.

In the FormIt snippet call, add the `csrfhelper_formit` to your `&hooks` property.

Also add the `&csrfKey` property with the key for the CSRF token; this should be unique for each unique form and match the `&key` in the `csrfhelper` snippet call. In the example above, this was set to `simple-form`.

## Full example 

Below is a full example based on the [simple contact form example for FormIt](https://docs.modx.com/extras/revo/formit/formit.tutorials-and-examples/formit.examples.simple-contact-page).

```` html
[[!FormIt?
   &hooks=`spam,csrfhelper_formit,email,redirect`
   &redirectTo=`71`
   &validate=`nospam:blank,
      name:required,
      email:email:required,
      subject:required,
      text:required:stripTags`
   &csrfKey=`simple-form`
]]


<h2>Contact Form</h2>
 
[[!+fi.validation_error_message:notempty=`<p>[[!+fi.validation_error_message]]</p>`]]
 
<form action="[[~[[*id]]]]" method="post" class="form">
     [[!+fi.error.csrf_token:notempty=`<div class="error">[[!+fi.error.csrf_token]]</div>`]]
     <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`simple-form`]]">
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
  
    <div class="form-buttons">
        <input type="submit" value="Send Contact Inquiry" />
    </div>
</form>
````

