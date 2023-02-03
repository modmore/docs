Commerce event names are available as constants on the main `\Commerce` class. They're all prefixed with `EVENT_`.

[TOC]

## List of Events

When an event is fired, it will provide you with an event object in your callback. That event object typically has access to various types of relevant information through getters. Look at the Event Class further down on this page for details of what the specific event class makes available, or how to use it.

| Constant                                           | Event Class             | Triggered by                                                                                                                               | Use cases                                                                                                                                      |
|----------------------------------------------------|-------------------------|--------------------------------------------------------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------|
| `\Commerce::EVENT_ADDRESS_VALIDATE`                | `AddressValidation`     | Checkout when the customer submits an address                                                                                              | To validate if an address is allowed or correct.                                                                                               |
| `\Commerce::EVENT_STATE_CART_TO_PROCESSING`        | `OrderState`            | `comCartOrder` class when `markProcessed()` is called by a status change or other code.                                                    | To process something when an order is placed, without relying on status change actions.                                                        |
| `\Commerce::EVENT_STATE_CART_TO_CANCELLED`         | `OrderState`            | `comCartOrder` class when `markCancelled()` is called by a status change or other code.                                                    | To process something when a concept order is cancelled.                                                                                        |
| `\Commerce::EVENT_STATE_PROCESSING_TO_COMPLETED`   | `OrderState`            |                                                                                                                                            |                                                                                                                                                |
| `\Commerce::EVENT_STATE_PROCESSING_TO_CANCELLED`   | `OrderState`            |                                                                                                                                            |                                                                                                                                                |
| `\Commerce::EVENT_ORDER_BEFORE_CALCULATE `         | `Order`                 | `comOrder->calculate`                                                                                                                      |                                                                                                                                                |
| `\Commerce::EVENT_ORDER_AFTER_CALCULATE `          | `Order`                 | `comOrder->calculate`                                                                                                                      |                                                                                                                                                |
| `\Commerce::EVENT_ORDER_BEFORE_STATUS_CHANGE`      | `OrderStatus`           |                                                                                                                                            |                                                                                                                                                |
| `\Commerce::EVENT_ORDER_AFTER_STATUS_CHANGE`       | `OrderStatus`           |                                                                                                                                            |                                                                                                                                                |
| `\Commerce::EVENT_ORDER_ADDRESS_ADDED`             | `Address`               |                                                                                                                                            |                                                                                                                                                |
| `\Commerce::EVENT_ORDER_MESSAGE_PLACEHOLDERS`      | `MessagePlaceholders`   | `comOrderMessage` when collecting placeholders for messages                                                                                | To add additional information (placeholders) to emails or other content that gets sent through the order messages system.                      |
| `\Commerce::EVENT_ORDERITEM_ADDED`                 | `OrderItem`             |                                                                                                                                            |                                                                                                                                                |
| `\Commerce::EVENT_ORDERITEM_UPDATED`               | `OrderItem`             |                                                                                                                                            |                                                                                                                                                |
| `\Commerce::EVENT_ORDERITEM_REMOVED`               | `OrderItem`             |                                                                                                                                            |                                                                                                                                                |
| `\Commerce::EVENT_ORDERITEM_BEFORE_CALCULATE`      | `OrderItem`             | `comOrderItem->calculate`                                                                                                                  |                                                                                                                                                |
| `\Commerce::EVENT_ORDERITEM_AFTER_CALCULATE `      | `OrderItem`             | `comOrderItem->calculate`                                                                                                                  |                                                                                                                                                |
| `\Commerce::EVENT_TRANSACTION_CREATED`             | `Transaction`           | v1.1 - `comOrder::addTransaction`, in the checkout flow when a transaction is initialised.                                                 | Synchronising transactions with 3rd party system                                                                                               |
| `\Commerce::EVENT_TRANSACTION_CANCELLED`           | `Transaction`           | v1.1 - `comTransaction::markCancelled` called by checkout or webhook action where the payment attempt is cancelled                         | Synchronising transactions                                                                                                                     |
| `\Commerce::EVENT_TRANSACTION_PROCESSING`          | `Transaction`           | v1.1 - `comTransaction::markProcessing` called by checkout or webhook action when the payment first enters a processing/open/pending state | Synchronising transactions                                                                                                                     |
| `\Commerce::EVENT_TRANSACTION_FAILED`              | `Transaction`           | v1.1 - `comTransaction::markFailed` called by checkout or webhook action when the payment failed.                                          | Synchronising transactions                                                                                                                     |
| `\Commerce::EVENT_TRANSACTION_COMPLETED`           | `Transaction`           | v1.1 - `comTransaction::markCompleted` called by checkout or webhook action when the payment was successful.                               | Synchronising transactions                                                                                                                     |
| `\Commerce::EVENT_DASHBOARD_INIT_GENERATOR`        | `Admin\GeneratorEvent`  | When initialising the dashboard and loading the available pages (controllers/views).                                                       |                                                                                                                                                |
| `\Commerce::EVENT_DASHBOARD_GET_MENU`              | `Admin\TopNavMenu`      | When initialising the dashboard and generating the navigation.                                                                             | Customising the navigation or adding links to additional pages.                                                                                |
| `\Commerce::EVENT_DASHBOARD_PAGE_BEFORE_GENERATE`  | `Admin\PageEvent`       |                                                                                                                                            |                                                                                                                                                |
| `\Commerce::EVENT_DASHBOARD_CHECKLIST_GET_CHECKS`  | `Checklist`             | Configuration checklist in the dashboard                                                                                                   |                                                                                                                                                |
| `\Commerce::EVENT_DASHBOARD_REPORTS_GET_REPORTS`   | `Reports`               | Reporting section of the dashboard                                                                                                         | Allows you to register additional reports or exports.                                                                                          |
| `\Commerce::EVENT_DASHBOARD_GET_RATE_PROVIDERS`    | `RateProvider`          | Tax rules form to select the rate provider                                                                                                 | Register custom rate providers to be used for taxation.                                                                                        |
| `\Commerce::EVENT_DASHBOARD_ORDER_ACTIONS`         | `Admin\OrderActions`    | In the dashboard when generating the possible actions for an order.                                                                        |                                                                                                                                                |
| `\Commerce::EVENT_DASHBOARD_ORDER_ITEM_DETAIL`     | `Admin\OrderItemDetail` | In the dashboard when listing order items.                                                                                                 | Add additional information or details into the order items grid per order item.                                                                |
| `\Commerce::EVENT_DASHBOARD_ORDERSHIPMENT_ACTIONS` | `Admin\ShipmentActions` | In the dashboard when listing order shipments.                                                                                             | Add additional actions to order shipments                                                                                                      |
| `\Commerce::EVENT_CHECKOUT_BEFORE_STEP`            | `Checkout`              | During the checkout, before a specific step is processed.                                                                                  | Generally for processing that will impact the regular step processing, so has to be processed first.                                           |
| `\Commerce::EVENT_CHECKOUT_AFTER_STEP`             | `Checkout`              | During the checkout, after a step has been processed, but not yet returned to the page.                                                    | Generally for making additional placeholders or information available.                                                                         |
| `\Commerce::EVENT_ITEM_ADDED_TO_CART`              | `Cart\Item`             | Only in the cart when a product is added to cart.                                                                                          | Adding additional information or corrections to items added to the cart.                                                                       |
| `\Commerce::EVENT_GET_PAYMENT_GATEWAYS`            | `Gateway`               | Administrator listing available gateways when creating or editing payment methods.                                                         | Registering custom payment gateways.                                                                                                           |
| `\Commerce::EVENT_GET_PDF_WRITER`                  | `PdfWriter`             | Commerce core whenever a PDF writer is required.                                                                                           | Registering a PDF writer that can turn a HTML snippet into a PDF.                                                                              |
| `\Commerce::EVENT_SEND_MAIL`                       | `Mail`                  | v1.3 - comOrderEmailMessage right before sending an email.                                                                                 | Customizing an email before it is sent; including adding attachments, adding/changing the recipients, or altering the content. (Added in v1.3) |
| `\Commerce::EVENT_SCHEDULER_BEFORE`                | `Scheduler`             | v1.3 - `Services\SchedulerScheduler::fetch` Before the Scheduler service runs a background task.                                           | Customizing an email before it is sent; including adding attachments, adding/changing the recipients, or altering the content. (Added in v1.3) |
| `\Commerce::EVENT_SCHEDULER_AFTER`                 | `Scheduler`             | v1.3 - `Services\Scheduler\Handler::handle` After the Scheduler service runs a background task.                                            | Customizing an email before it is sent; including adding attachments, adding/changing the recipients, or altering the content. (Added in v1.3) |

### Common use cases

- To trigger something when an order is complete, consider using a [custom status change action](../Status_Change_Actions) or use `\Commerce::EVENT_STATE_CART_TO_PROCESSING`
- To implement custom address validation, use `\Commerce::EVENT_ADDRESS_VALIDATE`
- To accept and store additional information in the checkout, use `\Commerce::EVENT_CHECKOUT_BEFORE_STEP` to create [custom order fields](../Order_Fields)
- For registering pages or assets into the manager dashboard, use `\Commerce::EVENT_DASHBOARD_INIT_GENERATOR` and `\Commerce::EVENT_DASHBOARD_GET_MENU`
- To change outgoing emails without needing a custom mail class, use `\Commerce::EVENT_SEND_MAIL`

## Event Classes

All event classes are in the `modmore\Commerce\Events` namespace. They all extend the [Event](http://api.symfony.com/2.8/Symfony/Component/EventDispatcher/Event.html) class.

Some events only allow you to hook in to listen, while others also allow you to "talk back" with setters on the event class. It's strongly recommended to use a good IDE (like PhpStorm) when writing modules, so you can take advantage of auto-complete and the ability to jump to the calling code to see how things work.

### Address

FQN: `modmore\Commerce\Events\Address`

- `getAddressJoin()`: returns a `comOrderAddress` object
- `getAddress()`: returns a `comAddress` object
- `getOrder()`: returns a `comOrder` object

### AddressValidation

FQN: `modmore\Commerce\Events\AddressValidation`

- `getAddress()`: returns a `comAddress` object
- `getOrder()`: returns a `comOrder` object
- `getType()`: returns a string "billing" or "shipping" to indicate what type of address is being validated.
- `addFieldError(string $field, string $message)`: adds a field-specific error to the validation.
- `addMessage(string $message)`: adds a generic error message to the validation.
- `hasAnyErrors()`: returns true if there is at least one field specific error, or an error message.
- `getFieldErrors()`: returns an array of AddressValidationError objects (same namespace) with the field specific errors.
- `hasMessages()`: returns true if there's at least one generic error message set.
- `getMessages()`: returns an array of generic error messages.

### Checklist

FQN: `modmore\Commerce\Events\Checklist`

- `addCheck(modmore\Commerce\Admin\Configuration\Checklist\Check $instance)`: Adds the provided check instance to the checklist.
- `getChecks()`: returns an array of all module provided checks.

### Checkout

FQN: `modmore\Commerce\Events\Checkout`

- `getProcess()`
- `getStepKey()`
- `getStep()`
- `getData()`
- `getDataKey(string $key, mixed $default = null)`
- `setData(array $data)`
- `getOrder()`
- `getResponse()`
- `getRequestMethod()` returns GET or POST (as of v1.1)

### Mail

FQN: `modmore\Commerce\Events\Mail`

- `attach(string $filePath, bool $storeContents = false)`: attaches the file located at `$filePath` (provide a fully qualified path) to the outgoing email. Optionally, if `$storeContents` is enabled, the file contents will be persisted alongside the email in the database properties as base64. This could get rather big, but could be potentially used to keep a more permanent record.
- `public function clearAttachments()`: removes all attachments from the email
- `public function setRecipient(string $email, string $name)`: removes any pre-set recipients, and instead replaces it with the email and name provided.
- `public function addRecipient(string $type, string $email, string $name)`: adds an extra recipient to the email; `$type` can be one of `to`, `cc`, `bcc`, or `reply_to`. Note that adding additional "to" or "cc" addresses will **add** that to the email - it will not send multiple emails to each individually.
- `public function getBody(): string`: returns the body (content) of the email.
- `public function setBody(string $body)`: overrides the body (content) of the email.
- `public function getMessage(): comOrderMessage`: returns the `comOrderMessage` instance being sent. You can use `$event->getMessage->get('message_key')`: to compare against the message key that may (or may not!) be configured in the status configuration that created the email message.
- `public function getOrder(): comOrder`: returns the order this message is for, useful for example to check the context (`$event->getOrder()->get('context')`) this order was created from.

### Gateways

FQN: `modmore\Commerce\Events\Gateways`

- `addGateway(string $class, string $label)`: provide the FQN for a payment gateway (must be autoloadable), and a translated label for it.
- `getGateways()`: returns an array of value/label pairs for custom registered gateways

### MessagePlaceholders

FQN: `modmore\Commerce\Events\MessagePlaceholders`

- `setPlaceholder(string $key, mixed $value)`: set a single placeholder
- `getPlaceholders()`: return all placeholders set by modules
- `getMessage()`: returns a `\comOrderMessage` instance for which placeholders are requested.
- `getOrder()`: returns the relevant `\comOrder` instance

### Order

FQN: `modmore\Commerce\Events\Order`

- `getOrder()`: returns the comOrder instance.

### OrderItem

FQN: `modmore\Commerce\Events\OrderItem`

- `getItem()`: returns the affected comOrderItem instance
- `getOrder()`: returns the relevant comOrder instance

### OrderState

FQN: `modmore\Commerce\Events\OrderState`

- `getOrder()`: returns the comOrder instance
- `getOldState()`: returns the old state as string
- `getNewState()`: returns the new state as string

### OrderStatus

FQN: `modmore\Commerce\Events\OrderStatus`

- `getOrder()`
- `getOldStatus()`: returns the old comStatus object
- `getNewStatus()`: returns the new comStatus object
- `getStatusChange()`: returns the comStatusChange object

### Payment

FQN: `modmore\Commerce\Events\Payment`

**Deprecated**, removed in v1.1.

- `getGateway()`: returns the BaseGateway instance for the received payment
- `getMethod()`: returns the comPaymentMethod instance
- `getTransaction()`: returns the comTransaction instance
- `getOrder()`: returns the comOrder instance
- `getResponse()`: returns an implementation of `Omnipay\Common\Message\ResponseInterface` that describes the successful payment response. What information this contains depends on the gateway implementation, but usually includes an array in `$response->getData()`. (added in 0.11)

### RateProvider

FQN: `modmore\Commerce\Events\RateProvider`

- `addProvider(string $class, string $name)`: registers a rate provider. If the class doesn't exist (or can't be autoloaded), this will return false, otherwise it will return true.
- `getProviders()`: returns an array of module registered rate providers.

### Reports

FQN: `modmore\Commerce\Events\Reports`

- `addReport(ReportInterface $report)`: adds a report to the list of reports. This needs to be provided an instance.
- `getReports()`: returns an array of all module registered rate providers.

### Transaction

FQN: `modmore\Commerce\Events\Transaction`

- `getTransaction()`: returns the relevant `comTransaction` object. From that you can use `getOrder()` to get the `comOrder` instance, and `getMethod()` to get the `comPaymentMethod` instance.

### Admin\GeneratorEvent

FQN: `modmore\Commerce\Events\Admin\GeneratorEvent`

- `getGenerator()`: returns the Generator. You can use this to add pages via `$generator->addPage()`.

### Admin\OrderActions

FQN: `modmore\Commerce\Events\Admin\OrderActions` (extends `modmore\Commerce\Events\Admin\Actions`)

- `getActions()`: returns order actions.
- `setActions(array $actions)`: sets an array of actions. Note that this will overwrite the old set of actions (so you can reorder things, for example), so make sure to `array_merge` the result of `getActions()` if you just want to add something, or use addAction instead. Actions are instances of `modmore\Commerce\Admin\Util\Action`, or (deprecated) arrays with a `url`, `title` and (if you want the url to open in a modal) `modal` with a value of `true`.
- `addAction(modmore\Commerce\Admin\Util\Action $action)`: add a single action.
- `getOrder()`: returns the comOrder object.

### Admin\OrderItemDetail

FQN: `modmore\Commerce\Events\Admin\OrderItemDetail`

- `getItem()`: returns the comOrderItem the detail is being rendered for
- `addRow(string $html)`: from your module, write some arbitrary HTML to the item's detail section
- `getRows()`: returns the added rows to the item

### Admin\OrderMenu

FQN: `modmore\Commerce\Events\Admin\OrderMenu`

- `getActivePage()`: returns a Page instance.
- `getItems()`: returns an array of menu items
- `setItems(array $items)` Sets (overwrites) an array of menu items.

### Admin\PageEvent

FQN: `modmore\Commerce\Events\Admin\PageEvent`

- `getPage()`: returns a Page instance.

### Admin\ShipmentActions

FQN: `modmore\Commerce\Events\Admin\ShipmentActions` (extends `modmore\Commerce\Events\Admin\Actions`)

- `getActions()`: returns order actions.
- `setActions(array $actions)`: sets an array of actions. Note that this will overwrite the old set of actions (so you can reorder things, for example), so make sure to `array_merge` the result of `getActions()` if you just want to add something, or use addAction instead. Actions are instances of `modmore\Commerce\Admin\Util\Action`, or (deprecated) arrays with a `url`, `title` and (if you want the url to open in a modal) `modal` with a value of `true`.
- `addAction(modmore\Commerce\Admin\Util\Action $action)`: add a single action.
- `getOrderShipment()`: returns the `comOrderShipment` object. The `comOrder` instance is available from `$shipment->getOrder()`.

### Admin\TopNavMenu

FQN: `modmore\Commerce\Events\Admin\TopNavMenu`

- `getActivePage()`: returns a Page instance.
- `getItems()`: returns an array of menu items
- `setItems(array $items)` Sets (overwrites) an array of menu items.

### Cart\Item

FQN: `modmore\Commerce\Events\Cart\Item`

- `getItem()`: returns the `comOrderItem` instance
- `getOrder()`: returns the `comOrder` instance
- `getOptions()`: returns an array of request parameters (GET and/or POST) that were sent along with the add-to-cart request. **This is unfiltered input, use wisely.**
- getOption(string $key, mixed $default = null): returns a single option that was sent in GET or POST, which is not empty, or the provided default.


### Scheduler

FQN: `modmore\Commerce\Events\Scheduler`

- `getScheduler()`: returns the `Services\Scheduler\Scheduler` instance.
- `getTasks()`: returns an array of current tasks.