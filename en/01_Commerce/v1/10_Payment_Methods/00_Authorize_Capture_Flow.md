---
title: Authorize & Capture Flow
---

As of Commerce 1.3, you can optionally choose to only request a temporary hold on a customers' payment instrument (a credit card typically), and capture that at a later time (for example when shipping the product, or after manual review).

This is only supported by select gateways and payment methods.

> As of Commerce v1.3, the supported gateways are Stripe (credit card payments only) and Manual. We plan to add support  to other gateways in the future.

Commerce currently expects a single authorization to have a single capture. It is not supported to do incremental captures.

[TOC]

## Requesting authorizations

In the gateway configuration, enable the **Request authorization instead of payment** checkbox and note the gateway-specific description for any limitations or other steps.

## Capturing authorizations manually

If your order processing happens manually, you can capture payments manually by navigating to an order in the Commerce Dashboard, scrolling down to the Transactions section, and choosing **Capture transaction** in the actions menu.

This allows you to specify the amount that needs to be captured, by default the total amount due on the order, as well as provide a note that will be written to the transaction log.

> The maximum amount that can be captured and how long an authorization remains valid for is gateway-specific. For example, Stripe credit card authorizations must be charged within 7 days.

## Capturing authorizations automatically

Alternatively, you can capture authorizations through the **Capture authorized transactions** status change action. This needs to be setup in your [status workflow](../Statuses).

Go to Configuration > Statuses and click on the status change (middle column) that you want to capture transactions in. For example, your **Shipped** status change.

Hover over the arrow on the **Add Status Change** button and choose **Capture authorized transactions** in the fly-out menu. Give it a name (e.g. "Capture transactions"), the order within the status change it should run at, and save.

Now, whenever you run that status change for an order, Commerce will attempt to capture any authorized transaction on the order for the total amount due.
