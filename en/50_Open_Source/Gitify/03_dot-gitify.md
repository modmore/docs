---
title: .gitify file
---

To define what to export, to where and how, we're using a `.gitify` file formatted in YAML. This file is located in the root of the project. 


_As of Gitify v2.0.1-pl, it's possible to specify a different YAML config file to use with the `--dotfile` option, when used with the `build` or `extract` commands._
```
gitify extract --dotfile=.myconfigfile
```

An example `.gitify` may look like this:

````
data_directory: _data/
backup_directory: _backup/
data:
    contexts:
        class: modContext
        primary: key
    context_settings:
        class: modContextSetting
        primary:
            - context_key
            - key
    content:
        type: content
        exclude_keys:
            - editedby
            - editedon
    categories:
        class: modCategory
        primary: category
        truncate_on_force:
            - modCategoryClosure
    templates:
        class: modTemplate
        primary: templatename
        extension: .html
    template_variables:
        class: modTemplateVar
        primary: name
    template_variables_access:
        class: modTemplateVarTemplate
        primary:
            - tmplvarid
            - templateid
    chunks:
        class: modChunk
        primary: name
        extension: .html
    snippets:
        class: modSnippet
        primary: name
        extension: .php
    plugins:
        class: modPlugin
        primary: name
        extension: .php
    plugin_events:
        class: modPluginEvent
        primary:
            - pluginid
            - event
    events:
        class: modEvent
        primary: name
    namespaces:
        class: modNamespace
        primary: name
    system_settings:
        class: modSystemSetting
        primary: key
        where:
            - 'editedon:!=': '0000-00-00 00:00:00'
        exclude_keys:
            - editedon
    extension_packages:
        class: modExtensionPackage
        primary: namespace
        exclude_keys:
            - created_at
            - updated_at
    fc_sets:
        class: modFormCustomizationSet
        primary: id
    fc_profiles:
        class: modFormCustomizationProfile
        primary: id
    fc_profile_usergroups:
        class: modFormCustomizationProfileUserGroup
        primary:
            - usergroup
            - profile
    fc_action_dom:
        class: modActionDom
        primary:
            - set
            - name
    mediasources:
        class: modMediaSource
        primary: id
    mediasource_elements:
        class: sources.modMediaSourceElement
        primary:
            - source
            - object_class
            - object
            - context_key
    dashboards:
        class: modDashboard
        primary:
            - id
            - name
    dashboard_widgets:
        class: modDashboardWidget
        primary: id
    dashboard_widget_placement:
        class: modDashboardWidgetPlacement
        primary:
            - dashboard
            - widget
````

The `.gitify` file structure is real simple. There are root nodes for `data_directory` (the relative path where to store the files), `backup_directory`, `data` and `packages`. 

`data` contains an array of what we call "Partitions". These partitions are basically the name of the directory that holds all the files of that type, and can also be used in the `Gitify extract` and `Gitify build` commands. Each partition specifies either a `type` that has special processing going on (only `content` is available as type currently), or a `class` which specified the xPDOObject derivative that you want to use. The `primary` field determines the key to use in the name of the generated files. This defaults to `id`, but in many cases you may want to use the `name` as that is more human friendly. The primary is used for the file names and is also related to the automatic ID conflict resolution.

By default files will be created with a `.yaml` extension, but if you want you can override that with a `extension` property. This can help with syntax highlighting in IDEs.

Each partition can also specify a `where` property. This contains an array which can be turned into a valid xPDO criteria. 

When using GitifyWatch, there is also an `environments` root node in the gitify file, refer to the GitifyWatch documentation for more about that. 

### Third party packages (models)

When a certain class is not part of the core models, you can define a `package` as well. This will run `$modx->addPackage` before attempting to load the data. The path is determined by looking at a `[package].core_path` setting suffixed with `model/`, `[[++core_path]]components/[package]/model/`or a hardcoded `package_path` property. For example, you could use the following in your `.gitify` file to load [ContentBlocks](http://modmo.re/cb) Layouts &amp; Fields:

```` 
data:
    cb_fields:
        class: cbField
        primary: name
        package: contentblocks
    cb_layouts:
        class: cbLayout
        primary: name
````

As it'll load the package into memory, it's only required to add the package once. For clarify, it can't hurt to add it to each `data` entry that uses it.

### Dealing with Closures

A Closure is a separate table in the database that a core or third party extra may use to keep information about a hierarchy in a convenient format. These are often automatically generated when creating a new object, which can result in a error messages and other issues when building, especially with the `--force` flag. 

To solve this, a `truncate_on_force` option was introduced in v0.6.0 that lets you define an array of class names that need their tables truncated on a force build. Truncating the closure table(s) before a forced build ensures that the model can properly create the rows in the closure table, without throwing errors.

Here are two examples of using `truncate_on_force`:

````
data:
    categories:
        class: modCategory
        primary: category
        truncate_on_force:
            - modCategoryClosure

    quip_comments:
        class: quipComment
        package: quip
        primary: [thread, id]
        truncate_on_force: 
            - quipCommentClosure
````

### Composite Primary Keys

When an object doesn't have a single primary key, or you want to get fancy with file names, it's possible to define a composite primary key, by setting the `primary` attribute to an array. For example, like this:

````
data:
    chunks:
        class: modChunk
        primary: [category, name]
        extension: .html
````

That would grab the category and the name as primary keys, and join them together with a dot in the file name. This is a pretty bad example, and you shouldn't really use it like this.

### Install MODX Packages

You can also define packages to install with the `Gitify package:install --all` command. This uses the following format

````
packages:
        modx.com:
            service_url: http://rest.modx.com/extras/
            packages:
                - ace
                - wayfinder
        modmore.com:
            service_url: https://rest.modmore.com/
            credential_file: '.modmore.com.key'
            packages:
                - clientconfig
````

When a provider needs to be authenticated, like modmore.com the example above, you can provide a `credential_file` option which points to a file name. This file needs to contain a `username` and `api_key` value (in YAML format), like so:

````
username: my_api_key_username
api_key: some_api_key_password
````

Alternatively, you can also define the username and api_key directly on the provider information in the .gitify file, but the credential_file approach is recommended to be able of keeping your authentication outside of the repository. 

For security, the key file needs to be kept out of the git repository using a .gitignore file, and you will also want to protect direct read access to it with your .htaccess file or keeping it out of the webroot.

To install the packages that you added to the `packages` entry in the .gitify file, simply run the command `Gitify package:install --all`. That will attempt to install all packages that were mentioned, skipping any that are already installed. 