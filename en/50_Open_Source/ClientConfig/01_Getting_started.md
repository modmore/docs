With ClientConfig you can let client manage system-wide settings easily. But you'll have to set up the settings first.

After the installation, go to Extras > Configuration. You should see a message stating to check this documentation.

In the Configuration component, click the Admin button in the top right. This button is only available if you are part of the Administrator user group, and other groups can be added to that via the `clientconfig.admin_groups` setting.

In the Admin panel, you will find two tabs. Settings and Groups.

First open the Groups tab and hit the button to create a new group. Give it a good label, for example _Template_ or _My first group_, and an optional description. Save the group.

Now we can add some settings in the Settings tab. Simply click the _Add Setting_ button and fill out the form. Here's what all the fields are for:

- **key**: the reference for this setting. If you set this to twitter, you can reference its value throughout the website as [[++twitter]].
- **label**: the name of the setting as displayed to the user. For example you might set this to Twitter Handle.
- **description**: an optional description that will be displayed to the user when hovering over a field in the component.
- **group**: allows you to categorise settings into different groups. These groups are translated into tabs in the component.
- **sort order**: allows you to decide the order in which settings are displayed to the user.
- **field type**: decides how the field is displayed. There are many different options for you to choose from, which are all documented in the Field Types documentation.
- **value**: shortcut to setting the value of the setting.
- **field options**: only visible when you chose the Selectbox field type, this allows you to specify options for in the drop down. See the Field Types documentation.
- **required**: when enabled, the user cannot save the settings unless this field is set.

After having added a few settings, click the To Client View button in the top right to get to the interface that your client will manage settings with. You will see the settings are in the tabs you defined, and super easy for your client to maintain.