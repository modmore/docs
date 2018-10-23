CSRFHelper can protect your change password forms from the [Login package](https://modx.com/extras/package/login) against CSRF attacks.

[TOC]

## Adding the token to the form

In your change password form, add a hidden input with name csrf_token that calls the `csrfhelper` snippet:

    <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`changepassword` &singleUse=`1`]]">

We're adding `&singleUse` here so each request to the form page gets a new token. If you leave that off, the token will instead be valid for 24 hours.

## Validating the token

On the [ChangePassword](https://docs.modx.com/extras/revo/login/login.changepassword) snippet call, add the `csrfhelper_login` to the `&preHooks`, and set `&csrfKey` to the same key in the `csrfhelper` snippet, so `changepassword` from the example above.

For example:

````html
[[!ChangePassword?
    &preHooks=`csrfhelper_login`
    &csrfKey=`changepassword`
]]
````

## Full example

Based on the [example from the documentation](https://docs.modx.com/extras/revo/login/login.changepassword), your form might end up looking like this:

````html
[[!ChangePassword?
    &submitVar=`change-password`
    &placeholderPrefix=`cp.`
    &validateOldPassword=`1`
    &validate=`nospam:blank`
    &preHooks=`csrfhelper_login`
    &csrfKey=`changepassword`
]]
<div class="updprof-error">[[!+cp.error_message]]</div>
<form class="form" action="[[~[[*id]]]]" method="post">
    <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`changepassword` &singleUse=`1`]]">
    <input type="hidden" name="nospam" value="" />
    <div class="ff">
        <label for="password_old">Old Password
            <span class="error">[[!+cp.error.password_old]]</span>
        </label>
        <input type="password" name="password_old" id="password_old" value="[[+cp.password_old]]" />
    </div>
    <div class="ff">
        <label for="password_new">New Password
            <span class="error">[[!+cp.error.password_new]]</span>
        </label>
        <input type="password" name="password_new" id="password_new" value="[[+cp.password_new]]" />
    </div>
    <div class="ff">
        <label for="password_new_confirm">Confirm New Password
            <span class="error">[[!+cp.error.password_new_confirm]]</span>
        </label>
        <input type="password" name="password_new_confirm" id="password_new_confirm" value="[[+cp.password_new_confirm]]" />
    </div>
    <div class="ff">
        <input type="submit" name="change-password" value="Change Password" />
    </div>
</form>
````
