ContentBlocks exposes element classes to provide a fluid PHP approach (`modmore\ContentBlocks\Elements\Canvas` and friends) to coding a page in PHP. That builds an in-memory tree that can be persisted to the database (using xPDO models `cbCanvas`, `cbCanvasLayout`, `cbCanvasBlock`) or rendered with the `RenderService`.

Instead of manually writing JSON, it's recommended to use this fluid API.

Use `toArray()` / `fromArray($cbCanvas, $data)` on Elements classes, or `cbCanvas::fromElementsCanvas()` / `toElementsCanvas()` to move between PHP objects and the database.

## Class map

| Layer | Namespace / location | Purpose |
|-------|----------------------|---------|
| Elements | `modmore\ContentBlocks\Elements\{Canvas,Layout,Column,Block}` | Programmatic tree building and rendering |
| Interfaces | `Elements\{Canvas,Layout,Column,Block}Interface` | Contracts for Elements classes |
| xPDO models | `cbCanvas`, `cbCanvasLayout`, `cbCanvasBlock` | Database persistence |
| Manager client | `assets/components/contentblocks/js/core/Elements/` | DOM, events, editor UX |

```
Canvas
  └── Layout (many)
        └── Column (many, keyed by reference)
              └── Block (many)
```

On the client, collections (`LayoutCollection`, `ColumnCollection`, `BlockCollection`) sit between the element classes and manage ordering, modals, and drag-and-drop. The PHP Elements layer has no collection classes; parents create children through `addLayout()`, `addColumn()`, and `addBlock()`.

Every Elements tree is bound to the database:

- `Canvas` requires a `cbCanvas` record
- `Layout` wraps a `cbCanvasLayout` and points at its parent canvas
- `Column` has no table; it points at its parent layout
- `Block` wraps a `cbCanvasBlock` and points at its parent column

New children get unsaved xPDO objects immediately. You can still render without calling `save()`.

## Building content for rendering

Use the Elements classes when you want HTML output — imports, migrations, CLI tools, or one-off generation.

```php
use modmore\ContentBlocks\Elements\Canvas;

/** @var \ContentBlocks $contentBlocks */
/** @var cbCanvas $cbCanvas */
$cbCanvas = $contentBlocks->getCanvas('modResource', $resourceId);
$renderService = $contentBlocks->getRenderService();

$canvas = new Canvas($cbCanvas);
$canvas->addLayout('full-width')
    ->setTitle('Hero section')
    ->addColumn('main')
    ->addBlock('richtext', ['text' => ['value' => '<p>Hello from PHP</p>']]);

$html = $canvas->generateOutput($renderService);
```

`addLayout()`, `addColumn()`, and `addBlock()` return the created child. Each element implements `generateOutput(RenderService $renderService)` so you can render at any level (single block, column, layout, or full canvas).

### Block data shape

Block `data` must match what input types produce on the client. Scalar inputs typically nest under their input key:

```php
// text input
['text' => ['value' => 'Hello']]

// richtext input
['body' => ['value' => '<p>Rich HTML</p>']]

// image input (simplified)
['image' => [
    'url' => '/assets/image.jpg',
    'relativeUrl' => 'assets/image.jpg',
    'width' => 800,
    'height' => 600,
]]
```

Check the block definition JSON and input type docs for the exact structure per input. Rendering does not validate data against definitions; missing keys surface as empty template variables.

Update block data after construction with `setData()`:

```php
$block = $column->addBlock('text');
$block->setData(['text' => ['value' => 'Updated']]);
```

### Publishing fields

Layouts and blocks support the same publishing properties as the manager:

| Property | PHP setter | Default |
|----------|------------|---------|
| `active` | `setActive(bool)` | `true` |
| `activate_on` | `setActivateOn(int)` | `0` (Unix timestamp) |
| `deactivate_on` | `setDeactivateOn(int)` | `0` |

`RenderService` skips elements where `isActive()` is `false`. It does **not** evaluate `activate_on` / `deactivate_on` against the current time at render time. Scheduled visibility is handled by `PublishingService`, which updates the stored `active` flag in the database. When building Elements in PHP for immediate render, set `active` to the effective value yourself.

## Content array format

Elements classes serialize to the same structure the manager uses for layouts and blocks, including instance IDs when set.

```json
{
  "id": 12,
  "layouts": [
    {
      "id": 45,
      "layout": "full-width",
      "title": "Hero section",
      "data": {},
      "active": true,
      "activate_on": 0,
      "deactivate_on": 0,
      "columns": {
        "main": {
          "blocks": [
            {
              "id": 101,
              "block": "text",
              "data": { "text": { "value": "Hello" } },
              "active": true,
              "activate_on": 0,
              "deactivate_on": 0
            }
          ]
        }
      }
    }
  ]
}
```

| Field | PHP API | Serialized key |
|-------|---------|----------------|
| Canvas ID | `getId()` from the `cbCanvas` record | `id` (optional on canvas root) |
| Layout/block instance ID | `getId()` / `hasId()` | `id` (`0` when unset, same as client) |
| Layout definition key | `setKey()` / `getKey()` | `layout` |
| Block definition key | `setKey()` / `getKey()` | `block` |
| Column structure | `$layout->addColumn('main')` | object keyed by column key |
| Layout title | `setTitle()` / `getTitle()` | `title` |
| Layout modal data | `setData()` / `getData()` | `data` |
| Block input data | `setData()` / `getData()` | `data` |

Column serialize output matches the client: `{ "blocks": [...] }` without a `reference` field. The column key lives on the parent layout's `columns` object. When deserializing a column payload on its own, pass the parent layout and the reference:

```php
Column::deserialize($layout, 'main', $columnJson);
Column::fromArray($layout, 'main', $columnData);
```

```php
$canvas = Canvas::fromArray($cbCanvas, $payload);
$payload = $canvas->toArray();
$json = $canvas->serialize();                     // json_encode(toArray())
$canvas = Canvas::deserialize($cbCanvas, $json);  // fromArray(json_decode())
```

Legacy payloads using `key` instead of `layout`/`block`, or column lists with `reference`, are still accepted by `fromArray()`.

### Editing a loaded canvas

Load the canvas, change an element you already hold, and call `save()` on that element. That writes only that row (and, for blocks, that block's repeater children). It does not delete siblings.

```php
/** @var cbCanvas $cbCanvas */
$cbCanvas = $contentBlocks->getCanvas('modResource', $resourceId);

$canvas = $cbCanvas->toElementsCanvas();
$block = $canvas->getLayouts()[0]['layout']->getColumns()[0]['blocks'][0];

$block->setData(['text' => ['value' => 'Updated copy']]);
$block->save();
```

Repeater row IDs live inside the parent block's `data.rows` arrays (same as the client).

To replace the entire canvas the way the manager does (create missing rows and delete anything absent from the payload), use `fromElementsCanvas()` / `updateContentFromJSON()`. **Always send the complete canvas state** unless you intend to delete sibling layouts or blocks.

## Repeaters

Include repeater rows in the parent block's `data` using the same shape the client sends:

```php
$column->addBlock('featured-list', [
    'title' => ['value' => 'Featured'],
    'items' => [
        'rows' => [
            [
                'block' => 'repeater-row',
                'data' => ['text' => ['value' => 'Row one']],
                'active' => true,
                'activate_on' => 0,
                'deactivate_on' => 0,
            ],
        ],
    ],
]);
```

- **Rendering** — nested `rows` in block data work directly; the parent tree still needs a `cbCanvas`, but you do not have to call `save()`.
- **Persistence** — `Block::save()`, `cbCanvas::fromElementsCanvas()`, and `updateContentFromJSON()` pass repeater rows to `RepeaterBlockService`, which stores child rows as individual `cbCanvasBlock` records with `parent_block` and `repeater_key`.
- **Loading** — `cbCanvas::toElementsCanvas()` hydrates child rows back into nested `data`.

## Database models

### cbCanvas

| Field | Description |
|-------|-------------|
| `principal_type` | Owner class, e.g. `modResource` |
| `principal_id` | Owner ID |
| `principal_field` | TV/resource field name, usually `content` |
| `graph` | Reserved for future use; not read or written today |

Access via `$contentBlocks->getCanvas('modResource', $resourceId, 'content')`.

### cbCanvasLayout

| Field | Description |
|-------|-------------|
| `canvas` | Parent canvas ID |
| `layout_key` | Definition key from `layouts/*.json` |
| `position` | 0-based order on the canvas |
| `title` | Custom layout title from the manager |
| `data` | Layout modal input values (array) |
| `active`, `activate_on`, `deactivate_on` | Publishing state |

### cbCanvasBlock

| Field | Description |
|-------|-------------|
| `canvas`, `layout` | Parent references |
| `column_key` | Column from layout definition |
| `position` | Order within the column |
| `block_key` | Definition key from `blocks/*.json` |
| `data` | Input values (array); repeater rows are stripped on save |
| `parent_block`, `repeater_key` | Repeater row linkage (child blocks) |
| `active`, `activate_on`, `deactivate_on` | Publishing state |

## Loading and saving

### Render from a stored canvas

```php
/** @var cbCanvas $canvas */
$canvas = $contentBlocks->getCanvas('modResource', $resourceId);
$html = $canvas->generateOutput($contentBlocks->getRenderService());
```

Internally, `cbCanvas::toElementsCanvas()` wraps the canvas record and its layout/block rows in Elements classes (including repeater hydration) and passes the result to `RenderService`.

### Persist a single element

```php
$canvas = $cbCanvas->toElementsCanvas();
$layout = $canvas->addLayout('full-width');
$block = $layout->addColumn('main')->addBlock('text', ['text' => ['value' => 'Hello']]);
$layout->save(); // new layout row; does not save child blocks
$block->save(); // new block row, FKs from parents
```

`save()` writes only that record. A new block first saves its canvas and layout if those rows do not exist yet. Columns have no table and no `save()` method.

### Persist an Elements tree

```php
/** @var cbCanvas $canvas */
$canvas = $contentBlocks->getCanvas('modResource', $resourceId);

$response = $canvas->fromElementsCanvas($elementsCanvas);
// $response tracks added/updated/removed layout and block IDs
```

`fromElementsCanvas()` syncs through the same ID-based upsert path as the manager save, including deletes. Use per-element `save()` when you only want to write the rows you changed.

### Duplicate a canvas

```php
$copy = $sourceCanvas->duplicate();
```

Copies all layouts and blocks (including repeater children) into a new `cbCanvas` record via the Elements round-trip. You will need to update the canvas principal values manually.

### Conversion paths

| Direction | Method |
|-----------|--------|
| Elements → array | `$canvas->toArray()` |
| array → Elements | `Canvas::fromArray($cbCanvas, $data)` |
| Database → Elements | `$cbCanvas->toElementsCanvas()` |
| One element → Database | `$layout->save()` / `$block->save()` |
| Elements → Database (full upsert) | `$cbCanvas->fromElementsCanvas($canvas)` |
| Elements → HTML | `$canvas->generateOutput($renderService)` |
| Database → manager JSON | `$cbCanvas->getContentAsJSON()` |
| manager JSON → Database | `$cbCanvas->updateContentFromJSON($json)` |

## Limitations

- **Publishing is scheduled at render time** — `RenderService` checks `active` only. Run `PublishingService::syncCanvasPublishingState()` on stored canvases, or set `active` yourself when building Elements for immediate output.
- **No definition validation** — Elements classes do not verify that layout, block, or column keys exist in config.
- **`cbCanvas.graph`** — reserved; not used yet.
- **`Canvas::getLayouts()` return shape** — returns enriched entries `[['layout' => ..., 'key' => ..., 'data' => ...]]` for `RenderService`, not bare layout objects.

## API reference (Elements)

### Canvas / Elements\CanvasInterface

- `__construct(cbCanvas $record)`
- `getRecord(): cbCanvas` / `getId(): ?int` / `save(): bool`
- `addLayout(string $key = '', ?int $position = null): LayoutInterface`
- `getLayouts(): array` — enriched entries for rendering
- `toArray(): array` / `fromArray(cbCanvas $record, array $data): CanvasInterface`
- `generateOutput(RenderService $renderService): string`
- `serialize(): string` / `deserialize(cbCanvas $record, string $serialized): CanvasInterface`

### Layout / LayoutInterface

- `getParent(): CanvasInterface` / `getRecord(): cbCanvasLayout`
- `getId(): int|string|null` / `hasId(): bool` / `save(): bool`
- `setKey(string)` / `getKey(): string`
- `setTitle(?string)` / `getTitle(): ?string`
- `setData(array)` / `getData(): array`
- `setActive()`, `setActivateOn()`, `setDeactivateOn()` / matching getters
- `addColumn(string $reference): ColumnInterface`
- `getColumns(): array`
- `toArray(): array` / `fromArray(CanvasInterface $canvas, array $data): LayoutInterface`
- `generateOutput()`, `serialize()`, `deserialize(CanvasInterface $canvas, string $serialized)`

### Column / ColumnInterface

- `__construct(LayoutInterface $parent, string $reference)`
- `getParent(): LayoutInterface` / `getReference(): string`
- `addBlock(string $key = '', array $data = [], ?int $position = null): BlockInterface`
- `getBlocks(): BlockInterface[]`
- `toArray(): array` / `fromArray(LayoutInterface $layout, string $reference, array $data): ColumnInterface`
- `serialize(): string` / `deserialize(LayoutInterface $layout, string $reference, string $serialized): ColumnInterface`
- `generateOutput()`
- No `save()` — columns are not stored as rows

### Block / BlockInterface

- `getParent(): ColumnInterface` / `getRecord(): cbCanvasBlock`
- `getId(): int|string|null` / `hasId(): bool` / `save(): bool`
- `setKey(string)` / `getKey(): string`
- `setData(array)` / `getData(): array`
- `setActive()`, `setActivateOn()`, `setDeactivateOn()` / matching getters
- `toArray(): array` / `fromArray(ColumnInterface $column, array $data): BlockInterface`
- `generateOutput()`, `serialize()`, `deserialize(ColumnInterface $column, string $serialized)`

## See also

- [Parser](Parser) — template resolution and `RenderService` behavior
- [Canvas Structure](../00_Architecture/Canvas_Structure) — client-side element hierarchy
- [Data Flow](../00_Architecture/Data_Flow) — save and render pipelines
- [Publishing plugin](../../03_Plugins/Publishing) — scheduled visibility in the manager
