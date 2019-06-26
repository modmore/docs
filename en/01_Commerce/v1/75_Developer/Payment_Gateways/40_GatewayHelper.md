The GatewayHelper (`\modmore\Commerce\Gateways\Helpers\GatewayHelper`) is a static helper class that you can use inside payment gateways. 

[TOC]

## getNotifyURL

Use `GatewayHelper::getNotifyURL(comTransaction $transaction)` to get a normalised webhook notification URL. 

This will return a fully qualified URL to `assets/components/commerce/notify.php` with the transaction ID, in such a way that Commerce can automatically route the webhook request to the right transaction/gateway instance. 

## getSharedNotifyURL

Use `GatewayHelper::getSharedNotifyURL(\comPaymentMethod $method)` to get a normalised webhook notification URL for gateways that do not implement transaction-specific notification/webhook URLs. 

This will return a fully qualified URL to `assets/components/commerce/notify.php` with the payment method ID. When such a request is received, and 

## getReturnUrl

Use `GatewayHelper::getReturnURL(comTransaction $transaction)` to get the URL to redirect the customer to in the case of an off-site redirect payment. This is a fully qualified URL to the (context-specific) checkout page, including the transaction ID. 

## getCancelUrl

Use `GatewayHelper::getCancelURL(comTransaction $transaction)` to get the URL to redirect the customer to in the case of an off-site redirect payment that was cancelled. This is a fully qualified URL to the (context-specific) checkout page, including the transaction ID and the cancel_transaction parameter. 

## getDescription

Use `GatewayHelper::getDescription(comOrder $order)` to return the payment description/descriptor that can be shown to the customer or included on a payment reference. This is a translated (lexicon) string in the format `Order {id} at {site_name}`.

The description will automatically use either the order ID or the reference if it is already set, and a context-specific site name.

## normalizeNames

Use `normalizeNames(&$firstName, &$lastName, &$fullName)` to normalize the usage of first/last/full names. Commerce supports both split name fields and fullname fields for addresses, and gateways sometimes require different values.

The normalizeNames method updates the referenced variables:

- If `$firstName` and `$lastName` are empty, but `$fullName` is not, `$firstName` is set to the first space-separated word in `$fullName` and `$lastName` is filled with the remainder. 
- If `$fullName` is empty, but `$firstName` and `$lastName` are not, `$fullName` is set to `$firstName $lastName`. 

