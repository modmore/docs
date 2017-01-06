---
title: Autofill Geo IP
---

Looks up the country and optionally state a customer is in during the checkout. This information is then prefilled into the Address, and available as `{{ geolocated.country }}` and `{{ geolocated.region }}` in the rest of the checkout.

This module sends a request with the customer IP address to [ipinfo.io](https://ipinfo.io), which is free for up to 1000 requests per day. If you hit the limit you can purchase a [monthly subscription](https://ipinfo.io/pricing) to get more requests. 

The geolocating results are cached by IP address to limit the number of requests to ipinfo.io. 

## Properties

- Prefill State (`prefillState`): When enabled not only the country, but also the state/region will be prefilled on the address step of the checkout. This is most useful if your webshop primarily serves large countries like the United States or Russia where the state is reasonably accurate. For smaller countries like the Netherlands, the state information is often incorrect. 
- Token (`token`): if you have a paid subscription for ipinfo.io, add the access token they've provided to you here to add it to the requests. 