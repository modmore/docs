The page you're currently looking at contains information related to Redactor 1.x. Please visit [Images and Base URLs](../v2.x/Images_and_Base_URLs) for the relevant information for Redactor 2.x.

---

Using Redactor is straightforward and usually doesn't require any manual work other than purchasing and installing the package. However, when you have been managing content with TinyMCE (or other editors like CKEditor) before, you may experience issues with images not being displayed in the editor.

### Problem & Cause

TinyMCE (and CKEditor) use an iframe for the editor, and in that iframe it loads the various files. It also sets a base path tag, pointing to the root of the MODX install (site\_url). While this is fine, the problem occurs when you insert an image. TinyMCE assumes its editor will have that base path set, and places image urls relative to that base path (for example, TinyMCE would insert `<img src="assets/uploads/foo.png" />`).

This is where the problem comes from, as Redactor does _not_ use this base path tag and by default doesn't use an iframe either. As a result, the relative images inserted with TinyMCE are loaded as if they are relative to the manager url. This results in broken images.

When you insert images with Redactor, it uses the [media source and upload path configuration](Using_Media_Sources) to fetch the url to an image. This results in absolute urls, like so: `<img src="/assets/uploads/foo.png">` and makes sure the image works both in the manager and front-end.

### Solution

First of all, start using Redactor as soon as possible! ;) Taking advantage of the media source enabled uploads to get it right the first time is the best way to prevent issues.

There are two ways to resolve the issues in the manager.

#### 1. Change to iframe mode

Iframe mode, available since Redactor 1.1, places the editor in an iframe instead of directly on the page. As of Redactor 1.2 the iframe also sets a base tag (like TinyMCE and CKEditor do), pointing all relative assets to the relative root of the site. This means that even urls like assets/uploads/foo.png work. (Note: prior to Redactor 1.2, the iframe mode did not set the base tag, so be sure you use 1.2 or up).

To enable iframe mode, go to the System Settings for Redactor, and set the redactor.iframe setting to true.

#### 2. Fix all upload paths

If you want to quickly change all relative (`assets/uploads/foo.png`) into absolute (`/assets/uploads/foo.png`) images, you can execute the following SQL query on your database using the command line or your favourite database management tool. This will replace all instances of `src="assets` with `src="/assets`, fixing the relative paths.

````
UPDATE modx_site_content SET content = replace(content, 'src="assets', 'src="/assets');
````

This SQL assumes that all your images are placed inside the assets folder, but if it's not you can adjust the query accordingly.

If similar problems exist with file links, you can run the following SQL as well:

````
UPDATE modx_site_content SET content = replace(content, 'href="assets', 'href="/assets');
````

And the same can be done for rich text or Redactor TVs:

````
UPDATE modx_site_tmplvar_contentvalues SET value = replace(value, 'src="assets', 'src="/assets') WHERE tmplvarid IN (ids, of, your, richtext, tvs);
UPDATE modx_site_tmplvar_contentvalues SET value = replace(value, 'href="assets', 'href="/assets') WHERE tmplvarid IN (ids, of, your, richtext, tvs);
````

Be sure to change the "ids, of, your, richtext, tvs" to the actual IDs of the template variables. (Thanks Bert Oost for providing these examples)