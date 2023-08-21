After installation, a MODX resource contains a new Translate button. This button
opens a menu for translating the resource.

[![](img/buttons.png)](img/buttons.png)

The first section of the menu contains (if available) all linked babel contexts
and provides a translation from the context language set with the context
setting `cultureKey`.

The second section of the menu contains a menu entry, that shows the usage
status of the DeepL API.

[![](img/status.png)](img/status.png)

## Available Languages

The source language list is created by linked Babel resources and their
`cultureKey` setting. The target language is set with the `cultureKey` setting
of the current resoures context.

The following source and target languages are currently available:

### Source Languages 

`bg`, `cs`, `da`, `de`, `el`, `en`, `es`, `et`, `fi`, `fr`, `hu`, `id`, `it`,
`ja`, `ko`, `lt`, `lv`, `nb`, `nl`, `pl`, `pt`, `ro`, `ru`, `sk`, `sl`, `sv`,
`tr`, `zh`

### Target Languages

`bg`, `cs`, `da`, `de`, `el`, `en-GB`, `en-US`, `es`, `et`, `fi`, `fr`, `hu`,
`id`, `it`, `ja`, `ko`, `lt`, `lv`, `nb`, `pl`, `pt-PT`, `pt-BR`, `ro`, `ru`,
`sk`, `sl`, `sv`, `tr`, `zh`

If the target language has multiple dialects, the first dialect in the above
list is automatically selected. If, for example, translation to `en-US` is
required, then this can be specified in an additional context setting
`translationKey`.
