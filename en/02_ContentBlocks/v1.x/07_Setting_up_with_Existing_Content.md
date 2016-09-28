
If you're installing ContentBlocks on an existing site that already has content, there are a few things to keep in mind to make the transition as easy as possible.

If a resource was not edited with ContentBlocks before, it will default the canvas to the layout defined in the `contentblocks.default_layout` setting. This setting should contain the ID of a layout to use as a default, you can find the ID for a layout in the Component - it is in brackets after the name.

The default layout should probably be set to a full width layout so that existing content will take up the entire width.

Aside from the default layout, you can also set the default layout column. This should contain the reference of the column that the default/inherited content should be inserted to. You need to set this in the `contentblocks.default_layout_part` setting. With the `contentblocks.default_field` setting, you can also configure the default field to use - this would typically be a rich text or code field.

For finer control over the default content, you can also use [Default Templates](Default_Templates).