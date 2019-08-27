Once installed, Redactor automatically enhances the standard content field with the rich text editor. 

To change the configuration set that is used for the content, go to the system settings and add the configuration set ID to the `redactor.configuration_set` setting.

[TOC]

## Context overrides

You can set different configuration sets per context. To do this, create a context setting with key `redactor.configuration_set` and provide it the ID of the configuration set you want to use in that context.

## Editor not showing

Redactor uses a couple of factors to determine if the editor should be shown. If you're not seeing the editor, or if you want to prevent the editor in certain cases, check these options.

- Make sure the `use_editor` system setting is enabled.
- Make sure the `which_editor` system setting is enabled. (If you want to disable editors globally, or use a different editor for the content, you can use the [Redactor template variable](Template_Variables) which will work regardless of this setting)
- On specific resources, make sure `Rich text` is checked on the resource settings tab.
 