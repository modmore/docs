Most v1 input types have a direct v2 equivalent. Key differences:

[TOC]

## Rich text

| v1 | v2 |
|----|-----|
| `use_tinyrte` property on text/textarea fields | [MiniRTE plugin](../03_Plugins/MiniRTE) on block configuration |
| Dedicated richtext input | [Richtext input](../02_Input_Types/Richtext) (unchanged concept) |

See [Rich Text Options](../01_Configuring_Content/Rich_Text_Options).

## Lists

| v1 | v2 |
|----|-----|
| `list` input type | [List input](../02_Input_Types/List) |
| `ordered_list` input type | [List input](../02_Input_Types/List) with `ordered` property |

## Removed or changed types

Some v1-only input types may not have a direct v2 built-in yet. Check the [Input Types](../02_Input_Types/index) catalog and plan custom inputs or alternative block designs.

## Snippets referencing field IDs

v1 snippets like `cbHasField` used numeric field IDs from the component. v2 block identification differs, as blocks are identified by their key (filename). Snippets will be updated during the beta.
