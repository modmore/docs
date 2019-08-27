To prevent spam, you can use the [Math hook](https://docs.modx.com/extras/revo/formit/formit.hooks/formit.hooks.math) that ships with FormIt. 

[TOC]

## Create a custom field

Go to Extras > Formalicious and click on Admin Panel in the top right. On the _Field Types_ tab, create a new field type, providing the following information:

- Name: a name of your choosing to describe the field, for example `Math Captcha`
- Chunk Template: `customMathFieldTpl` (we'll create this chunk momentarily)
- Leave the values question unchecked and define no chunk for values
- Leave validators empty as well. While the Math hook docs mention making the math field required, that does not work by specifying the validator on the field type in Formalicious. (Formalicious uses `field_ID` names for the fields, while the Math hook expects a hardcoded `math` field)

Save, and create a new chunk called `customMathFieldTpl` with the following:

````html
<div class="row">
    <div class="form-group col-xs-12">
        <label>[[!+fi.op1]] [[!+fi.operator]] [[!+fi.op2]]?</label>
        [[!+fi.error.math]]
        <input type="text" name="math" value="[[!+fi.math]]" />
    </div>
</div>
````

Now you're ready to use the field.

## Add the field to a form

Go to Extras > Formalicious and edit your form. 

Add the newly created `Math Captcha` field to your form. You can give it a title, but that's not currently used in the `customMathFieldTpl`, so is only shown in the form management. 

Next open the Advanced tab, and add `math` to the Posthooks. This makes sure the field is validated and that error messages are shown.

**Important**: the math hook only works with forms that only have a single step. 

