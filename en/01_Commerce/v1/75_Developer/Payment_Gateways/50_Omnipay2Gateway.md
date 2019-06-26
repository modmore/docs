The Omnipay2Gateway abstract class can be used to quickly implement Omnipay 2 payment drivers into the Commerce gateway/transaction system introduced in v1.1.

The Omnipay2Gateway class automatically implements `GatewayInterface` and `WebhookGatewayInterface`, calling `$driver->purchase()` on `submit()`, `$driver->completePurchase()` on `returned()`, and `$driver->acceptNotification()` on `webhook()`. The resulting response is automatically turned into a `\modmore\Commerce\Gateways\Omnipay2\Transaction` or `\modmore\Commerce\Gateways\Omnipay2\RedirectTransaction` respectively.

