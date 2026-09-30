---
title: ContentBlocks 2.x
description: Documentation for ContentBlocks 2, a premium extra from modmore for MODX.
---

[ContentBlocks](https://modmore.com/contentblocks/) is a powerful content manager for MODX allowing editors to create modular, multi-column content. Version 2 uses file-based JSON configuration for blocks and layouts, with Twig or MODX placeholder templates for front-end output.

> ContentBlocks is in alpha for supporters only, and not yet available for public use. We're building out this documentation as we go to make sure it's all ready for you when it comes out publicly.

# Main changes from v1

ContentBlocks 2 is a complete rewrite, but many concepts are familiar.

One of the biggest user-facing changes is that configuration (your blocks, layouts) are now file-based, using a JSON schema for defining all the options. This makes it a lot easier to use an IDE or version control on the elements.

Each block is now also essentially a single-row repeater: a block consists of multiple input types that combined make up the content to add.

# Recommended Reading

- [Getting Started](Getting_Started)
- [Configuring Content](Configuring_Content)
- [Migration from v1](Migration_from_v1)
- [User Guide](User_Guide) — for content editors (non-technical)
