[TOC]

## v1 Templates

ContentBlocks 1.x **Templates** let you define preset combinations of layouts and fields that editors could insert in one action via the Template Builder.

In v2, that preset is **starter blocks** on a layout column. Add an optional `blocks` array to a column in the layout JSON. When an editor inserts the layout, those blocks are created in the column, including any starting values and an optional locked state.

The preset belongs to that one layout. Choosing the layout in Add Layout inserts its blocks. v1 listed Templates as a separate choice and one Template could contain several layouts.

See [Starter blocks](../01_Configuring_Content/Layouts#starter-blocks) for the JSON shape. `data` is keyed by the block's input name, then by that input's store (usually `value`).

## v1 Default Templates (removed)

v1 Default Templates automatically inserted a predefined set of layouts and fields on new resources, chosen by rules. **There is no direct v2 equivalent yet.**

Starter blocks only fill a layout when an editor inserts it. They do not select content for a new or legacy resource.

## v1 default layout/field settings

Legacy system settings `contentblocks.default_layout`, `contentblocks.default_layout_part`, and `contentblocks.default_field` applied when no Default Template was found. These are v1 concepts and do not apply to v2 file-based configuration.
