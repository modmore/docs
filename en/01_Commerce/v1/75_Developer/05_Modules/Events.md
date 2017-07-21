Commerce event names are available as constants on the main `\Commerce` class. They're all prefixed with `EVENT_`. 

[TOC]

## List of Events

When an event is fired, it will provide you with an event object in your callback. That event object typically has access to various types of relevant information through getters. Look at the Event Class further down on this page for details of what the specific event class makes available, or how to use it. 

|Constant|Event Class|Triggered by|Use cases|
|---|---|---|---|
|`\Commerce::EVENT_ADDRESS_VALIDATE`|`AddressValidation`|Checkout when the customer submits an address|To validate if an address is allowed or correct.|
|`\Commerce::EVENT_STATE_CART_TO_PROCESSING`|`OrderState`|`comCartOrder` class when `markProcessed()` is called by a status change.|To process something when an order is placed, without relying on status change actions.|
|`\Commerce::EVENT_STATE_CART_TO_CANCELLED`|`OrderState`| | |
|`\Commerce::EVENT_STATE_PROCESSING_TO_COMPLETED`|`OrderState`| | |
|`\Commerce::EVENT_STATE_PROCESSING_TO_CANCELLED`|`OrderState`| | |
|`\Commerce::EVENT_ORDER_BEFORE_CALCULATE `|`Order`| | |
|`\Commerce::EVENT_ORDER_AFTER_CALCULATE `|`Order`| | |
|`\Commerce::EVENT_ORDER_BEFORE_STATUS_CHANGE`|`OrderStatus`| | |
|`\Commerce::EVENT_ORDER_AFTER_STATUS_CHANGE`|`OrderStatus`| | |
|`\Commerce::EVENT_ORDER_PAYMENT_RECEIVED`|`Payment`| | |
|`\Commerce::EVENT_ORDER_GET_ACTIONS`|`Admin\OrderActions`| | |
|`\Commerce::EVENT_ORDER_ADDRESS_ADDED`|`Address`| | |
|`\Commerce::EVENT_ORDERITEM_ADDED`|`OrderItem`| | |
|`\Commerce::EVENT_ORDERITEM_UPDATED`|`OrderItem`| | |
|`\Commerce::EVENT_ORDERITEM_REMOVED`|`OrderItem`| | |
|`\Commerce::EVENT_ORDERITEM_BEFORE_CALCULATE`|`OrderItem`| | |
|`\Commerce::EVENT_ORDERITEM_AFTER_CALCULATE `|`OrderItem`| | |
|`\Commerce::EVENT_DASHBOARD_GET_PAGES`|`Admin\GeneratorEvent`| |
|`\Commerce::EVENT_DASHBOARD_GET_MENU`|`Admin\TopNavMenu`| | |
|`\Commerce::EVENT_DASHBOARD_PAGE_BEFORE_GENERATE`|`Admin\PageEvent`| | |
|`\Commerce::EVENT_DASHBOARD_CHECKLIST_GET_CHECKS`|`Checklist`| | |
|`\Commerce::EVENT_DASHBOARD_REPORTS_GET_REPORTS`|`Reports`| | |
|`\Commerce::EVENT_CHECKOUT_BEFORE_STEP`|`Checkout`| | |
|`\Commerce::EVENT_CHECKOUT_AFTER_STEP`|`Checkout`| | |

## Event Classes

All event classes are in the `modmore\Commerce\Events` namespace. They all extend the [Event](http://api.symfony.com/2.8/Symfony/Component/EventDispatcher/Event.html) class.

Some events only allow you to hook in to listen, while others also allow you to "talk back" with setters on the event class.

### Address

- `getAddressJoin()`: returns a `comOrderAddress` object
- `getAddress()`: returns a `comAddress` object
- `getOrder()`: returns a `comOrder` object

### AddressValidation

- `getAddress()`: returns a `comAddress` object
- `getOrder()`: returns a `comOrder` object
- `getType()`: returns a string "billing" or "shipping" to indicate what type of address is being validated.
- `addFieldError(string $field, string $message)`: adds a field-specific error to the validation.
- `addMessage(string $message)`: adds a generic error message to the validation.
- `hasAnyErrors()`: returns true if there is at least one field specific error, or an error message.
- `getFieldErrors()`: returns an error of AddressValidationError objects (same namespace) with the field specific errors.
- `hasMessages()`: returns true if there's at least one generic error message set.
- `getMessages()`: returns an array of generic error messages.

### Checklist

- `addCheck(modmore\Commerce\Admin\Configuration\Checklist\Check $instance)`: Adds the provided check instance to the checklist.
- `getChecks()`: returns an array of all module provided checks.

### Checkout

- `getProcess()`
- `getStepKey()`
- `getStep()`
- `getData()`
- `getDataKey(string $key, mixed $default = null)`
- `setData(array $data)`
- `getOrder()`
- `getResponse()`

### Order

- `getOrder()`: returns the comOrder instance. 

### OrderItem

- `getItem()`: returns the affected comOrderItem instance
- `getOrder()`: returns the relevant comOrder instance

### OrderState

- `getOrder()`: returns the comOrder instance
- `getOldState()`: returns the old state as string 
- `getNewState()`: returns the new state as string

### OrderStatus

- `getOrder()`
- `getOldStatus()`: returns the old comStatus object
- `getNewStatus()`: returns the new comStatus object
- `getStatusChange()`: returns the comStatusChange object

### Payment

- `getGateway()`: returns the BaseGateway instance for the received payment
- `getMethod()`: returns the comPaymentMethod instance 
- `getTransaction()`: returns the comTransaction instance
- `getOrder()`: returns the comOrder instance

### RateProvider

- `addProvider(string $class, string $name)`: registeres a rate provider. If the class doesn't exist (or can't be autoloaded), this will return false, otherwise it will return true.
- `getProviders()`: returns an array of module registered rate providers.

### Reports

- `addReport(ReportInterface $report)`: adds a report to the list of reports. This needs to be provided an instance.
- `getReports()`: returns an array of all module registered rate providers.

### Admin/GeneratorEvent

- `getGenerator()`: returns the Generator. You can use this to add pages via `$generator->addPage()`.

### Admin/OrderActions

- `getActions()`: returns order actions.
- `setActions(array $actions)`: sets an array of actions. Note that this will overwrite the old set of actions (so you can reorder things, for example), so make sure to `array_merge` the result of `getActions()` if you just want to add something. Actions are arrays with a `url`, `title` and (if you want the url to open in a modal) `modal` with a value of `true`.
- `getOrder()`: returns the comOrder object.

### Admin/OrderMenu

- `getActivePage()`: returns a Page instance.
- `getItems()`: returns an array of menu items
- `setItems(array $items)` Sets (overwrites) an array of menu items.

### Admin/PageEvent

- `getPage()`: returns a Page instance.

### Admin/TopNavMenu

- `getActivePage()`: returns a Page instance.
- `getItems()`: returns an array of menu items
- `setItems(array $items)` Sets (overwrites) an array of menu items.