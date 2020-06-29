The WiPay payment gateway for [WiPay Caribbean](https://wipaycaribbean.com/) is available as a [free extension](https://modmore.com/commerce/extensions/wipay/).

[TOC]

## Configuration

First install the _WiPay for Commerce_ extension from our package manager. 

Next go to Extras > Commerce > Configuration > Modules and enable the "WiPay" module in both modes.

Now you can navigate to Configuration > Payments to create a new payment method. Select WiPay in the list of gateways, provide a name and enable the payment method on the availability tab. Save.

In the WiPay tab, provide the `Developer ID` and `Merchant Key` for your account. 

- For test payments, check "Sandbox" and use `1` for the Developer ID and `123` for the Merchant Key. 
- For live payments, you may find your credentials in the WiPay dashboard under "Developer".  

## Special considerations

1. This gateway **requires friendly URLs to be used**. That has to do with a bug in the WiPay system where it incorrectly appends values to the return url. If you do not use friendly URLs in MODX, that will cause customer returns to go to your error page rather than the checkout.

2. WiPay **requires a phone number**. The implementation will check both the `phone` and `mobile` values on the **billing** address, and refuse to redirect when it has no value. Make sure to set up the Basic Address Validation module so that your customer is required to enter a phone number.  
