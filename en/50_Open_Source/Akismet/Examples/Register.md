---
title: Register 
description: Protecting user registration forms against spam with Akismet
---

Register is part of the [Login package](https://modx.com/extras/package/login) and used for allowing users to create new accounts on your site. Akismet can protect against spam signups.

The example below is based on the [example from the MODX documentation](https://docs.modx.com/current/en/extras/login/login.register/example-form-1), adapted to include the [Akismet hook](../Akismet_Snippet).

[TOC]

## Register resource 

Replace activationResourceId with the ID of the activation resource, and submittedResourceId with the ID of the resource that instructs (see below).

```html
<h2>Register</h2>

[[!Register?
    &submitVar=`registerbtn`
    
    &preHooks=`Akismet`
    
    &akismetTest=`1`
    &akismetType=`signup`
    &akismetAuthor=`username`
    &akismetAuthorEmail=`email`
    &akismetContent=`fullname`
    &akismetHoneypotField=`nospam`

    &activationResourceId=`123`
    &activationEmailTpl=`myActivationEmailTpl`
    &activationEmailSubject=`Thanks for Registering!`
    &submittedResourceId=`45`
    &usergroups=`Marketing,Research`
    &validate=`nospam:blank,
  username:required:minLength=^6^,
  password:required:minLength=^6^,
  password_confirm:password_confirm=^password^,
  fullname:required,
  email:required:email`
    &placeholderPrefix=`reg.`
]]

<div class="register">
    <div class="registerMessage">[[!+reg.error.message]]</div>

    <form class="form" action="[[~[[*id]]]]" method="post">
        <input type="hidden" name="nospam" value="[[!+reg.nospam]]" />

        <label for="username">[[%register.username? &namespace=`login` &topic=`register`]]
            <span class="error">[[!+reg.error.username]]</span>
        </label>
        <input type="text" name="username" id="username" value="[[!+reg.username]]" />

        <label for="password">[[%register.password]]
            <span class="error">[[!+reg.error.password]]</span>
        </label>
        <input type="password" name="password" id="password" value="[[!+reg.password]]" />

        <label for="password_confirm">[[%register.password_confirm]]
            <span class="error">[[!+reg.error.password_confirm]]</span>
        </label>
        <input type="password" name="password_confirm" id="password_confirm" value="[[!+reg.password_confirm]]" />

        <label for="fullname">[[%register.fullname]]
            <span class="error">[[!+reg.error.fullname]]</span>
        </label>
        <input type="text" name="fullname" id="fullname" value="[[!+reg.fullname]]" />

        <label for="email">[[%register.email]]
            <span class="error">[[!+reg.error.email]]</span>
        </label>
        <input type="text" name="email" id="email" value="[[!+reg.email]]" />

        <br class="clear" />

        <div class="form-buttons">
            <input type="submit" name="registerbtn" value="Register" />
        </div>
    </form>
</div>
```

If you do not use the `[[!+reg.error.message]]` placeholder (which will contain all errors), you can render the Akismet error specifically like this:

    [[!+register.error.akismet:notempty=`<p class="error">[[!+register.error.akismet]]</p>`]]

In the **myActivationEmailTpl** chunk:

```html
<p>[[+username]],</p>

<p>Thanks for registering! To activate your new account, please click on the following link:</p>

<p><a href="[[+confirmUrl]]">[[+confirmUrl]]</a></p>

<p>After activating, you may login with your password and username:</p>

<p>
Username: <strong>[[+username]]</strong><br />
Password: <strong>[[+password]]</strong></p>

<p>If you did not request this message, please ignore it.</p>

<p>Thanks,<br />
<em>Site Administrator</em></p>
```

## Submitted resource

The submitted resource is used to tell people their account was created, but they need to check their email to click the activation link. It requires no special snippet, but you do need to refer to it in the Register snippet above (`&submittedResourceId`).

## Activation Resource

The activation resource needs to have the [ConfirmRegister snippet](https://docs.modx.com/current/en/extras/login/login.confirmregister) on it. 

```html 
[[!ConfirmRegister]]
```

It's suggested to at least provide a &errorPage property if there's an issue confirming the new account, and/or the &redirectTo property.

Set the ID of your activation resource to `&activationResourceId` on the Register snippet.

