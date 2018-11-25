Upon installation you'll find a new template called `DigitalSignage (1.x.x original)`. As the name implies, this is a default template that **will be overwritten on upgrades**, so you'll want to avoid editing it directly.

[TOC]

## Setting a custom template

To start tweaking your design, first duplicate the original template. 

Go to System > System Settings and change the `digitalsignage.templates` system setting to include the ID of the new template you just created. This setting accepts a comma separated list of template IDs, so if its value is for example `2` and your template is ID `3`, you can set it to `2,3`.

In the Digital Signage dashboard, on the Broadcasts tab, right click the broadcast you want to use with your own template and choose _Update broadcast_. Choose your template under Templates, and save. 

## Editing the template

Now that your broadcast uses a new template, you can start changing things. Let's take a look; open your duplicated template. You'll find it's built with HTML, CSS and JS, so you can change it quite a bit!

First off, you'll probably want to add a custom CSS file to hold your tweaks. It's useful to keep the original CSS in place, as that contains all the needed styles for the basic layout and core plugins (ticker and clock). Keeping your tweaks separated will help with maintenance and upgrading Digital Signage in the future.

