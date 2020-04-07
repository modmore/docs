With the [Slack Extension](https://modmore.com/commerce/extensions/slack/) you can get a notification in your Slack team whenever there's a new order.

## Download & Install

First download and install the free extension from the modmore package provider.

After the installation navigate to Extras > Commerce > Configuration > Modules and find Slack in the list. Enable it in test and live modes.

## Set up the Status Change Action

Now go to Statuses (still in Extras > Commerce > Configuration) and click on the name of the status change you want to fire the notification from. In most cases, this will be called _Payment Received_, but that's configurable.

In the list of status change actions for that status change, hover the down arrow on the Add Status Change Action button and click on `Send new order to Slack`.

In the window:

1. Add a suitable name (e.g. "Notify Slack").
2. Enter the Incoming Webhook URL in the _Slack Configuration_ section. Note the instructions shown to you there on how to generate that in the Slack Apps directory.
3. To test the URL is correct, tick the _Send test message on save_ checkbox, and save the status change action. If all goes well, you'll see the notification message for the last received order (if any) appear in your Slack account almost instantly. If it failed, then you'll see an error message. The error log will also contain a more detailed message if that happens.
4. Optionally, choose what information you want in the notification with the other checkboxes.

Now, whenever there's a new order, you'll instantly see it on Slack. How great is that! Now, get back to work, no time to slack around..