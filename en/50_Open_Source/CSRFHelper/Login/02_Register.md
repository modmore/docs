CSRFHelper can protect your registration forms from the [Login package](https://modx.com/extras/package/login) against CSRF attacks.

[TOC]

## Adding the token to the form and hook

In your registration form, add a hidden input with name csrf_token that calls the `csrfhelper` snippet:

    <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`register` &singleUse=`1`]]">

We're adding `&singleUse` here so each request to the registration page gets a new token. If you leave that off, the token will be valid for 24 hours.

## Validating the token

On the Register snippet call, add the `csrfhelper_login` to the `&preHooks`, and set `&csrfKey` to the same key in the `csrfhelper` snippet, so `register` in the example above.

Taking the [example form from the official documentation](https://docs.modx.com/extras/revo/login/login.register/register.example-form-1), and adding the necessary tweaks, you'll end up with a form like this:

````html
[[!Register?
    &submitVar=`registerbtn`
    &submittedResourceId=`73`
    &preHooks=`csrfhelper_login`
    &csrfKey=`register`
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
        <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`register` &singleUse=`1`]]">

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
````
