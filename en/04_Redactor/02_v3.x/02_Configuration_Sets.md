Configuration sets are how you manage the configuration for Redactor. They are found in **Extras > Redactor Configuration** and will show you a live preview of the chosen configuration.

[TOC]

## Available options

Each set contains all the different options that are available, with a detailed description.
 
For some more complex functionality with more advanced options, additional documentation is available in the [Features section](Features/index).

### Default Configuration Sets

When you first install Redactor 3, we install two default configuration sets for you. 

- One, called "Standard", is a pretty basic implementation that should work well for most users. It does not enable all options, but what the most common ones. 
- Second, called "Minimal", is a much more minimal configuration. 

You can edit these default sets as you see fit; they will not be overwritten on upgrade. 

If you wish to restore the default sets, you need to first remove all configuration sets. Then go to Extras > Installer and choose _Reinstall_ for Redactor. The default sets will be created again. 

## Exports & Import

From the configuration sets overview, you can export and import sets.

If you click the Export button at the top right of the grid, that will download an XML export of all the configured sets. Alternatively you can right click on a specific set and click Export in the context menu to only export a single set.

To import sets, click the Import button in the top right of the grid. 

Exports are not bound to a specific installation, so you can use exports to quickly start new sites with the same configuration. Usage configuration is not included in the export.

When contacting support about editor issues, please also include an export of the configuration set you use. 

## Duplicate

To duplicate sets, right click the set and choose Duplicate. Enter a new name and description and save.  

## Assigning usage 

Once you've created sets, you can assign sets to be used globally, for specific contexts, and for specific template variables. 

To quickly assign a configuration set as the system default, you can right click a set in the grid and choose "Set as system default". This requires permission to edit settings. 

To learn how to configure what set to use in different places, see:

- [Resource content](Usage/Content)
- [Template-specific overrides for the content](Usage/Template)
- [Resource introtext](Usage/Introtext)
- [Template variables](Usage/Template_Variables)
- [ContentBlocks fields](Usage/ContentBlocks)
- [Third-party extra](Usage/Third_Party_Extras)
