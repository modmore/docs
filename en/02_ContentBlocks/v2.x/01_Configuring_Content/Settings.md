ContentBlocks system settings are managed in _System_ → _System Settings_. Filter by `contentblocks` to see all options.

> @TODO: evaluate settings for 2.0 build and update

[TOC]

## Core

| Setting | Description |
|---------|-------------|
| `contentblocks.config_directories` | Comma-separated directories for block, layout, and canvas JSON. First existing path wins. Supports `{core_path}` and `{base_path}`. |
| `contentblocks.disabled` | Set to `1` to disable ContentBlocks site-wide. Can be overridden per context. |
| `contentblocks.debug` | Use non-minified JavaScript in the manager for debugging. |
| `contentblocks.accepted_resource_types` | Comma-separated resource class keys ContentBlocks enhances (e.g. `modDocument`). |
| `contentblocks.show_resource_option` | Show "Use ContentBlocks" toggle on individual resources. |
| `contentblocks.canvas_position` | Where to place the canvas: `inherit`, `block`, `tab1`, or `tab2`. |
| `contentblocks.implode_string` | Glue between layout/block outputs when generating resource content. |
| `contentblocks.default_modal_view` | Add-content modal view: `default`, `condensed`, or `expanded`. |
| `contentblocks.remove_content_dom` | Remove the native content field DOM when ContentBlocks initializes (helps RTE conflicts). |
| `contentblocks.clear_cache_after_rebuild` | Clear resource cache after Rebuild Content completes. |

## Link input

| Setting | Description |
|---------|-------------|
| `contentblocks.link.link_detection_pattern` | Regex to detect valid links; prepends `http://` when no match. |

## Typeahead

| Setting | Description |
|---------|-------------|
| `contentblocks.typeahead.include_introtext` | Include resource introtext in typeahead results. |

## Image and file uploads

| Setting | Description |
|---------|-------------|
| `contentblocks.image.source` | Default media source for image inputs. |
| `contentblocks.image.upload_path` | Default upload path within the media source. Supports `[[+year]]`, `[[+month]]`, `[[+resource]]`, etc. |
| `contentblocks.image.crop_path` | Path for cropped images. |
| `contentblocks.image.hash_name` | Hash uploaded filenames. |
| `contentblocks.image.prefix_time` | Prefix filenames with unix timestamp. |
| `contentblocks.image.sanitize` | Sanitize filenames on upload. |
| `contentblocks.file.upload_path` | Default upload path for file inputs. |
| `contentblocks.sanitize_pattern` | RegEx for filename sanitization. |
| `contentblocks.sanitize_replace` | Replacement string for sanitization. |
| `contentblocks.translit` | Enable transliteration before sanitization. |
| `contentblocks.translit_class` | Transliteration class name. |
| `contentblocks.translit_class_path` | Path to transliteration class. |
| `contentblocks.base_url_mode` | Image URL mode: `relative`, `absolute`, or `full`. |

## Code input

| Setting | Description |
|---------|-------------|
| `contentblocks.code.theme` | Ace editor theme for the Code input. |
