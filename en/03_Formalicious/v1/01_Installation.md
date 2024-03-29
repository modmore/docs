> **This extra is discontinued**. It was originally built by Sterc and distributed by modmore as a Premium Extra, however in 2020 Sterc decided they can no longer offer the support required. It is no longer available from modmore, but may be available elsewhere.
>
> Unfortunately modmore cannot provide standard support for this extra. You may request support from Sterc directly or consider [booking Premium MODX Support](https://modmore.com/premium-modx-support/) if you need help with it.

Installing Formalicious requires the free Extra _FormIt 2.2.11-pl_ to function properly. FormIt is also maintained by us and thus, should guarantee maximum compatibility between FormIt and Formalicious. The MODX installer should install this automatically when installing Formalicious from the modmore repository.

A custom manager page called _Formalicious_ is installed within the _Extras_ menu. Also a Template Variable and Element Category named _Formalicious_ are created. The _Template Variable_ should be assigned to all the templates you wish to use Formalicious forms on and a Snippet should be added to those templates.

To accomplish this, follow these steps:
1. Click the _formalicious_ TV
2. Click _Template Access_
3. Enable the checkmarks for the templates on which you want to use Formalicious-forms
4. Save your changes
5. Go to every template you just enabled
6. In the field _Template code (HTML)_, add the following Snippet-call at the location where you want to show your forms: ```[[!renderForm? &form=`[[!*formalicious]]`]]``` We recommend to add it just below the ```[[*content]]``` placeholder, because it enables your content-managers to add text above the form.
7. An alternative would be to create a chunk called _form_ where you add the above Snippet-call. Instruct your content-managers to add the chunk-code ```[[$form]]``` anywhere they want, so they have more flexibility regarding the location of their forms, e.g. in-between two paragraphs.
8. Save your changes

## Inserting a form with ContentBlocks

If you also use [ContentBlocks](https://modmore.com/contentblocks/), you can use a field to select a form to insert as well, instead of needing the template variable and form code in your template. This gives your content editors more control over what form is inserted at what position.

Formalicious will add its custom input type during installation. At Extras > ContentBlocks, create a new field using the "Formalicious Form Selector" input type and customise the template as needed.
