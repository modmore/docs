CSRFHelper can protect your login forms from the [Login package](https://modx.com/extras/package/login) against CSRF attacks.

[TOC]

## Adding the token to the Login form

First, we need to define a custom chunk to use as the login form if you haven't already done that:

    [[!Login?
        &tplType=`modChunk` 
        &loginTpl=`myLoginTpl`
    ]]

Edit the `myLoginTpl` chunk. Based on the default `lgnLoginTpl` chunk, that might look like this:

````html
<div class="loginForm">
    <div class="loginMessage">[[+errors]]</div>
    <div class="loginLogin">
        <form class="loginLoginForm" action="[[~[[*id]]]]" method="post">                
            <fieldset class="loginLoginFieldset">
                <legend class="loginLegend">[[+actionMsg]]</legend>
                <label class="loginUsernameLabel">[[%login.username]]
                    <input class="loginUsername" type="text" name="username" />
                </label>
                
                <label class="loginPasswordLabel">[[%login.password]]
                    <input class="loginPassword" type="password" name="password" />
                </label>
                <input class="returnUrl" type="hidden" name="returnUrl" value="[[+request_uri]]" />

                [[+login.recaptcha_html]]
                
                <input class="loginLoginValue" type="hidden" name="service" value="login" />
                <span class="loginLoginButton"><input type="submit" name="Login" value="[[+actionMsg]]" /></span>
            </fieldset>
        </form>
    </div>
</div> 
````

Inside the `<form>`, add a hidden field like so:

    <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`login` &singleUse=`1`]]">

Note that we're adding `&singleUse` here. Logging in a sensitive action, so we only want each token to be used once. We're also setting the `&key` to `login`, which we'll need to also set in the Login snippet in a minute.

While for [Formit](../FormIt) we need to separately add an error placeholder to show when the security token isn't valid, that's not needed for Login. The `[[+errors]]` placeholder will show the error automatically.

The full example `myLoginTpl` chunk, including the `csrf_token` hidden field, now looks like this:

````html
<div class="loginForm">
    <div class="loginMessage">[[+errors]]</div>
    <div class="loginLogin">
        <form class="loginLoginForm" action="[[~[[*id]]]]" method="post">
            <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`login` &singleUse=`1`]]">
                
            <fieldset class="loginLoginFieldset">
                <legend class="loginLegend">[[+actionMsg]]</legend>
                <label class="loginUsernameLabel">[[%login.username]]
                    <input class="loginUsername" type="text" name="username" />
                </label>
                
                <label class="loginPasswordLabel">[[%login.password]]
                    <input class="loginPassword" type="password" name="password" />
                </label>
                <input class="returnUrl" type="hidden" name="returnUrl" value="[[+request_uri]]" />

                [[+login.recaptcha_html]]
                
                <input class="loginLoginValue" type="hidden" name="service" value="login" />
                <span class="loginLoginButton"><input type="submit" name="Login" value="[[+actionMsg]]" /></span>
            </fieldset>
        </form>
    </div>
</div>
````

## Validating the token with a hook

Now that we're submitting the token, we should also validate it. We do this with the `csrfhelper_login` pre-hook.

In the Login snippet call, add the `csrfhelper_login` to your `&preHooks` property. 

Also add the `&csrfKey` property with the key for the CSRF token; this should be unique for each unique form and match the `&key` in the `csrfhelper` snippet call. In the example above, this was set to `login`.

All things combined, our Login snippet now looks like this:

````html
[[!Login?
    &tplType=`modChunk` 
    &loginTpl=`myLoginTpl`
    &preHooks=`csrfhelper_login`
    &csrfKey=`login`
]]
````
