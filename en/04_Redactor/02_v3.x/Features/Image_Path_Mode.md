As images in the manager and the front-end often require slightly different URL structures, Redactor will normalise inserted image URLs according to the image path mode. 

This is set on your configuration set, in the Media section.

On this page we elaborate a bit on the different modes you can choose. This assumes the following settings:

- Site URL is `https://mysite.com/modx/`
- Base URL is `/modx/`
- Image is located at `/modx/assets/image.jpg`
- The image relative URL (from the site's base url) is `assets/image.jpg`

[TOC]

## Relative mode

The default and recommended value.

In the manager, the url including base url is used to ensure it loads: `/modx/assets/image.jpg`

In the frontend, the relative url is used: `assets/image.jpg`

**Important**: when using relative mode, you need to have `<base href="[[!++site_url]]">` in your template, to ensure the image can be found. 

This mode is suitable for most single and multi-context uses.

## Absolute mode

In the manager, the url including base url is used: `/modx/assets/image.jpg`

In the front-end, the base url is prepended to the image relative url to get to an absolute URL from the root of the domain: `/modx/assets/image.jpg`

With this mode, you don't need the `<base href>` tag in the template.

This mode may not work with all multi-context configurations. If your context for example sets a base url of `/de/`, the resulting url would be `/de/assets/image.jpg` even though the file might actually be located at `/assets/image.jpg`. In such cases, use Root relative mode instead.

## Root relative mode

Root relative mode is a combination of relative and absolute mode designed for multi-context setups where assets are located in the root of the domain, and not in a context-specific base url.

In the manager and frontend, the would be `/assets/image.jpg`

## Full mode

In full mode, the entire site url is prepended to the relative image url. This makes it not very portable, and we don't encourage using this mode except for certain edge cases with subdomain-based context routing.
