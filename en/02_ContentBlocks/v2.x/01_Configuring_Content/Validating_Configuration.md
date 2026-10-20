ContentBlocks ships JSON Schema definitions and a CLI validator for block, layout, and canvas configuration files. Use these tools while authoring or reviewing config changes to catch structural mistakes early.

[TOC]

## Quick start

From your MODX site root, validate the active config directory (the first valid path from `contentblocks.config_directories`):

```bash
php core/components/contentblocks/bin/contentblocks validate
```

To validate a specific directory or file instead:

```bash
php core/components/contentblocks/bin/contentblocks validate /path/to/config
php core/components/contentblocks/bin/contentblocks validate /path/to/blocks/text.jsonc
```

When no path is given, the CLI bootstraps MODX and reads `contentblocks.config_directories` the same way the manager does. Run the command from a directory where `config.core.php` can be found (typically your site root).

For full command syntax, flags, and exit codes, see the [CLI Reference](../07_Advanced/CLI_Reference).

## What gets validated

The validator checks each `.json` and `.jsonc` file against a JSON Schema located in `core/components/contentblocks/model/schema` for its type:

| Config type | Detected from path | Schema |
|-------------|-------------------|--------|
| Block | `.../blocks/...` | `block.schema.json` |
| Layout | `.../layouts/...` | `layout.schema.json` |
| Canvas | `.../canvas/...` | `canvas.schema.json` |

Validation covers:

- Required top-level structure (for example `title` on blocks, `columns` on layouts)
- Input wrapper shape (`type`, `width`, `properties`)
- Nested inputs inside repeaters and tabs
- Unknown or misspelled top-level keys

Config type can be forced with `--type=block|layout|canvas` but should be autodetected normally.

## Errors vs warnings

**Errors** indicate invalid JSON or schema violations. These must be fixed before the config is considered valid.

**Warnings** are issued for unknown input type or plugin names. Custom input types and plugins are allowed in ContentBlocks, so these are not rejected outright. A warning helps you spot typos (for example `texxt` instead of `text`).

Use `--strict` to treat warnings as failures. This is useful in CI pipelines where you want zero ambiguity.

## Example output

```
OK  /path/to/config/blocks/text.json (block)
  No issues found.

INVALID  /path/to/config/layouts/broken.json (layout)
  ERROR [columns]: There must be a minimum of 1 items in the array (minItems)

OK  /path/to/config/blocks/custom.json (block)
  WARN [inputs.hero.type]: Unknown input type "hero-banner". Custom input types are allowed; verify the name is not a typo.
```

Machine-readable output is available with `--format=json`.

## JSON Schema files

Schema definitions live in the package at:

```
core/components/contentblocks/model/schema/
  block.schema.json
  layout.schema.json
  canvas.schema.json
  defs/
```

These schemas power both the CLI validator and IDE autocomplete.

## IDE autocomplete

Point your editor at the schemas to get key completion and inline validation while editing config files.

### Per-file `$schema` key

Add a `$schema` reference at the top of a config file:

```json
{
    "$schema": "../../model/schema/block.schema.json",
    "title": "My Block"
}
```

Adjust the relative path based on where your config file lives.

### VS Code / Cursor workspace settings

Add to `.vscode/settings.json` in your project:

```json
{
    "json.schemas": [
        {
            "fileMatch": ["**/blocks/*.{json,jsonc}"],
            "url": "./core/components/contentblocks/model/schema/block.schema.json"
        },
        {
            "fileMatch": ["**/layouts/*.{json,jsonc}"],
            "url": "./core/components/contentblocks/model/schema/layout.schema.json"
        },
        {
            "fileMatch": ["**/canvas/*.{json,jsonc}"],
            "url": "./core/components/contentblocks/model/schema/canvas.schema.json"
        }
    ]
}
```

For user-level settings (outside the workspace), use absolute `file://` URLs to the schema files on disk.

### PhpStorm / JetBrains

Open **Settings | Languages & Frameworks | Schemas and DTDs | JSON Schema Mappings** and add one mapping per config type. Set **Schema version** to **JSON Schema version 7**. File path patterns are relative to the project root (your MODX site root). Add `.json` and `.jsonc` as separate patterns.

| Name | Schema file | File path patterns |
|------|-------------|--------------------|
| ContentBlocks Block | `core/components/contentblocks/model/schema/block.schema.json` | `**/blocks/*.json`, `**/blocks/*.jsonc` |
| ContentBlocks Layout | `core/components/contentblocks/model/schema/layout.schema.json` | `**/layouts/*.json`, `**/layouts/*.jsonc` |
| ContentBlocks Canvas | `core/components/contentblocks/model/schema/canvas.schema.json` | `**/canvas/*.json`, `**/canvas/*.jsonc` |

To share the mappings with the project, add `.idea/jsonSchemas.xml`:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<project version="4">
  <component name="JsonSchemaMappingsProjectConfiguration">
    <state>
      <map>
        <entry key="ContentBlocks Block">
          <value>
            <SchemaInfo>
              <option name="name" value="ContentBlocks Block" />
              <option name="relativePathToSchema" value="core/components/contentblocks/model/schema/block.schema.json" />
              <option name="schemaVersion" value="JSON Schema version 7" />
              <option name="patterns">
                <list>
                  <Item>
                    <option name="pattern" value="true" />
                    <option name="path" value="**/blocks/*.json" />
                    <option name="mappingKind" value="Pattern" />
                  </Item>
                  <Item>
                    <option name="pattern" value="true" />
                    <option name="path" value="**/blocks/*.jsonc" />
                    <option name="mappingKind" value="Pattern" />
                  </Item>
                </list>
              </option>
            </SchemaInfo>
          </value>
        </entry>
        <entry key="ContentBlocks Layout">
          <value>
            <SchemaInfo>
              <option name="name" value="ContentBlocks Layout" />
              <option name="relativePathToSchema" value="core/components/contentblocks/model/schema/layout.schema.json" />
              <option name="schemaVersion" value="JSON Schema version 7" />
              <option name="patterns">
                <list>
                  <Item>
                    <option name="pattern" value="true" />
                    <option name="path" value="**/layouts/*.json" />
                    <option name="mappingKind" value="Pattern" />
                  </Item>
                  <Item>
                    <option name="pattern" value="true" />
                    <option name="path" value="**/layouts/*.jsonc" />
                    <option name="mappingKind" value="Pattern" />
                  </Item>
                </list>
              </option>
            </SchemaInfo>
          </value>
        </entry>
        <entry key="ContentBlocks Canvas">
          <value>
            <SchemaInfo>
              <option name="name" value="ContentBlocks Canvas" />
              <option name="relativePathToSchema" value="core/components/contentblocks/model/schema/canvas.schema.json" />
              <option name="schemaVersion" value="JSON Schema version 7" />
              <option name="patterns">
                <list>
                  <Item>
                    <option name="pattern" value="true" />
                    <option name="path" value="**/canvas/*.json" />
                    <option name="mappingKind" value="Pattern" />
                  </Item>
                  <Item>
                    <option name="pattern" value="true" />
                    <option name="path" value="**/canvas/*.jsonc" />
                    <option name="mappingKind" value="Pattern" />
                  </Item>
                </list>
              </option>
            </SchemaInfo>
          </value>
        </entry>
      </map>
    </state>
  </component>
</project>
```

For IDE-wide mappings (outside the project), use the absolute path of each schema file in **Schema file or URL**.

## Manager component

> The manager component is experimental and may change drastically or be removed before or during beta.

The ContentBlocks manager component (Extras → Content Blocks) provides a companion UI for the file-based config workflow:

- **Overview** — config path, definition counts, validation summary, orphan keys, missing templates
- **Blocks / Layouts / Canvas** — browse definitions, edit JSON and templates, create, duplicate, rename, and delete files
- **Usage** — see how often block and layout keys are used across canvas content
- **Tools** — validate all definitions, rebuild resource output, open `contentblocks.*` system settings

Disk remains the source of truth. The manager writes directly to the resolved config directory from `contentblocks.config_directories`. Git-based workflows and IDE editing remain fully supported.

Validation in the manager uses the same `ConfigValidator` rules as the CLI. Use **Validate (strict)** in Tools to treat unknown input/plugin warnings as failures.

## Related

- [Config Directories](Config_Directories) — where configuration files are loaded from
- [CLI Reference](../07_Advanced/CLI_Reference) — full command documentation
