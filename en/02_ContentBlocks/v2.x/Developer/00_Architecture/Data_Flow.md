ContentBlocks is built around the manager UI and the data that comes from that.

There is also a PHP equivalent that can be used to generate or manipulate content *without* manually writing JSON or complex structures. To learn how to use that, see [Building Content in PHP](../03_Parser_and_Rendering/Building_Content_in_PHP)

## Data flow from the manager

1. Editor modifies canvas in the manager. This generates a big JSON array containing all canvas information, that is submitted to the server-side when the resource is saved.
2. The ContentBlocks plugin intercepts the save, loads the canvas from the database, reads the JSON, and calls `$canvas->updateContentFromJSON($data)` to do a full insert/update/remove cycle.
3. The final data is stored in `cbCanvas`, `cbCanvasLayout`, and `cbCanvasBlock`.
4. The `PublishingService` is called to update the next-publish-event timestamp in the cache, so that publishing automatically runs.
5. The content is parsed by the RenderService with the configured [Parsers](../03_Parser_and_Rendering/Parser), and stored to the resource content.
