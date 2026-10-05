[TOC]

## Triggered on the **Layout** instances:

- `focus` with no data when the layout becomes active. Moving focus between blocks in the same layout does not fire it again. (triggered by Canvas)
- `instanceid` with data `{ from, to }` when the ID for the layout changed. This happens when first saving the resource (or other canvas) that the layout was added on, and replaces the temporary ID (e.g. `new-ext-gen231`) with the permanent ID for the layout as saved in the database.
- `add` with no data when a layout is added to the canvas. (triggered by LayoutCollection)
- `change` when the layout changes. The data depends on what changed:
    - Title or instance id, from the layout store: `{ valueKey, newValue, oldValue }`
    - A layout setting input: `{ inputKey, valueKey, newValue, oldValue, inputStore }`
    - Lock: `{ inputKey: null, valueKey: "locked", newValue: { locked:true/false }, oldValue: { locked:true/false }, store }`
    - Publishing: `{ inputKey: null, valueKey: "publishing", newValue, oldValue, store }`, where the values are `{ active, activate_on, deactivate_on }`
    - Move: an empty object, fired after `move`. (triggered by LayoutCollection)
- `beforeRemove` with data `{ preventRemove: false }`. (triggered by LayoutCollection) The collection checks its own local flag after the event, so changing `preventRemove` on the data object does not cancel the remove.
- `remove` with no data when the layout has been removed. (triggered by LayoutCollection)
- `hide` with no data when the layout is collapsed. (triggered by Layout)
- `show` with no data when the layout is expanded again. (triggered by Layout)
- `move` with data `{ direction, newIndex }` when the layout was moved on the canvas. `direction` is `"up"` or `"down"`. (triggered by LayoutCollection)
- `toolbar` with data `{ items }` when the toolbar is rendered. Update (by reference) the provided items array to add, reorder, or remove toolbar items. Each item is an object with keys: `key` (unique id), `icon` (font awesome icon name), `text` (button text to show), `title` (hover title), `handler` (callable to handle clicks), `renderer` (callable that turns the item into a DOM element). (triggered by LayoutToolbar) Every layout toolbar is re-rendered when any layout is added, changed, or removed.

Slightly more advanced events:

- `beforeInsertFieldModal` with data `{ body, canvas, layout, column }` when the modal is prepared to insert a field on this layout. You can change the modal contents before it is opened. The modal markup may change, so be conservative in your targeting. Also triggered on the column and the canvas. (triggered by BlockCollection)
- `beforeInsertLayoutModal` with data `{ body, canvas, index, layout }` when the modal is opened from this layout's insert button. `layout` is this layout, and `index` is its position. Also triggered on the canvas. Opening the modal from the canvas insert button does not fire this on a layout, and `layout` is `null` there. (triggered by LayoutCollection)
- `locked:change` with data `{ layout, oldValue, newValue }`. Each value is `{ locked }`.
- `publishing:change` with data `{ layout, oldValue, newValue }`. Each value is `{ active, activate_on, deactivate_on }`. The canvas also receives `layout:publishing:change` with the same data.

## Bubbling up from Blocks

- `block:add` with data `{ block, index }` when a block is added to the layout. `index` is `-1` when the block is appended. Also fired when a block is moved in from another column. Bubbled from the column.
- `block:change` with data `{ block, changeData }` when a block in the layout has changed. `changeData` is the block [`change`](Block_Events) payload: `{ inputKey, valueKey, newValue, oldValue, inputStore, store }`. Bubbled from the column.
- `block:remove` with data `{ block }` when a block is removed from the layout. Also fired when a block is moved to another column. Reordering a block inside the same column does not fire this. (triggered by BlockCollection, and bubbled from the column)
- `block:toolbar` with data `{ block, items }` when a block toolbar in the layout is rendered. Bubbled from the column.

## Bubbling up from Columns

- `column:add` with data `{ column }` when a column is added. (triggered by ColumnCollection)
- `column:change` with data `{ column, changeData }` when a column fires `change`. Core does not currently fire this.
- `column:remove` is not currently triggered. Columns are created with the layout and are not removed on their own currently.
