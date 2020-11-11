Using the Agenda FormIt hooks, you can create and edit events by users in the
frontend. When you've completed this tutorial, you'll could create and edit an
event on a frontend page.

[TOC]

## Basic Setup

First install FormIt and create a new MODX Resource. Then create a new Calendar
under under Extras > Agenda > Calendars tab. Name it i.e. "User Events" with an
alias of "userevents" and make sure it's active.

## FormIt Call and form code

To render and execute the form, we have to add a FormIt call to a MODX resource.
This FormIt Call uses the [AgendaEventGet](../04_Snippets/07_AgendaEventGet.md) and
the [AgendaEventSet](../04_Snippets/08_AgendaEventSet.md) hooks.

Here's our `FormIt` example call; make sure to adjust the `&agendaEvent` property to
the ID of an existing event, that should be editable in the frontend.

```html
[[!FormIt?
    &successMessage=`The event was edited!`
    &hooks=`agendaeventset`
    &preHooks=`agendaeventget`
    &agendaEvent=`xxx`
    &clearFieldsOnSuccess=`0`
]]
```

The form code (based on Bootstrap 3) should be added below of the `FormIt` call with the following content:

```
[[!+fi.validation_error_message:notempty=`<div class="alert alert-danger" role="alert">[[!+fi.validation_error_message]]</div>`]]
[[!+fi.successMessage:notempty=`<div class="alert alert-success" role="alert">[[!+fi.successMessage]]</div>`]]

<div class="row">
    <div class="col-md-12">
    <form class="" action="[[~[[*id]]]]" method="post">
        <input type="hidden" name="submit" value="submit" >

        <div class="form-group required">
            <label class="control-label" for="title">
                [[%agenda.event_title? &namespace=`agenda`]] *
                <span class="error">[[!+fi.error.title]]</span>
            </label>
            <input type="text" name="title" id="title" class="form-control" value="[[!+fi.title]]" />
        </div>
        <div class="form-group required">
            <label class="control-label" for="startdate">
                [[%agenda.event_startdate? &namespace=`agenda`]] *
                <span class="error">[[!+fi.error.startdate]]</span>
            </label>
            <input type="text" name="startdate" id="startdate" class="form-control" value="[[!+fi.startdate]]" />
        </div>
        <div class="form-group required">
            <label class="control-label" for="enddate">
                [[%agenda.event_enddate? &namespace=`agenda`]] *
                <span class="error">[[!+fi.error.enddate]]</span>
            </label>
            <input type="text" name="enddate" id="enddate" class="form-control" value="[[!+fi.enddate]]" />
        </div>
        <div class="form-group required">
            <label class="control-label" for="category">
                [[%agenda.event_categories? &namespace=`agenda`]] *
                <span class="error">[[!+fi.error.category_ids]]</span>
            </label>
            <select name="category" id="category" class="form-control">
            [[!AgendaCategories?
            &tpl=`@INLINE <option value="[[+alias]]" [[+selected]]>[[+name]]</option>`
            &wrapperTpl=`@INLINE [[+output]]`
            &selected=`[[!+fi.category]]`
            &allowedRequestKeys=`none`
            ]]
            </select>
        </div>
        <div class="form-group">
            <label class="control-label" for="description">
                [[%agenda.event_description? &namespace=`agenda`]]
                <span class="error">[[!+fi.error.description]]</span>
            </label>
            <textarea id="description" name="description" class="form-control">[[!+fi.description:striptags]]</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">[[%save]]</button>
        </div>
    </form>
    </div>
</div>
```

On the page with the FormIt call the title, the start date, the end date, the
category and the description of an existing event could be edited. The category
could be set with a dropdown showing all active categories.

Some notes:

- The `agendaEvent` property could be set by request parameter. Please make sure
that all events on your page could be edited, if you allow this. You could
restrict the editing to events created by the current user with the
`agendaOwnEvent` property.
- You can't set multiple categories with the dropdown at the moment, because of
a restriction in the `AgendaCategories` snippet.
- If you change the `agendaEvent` property to `agendaRepeating`, you could edit
the start date and end date of the repeating event. The other fields will change
the event itself.
- All editable fields are shown on the documentation of the
[AgendaEventGet](../04_Snippets/07_AgendaEventGet.md) and the
[AgendaEventSet](../04_Snippets/08_AgendaEventSet.md) hooks.
