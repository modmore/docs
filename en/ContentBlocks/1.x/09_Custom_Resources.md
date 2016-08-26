---
title: ContentBlocks on Custom Resources
---

As of ContentBlocks 1.1 it is possible to use it on a variety of custom resource types.

Once we have independently confirmed that third party custom resources work as expected with ContentBlocks, we will include it in the `contentblocks.accepted_resource_types` system setting so it is enabled by default. It is possible to manually add class keys to this setting if you want to test it with a resource type that we have not yet confirmed, or disable using ContentBlocks on certain resource types.

## Supported Custom Resource Types

The following Extras are known to work with ContentBlocks and enabled by default as of 1.1.0:

- MoreGallery
- [SimpleCart](http://modxsimplecart.com/) (as of v2.1.1)
- [Articles](http://rtfm.modx.com/extras/revo/articles) (as of v1.7.7)
- [GoodNews](http://www.bitego.com/extras/goodnews/)
- [Collections](http://modx.com/extras/package/collections)
- [GridClassKey](http://modx.com/extras/package/gridclasskey)

Of course ContentBlocks also works well with the built-in Document type.

## Implementing ContentBlocks Support

To get ContentBlocks working with your Custom Resource Type, it's important to understand that ContentBlocks is built to grab the old content field, get rid of it, and then instantiating the ContentBlocks canvas in its place. The most important bit here is that it has to be able of locating the Content field.

If your custom resource type is built to mimic (or perhaps even inherit) the default Resource panel, this should make it work out of the box and all you need to do is add your class\_key to the `contentblocks.accepted_resource_types` setting.

However if your custom resource type does not use the same (or similar) ExtJS to define the content field, you will need to tell ContentBlocks what to replace. We've made this as easy as possible. Simply add a `contentblocks_replacement` class to the div/wrapper that needs to be replaced. Yes, that's all you have to do.

The hard part is finding out what div to place the class on. If your resource type is loosely based on Articles, you could use the [Articles pull request](https://github.com/modxcms/Articles/pull/87) as example; in that case we added an `itemCls` option to the content textarea definition. This class is then added to the div that wraps the form item in ExtJS, which is what we want to replace.

Once you have the canvas working, it is possible to use CSS to change the ContentBlocks appearance. To do this, scope your CSS to `.contentblocks-wrapper.type_YOUR_CLASS_KEY` to make sure it ONLY applies to ContentBlocks in your own custom resource, and doesn't leak into other implementations. The `type_YOUR_CLASS_KEY` class will be set to a lowercase representation of your class\_key, for example `type_article` and `type_articlecontainer`. When ContentBlocks successfully loaded, it will also add a `.contentblocks_loaded` class to the body of the page; this can be used to target specific tweaks to the page only when your users use ContentBlocks. When changing the ContentBlocks appearance, please stick to the bare minimum changes and don't change the entire design. Keep it consistent with the normal implementation as much as possible.

If you need help figuring out the place to add the `contentblocks_replacement` class, or want to discuss styling tweaks you have in mind, please [contact us via support](mailto:support@modmore.com). If your extra is private, or not yet released, providing us with a MODX site with your custom resource set up is the fastest way to success. Providing us a transport package if you have one also works. If you need a ContentBlocks license to test your integration, please do let us know.
