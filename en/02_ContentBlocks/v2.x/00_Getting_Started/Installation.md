ContentBlocks 2 is distributed as a premium extra from [modmore](https://modmore.com/contentblocks/). Install it through the modmore package provider in the MODX manager, or via the modmore CLI.

> ContentBlocks 2.0 is currently in private preview. If you've supported the 2.0 development but have not joined our Slack team, please get in touch with us at [support@modmore.com](mailto:support@modmore.com).
>

[TOC]

## Requirements

- MODX Revolution 3.x, 3.2+ recommended
- PHP 8.1+
- "Twig for MODX 3" package, available from the MODX.com package provider.


## After installation

1. **System settings** — Open _System_ → _System Settings_ and filter by `contentblocks`. Set [Config Directories](../01_Configuring_Content/Config_Directories) to point at your block, layout, and canvas definitions. By default, this will be `core/components/contentblocks/config`, which is a safe location we will not write core updats to.
2. **Add definitions** — Create block, layout, and canvas JSON files in your config path. See [Quick Start](Quick_Start).
3. **Edit your first resource** — You can now manage your content!
