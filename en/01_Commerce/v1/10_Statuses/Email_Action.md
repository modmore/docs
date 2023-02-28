The Email Status Change Action is used to send an email when the status change is processed. It can send both to a specific email address (e.g. the merchant), or an email address specified on the order.

> Are you looking for where to **change the email address that receives the default "New order" email**?
> You will find that **in the Status Workflow**. Navigate to Commerce > Configuration > Statuses, and click on "Order notification to merchant", in the status change column. There you can change the recipient.
> [Learn more about ways to customise the default emails](https://support.modmore.com/article/170-how-can-i-change-the-emails-that-get-sent-when-an-order-is-placed)

This action does not handle the actual email sending, instead it creates an [Order Message](../Orders/Messages) of type email and triggers a send on that.

[TOC]

## Options

The following options are available when creating or updating an Email status change action.

- Subject: the email subject, can include the placeholders mentioned below.
- From: the email address to be used as the "From" address. Make sure your server and MODX is configured properly so it can send from this address.
- Recipient: leave empty to send to the email address specified on the order billing address. Set to a specific email address to send it to them.
- Content: the actual email content to send. This can contain HTML and the placeholders mentioned below.

## Placeholders

The subject and content can contain placeholders as described for [Order Messages (email type)](../Orders/Messages).


