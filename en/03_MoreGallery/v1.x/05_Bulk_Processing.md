MoreGallery 1.6 introduced bulk actions for activating (showing), deactivating (hiding) and removing images in a gallery.

Start by ticking the checkbox shown in the top right of images. When at least one image is selected, the bulk toolbar will show up at the bottom of your screen. 

The bulk toolbar looks like this:

![Bulk Toolbar](images/bulk-toolbar.jpg)

From left to right, these are the provided functions in the toolbar.

- Select all images
- Deselect all images (which also hides the bulk toolbar)
- Mark all selected images as active/visible
- Mark all selected images as inactive/hidden
- Remove all selected images

## Batching

When a bulk action is started, it sends a lot of requests to the server. To make sure you don't overload the server, this processing happens in batches. By default MoreGallery works with 3 batches, which means that the bulk actions are split into 3 groups.

Within each batch the images are processed sequentially, where the next one doesn't start processing until the previous one is done. With 3 batches, that means there are up to 3 requests waiting for a response from the server at any given time.

If you have a beefy server that can easily take more requests, or you have a lot of latency to the server, you can update the `moregallery.bulk_batches` system setting to a higher value to process the bulk action faster.
