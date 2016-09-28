New in Redactor 2 is our base urls plugin. It is enabled by default and is used to normalise image `src` attributes. It can be disabled with the `redactor.plugin_baseurls` setting, and the mode is configured with the `redactor.baseurls_mode` setting.

### Why use the Base URLs plugin?

When inserting an image, either through upload or selecting it from existing uploads, Redactor receives a url to the image from the media source. This url is built based on your media source configuration, but in most cases will contain the site base url.

If this base url is simply a single slash, meaning your MODX site is in the root of a domain, that is usually not a problem. The image will show up properly in the manager and also in the front-end without any further work.

But if you are developing a new site in a subfolder like /dev/, having images being inserted with the /dev/ folder in the url is not ideal - once the site goes live on the root of the domain, you'll need to go through every page on the site to fix that. In that case, you want to use a relative url to the image. That way you can more easily migrate the site to a different folder, but there is one issue: the images will be broken in the manager. Because relative image urls are, well, relative, the browser ends up requesting /manager/assets/images/... which is not where your images are.

Some other rich text editors use an iframe with a base path to combat these problems, but with the base url plugin in Redactor we've found a more flexible solution.

## What does it do?

It looks at the src attribute of all images in your content. Let's say it finds an image that points to `/dev/assets/uploads/image.png`. As you can see, this was uploaded in a dev site so the base url is `/dev/`.

What it does depends on the mode you have set in the redactor.baseurls\_mode setting:

- `relative` (default). In the manager panel, it will use the url including the base url. This way, the image is working in the manager. When viewing the source, or saving the content, it changes the src attribute to be relative. So the saved image url is then `assets/uploads/image.png`.
- `absolute`. In the manager panel, it will use the url including the base url. This way, the image works in the manager. For viewing the source and saving the content, it sets the src attribute to be absolute including the base url. So the saved image url is `/dev/assets/uploads/image.png`.
- `full`. Both the url in the manager and in the source view or when the page is saved are rewritten to be a full url, including the site url. So the image url might then be `localhost/dev/assets/uploads/image.png`
- `off` (or left empty). The base urls plugin does nothing, which probably breaks your images. Unless you have a very specific use case, we don't recommend disabling this plugin.

By default the baseurl plugin uses the relative mode. This is the most portable approach that makes moving a site easiest, while also making sure images show up properly at all times.
