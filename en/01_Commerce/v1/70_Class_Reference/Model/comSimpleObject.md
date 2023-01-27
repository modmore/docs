Base object for all model classes in Commerce.

Contains logic for Formatters, properties, making the Commerce class and adapter available, etc.

## Meta

- Extends: `xPDOSimpleObject`

## Descendant Classes

- [`comCurrency`](comCurrency)
- [`comProduct`](comProduct)
- [`comProductBundleProduct`](comProductBundleProduct)
- [`comProductPriceIndex`](comProductPriceIndex)
- [`comProductMatrix`](comProductMatrix)
- [`comProductMatrixColumn`](comProductMatrixColumn)
- [`comProductMatrixRow`](comProductMatrixRow)
- [`comOrder`](comOrder)
- [`comOrderField`](comOrderField)
- [`comOrderItem`](comOrderItem)
- [`comOrderShipment`](comOrderShipment)
- [`comInvoice`](comInvoice)
- [`comDeliveryType`](comDeliveryType)
- [`comShippingMethod`](comShippingMethod)
- [`comStatus`](comStatus)
- [`comStatusChange`](comStatusChange)
- [`comStatusChangeAction`](comStatusChangeAction)
- [`comTaxGroup`](comTaxGroup)
- [`comTaxRule`](comTaxRule)
- [`comTaxRate`](comTaxRate)
- [`comOrderItemTax`](comOrderItemTax)
- [`comOrderItemAdjustment`](comOrderItemAdjustment)
- [`comOrderLog`](comOrderLog)
- [`comOrderAddress`](comOrderAddress)
- [`comAddress`](comAddress)
- [`comOrderMessage`](comOrderMessage)
- [`comTransaction`](comTransaction)
- [`comTransactionLog`](comTransactionLog)
- [`comPaymentMethod`](comPaymentMethod)
- [`comSchedulerTask`](comSchedulerTask)
- [`comI18n`](comI18n)
- [`comModule`](comModule)
- [`comCoupon`](comCoupon)
- [`comCouponUsage`](comCouponUsage)
- [`comDiscount`](comDiscount)
- [`comResourceProduct`](comResourceProduct)
- [`comProductBundle`](comProductBundle)
- [`comProductMatrixProduct`](comProductMatrixProduct)
- [`comCartOrder`](comCartOrder)
- [`comProcessingOrder`](comProcessingOrder)
- [`comCompletedOrder`](comCompletedOrder)
- [`comCancelledOrder`](comCancelledOrder)
- [`comSessionCartOrder`](comSessionCartOrder)
- [`comSessionCartOrderItem`](comSessionCartOrderItem)
- [`comShippingMethodByCountry`](comShippingMethodByCountry)
- [`comShippingMethodByWeight`](comShippingMethodByWeight)
- [`comStatusChangeActionEmail`](comStatusChangeActionEmail)
- [`comStatusChangeActionEvent`](comStatusChangeActionEvent)
- [`comStatusChangeActionInvoice`](comStatusChangeActionInvoice)
- [`comStatusChangeActionCaptureTransactions`](comStatusChangeActionCaptureTransactions)
- [`comStatusChangeActionWebhook`](comStatusChangeActionWebhook)
- [`comOrderItemShippingAdjustment`](comOrderItemShippingAdjustment)
- [`comOrderItemDiscountAdjustment`](comOrderItemDiscountAdjustment)
- [`comOrderItemExtraAdjustment`](comOrderItemExtraAdjustment)
- [`comOrderEmailMessage`](comOrderEmailMessage)
- [`comOrderInternalMessage`](comOrderInternalMessage)
- [`comOrderTemplatedEmailMessage`](comOrderTemplatedEmailMessage)
- [`comFreeProductDiscount`](comFreeProductDiscount)
- [`comUserDiscount`](comUserDiscount)
- [`comUserGroupDiscount`](comUserGroupDiscount)

The following classes belong to classes in extensions or third-party code. They may require a package to be installed or are not publicly available at all.

- `ctsSchedule`
- `ctsScheduleSlot`
- `ctsDate`
- `ctsDateSlot`
- `ctsOrderSlot`
- `Digitalproduct`
- `DigitalproductFile`
- `DigitalproductProduct`
- `UserGroupShipment`
- `MyParcelOrderShipment`
- `DigitalproductOrderShipment`
- `TableRatesShippingMethod`
- `MyParcelShippingMethod`
- `TimeSlotsShippingMethod`
- `GoogleRoutesShippingMethod`
- `UserGroupStatusChangeAction`
- `MyParcelCreateShipmentAction`
- `ReserveTimeSlotStatusChangeAction`
- `SlackStatusChangeAction`
- `SnippetStatusChangeAction`
- `CaptureKlarnaOrder`
- `ReleaseKlarnaOrder`
- `AvalaraCreateTransaction`

## Fields


| Field | Type | Description |
| ----- | ---- | ----------- |
| **id** | integer (`INTEGER`) | Primary key |
| **class_key** | string (`varchar[100]`) | Type of object |
| **properties** | array (`text`)<br>may be null | Serialized arbitrary data stored with an object. Use utility methods instead of directly accessing these values: `getProperty($key, $default)`, `getProperties()`, `setProperty($key, $value)`, `setProperties($properties, $merge)`, `unsetProperty($key)`, `unsetProperties($keys)` |
