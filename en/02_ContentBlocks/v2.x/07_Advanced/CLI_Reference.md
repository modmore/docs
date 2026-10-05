---
title: CLI Reference
---

ContentBlocks includes a command-line utility at `core/components/contentblocks/bin/contentblocks`. Commands bootstrap MODX so they can read system settings and access package services.

[TOC]

## Requirements

- PHP 8.0 or higher
- A bootstrapped MODX site with `config.core.php` reachable from the working directory
- Composer dependencies installed in `core/components/contentblocks/` (`composer install`); installing the package will do this.

Run commands from your MODX site root, or from any directory where walking up the filesystem finds `config.core.php`.

## Invocation

```bash
php core/components/contentblocks/bin/contentblocks <command> [arguments] [options]
```

Show available commands:

```bash
php core/components/contentblocks/bin/contentblocks help
```

## Commands

### `validate`

Validate block, layout, and canvas JSON/JSONC configuration files.

```bash
php core/components/contentblocks/bin/contentblocks validate [path] [options]
```

| Argument / option | Description |
|-------------------|-------------|
| `path` | Optional. A file or directory to validate. When omitted, validates the active config directory from `contentblocks.config_directories`. |
| `--type=block\|layout\|canvas` | Force config type instead of detecting from the path. |
| `--strict` | Treat warnings as failures. |
| `--format=text\|json` | Output format. Default: `text`. |

**Behaviour**

- Accepts a single file (`.json` or `.jsonc`) or a directory (searched recursively).
- Detects config type from path segments: `blocks/`, `layouts/`, `canvas/`.
- Decodes JSONC (comments stripped) before validation.
- Validates structure against JSON Schema definitions in `core/components/contentblocks/model/schema/`.
- Warns on unknown input type and plugin names without failing (unless `--strict` is set).

**Examples**

```bash
# Validate active config (from contentblocks.config_directories)
php core/components/contentblocks/bin/contentblocks validate

# Validate a custom config directory
php core/components/contentblocks/bin/contentblocks validate /path/to/config

# Validate a single file
php core/components/contentblocks/bin/contentblocks validate /path/to/blocks/hero.jsonc

# Strict mode for CI (marks warnings as failure)
php core/components/contentblocks/bin/contentblocks validate --strict

# JSON output for tooling
php core/components/contentblocks/bin/contentblocks validate --format=json
```

**Exit codes**

| Code | Meaning |
|------|---------|
| `0` | All files valid (no errors; warnings allowed unless `--strict`) |
| `1` | One or more files invalid, MODX bootstrap failed, or no config path found |

**Text output**

Each file is printed on its own line with a status prefix (`OK` or `INVALID`), followed by errors and warnings indented beneath:

```
OK  /path/to/blocks/text.json (block)
  No issues found.

INVALID  /path/to/layouts/broken.json (layout)
  ERROR [columns]: There must be a minimum of 1 items in the array (minItems)
```

**JSON output**

With `--format=json`, the command prints a single JSON object:

```json
{
    "strict": false,
    "results": [
        {
            "file": "/path/to/blocks/text.json",
            "type": "block",
            "valid": true,
            "errors": [],
            "warnings": []
        }
    ]
}
```

When `--strict` is enabled, each result's `valid` field will turn to false when there are warnings as well.

### `help`

Print usage information and exit with code `0`.

## MODX bootstrap

The CLI initializes MODX in the `web` context and loads the ContentBlocks service. This is required for commands that read `contentblocks.config_directories` or other system settings.

If `config.core.php` cannot be found, commands that need MODX will fail with an error message. Pass an explicit path to `validate` if you want to check files without relying on MODX configuration.

## Extensibility

The CLI is structured as a small command router (`Application`) with individual command classes. Additional utilities can be registered alongside `validate` in future releases.

## Related

- [Validating Configuration](../01_Configuring_Content/Validating_Configuration) — practical guide for validating config files and IDE setup
- [Config Directories](../01_Configuring_Content/Config_Directories) — how config paths are resolved
