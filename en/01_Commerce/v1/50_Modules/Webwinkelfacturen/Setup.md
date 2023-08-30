The setup process involves a few steps. If at any point you get stuck or are unsure what to do, please do reach out to support@modmore.com for help - free of charge.

[TOC]

## Start a free Webwinkelfacturen trial

First, you'll need to create your Webwinkelfacturen account.

You already need to know which bookkeeping software to use at this stage, so make sure you have talked it through with your client.

We hope to offer an automatic signup option in the future, but for now please [send us an email](mailto:support@modmore.com) with the accounting software you would like to signup with, and we'll send you back a signup link within 24 hours.

Pass the signup link along to your client, or complete it together, to start the Webwinkelfacturen trial. The trial lasts 30 days, but if you need a longer trial because the webshop isn't complete yet, we have found the Webwinkelfacturen support team to be willing to assist.

(Note that while we need to send you the signup link for the integration, we do not have any access to your billing or plan information. We only have technical access to assist with the integration.)

Within 24 hours of signing up, we will send you your Client ID and Client Secret. Again, we hope to automate this in the future.

## Connect Webwinkelfacturen to your accounting software

Technically, you can set up the accounting software later, however all order submissions from Commerce will fail if you do not yet have the accounting software connected so we recommend doing that first.

Follow the steps in the Webwinkelfacturen dashboard ([and the documentation here](https://www.webwinkelfacturen.nl/handleidingen)) to set up the connection. Make sure the accounting software shows a green dot in the dashboard.

## Install the Commerce integration

The Commerce-side of the integration is distributed as a Commerce extension. On [development domains](https://modmore.com/free-development-licenses/), you can download the Webwinkelfacturen package from our [package provider](https://modmore.com/about/package-provider/) for free to try.

For production usage, you will need to [buy a license](https://modmore.com/commerce/extensions/webwinkelfacturen/). As with all our premium extras: one license is valid for one site, and support plus upgrades within the current major version (1.x) are included.

In MODX, download and install the package through the package manager.

## Authenticate Commerce with Webwinkelfacturen

Go to Extras > Commerce > Configuration > Modules and find the Webwinkelfacturen module in the list.

Add the Client ID and Client Secret you were provided in the respective fields. Make sure to enable the module in both test and live mode. Save the module.

Copy the Redirect URI, login to your Webwinkelfacturen dashboard, and save in the redirect url configuration.

> Note: this step is still a bit unsure if it needs to be done by you or by us, so please drop us an email with your redirect url if you get stuck here.

Return to Commerce, and click the button to start the authorization. That may require you to login to the Webwinkelfacturen account you created in the previous step, so you may need to do that together with your client.

When you return, there should be a checkmark with today's date in the module configuration to indicate you are successfully authorized.

## Configure the Status Change Action

Go to Commerce > Configuration > Statuses.

You'll need to decide when you want to submit the order information to Webwinkelfacturen (and your bookkeeping software), make sure to discuss this with your client.

Typically, there are 2 main options: when the order comes in (= Payment Received status change) or when the order has been processed and is ready to ship ( = Shipped status change). However, you can set this up any way that is appropriate for the clients' business.

Click on the name of the status change you would like to use. On the _Add Status Change Action_ button, choose _Send to Webwinkelfacturen.nl_ in the dropdown menu.

Make sure to set the Order appropriately. For example, make sure the order is higher than a status change action that creates an invoice number, so we can pass along the invoice number.

Ensure the action is active, and save.

## Set up the Commerce cron job

Before continuing, make sure that you have configured the [cron job for Commerce's built-in scheduler](../../Scheduler). The integration requires the scheduler to submit orders and check order status in the background.

## Submit an order

Now you can run the status change you added the action to for an order. After doing so, you should see the order appear under Commerce > Orders > Webwinkelfacturen.

If orders are not being submitted to Webwinkelfacturen after about a minute, make sure the Scheduler's cron job is working correctly.

## Wait

If an order is successfully submitted, it may take 24-48 hours for the order to appear in your Webwinkelfacturen dashboard and accounting software. We have no control over this process.

In Commerce > Orders > Webwinkelfacturen you can always find the latest status of the order. That will run automatically periodically in the background, but you can also check the processing status through the Actions menu.

If it encountered an error, that means the order was not accepted by Webwinkelfacturen. If the provided error message (in Actions > View Log) is not self-explanatory, please send us an email and we'd be happy to assist. If needed, we can also liaise with Webwinkelfacturen on your behalf if it is unclear why submitting orders fails.

> Please note that orders may seem stuck in "Awaiting confirmation" status as we're not currently getting back the expected confirmation from Webwinkelfacturen, even though the processing was successful. We hope to resolve this in a future update.

