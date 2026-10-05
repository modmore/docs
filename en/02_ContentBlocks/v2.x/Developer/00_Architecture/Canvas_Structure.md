[TOC]

## Client-side

The manager-side structure of a canvas is made up from the following core elements and collections:

- Canvas
  - LayoutCollection
    - Layout (many)
      - ColumnCollection
        - Column (many)
          - BlockCollection
            - Block (many)
              - BlockToolbar
              - Input (many)

Each of these can be found in js/core/Collections and js/core/Elements.

Descendent elements have references to the parents they belong to. For example, from a Block element you can access `this.Canvas` to get the canvas it belongs to, or `this.Column` to get to the column it is in.

Each element and collection has methods to manipulate its contents, as well as events.

## Server-side

On the server, you'll find PHP interfaces and implementing classes representing the main elements. The server-side does not have the dedicated Collection classes (just an internal array), but other than that maps directly to the way the Client-side builds content as well.

- `modmore\ContentBlocks\Elements\Canvas`
  - `modmore\ContentBlocks\Elements\Layout`
    - `modmore\ContentBlocks\Elements\Column`
      - `modmore\ContentBlocks\Elements\Block`

The database (xPDO) objects that match with these are `cbCanvas`, `cbCanvasLayout` (also containing columns), and `cbCanvasBlock`. **Generally, you should only ever interact with the `cbCanvas` directly, but not the `cbCanvasLayout` or `cbCanvasBlock`.**

To find out how to use these to generate or manipulate content from PHP, see [Building Content in PHP](../03_Parser_and_Rendering/Building_Content_in_PHP).
