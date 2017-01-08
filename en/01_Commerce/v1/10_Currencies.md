Commerce has basic multi-currency support built-in. It allows you to use context settings to specify different currencies per context (which also relies on each context having its own cart and checkout page). This mostly affects number formatting and payment method integrations.

## Limitations

It's not currently possible to (out of the box) specify different prices for a product per currency. The price set on a product is assumed to be in the current currency, so you might need to create different product records for different currencies. 

## Setting the Currency

To set which currency is used, set the `commerce.currency` setting to the three character alpha code for a currency, for example `EUR`, `USD` or `RUB`. Commerce will match this code with the currencies managed in Configuration > Currencies. 

The system default is configured through the system settings, but you can create context settings with the `commerce.currency` key to set specific currencies for different contexts. 

## Managing Currencies

In the merchant dashboard under Configuration > Currencies you can manage the formatting for each defined currency. During the first installation a few currencies are created for you, but you can add more or edit them.

The following fields are available for currencies. 

- Alpha Code: the 3 character ISO4217 alpha code for the currency. Used for telling the payment method what currency to use, so really important to set correctly.
- Numeric Code: a numerical code, typically 3 numbers, that represents the currency per the ISO4217 standard. This can be used by certain payment gateways, though most rely on the alpha code. See the list mentioned below to find the right number.
- Number of subunits: how many decimal places the currency uses. Most currencies have 2, but some currencies have none or up to 8 (bitcoin). This affects calculations and formatting.
- Prefix: the prefix is prefixed to the formatted amount. This is usually the currency symbol (€, $ etc), but can also be the currency alpha code, or nothing. 
- Suffix: the suffix is appended to the end of the formatted amount. This can be empty or the alpha code.
- Decimal Point: The character to use to indicate decimals, usually a dot or comma.
- Thousands Separator: The character between thousands, usually a dot, comma, or space.

If you're unsure about what certain fields should be set to, [this page](http://www.thefinancials.com/Default.aspx?SubSectionID=curformat) has a rather comprehensive list of currencies and how they are expected to be configured. 
