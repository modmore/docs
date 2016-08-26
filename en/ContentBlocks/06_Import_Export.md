---
title: Importing & Exporting
---

Through the ContentBlocks component (under Components or Apps in the top navigation) it is possible to create an XML export of [Fields](Fields), [Layouts](Layouts) and [Templates](Templates).

## Exporting Data

To export all data, simply click the "Export" button in the Field, Layout or Template grid toolbar. After a quick confirmation of what is about to happen, the system will generate an XML file with all Field or Layouts and your browser should initiate the download.

Since ContentBlocks 1.3.0, it is also possible to export a single field, layout or template by right clicking it in the grid and choosing the Export option.

[![](https://assets.modmore.com/uploads/2015/12/contentblocks_export.png)](https://assets.modmore.com/uploads/2015/12/contentblocks_export.png)

## Importing Data

Importing from your XML Export is a bit more tricky, as you will need to determine the right import mode. To start off, click the Import button on the Fields or Layouts tab and choose the file from your local computer.

If you click the Import button on the Fields tab only Field records will be imported, and if you use the Import button on the Layouts tab only Layout records will be imported - regardless of the file its contents.

There are three import modes available, each with their own use cases and caveats:

1. **Insert** With the Insert mode, each of the fields or layouts will have their IDs unset during the import, which will cause them to essentially be appended to the existing fields or layouts. This has the benefit of being safe: there is no risk of breaking any existing content if there are only new fields/layouts being added. However, it does mean that (if your export contains similar data as what already exists) you will end up with duplicate fields.
2. **Overwrite** In Overwrite mode, before a new field or layout is created, the script will check a field/layout with the same ID as the current one. If it exists, it will be overwritten, but if it doesn't exist a new field/layout will be created. This compromise can limit the number of duplicates if your export is very similar to the existing data, however it does introduce the risk that unrelated fields are overwritten causing content issues. Example: if before the import the field with ID 5 was a snippet field, but after the import field ID is suddenly a heading field, the heading field wont know what to do with the data from the snippet field and that data will be lost on the next save.
3. **Replace** The most nuclear option, Replace first clears the Field or Layout table and then imports the data from the file, keeping all of the IDs as defined in the export file. This has the highest chance of breaking content but is in some cases the most appropriate option.

If you need help figuring out the right import mode for your situation, please don't hesitate to get in touch with [support@modmore.com](mailto:support@modmore.com).

[![](https://assets.modmore.com/uploads/2015/12/contentblocks_import.png)](https://assets.modmore.com/uploads/2015/12/contentblocks_import.png)