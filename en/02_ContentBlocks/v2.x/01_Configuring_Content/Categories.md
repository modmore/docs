The `category` property on block and layout definitions groups items in the Add Content modal. You can use a single category, or specify an array of categories.

[TOC]

## Usage

**Single category:**

```json
{
    "title": "Image",
    "category": "Media",
    "inputs": { ... }
}
```

**Multiple categories:**

```json
{
    "title": "Snippet",
    "category": ["Dynamic", "Developer"],
    "inputs": { ... }
}
```

**Uncategorized:** omit `category` to list the block or layout under **Uncategorized** in the picker.

Category names are shown as-is in the manager. There is no separate category registry — use consistent naming across your definitions.

> If you add multiple categories to a single field or layout, it will appear in both categories. That's intentional.

## Editor perspective

Editors see categories as sidebar filters when adding blocks or layouts. For a plain-language guide, see [Finding Blocks](../User_Guide/Using_the_Canvas/Finding_Blocks).
