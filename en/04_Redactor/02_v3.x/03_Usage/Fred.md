[Fred](http://modx.com/extras/package/fred) is a front-end visual page builder. While we obviously prefer [ContentBlocks](https://modmore.com/contentblocks/), Redactor 3 includes **experimental** support for Fred. 

Experimental means that it's functional, but that we may decide to drop support in the future. Due to our limited first-hand experience with Fred, we may not be able of reaching the same level of support as we can for our ContentBlocks and standard MODX integrations. 

[TOC]

## Getting Started

If you already have a functional Fred set-up with support for the standard TinyMCE rich text editor, you can easily switch to Redactor. Skip ahead to _Enabling Redactor_.

### Prepare a rich text enabled element

In the Fred manager component, create/update an element. For its markup, you will need to define:

- A div element for the content
- `data-fred-name="text"` (or a different name) to make Fred save the value
- `data-fred-rte="true"` to enable rich text support
- Optionally, `data-fred-rte-config="redactor_text" (or a different name) to set the configuration. See _Customising Redactor_, below.

For example, your element markup could look like this:

``` html
<section class="{{bgcolor}} {{textcolor}}" id="{{ anchortext|lower|replace({' ': ''}) }}" data-fred-render="{{published}}">
    <div class="container">
        <div class="row">
            <h2 class="section-heading" contenteditable="true" data-fred-name="head">Learn more about this awesome feature!</h2>
            <div class="text-faded mb-4 text-left" data-fred-name="text" data-fred-rte="true" data-fred-rte-config="redactor_text">
                <p>There's so much you can do here. Make it pop!</p>
            </div>
        </div>
    </div>
</section>
``` 

### Enabling Redactor 

Once you have a rich text element, you can start using Redactor for it.

If you haven't installed Redactor 3 yet, you'll need to do that first.

In the manager, under System > System Settings, search for the `fred.rte` system setting, and type in `Redactor`. 

If you now visit a Fred-enabled page and add your rich text element to it, you should see Redactor is initialised. 

## Customising Redactor

Redactor uses [Configuration Sets](../Configuration_Sets) to manage its different configuration. We recommend creating a unique set for Fred as you'll likely want slightly different configuration for Fred then you would for other things in the manager. 

### Create a configuration set

Start by creating a new configuration set (or duplicating one you like) and opening it to change its settings.

- We recommend enabling **Air Mode** (in the Toolbar tab), which will hide the toolbar until you select some text. For a visual editor like Fred, that's probably ideal. Redactor will work in Fred without air mode, but the toolbar will be visible at all times. 
- You can [choose a theme you like](../Themes), but on light sites we recommend to use the `dark` theme, and on dark sites we recommend using the `default` (or `redactor2`) theme. That ensures the toolbar properly stands out. Note that within the context of Fred, themes only affect the toolbar and not the content. 

When you have a configuration set you like, save it, and move on to the next section where we tell Fred which one to use.

### Choosing a configuration set

Without any Fred-specific configuration, the default configuration set will be used. This supports context overrides ([learn more](Content)) as well as [template-based configuration sets](Template). 

If you're happy with that, you're all set!

If you'd rather use specific sets in Fred, perhaps even a different configuration set for a different type of element, you can do that with a [Fred RTE Config](https://modxcms.github.io/fred/themer/cmp/rte_configs/). 

In the Fred component, go to RTE Configs and create a new RTE config. In our markup example earlier we called it `redactor_text`, but you can change the name to something else. 

For the content, provide a JSON object with a key `configuration_set` and the ID of the configuration set you want to use. 

For example:

```json
{
    "configuration_set": 2
}
```

At this time, no other options can be provided in a Fred RTE Config.

Redactor will now use the provided configuration set for the element. RTE Configs override other ways of setting the configuration set to use.

## Limitations

Only the "Simple" media browser is supported for inserting existing files and images. The standard MODX browser is not available in Fred. 

Redactor does not currently integrate with Fred's elFinder, but we may add that in a future release given enough people use Redactor with Fred. Be sure to let us know if you're using Fred and would like us to support the additional finder.

## Fred Tips

- [Shortcodes](../Shortcodes) are a great companion for a rich text editor in Fred. Just type `h2.` to switch to a header level 2.
- Create different configurations for different elements. A primary blog content section could be configured to allow more toolbar features than a piece of hero text.
