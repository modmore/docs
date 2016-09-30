Most settings in SimpleCart can be found under System > System Settings when choosing` simplecart` in the namespace dropdown. A selection of the settings are also available under Extras > SimpleCart > Administer > Settings. 

Many settings can be created as context settings as well, to have context-specific values or configuration. 

Some of the settings on this page may not exist by default, but will work when created with the documented key. 

[TOC]

### Default Category Template 

`simplecart.default_category_template` Select the template used for new category template. If not set elsewhere, it falls back on the system default.

### Default Currency

`simplecart.default_currency` Enter the ID of the default currency to use. Default set to ID 1 (EURO).

### Default Tax ID

`simplecart.default_tax` Enter the ID of the Tax that should be applied by default. This is set for you automatically through Extras > SimpleCart > Administer > Taxes. 

### Deliver free amount

`simplecart.deliverfree_amount` The minimum order amount where delivery prices should be ignored, making delivery free. It's possible to set the [delivery methods](Manager/Administration/Delivery_Methods) to ignore this setting.

<!-- 
### Disable Order Logging

`simplecart.disable_order_logs` When enabled, the default order logging is disabled. Only important logs are created.
-->

### Order free amount

`simplecart.orderfree_amount` The minimum order amount where payment method prices should be ignored, making it free to use the payment methods. It's possible to set the [payment methods](Manager/Administration/Payment_Methods) to ignore this setting.

### Order number format

`simplecart.ordernr_format` The format for the order number is parsed like a chunk. You can use output filters too. Available placeholders: = order nr, = context key, = logged-in user (or 0)= 2-digits year, = 4-digits year, = month without leading zeros, = month with leading zeros, = day without leading zeros, = day with leading zeros.

### Order start number

`simplecart.ordernr_start` The first order number where to start if there are no orders made yet. After the first order is placed, the next ones will increment from the highest order number in the system. 

### Status update e-mail chunk

`simplecart.orderstatusupdate_emailtpl` The name of a chunk to use for wrapping the status update emails. See [Update Status](Manager/Orders/Update_Status).

### Product code TV

`simplecart.productcode_tvname` The TV name of the product code. For example: `productCode` Exists primarily for backwards compatibility with SimpleCart v1 and is not needed for newer installs. 

### Product Main Image TV

`simplecart.productimage_tvname` The TV name of the product image keeper. For example: `productImage1`. Exists primarily for backwards compatibility with SimpleCart v1 and is not needed for newer installs. 

### Product price TV

`simplecart.productprice_tvname` TV name of the product price. For example: `productPrice`. Exists primarily for backwards compatibility with SimpleCart v1 and is not needed for newer installs. 

### Product stock TV

`simplecart.productstock_tvname` The TV name of the product stock keeper. For example: `productStock`. Exists primarily for backwards compatibility with SimpleCart v1 and is not needed for newer installs. 

### The storage type of SimpleCart

`simplecart.storage_type` Choose the type to store (for example) cart data in. Possible values are: `cookie` (default), `cache` or `session`

### Use Default CSS

`simplecart.usedefaultcss` Whether or not you want to use SimpleCarts' default CSS in the frontend to let the default output look a little better.
