To disable the automatic loading and execution of the reCAPTCHA script, you have
to modify i.e. the default recaptchav3_html with the following code:

```
<script type="application/javascript">
    function loadCaptcha() {
        grecaptcha.ready(function() {
            grecaptcha.execute('[[+site_key]]', {action: '[[+form_id]]'}).then(function(token) {
                document.querySelector('[name="[[+token_key]]"]').value = token;
            });
        });
    }
</script>
<script onload="loadCaptcha()" type="text/plain" data-type="application/javascript" data-src="https://www.google.com/recaptcha/api.js?render=[[+site_key]]&hl=[[++cultureKey]]" data-name="googleRecaptcha"></script>
<input type="hidden" name="[[+token_key]]">
<input type="hidden" name="[[+action_key]]" value="[[+form_id]]">
```

Since the order of excecution of javascripts after they are enabled by Klaro! is
not fixed, the `grecaptcha.ready` method has to be wrapped by a method, that is
executed after the load of the recaptcha script with the onload attribute.
Otherwise you will get an `Uncaught ReferenceError: grecaptcha is not defined`
error in the browser console.