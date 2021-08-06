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

### Disable the inputs

The forms that are secured by reCAPTCHA can be modified on changing the
consent state of the googleRecaptcha service with a callback function. The 
following example is predefined in the demo service data in the onToggle
callback:

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

### Disable the submit

Another option would be to disable the form's submit button and display a 
modal window to enable the reCAPTCHA service, which can be used to 
re-enable the submit button. The following example code for the onToggle
callback does this with jQuery/Bootstrap 5:

```
function(consent, service) {
    var button = $('button[data-name="' + service.name + '"], input[type="submit"][data-name="' + service.name + '"]');
    button.css('display', 'inline-block');
    if (!consent) {
        button.on('click', function(event) {
            var recaptchaModal = new bootstrap.Modal(document.getElementById('recaptchaModal'));
            recaptchaModal.show();
            event.preventDefault();
        });
    } else {
        button.off('click');
    }
}
```

The modal window that appears after clicking the submit button can be created as follows (Bootstrap 5):

```
<div class="modal fade" id="recaptchaModal" tabindex="-1" aria-labelledby="recaptchaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recaptchaModalLabel">reCAPTCHA service needed</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>You have disabled the reCAPTCHA service in the consent settings. This service provides spam protection for our forms. The forms cannot be submitted without enabling the reCAPTCHA service. Please <a data-bs-dismiss="modal" onclick="klaro.show(window.consentFriendConfig, { modal: true });return false;">enable</a> the service in the settings. Alternatively, you can send us an <a href="mailto:[[++emailsender]]">email</a>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
```

