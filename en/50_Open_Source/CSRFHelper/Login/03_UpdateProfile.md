CSRFHelper can protect your update profile forms from the [Login package](https://modx.com/extras/package/login) against CSRF attacks.

[TOC]

## Adding the token to the form

In your registration form, add a hidden input with name csrf_token that calls the `csrfhelper` snippet:

    <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`updateprofile` &singleUse=`1`]]">

We're adding `&singleUse` here so each request to the form page gets a new token. If you leave that off, the token will instead be valid for 24 hours.

## Validating the token

On the [UpdateProfile](https://docs.modx.com/extras/revo/login/login.updateprofile) snippet call, add the `csrfhelper_login` to the `&preHooks`, and set `&csrfKey` to the same key in the `csrfhelper` snippet, so `updateprofile` from the example above.

For example:

````html
[[!UpdateProfile?
    &validate=`fullname:required,email:required:email`
    &preHooks=`csrfhelper_login`
    &csrfKey=`updateprofile`
]]
````

## Full example

Based on the [example from the documentation](https://docs.modx.com/extras/revo/login/login.updateprofile), your form might end up looking like this:

````html
[[!UpdateProfile?
    &validate=`fullname:required,email:required:email`
    &preHooks=`csrfhelper_login`
    &csrfKey=`updateprofile`
]]


<div class="update-profile">
    <div class="updprof-error">[[+error.message]]</div>
    [[+login.update_success:is=`1`:then=`[[%login.profile_updated? &namespace=`login` &topic=`updateprofile`]]`]]
 
    <form class="form" action="[[~[[*id]]]]" method="post">
        <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`updateprofile` &singleUse=`1`]]">
        <input type="hidden" name="nospam" value="" />
 
        <label for="fullname">[[!%login.fullname? &namespace=`login` &topic=`updateprofile`]]
            <span class="error">[[+error.fullname]]</span>
        </label>
        <input type="text" name="fullname" id="fullname" value="[[+fullname]]" />
 
        <label for="email">[[!%login.email]]
            <span class="error">[[+error.email]]</span>
        </label>
        <input type="text" name="email" id="email" value="[[+email]]" />
 
        <label for="phone">[[!%login.phone]]
            <span class="error">[[+error.phone]]</span>
        </label>
        <input type="text" name="phone" id="phone" value="[[+phone]]" />
 
        <label for="mobilephone">[[!%login.mobilephone]]
            <span class="error">[[+error.mobilephone]]</span>
        </label>
        <input type="text" name="mobilephone" id="mobilephone" value="[[+mobilephone]]" />
 
        <label for="fax">[[!%login.fax]]
            <span class="error">[[+error.fax]]</span>
        </label>
        <input type="text" name="fax" id="fax" value="[[+fax]]" />
 
        <label for="address">[[!%login.address]]
            <span class="error">[[+error.address]]</span>
        </label>
        <input type="text" name="address" id="address" value="[[+address]]" />
 
        <label for="country">[[!%login.country]]
            <span class="error">[[+error.country]]</span>
        </label>
        <input type="text" name="country" id="country" value="[[+country]]" />
 
        <label for="city">[[!%login.city]]
            <span class="error">[[+error.city]]</span>
        </label>
        <input type="text" name="city" id="city" value="[[+city]]" />
 
        <label for="state">[[!%login.state]]
            <span class="error">[[+error.state]]</span>
        </label>
        <input type="text" name="state" id="state" value="[[+state]]" />
 
        <label for="zip">[[!%login.zip]]
            <span class="error">[[+error.zip]]</span>
        </label>
        <input type="text" name="zip" id="zip" value="[[+zip]]" />
 
        <label for="website">[[!%login.website]]
            <span class="error">[[+error.website]]</span>
        </label>
        <input type="text" name="website" id="website" value="[[+website]]" />
 
        <br class="clear" />
 
        <div class="form-buttons">
            <input type="submit" name="login-updprof-btn" value="[[!%login.update_profile]]" />
        </div>
    </form>
</div>
````
