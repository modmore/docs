[TOC]

## Triggered on the **Column** instances:

- `add` with no data when the column is added to a layout. This happens while the layout is rendering.
- `change` is not currently triggered. If something does trigger it, the layout receives `column:change` with `{ column, changeData }`.
- `beforeInsertFieldModal` with data `{ body, canvas, layout, column }` when the modal is prepared to insert a field in this column. Also triggered on the layout and the canvas. (triggered by BlockCollection)

## Bubbling up from Blocks

- `block:add` with data `{ block, index }` when a block is added to the column. (triggered by BlockCollection)
- `block:change` with data `{ block, changeData }` when a block in the column has changed. `changeData` is the block [`change`](Block_Events) payload: `{ inputKey, valueKey, newValue, oldValue, inputStore, store }`. (triggered by Block)
- `block:remove` with data `{ block }` when a block is removed from the column. (triggered by BlockCollection)
- `block:move` with data `{ block, fromIndex, toIndex }` when a block is reordered inside this column. This is not bubbled to the layout or the canvas. (triggered by BlockCollection)
- `block:toolbar` with data `{ block, items }` when a block toolbar is rendered. (triggered by Block)
