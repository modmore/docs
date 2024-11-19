---
title: Contextual Consent 
---

Contextual consent allows the website to obtain the consent of the users on
place. This is used to hide embedded YouTube videos and display a placeholder
with a consent button inside.

This function can be extended with the service setting 'Contextual Consent
Only'. If this setting is activated, the service cannot be directly activated
globally with the 'Accept All' workflow in the consent modal. The service is
still hidden by a placeholder, but a second button is displayed which allows the
user to activate the service globally.

The contextual consent feature cannot be disabled, but the consent placeholder
can be hidden by the following css rule:

```css
div[data-type="placeholder"] {
    display: none;
}
```
