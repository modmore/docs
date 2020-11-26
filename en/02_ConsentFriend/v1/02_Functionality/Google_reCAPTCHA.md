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

The forms that are secured by reCAPTCHA could be modified on changing the
consent state of the googleRecaptcha service with a callback function. The
following example is predefined in the demo service data:

```
function(consent, service) {
    var buttons = document.body.querySelectorAll('input[data-name="' + service.name + '"],button[data-name="' + service.name + '"]'), index;
    for (index = 0; index < buttons.length; index++) {
       buttons[index].disabled = !consent;
    }
}
```

This code disables all inputs with `data-name="googleRecaptcha"`, when no
consent is given for this service and enables the input after the consent is
available.
