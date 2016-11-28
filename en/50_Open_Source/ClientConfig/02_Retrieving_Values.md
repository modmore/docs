After creating the settings and giving them a value, it's super easy to access the data. While the Settings are not actually stored as System Settings, you can access them in exactly the same way!

In templates, chunks or other front-end parts, simply call it as such: `[[++key]]` where "key" is the key you entered for the setting in the Admin.

In PHP, the settings are available through the `$modx->getOption('key')` APIs. 

Prior to v1.4, these values are made available through a plugin called on the OnHandleRequest event, so if you are also triggering a plugin on that event which needs the settings, make sure the ClientConfig plugin has a higher priority.

Connectors don't trigger the OnHandleRequest events, so if you want to access ClientConfig settings from a Processor before v1.4, you will need to call `$modx->invokeEvent('OnHandleRequest')` yourself - keep in mind this may have unintended side-effects from other plugins.