ClientConfig gives your client a user-friendly interface for making site wide changes, while you as the administrator set up the different options available to the end-user. 

Settings are available in chunks and templates with the familiar `[[++setting]]` tag for super easy implementation, and from snippets or third party code through the `$modx->getOption('key')` APIs.

Settings in ClientConfig with the same key as system or context settings will override those values. 

As of v2.0, ClientConfig also supports a [multi-context mode](Multiple_Contexts), which allows users to set values for each individual context. 

Important links:

- [Getting Started](Getting_started)
- [Github](https://github.com/modmore/ClientConfig), for bug reports, feature requests, and access to the full MIT-licensed source code.
- [ClientConfig on modmore.com](https://www.modmore.com/extras/clientconfig/).
- [ClientConfig on MODX.com](https://modx.com/extras/package/clientconfig).
