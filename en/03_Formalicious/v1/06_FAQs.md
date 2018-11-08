We're collecting the questions we get most often into a list of FAQs. If your question is not in the list, please reach out to us via support@modmore.com and we would be glad to help.

[TOC]

## How do I show my created form?
Make sure that you marked your form as Published, and then add the following snippet call where you want the form to appear (without the spaces):

```` html
[[!renderForm? &form=`FORM ID HERE`]]
````

You can also use a template variable to select the form, and to place the template variable value in the form property.

## I want to setup custom validation per field
This can be accomplished by going to the creating (or editing) a field-type in the admin-panel. You can mention a comma-separated list of FormIt-validators in the _Validation_ field in the dialog-window.

## I don't like the emails sent by Formalicious
Everything is customisable by using chunks or FormIt parameters. First, create a duplicate of the email-chunk (emailFormTpl or fiarTpl) you wish to change and rename it. Then go to the form which should use this new chunk.

Go to the _Advanced_ section and click _Add parameter_. Set the parameter-key to _emailTpl_ or _fiarTpl_ and set the value to the chunk you just made.

## Adding a reply to address

If you'd like the emails to have the proper reply-to header set, so you can immediately reply to an email to the customer, you can add a custom parameter to your form. 

Edit your form. On the Advanced tab, add a custom parameter with paramater key `emailReplyTo` and a value of `[[+field_ID]]`, where `ID` is the ID of the field that contains your customers' email address. You can find that ID on the Form Fields tab, in the first column. For example if your email field has ID 5, you would set the value to `[[+field_5]]`. 

