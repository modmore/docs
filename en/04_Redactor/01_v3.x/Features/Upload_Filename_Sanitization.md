On upload, Redactor will sanitize file names to make sure they're clean. 

This uses a few system settings:

- `redactor.sanitize_pattern`, contains a REGEX pattern of acceptable characters. Defaults to `/([[:alnum:]_\.-]*)/`
- `redactor.sanitize_replace` contains the value invalid characters are replaced with, defaults to `_`
- `redactor.translit` can be set to a transliteration strategy. `iconv` is included; others can be enabled with a third party package such as [Translit](https://modx.com/extras/package/translit). If you've configured the MODX core `translit` setting, you can leave `redactor.translit` empty to inherit the same configuration.
- `redactor.translit_class`
- `redactor.translit_class_path`

To disable file name cleaning (which is not recommended unless you use a separate implementation), disable _Clean filenames_ in the Media - Uploads section of the configurator.
