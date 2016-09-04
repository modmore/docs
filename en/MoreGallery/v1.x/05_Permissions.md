## Permissions

As of MoreGallery 1.5, you have fine grained control over the available features and options in a Gallery. This uses the Access Control Lists features of MODX, that allows you to assign sets of permissions to a user group.

During installation a Policy Template with the name `MoreGalleryTemplate` is created. This contains all the permissions for MoreGallery, 11 at latest count, which you can add to Access Policies through that template. The full list can be seen in your manager, along with a brief description of each, by browsing to _System_ > _Access Control Lists_ > _Policy Templates_ > _MoreGalleryTemplate_.

The permissions can control the entire gallery block (`moregallery_view_gallery`), as well as more specific features (`moregallery_upload`, `moregallery_import`, `moregallery_video`, `moregallery_resource_settings`) and permissions for specific image-related actions (`moregallery_image_active`, `moregallery_image_delete`, `moregallery_image_edit`, `moregallery_image_tags`, `moregallery_image_tags_new`, `moregallery_image_crop_edit`).

These permissions will stack. So someone first needs the `moregallery_view_gallery` permission in order to even see the gallery, before they be granted permission to upload, import or to add videos.

Similarly, to toggle the active/hidden state on an image, the user needs `moregallery_image_active` and also `moregallery_image_edit` permission. To add new tags on top of the ones that already exist, the user needs `moregallery_image_tags_new` permission as well as `moregallery_image_tags` permission.

## Limiting Access to the Galleries

Knowing what permissions are available, here's a step-by-step tutorial on setting up limited access to a Gallery for an editor user.

### Step 1: Create the Access Policy

The first thing to do is creating an access policy. Go to _System_ > _Access Control Lists_ and hop into the _Access Policies_ tab. Click on _Create Access Policy_ and fill in the window. Enter a name and description that describes your policy (e.g. "MoreGallery Basic Access"), but most importantly **select MoreGalleryTemplate as the policy template**. Save the new Policy.

Find the new policy in the grid and choose _Update Policy_ in the right click menu.

Now you can choose which permissions the user should have. In this example, we'll hide the video and tags features. So we select all permissions, except those that are related to videos and tags.

- moregallery\_view\_gallery
- moregallery\_upload
- moregallery\_import
- moregallery\_resource\_settings
- moregallery\_image\_active
- moregallery\_image\_delete
- moregallery\_image\_edit
- moregallery\_image\_crop\_edit

Select those permissions in the list, save the Access Policy, and choose close to return to the Access Control Lists page in the manager.

## Step 2: Add the Policy to a User Group

Now you can add the Access Policy to a user group. On the User Groups & Users tab choose the user group you would like to give limited access to the Gallery with your access policy. Right click it and choose _Update User Group_.

On the new page, go to _Permissions_ > _Context Access_. Hit _Add Context_ and in the window select the `mgr` context, a minimum role of member (9999), and the access policy you created in the previous step.

## Step 3: That's all!

You can now tweak your access policy further. Keep in mind when testing that you should use a different browser, and that you should flush the permissions after each change to the policy or user group (either Manage > Flush Your Permissions if you're logged in as the editor, or Manage > Logout All Users from an admin account).

Having issues setting it up to your liking? Send us a message via support@modmore.com and we'll get you sorted.