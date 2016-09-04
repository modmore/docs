## Plugin Events

As of **MoreGallery 1.3.0** you can hook into various parts of the system using Plugin Events.

The available plugin events in MoreGallery are:

- **MoreGallery\_OnImageCreate** (`$id`, `$object`, `$mode`, `$resource`): fired when a new image is added to a gallery. `$mode` can be `mgImage::MODE_UPLOAD` or `mgImage::MODE_IMPORT`, `$object` is the mgImage object and `$resource` is the mgResource object.
- **MoreGallery\_OnImageRemove** (`$id`, `$object`): fired when an image is removed from the gallery. Look at `$object->get('resource')` if you need the resource id.
- **MoreGallery\_OnTagCreate** (`$id`, `$tag`, `$object`): fired when a new tag object has been created. This only happens the first time a particular tag is entered. If you need to know when any tag was added to a specific image, use the MoreGallery\_OnImageTagCreate event instead.
- **MoreGallery\_OnImageTagCreate** (`$id`, `$tag`, `$object`): fired when any tag is added to an image. The `$tag` variable contains a `mgTag` object (`$tag->get('display')` contains the actual tag), and `$object` is the `mgImageTag` relational object.
- **MoreGallery\_OnImageTagRemove** (`$id`, `$object`): fired when a tag is removed from an image.
