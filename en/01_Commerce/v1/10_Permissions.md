As of Commerce 0.12 you can use the MODX permissions system to grant granular access to the Commerce dashboard.

When installing Commerce, you'll automatically get 2 new access policies you can add to user groups:

- Commerce - Full. This policy has all permissions, giving it access to everything in Commerce.
- Commerce - User. This policy contains all permissions, except those related to the configuration section. This makes it ideal to give to regular administrative users that need to manage orders, but not the configuration of the shop.

**These policies are overwritten when upgrading Commerce, so do not edit them.** If you'd like to tweak the permissions: **make a duplicate** and use that instead.

The permissions only affect the Commerce dashboard (and some functionality of the Product Matrix and Product TVs); front-end functionality is not limited.

[TOC]

## Permissions

The full list of permissions can be seen in your manager by browsing to _System_ > _Access Control Lists_ > _Policy Templates_ > _CommerceTemplate_. Each of the permissions has a description that, briefly, explains its purpose. In most cases only a single permission is responsible for granting access to view and manage a thing. If you have a need for more granular options, please let us know.

The policies are on _System_ > _Access Control Lists_ > _Policies_, with 2 policies (`Commerce - Full` and `Commerce - User`) by default. The policies need to be assigned as a context policy with context `mgr`.

If a user does not have permission to access something, a "Permission Denied" message is shown, along with the permission that was missing. 

## Configuring Commerce permissions

Knowing what permissions are available, here's a step-by-step tutorial on setting up limited access to the Commerce component for an editor user.

### Step 1: Create the Access Policy

There are 2 policies that you can use by default, but if you'd like to change the exact permissions that are granted, you'll first need to create a new access policy.

Go to _System_ > _Access Control Lists_ and hop into the _Access Policies_ tab. Click on _Create Access Policy_ and fill in the window. Enter a name and description that describes your policy (e.g. "Commerce - Orders Only"), but most importantly **select CommerceTemplate as the policy template**. Save the new Policy.

Find the new policy in the grid and choose _Update Policy_ in the right click menu.

Now you can choose which permissions the user should have. Be sure to look at the permission descriptions, as those will try to briefly elaborate what a permission is used for. 

Select those permissions in the list, save the Access Policy, and choose close to return to the Access Control Lists page in the manager.

### Step 2: Add the Policy to a User Group

Now you can add the Access Policy to a user group. On the User Groups & Users tab choose the user group you would like to manage access for. Right click the usergroup and choose _Update User Group_.

On the new page, go to _Permissions_ > _Context Access_. Click _Add Context_ and in the window select the `mgr` context, a minimum role of member (9999), and the access policy you created in the previous step (or one of the default policies). 

### Step 3: Flush your permissions

Under _Manage_ in the top menu, choose _Flush your permissions_ to refresh the permissions. 

### Step 4: That's all!

Despite its reputation, the MODX ACL system isn't _that_ bad, is it?

You can now tweak your access policy further. Keep in mind when testing that you should use a different browser, and that you should flush the permissions after each change to the policy or user group (Manage > Flush Your Permissions).

If you have issues with the permissions in Commerce, please get in touch :)
