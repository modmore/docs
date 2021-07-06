_ConsentFriend_ has five different default themes, that can be enabled in the
[system settings](04_System_Settings.md).

The scss variables have changed with version 1.3.0 in the open source part of
Klaro. Sadly the changes are not backwards compatible. If you created an own
theme, you have to use the new color variables. Please check the display of the
consent popup after the update and after compiling the scss file for your site.

> If you want to create your own theme, you could import the file
`assets/components/consentfriend/scss/klaro.scss` in your scss workflow.
To disable the default styling of the modal afterwards, please set the system
setting consentfriend.js_url to
`/assets/components/consentfriend/js/web/consentfriend-no-css.js`.

**default (or empty)**

[![](img/default.png)](img/default.png)

**black**

[![](img/black.png)](img/black.png)

**dark**

[![](img/dark.png)](img/dark.png)

**light**

[![](img/light.png)](img/light.png)

**white**

[![](img/white.png)](img/white.png)