[Payrexx](https://www.payrexx.com/) is a Swiss-based payment patform for small business across the world, offering 200+ payment methods. The integration with Commerce is available as a free extension from our package provider.

_The Payrexx payment gateway was developed for [Visions](https://www.visions.ch/)._

## Creating a Payrexx Payment Method

See [Payment Methods](../Payment_Methods) for the basics of creating a payment method.

The Payrexx gateway offers a number of configuration options.

- **Base Domain** should be set to `payrexx.com` unless you are using the platform solution in a marketplace situation. For more information about that, see below.
- **Instance** should be set to your account name, which you can find in your dashboard url. For example, if you sign in to Payrexx at `https://myaccount.payrexx.com/`, your instance is `myaccount`.
- **API Key** can be created in your Payrexx dashboard under Integrations > API & Plugins.

Once you've added these three options, save and re-open the payment method edit form to verify they were correct, and to get more options:

- **Webhook**: this is the webhook URL **you need to add in the Payrexx admin under Integrations > Webhooks**. Note you will need to update the webhook when you move to production. Make sure to only select "Transaction" events. Type of webhook should be "Normal (PHP-Post). 
- **Payment Provider** will let you choose from the payment providers you have activated in your Payrexx dashboard under Admin > Payment Service Providers.
- **Design (look & feel)** lets you choose the design for the hosted payment page. Set these up in the Payrexx dashboard under Configuration > Look & Feel.
- **Restrict to instance** should only be set up when using Payrexx as a marketplace solution with multiple merchants. **Leave unchecked if you are the only merchant**.

## Test vs Live mode

It is important to note that Payrexx **does not offer a separate test mode**. When adding Payment Service Providers (in the dashboard under Admin > Payment Service Providers) you have the option to choose if a provider should be used as test or live.

**You must make sure the mode in Commerce matches your account.** Optionally, you can create a separate test account with Payrexx, set that up as a separate payment method in Commerce, and contact Payrexx support asking for your account to be given a permanent trial plan.

## Payrexx Marketplaces

With the Payrexx [Platform Solution for Marketplaces](https://www.payrexx.com/en/solutions/white-label-solution/marketplace/), you get a white-label solution to accept payments on behalf of multiple independent merchants. Each will have their own Payrexx account and credentials, but as marketplace you will be able to take a cut of the sales.

To use the gateway with the Marketplace solution, you will need to:

1. Create a payment method **for each individual merchant on your marketplace**. The **Base Domain** will be the domain of your platform, and the **Instance** will be merchant-specific.
2. For each payment method, ensure **Restrict to instance** is **checked**.
3. For each order, you **must provide [an order field](../Orders/Custom_Fields)** with the name **payrexx_instance** and a value that matches the instance on one of the payment methods. You could use the [Basic Custom Fields module](../50_Modules/Custom_Fields_(Basic)) or a custom add-to-cart snippet that sets it in the background.
4. You should also **make sure all orders are limited to a single merchant**. You will not be able to sell items from multiple merchants in a single order. You can do this by giving each merchant their own context on a separate (sub)domain that does not share sessions/cookies, or programmatically resetting the order in a custom add to cart snippet.

At that point, when your customer reaches the Payment step of the checkout, they should only have the Payrexx payment method for the specific merchant as an option.
