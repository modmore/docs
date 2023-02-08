---
title: GoogleRoutes
---

The Google Routes shipping method is available as a free official extension.

It integrates with the Google Routes API (part of the Maps Platform) to calculate the shipping fee and determine shipping method availability based on the distance from your location to the customer's shipping address.

> The Google Maps platform offers a free tier for up to $200 in monthly usage. At current pricing, that's sufficient for about 40,000 lookups per month.

Within the shipping method configuration, you can set a price per mile or kilometer, a base price, a minimum and maximum fee, and the minimum and maximum distance the shipping method will be available for.

[TOC]

## Installations

Download the package from the modmore package provider by searching for GoogleRoutes, and install it normally. At least PHP 7.4.0 is required.

## Authentication

Before you can use the shipping method, you will need to get an API Key for the Google Maps Platform.

Visit the [Maps Platform](https://mapsplatform.google.com/) and click the Get Started button. You may be asked to login to your Cloud Console account, and to select or create a project that has an active billing account (even if you expect to stay within the $200/mo free tier).

After that, you should automatically get a popup with your API Key. It is recommended to keep the optional actions (enable all APIs and create budget alerts) on.

Copy your API Key, and paste it into the `commerce_googleroutes.api_key` system setting. This key will be used for any shipping method you configure.

Click the "Go to Google Maps Platform" button. You'll get a popup asking how you want to protect your API Key; we suggest using the IP address restriction for your server.

## Enable the module

Navigate to Commerce > Configuration > Modules in your MODX manager. Find Google Routes in the list, and enable it for test and live mode.

## Create your Shipping Method

1. Create a [Shipping Method](https://docs.modmore.com/en/Commerce/v1/Shipping_Methods.html) at `Commerce -> Configuration -> Shipping Methods`, set the _Type_ to **Google Routes Shipping Method** and be sure to make it available on the Availability tab.

2. Set your preferred [Delivery Type](https://docs.modmore.com/en/Commerce/v1/Delivery_Types.html) for the Shipping Method. ![Shipping Method Type and Delivery Type](https://user-images.githubusercontent.com/5160368/208797216-b86a42cb-f177-4465-a635-68a7f7edf1ca.png)

3. Select the _Google Routes_ tab and fill out the following: ![Google Routes configuration](https://user-images.githubusercontent.com/5160368/208797445-494cab41-dfd3-4a1d-b373-0421b296a9dc.png)
    - **Origin Address**: This is the address that Google will use to calculate all route distances from.
    - **Distance Unit**: Miles or Kilometres.
    - **Fee per Distance Unit**: This field expects a decimal that will be multiplied by the found distance. Leave it blank if the shipping method should be free.
    - **Minimum Fee**: You can set a minimum fee that overrides the _Fee per Distance Unit_ calculation if it's not high enough.
    - **Maximum Fee**: Similar to the _Minimum Fee_, you can set a override the charge calculation with a maximum fee.

4. Select the _Availability (Distance)_ tab. In addition to the regular _Availability_ tab options, here you can specify the minimum and maximum distance where this shipping method becomes available during checkout. ![Availability (Distance)](https://user-images.githubusercontent.com/5160368/208799241-fb2cfce8-0f8e-4014-a2bb-b776e58bcb1e.png) The values you enter are directly related to the _Distance Unit_ type you selected on the _Google Routes_ tab.

You can repeat these steps as necessary to create different configurations, for example if you have multiple locations you can deliver from.
