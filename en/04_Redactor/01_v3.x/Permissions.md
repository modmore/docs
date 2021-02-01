If desired, you can limit access to the Configurator using the MODX permissions system. 

On installation, Redactor will automatically give full configurator access to all user groups with access to the manager. After that, permissions are not changed unless you remove the policy from the administrator user group again.

[TOC]

## Available Permissions

A default Access Policy is created on installation which includes all permissions. 

The following permissions are included:

- `redactor_configurator` gives access to the Redactor Configurator component, including the menu item under Extras.
- `redactor_sets_view` gives access to view the configuration for a specific configuration (but not save the changes)
- `redactor_sets_create` allows creating new sets; also requires `redactor_save_sets`
- `redactor_sets_save` allows saving existing sets
- `redactor_sets_export` allows creating an XML export of one or all sets 
- `redactor_sets_import` allows importing sets from an XML import if `redactor_sets_create`, `redactor_sets_save` and `redactor_sets_delete` are also assigned
- `redactor_sets_delete` allows deleting a set. 

To duplicate sets, both `redactor_sets_create` and `redactor_sets_save` permission are needed. 

## Setting custom policies

### Step 1: Create the Access Policy

The first thing to do is creating an access policy. Go to _System_ > _Access Control Lists_ and hop into the _Access Policies_ tab. Click on _Create Access Policy_ and fill in the window. Enter a name and description that describes your policy (e.g. "Redactor Basic Access"), but most importantly **select RedactorTemplate as the policy template**. Save the new Policy.

Find the new policy in the grid and choose _Update Policy_ in the right click menu.

Now you can choose which permissions the user should have. We've listed them in the previous section. 

Select the desired permissions, save the Access Policy, and choose close to return to the Access Control Lists page in the manager.

### Step 2: Add the Policy to a User Group

Now you can add the Access Policy to a user group. 

On the User Groups & Users tab choose the user group you would like to give limited access to the configurator with your access policy. 

Right click the user group and choose _Update User Group_.

On the new page, go to _Permissions_ > _Context Access_. Hit _Add Context_ and in the window select the `mgr` context, a minimum role of member (9999), and the access policy you created in the previous step.

### Step 3: flush permissions

While manager sessions typically flush permissions automatically, you can flush the sessions via Manage > Flush permissions to make sure sessions are reloaded. 
