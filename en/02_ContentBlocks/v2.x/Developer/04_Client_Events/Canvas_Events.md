[TOC]

## Events triggered on the Canvas:

- `render` with no data when the canvas is first rendered on the page.
- `focus` with no data when focus enters or leaves the canvas. The block and layout that become active also fire their own `focus` event. See [Block Events](Block_Events) and [Layout Events](Layout_Events).
- `change` with no data when any content change has happened in the canvas. This fires after `layout:add`, `layout:change`, `layout:remove`, `column:add`, `column:change`, `column:remove`, `block:add`, `block:change`, and `block:remove`. It does not include the original event data.

## Bubbling up from Layouts

- `layout:add` with data `{ layout, index }` when a layout is added. `index` is `-1` when the layout is appended. (triggered by LayoutCollection)
- `layout:change` with data `{ layout, changeData }` when a layout changes. `changeData` is the layout [`change`](Layout_Events) payload. Adding or removing a layout does not fire this event.
- `layout:remove` with data `{ layout, index }` when a layout is removed. `index` is the position it was removed from. (triggered by LayoutCollection)
- `layout:toolbar` with data `{ layout, items }` when a layout toolbar is rendered. `items` is the same array as the layout `toolbar` event.
- `layout:publishing:change` with data `{ layout, oldValue, newValue }`. Each value is `{ active, activate_on, deactivate_on }`.

## Bubbling up from Columns

- `column:add` with data `{ column }` when a column is added to a layout. Bubbled from the layout.
- `column:change` with data `{ column, changeData }` when a column fires `change`. Bubbled from the layout. Core does not currently fire a column `change`.

## Bubbling up from Blocks

- `block:add` with data `{ block, index }` when a block is added. `index` is `-1` when the block is appended. Bubbled from the column through the layout. Also fired when a block is moved into a different column.
- `block:change` with data `{ block, changeData }` when a block's value changes. `changeData` is the block [`change`](Block_Events) payload, normally `{ inputKey, valueKey, newValue, oldValue, inputStore, store }`. Bubbled from the column through the layout. Adding or removing a block does not fire this event.
- `block:remove` with data `{ block }` when a block is removed. Bubbled from the layout. Also fired for the source column when a block is moved to a different column. Reordering inside the same column does not fire this event.
- `block:toolbar` with data `{ block, items }` when a block toolbar is rendered. Bubbled from the column through the layout.

## Others

- `beforeInsertFieldModal` with data `{ body, canvas, layout, column }` allowing you to change the field modal contents before it is opened. The modal markup may change, so be conservative in your targeting. (triggered by BlockCollection)
- `beforeInsertLayoutModal` with data `{ body, canvas, index, layout }` allowing you to change the layout modal contents before it is opened. `index` is the insert position. `layout` is the layout the insert is anchored to, or `null` when the modal is opened from the canvas. Also triggered on that layout when it is set. The modal markup may change, so be conservative in your targeting. (triggered by LayoutCollection)
