It's possible to use multiple currencies in Commerce, so long as you use one per context. Currencies can be set up via Extras > SimpleCart > Administer on the _Currencies_ tab. 

[ ![Backend Manager Admin configuration currencies overview](https://assets.modmore.com/uploads/2015/12/currencies_overview.png)](https://assets.modmore.com/uploads/2015/12/currencies_overview.png "Backend Manager Admin configuration currencies overview")

## Output format

By right clicking a currency and choosing _Update Currency_ you can manage the symbol, name and description of the currency. You can also change the output format on the Format tab, the formatting you specify here is used in the `_formatted` placeholders. 

[ ![Currency window format setup](https://assets.modmore.com/uploads/2015/12/currencies_format_win.png)](https://assets.modmore.com/uploads/2015/12/currencies_format_win.png "Currency window format setup")

You can change the number of decimals, decimal separator and a thousands separator. With the format template you can determine the position of the symbol related to the price. 

## Setting the Currency

To determine which currency is used, go to System > System Settings, find SimpleCart in the first dropdown and then locate the `simplecart.default_currency` system setting. Set it to the ID of the currency you wish to use. 

On a multi-context site, you can create context settings with the same `simplecart.default_currency` key to change the currency per context. 
