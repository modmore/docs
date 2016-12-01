---
title: Troubleshooting Custom Inputs
---

Sometimes things can fail without any clear indication about why. Sorry about that. Here's a few common situations. If these do not answer your questions, please do get in touch with support@modmore.com - we'd love to help figure it out.

## My input doesn't show up in the Input list

Make sure the `ContentBlocks_RegisterInputs` event is checked on the plugin's System Events tab. If it is, make sure that you are properly returning an array with your input reference as key and a valid instance of your input class as value to `$modx->event->output()`;

## Adding the field to the canvas doesn't work: Uncaught TypeError: cannot set property 'id' of undefined

In your JavaScript input function, make sure that at the end you return the input object at the end.