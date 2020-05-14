Klarna allows customers to pay for your order later and in multiple installments, while you get your money right away. 

[Learn more about Klarna on its official site](https://www.klarna.com/), and [find supported payment options per country here](https://developers.klarna.com/documentation/klarna-payments/in-depth-knowledge/payment-method-availability/).

To use Klarna with Commerce, you'll need to install the separate Klarna extension, available from the modmore.com package provider. The extension requires at least Commerce v1.1.5.

> **Note**: Klarna and Commerce 1.1.5 are coming soon. This doc was just written in advance. ;)

[TOC]

## Installation

As Klarna allows your customer to pay later, the integration is bit more complex than the average payment gateway. Most notably, it requires you to separately capture the payment, typically when you've shipped the products. That will then initiate the customers' payment term. 

First you'll need to enable the Klarna module after installing the extension, in Configuration > Modules. That will make the various integrations available.

### 1. Customer authorization

In **Configuration > Payment Methods**, create a new payment method and select Klarna as the payment gateway. Give it a name and optional description, and save. On the Klarna tab, add the API Username (UID), password, and select your region.

At this point you can start taking authorizations through Klarna, however **this does not yet capture the actual payment**. It's important to note this, as Commerce v1.1 does not currently differentiate between "Authorized" and "Paid" transactions - everything shows up as "Paid" however you wont get any money from Klarna unless you also capture the authorization.

### 2. Capture payment

To capture the payment, you can either use the Klarna Portal (which does **not** update the data in Commerce), or you can automate the capture in your [status workflow](../Statuses), which is recommended. 

In **Configuration > Statuses** find the status change at which point you want the order to be captured. Typically, this is a "Ready for shipping" or "Shipping" status change that you run when the order is on its way to the customer. It may also be a status change you run a little later, if you first want to wait for any returns, but be sure to note the authorization expiration which is 14-30 days by default. 

Click on the name of the status change to open the lists of actions that fire at that point in time. Hover the arrow on the right side of the _Add Status Change Action_ button and choose the **Capture Klarna Payment** action type. Give it a name, and save the action. 

Now, whenever you run the status change, the transactions are checked for any Klarna authorizations and the current order total will be captured. A few things to note:

- If the order total is **lower** than the initial authorization (for example you removed items), only the current order total will be charged. The remainder of the authorization remains capturable until released (see next section) or when the authorization expires.
- If the order total is **higher** than the initial authorization, **the capture will fail** because you're only allowed to charge the amount that was authorized. 
- There is a time limit on how long after the authorization you can capture the amount. This depends, but is 14-30 days usually. Don't wait too long! 

If an order does not contain any Klarna transactions, the capture action will sit quietly, so you can easily integrate this in an existing checkout/status workflow even if you use different payment methods. 

### 3. Releasing remaining authorizations & cancellations

If you didn't charge the full amount of the authorization, the remaining balance (which you can see by going to Actions > Transaction Detail on the order view) will stay authorized until the expiration date. That means it will also still be visible in the customers' Klarna app, and may affect their ability to complete more payments. 

To release funds that will not be captured, you can use the **Release remaining Klarna authorization** action. You could for example add that to a "Completed" status change, which you run when the order is definitely finished, or even as part of the same status change as the capture action; but make sure the capture runs **before** releasing remaining funds by setting the order accordingly. 

You can also add the action to a "Cancel"-type status change, to make sure cancelling an order also releases the funds right away. If nothing was captured, the entire order is cancelled in Klarna. 

## Refunds & the Klarna Portal

**Changes you make in the Klarna portal are not automatically synchronised to Commerce**. This also means that the reports in Commerce may be inaccurate if you use the portal to change items or make (partial) caputres or refunds.

At the moment refunds are not supported by Commerce.

## Supported payment options

The integration follows the best practices set up out by Klarna and will respond to the supported payment options based on pre-qualification. If you're not seeing certain options (like pay now or slice it), they're likely not supported for the current customer or disabled on your account and you may want to check with the Klarna merchant support.

If no payment options from Klarna are available at all, the payment method is hidden from the checkout completely. 

[Find the supported payment methods by Klarna here.](https://developers.klarna.com/documentation/klarna-payments/in-depth-knowledge/payment-method-availability/)

## Shipping tracking

Klarna can show shipping information in its app for customers to see where their orders are. At the moment Commerce does not yet collect all the information Klarna would like to see, but there are 2 options:

- A custom [Order Shipment](../Orders/Shipments) can implement the `getTrackingURL()` method. When a non-empty URL is returned, this will be sent along to Klarna.
- You (or an integration) can set the `tracking_reference` on the shipment as well. To manually set this, click on the name of the shipment on the order overview. While this does not contain information about the carrier or type of delivery, this piece of information will be provided to Klarna when set and it may still display that to the customer in their app.

Ideally, Klarna would also like to know the Shipping Company and the Shipping Method. If those are always the same for your shipping needs, you may hardcode a value in the system settings:

- `commerce_klarna.shipping_company` for the shipping company/carrier. This should be as specific as possible (e.g. "DHL US" instead of "DHL").
- `commerce_klarna.shipping_method` for the type of shipment. This has to be one of the following values: `PickUpStore|Home|BoxReg|BoxUnreg|PickUpPoint|Own`

All available (non-empty) shipping information will be sent to Klarna when the payment is captured; make sure to enter the information **before** the "Capture Klarna Order" status action is executed. 

## Templating and Design

The Klarna integration comes with one new template, `frontend/gateways/klarna.twig`, which you can override in your own theme if needed. That said, as it's tightly integrated with the back-end code and may change over time, it's recommended to only do so if you've been instructed to by support or know exactly what you're doing with regards to Klarna. 

Klarna also offers design options for its widget through the API; those are **not yet implemented** in the extension. 

To change how your store is reflected inside the Klarna app, go to "Branding" in the Klarna portal.



