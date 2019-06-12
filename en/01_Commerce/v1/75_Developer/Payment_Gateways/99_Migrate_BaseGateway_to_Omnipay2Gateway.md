> Note: this documentation explains how to move from the pre-1.1 `BaseGateway` implementation to the newer `Omnipay2Gateway` implementation, introduced in Commerce 1.1.
> 
> It's not necessary to migrate right away, as we continue to support BaseGateway until at least Commerce 1.4, but it is recommended to use the new interfaces and classes to give you more control over the payment flow. 

The `\modmore\Commerce\Gateways\BaseGateway` and `\modmore\Commerce\Gateways\Omnipay2\Omnipay2Gateway` classes are very similar. In fact, `BaseGateway` extends `Omnipay2Gateway` meaning it's a superset of the newer `Omnipay2Gateway` class.

The `BaseGateway` in 1.1 only acts as a backwards compatibility bridge. It will not support newer features we add to gateways, and you should move away from it when upgrading a gateway implementation.

[TOC]

## Migrating your gateway

There are a couple of differences that you'll need to make.

### Change the extended class 

First, make sure that you extend `Omnipay2Gateway` instead of `BaseGateway`.

Before:

````php
class MultiSafePay extends BaseGateway
{
````

After:

````php
class MultiSafePay extends Omnipay2Gateway
{
````

### Change $omnipayGateway to $gatewayName

````php
class MultiSafePay extends BaseGateway
{
    protected $omnipayGateway = 'MultiSafepay_Rest';
````

After:

````php
class MultiSafePay extends Omnipay2Gateway
    protected $gatewayName = 'MultiSafepay_Rest';
{
````

### getPaymentForm()

Do you generate a form by extending `public function getPaymentForm(comOrder $order)`? In the new gateway, that method has been renamed to `public function view(comOrder $order)`. In most cases you wont have to change the actual logic inside the method.

### purchase() / completePurchase() / handleNotification()

Are you overriding logic in `public function purchase(array $options = [])`, `public function completePurchase(array $options = [])` or `public function handleNotification(array $options = [])`? That needs to be refactored into the new `public function submit(comTransaction $transaction, array $data)`, `public function returned(comTransaction $transaction, array $data)` or `public function webhook(\comTransaction $transaction, array $data)` methods instead. 

If you don't have those methods defined, the Omnipay2Gateway class already defines them for you and you can skip this.

In most cases, `purchase()` maps directly to `submit()` (executed when a customer submits the payment form with the gateway selected), while `completePurchase()` maps to `returned()` (executed when the customer returns from an off-site redirected method, or if the customer returns on the payment page with a pending page before a payment is confirmed).

Webhook notifications should be handled by the `webhook()` method. In such cases, the `returned()` method must still be implemented in such a way that it returns the status of the payment at that given time. 

Noteworthy changes include that the methods may no longer return a boolean; they either return a `TransactionInterface` instance or throw a `TransactionException` with a message indicating the problem. As Omnipay drivers return `ResponseInterface` instances, there is a `public static function responseToTransaction(ResponseInterface $response)` method on `Omnipay2Gateway` which turns the Omnipay Response into a Commerce Transaction. That helper function automatically chooses between a `\modmore\Commerce\Gateways\Omnipay2\Transaction` and `\modmore\Commerce\Gateways\Omnipay2\RedirectTransaction` and should be functional for the majority of Omnipay drivers. It may still be worthwhile implementing custom Transaction objects to account for inconsistencies (e.g. `$response->isPending()` doesn't always work the same) or to indicate what additional data to store with transactions (`$transaction->getExtraInformation()`). See the documentation about Gateway Transactions for more information about that.

### preparePurchaseOptions

It's not uncommon for gateways to require custom information, which would have typically been added in `preparePurchase*` or `get*Item` methods. These have all been replaced:
 
- `public function preparePurchaseOptions(array $options = [])` => `protected function _prepareRequestOptions(comTransaction $transaction, array $options = [])` 
- `public function preparePurchaseCard(array $options = [])` => `protected function _prepareCard(comOrder $order)`
- `public function preparePurchaseItems(array $options = [])` => `protected function _prepareItems(comOrder $order)`
- `protected function getItemItem(\comOrderItem $item, array $options = [])` => `protected function _prepareItem(comOrderItem $item)`
- `protected function getShipmentItem(\comOrderShipment $shipment, array $options = [])` => `protected function _prepareShipmentItem(comOrderShipment $shipment)`
- `protected function getTransactionItem(array $options = [])` => `protected function _prepareTransactionItem(comOrder $order)`

Notably the `$options` method argument was dropped and all methods are now `protected` rather than `public`.

### normalizeNames

Calls to `protected function normalizeNames(&$firstname, &$lastname, &$name)` (typically in `preparePurchaseOptions()`) can be replaced with a call to `\modmore\Commerce\Gateways\Helpers\GatewayHelper::normalizeNames`.

### Refunds

While available on the `BaseGateway`, the `public function refund(array $options = [])` method was never fully implemented and has been dropped from the new implementations. When Commerce supports refunds, this will be added as a separate `RefundableGatewayInterface` of sorts.

### getProperty

The `public function getProperty($key, $default = null)` convenience method has been dropped; instead use `$this->method->getProperty()` to get a method property or `$transaction->getProperty()` to get information from a transaction.

### getMethod

`public function getMethod()` has been dropped. Inside the gateway instance, `$this->method` will always contain the `comPaymentMethod` instance.

### `markTransactionSuccessful(ResponseInterface $response)` and `markTransactionCancelled(AbstractResponse $response)`

The markTransactionSuccessful and markTransactionCancelled methods have been dropped. It's not the responsibility of the payment gateway to tell Commerce how/when to process a successful or failed transaction.

Instead of calling or overriding these methods, the gateway should only return the proper `Transaction` instances as a return value from `submit()`, `returned()` or `webhook()`. For example, such a transaction should return true for `isPaid()` or `isCancelled()`. The core webhook handling or checkout process will take the appropriate actions from there.

### getTransactionInfo

The `public function getTransactionInfo(ResponseInterface $response)` methods has been dropped; instead provide a custom `TransactionInterface` instance as a return value from `submit()`, `returned()` or `webhook()` that returns the additional transaction information to store. See `TransactionInterface->getExtraInformation()`. You can implement custom transaction objects either in submit/returned/webhook or in the `public static function responseToTransaction(ResponseInterface $response)` method.

### getNotifyUrl

The `public function getNotifyUrl()` method has been replaced by a call to `\modmore\Commerce\Gateways\Helpers\GatewayHelper::getNotifyURL($transaction)`. Similarly, the [GatewayHelper](GatewayHelper) also has methods for `getReturnUrl` and `getCancelUrl`. 
