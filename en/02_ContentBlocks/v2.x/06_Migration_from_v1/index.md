ContentBlocks 2 is a complete rewrite, not an in-place upgrade. You should plan for a migration path, rather than expecting a one-click update.

## Major changes

1. **File-based configuration** — blocks, layouts, and canvas settings move from the manager component to JSON files on disk.
2. **New database tables** — canvas data uses `cbCanvas`, `cbCanvasLayout`, and `cbCanvasBlock`.
3. **Twig templates** — front-end output uses `.twig` or `.tpl` files alongside JSON definitions.
4. **Terminology** — v1 "fields" become v2 "blocks".

## What was removed

- **Manager field/layout editor** as the source of truth (definitions are files)
- **Templates** (preset layout+field inserts via Template Builder) — no v2 equivalent yet, but that is something we will be exploring later in the beta.
- **Default Templates** — no v2 equivalent yet
- **Categories in the component** — use `category` on JSON definitions instead

## Migration approach

Hold off on migration until we provide migration tooling during the beta.

## In this section

- [Fields to Blocks](Fields_to_Blocks)
- [Input Type Changes](Input_Type_Changes)
- [Templates and Defaults](Templates_and_Defaults)
- [Database and Legacy Tables](Database_and_Legacy_Tables)
