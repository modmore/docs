---
title: 'get_file snippet'
---

The `commerce_digitalproduct.get_file` snippet is used as a download endpoint. You'll typically link to a resource that has this snippet in its content (or template) with a `secret` URL parameter.

Supported properties:

- `&checkUser`: when enabled the snippet will check if the currently logged-in user is the same that purchased the digital product. (disabled by default)
- `&checkCount`: when enabled the maximum download count will be enforced and users may not be able of downloading the file if they've already downloaded it more often. (enabled by default)
- `&checkExpiry`: when enabled the expiration time on the digital product will be enforced and users may not be able of downloading the file after that time. (enabled by default)
- `&errorTpl`: the name of a chunk that will be used when an error was encountered, i.e. user no longer can download the product. Defaults to `digitalproduct.file_error`; duplicate that chunk before editing as it will be overriden on upgrade otherwise.
