---
title: Persisting Carts between Devices
---

A new feature in SimpleCart 2.4 is the ability to persist cart contents between devices. This only works for **logged-in users**, as it relies on writing the carts data to the MODX cache rather than storing it in a cookie or user session. Special shout out to [Yee Jee Tso](https://www.sepiariver.ca/blog/) for suggesting and then building the first iteration of this feature!

## Setting up Persisted Carts

To persist carts between sessions, you'll need to change a few settings.

First of all, update the `simplecart.storage_type` setting to `cache`. This will write the cart contents and recently viewed items to the MODX cache based on the visitors' IP and user agent string.

The second setting to update is `simplecart.cache_storage_by_user`. Enable this setting. The cache will now be written based on the logged in users' ID if available. For anonymous users, this falls back to the standard behaviour of storing it based on the IP and user agent string.

Go ahead, try it out. Add something to your cart in one browser (make sure you're logged in), and login to your shop in another browser to see the cart is now synchronised. 
