---
title: Emails & Messages
---

Order Messages are communications from the shop specific to a certain order. Typically these are email notifications to the customer, but could also include emails to the merchant about the new order, text (SMS) messages sent via a third party integration, or other forms of order-specific communication.

[TOC]

## Emails in the status workflow

By default, Commerce will create a [status workflow](../Statuses) for you on installation that includes 2 email messages when an order is first received:

- "New order received" notification, sent to the merchant
- "Thanks for your order" email, sent to the customer

You can change the configuration for these emails (such as the merchant recipient email) by going to Commerce > Configuration > Statuses, and clicking the email you want to change in the Status Changes column.

There are more ways you can change the default emails with various settings. [There's a summary available here](https://support.modmore.com/article/170-how-can-i-change-the-emails-that-get-sent-when-an-order-is-placed).

## Viewing & sending Messages

To manage Order Messages, go to Commerce > Orders and when viewing an order navigate to the Messages tab. There you can see all previous messages, and create new ones.

When creating messages, you can choose if it should be sent immediately or not. When you uncheck the _Send message right away_ checkbox, it will be stored as a draft.

To send a draft hover over _Actions_ in the grid and select _Send Message_. To view a message contents, click _View Message Content_.

For automated messages, such as those created through an [Email Status Change Action](../Statuses/Email_Action), messages are usually sent right away.

Multiple recipients are supported, separate them with a comma.

## Message Types

The Commerce core provides 3 message types: Email, Formatted Email and Internal Note.

### Email Message

The email message type is the most common one. It sends, surprisingly, an email!

Email sending is done through MODX using PhpMailer, so make sure [MODX is properly set up for email sending](https://docs.modx.com/current/en/building-sites/sending-mail) (in MODX under System > Settings > Email area). It's strongly encouraged to use SMTP with an email delivery service like Mandrill, Postmark, Amazon SES, or others. Make sure that SPF and DKIM are configured properly for optimal delivery.

### Formatted Email Message

The formatted email, introduced in v1.2.0, lets you send an email that is wrapped in a nice template so it looks more professional than the standard "raw" email.

The used template, by default, is `emails/message.twig`. You can override its content using [custom Twig templating](../Front-end_Theming), and you can also set a different template to be used with the `commerce.templated_message_template` system setting. You can use all the placeholders in the template as described below, with the addition of the `message_content` block, which will be filled with the content added in the interface (`{% block message_content %}{% endblock %}`).

The content entered into a formatted message is processed using markdown (specifically, parsedown), to enable easier use of links and basic formatting options.

### Internal Note

The internal message type creates an internal note. It is not sent to anyone, but remains available to be checked on the order.

## Testing email templates the easy way

If you're working on customising email templates, it's useful to not go through the checkout for each attempt. You can do that by viewing the order detail page, Messages tab, and clicking "View Message".

In Commerce 1.2+, first disable the `commerce.save_sent_message_content` system setting before creating your test email. Doing so will make sure that the email template is re-rendered each time you view the message in the dashboard.

If you're looking for where the standard emails are defined, go to Configuration > Statuses and click on the status change that corresponds with payment received. That will have the default twig syntax to use in the message content.

## Available Placeholders

For the Email Message Type, and possibly third party message types, you can use a whole bunch of placeholders in the Subject and Content fields.

These are parsed as [Twig templates](../Front-end_Theming), so you can use logic in the emails as well.

An example of all placeholders is included at the end of this page. We'll discuss a couple special fields first.

### Order Fields

**Order fields** are available with the `order` prefix, like `{{ order.id }}`, `{{ order.total_formatted }}` and `{{ order.total_quantity }}`.

### Order Items

An array of order items is found in the `items` placeholder, which could be used like this:

```` twig
<ul>
{% for item in items %}
   <li>{{ item.quantity }}x {{ item.name }} - {{ item.total_formatted }}</li>
{% endfor %}
</ul>
````

_When items are assigned to a product_, you can find the product information in item.product. The exact information you'll find there may depend on the product type.

For example: `{{ item.product.weight_formatted }}`

### Addresses

Address information is available with the `billing_address` and `shipping_address` prefixes. For example `{{ billing_address.fullname }}`, `{{ shipping_address.address1 }}` and `{{ shipping_address.email }}`.

Note that depending on your checkout, it is possible only one or the other is available - build your template accordingly.

To automatically format the address, use the `format_address` filter like this: `{{ shipping_address|format_address }}`.

### Shipments & Shipping Methods

An array of [order shipments](Shipments) is available as `{{ shipments }}`, each containing the shipping method that was chosen. Here's how you may use that:

``` html
{% for shipment in shipments %}
    <p>Shipment {{ shipment.id }} will be delivered by {{ shipment.method.name }}</p>
{% endfor %}
```

As of v1.1, the `{{ shipment.total_weight }}`, `{{ shipment.tracking_url }}` and `{{ shipment.email_note }}` placeholders are available.

- The tracking_url needs to be provided by a custom order shipment implementation and may not be available until an order has been processed.
- The total_weight is calculated from each products' configured weight times the quantity. The unit this is in will be based on the weight unit set on the first product that was processed.
- The email_note is fully-rendered HTML based on the shipping methods' configured email note at the time the email is sent. In v0.12 and 1.0 you can access the email note as `{{ shipping_method_note }}`.

Because the `tracking_url` is only available with specific shipment types (like MyParcel), there is also a generic `tracking_reference` that you can manually add to a shipment from the dashboard. Click on the shipment name in the order detail page to add that.

If you're looking to organise your order items by shipment, you will need to combine the iteration and match `item.shipment` to `shipment.id`, like this:

``` html
{% for shipment in shipments %}
    <h3>{{ shipment.name }}</h3>

    {% if shipment.email_note %}
        {{ shipment.email_note|raw }}
    {% endif %}

    <ul>
        {% for item in items %}
            {% if item.shipment == shipment.id %}
                <li>{{ item.quantity }}x {{ item.name }} - {{ item.total_formatted }}</li>
            {% endif %}
        {% endfor %}
    </ul>

    <p>Total {{ shipment.product_quantity }} products, weight: {{ shipment.total_weight }}</p>

    {% if shipment.tracking_url %}
        <p><a href="{{ shipment.tracking_url }}" class="button">Track shipment {{ shipment.tracking_reference }}</a></p>
    {% elseif shipment.tracking_reference %}
        <p>Tracking reference: {{ shipment.tracking_reference }}</p>
    {% endif %}
{% endfor %}
```

(Prior to v0.8, you could use `{{ shipping_method }}`, but that has been deprecated and no longer returns the method for orders placed since the 0.8 update)

### Transactions & Payment Methods

Transactions for an order are available in a `{{ transactions }}` array that you can iterate over (as of v0.11.0-rc2).

Only completed transactions are included in this array, so you don't have to filter out failed/pending transactions.

Note that a transaction with the [Manual payment gateway](../Payment_Methods/Manual) is considered successful/paid by Commerce, even though may users apply that as a "pay in store"-type payment.

It is technically possible for there to be more than one completed transaction (e.g. partial payments or loyalty cards), though that's uncommon at this time.

Transactions include the payment method as `{{ transaction.method }}.

An example:

``` html
{% for transaction in transactions %}
    <p>Thank you for your {{ transaction.amount_formatted }} payment via {{ transaction.method.name }}.</p>
{% endfor %}
```

As of v1.1, the payment-method specific email note is also available on the transaction as `{{ transaction.email_note|raw }}`. In v0.12 and 1.0 you can access the email note as `{{ payment_method_note|raw }}`.

### Order fields

Custom order fields are available in `order_fields`, already rendered for the customer (as of v0.11).

To render a specific order field:

```html
{{ order_fields.coupon|raw }}
```

To render all order fields, iterate over the array:

```html
{% for name, value in order_fields %}
    <p><b>{{ lex('commerce.' ~ name) }}</b>: {{ value|raw }}</p>
{% endfor %}
```

Note that we're applying the `raw` filter to the value - this allows custom order fields to output HTML (like a link or .

### Payment/Shipping notes

On payment and shipping methods you can set an _Email Note_ that is automatically included in the email when those methods are selected. This is useful for including method-specific instructions or thank you messages.

In v0.12 and v1.0, use `{{ payment_method_note|raw }}` and `{{ shipping_method_note|raw }}` respectively.

In v1.1+ the email note is also available in the transaction and shipment as `{{ transaction.email_note }}` or `{{ shipment.email_note }}`. Which one to use depends on the layout of your email.

### Invoices

The last generated PDF invoice for an order is available in the `invoice` order field, like: `{{ order_fields.invoice }}`. That will only contain the invoice reference.

To attach the PDF invoice to the email, enable "Attach invoice" on the [email status change](../Statuses/Email_Action).

## Other message types

- [MessageBird extension](https://modmore.com/commerce/extensions/messagebird/) lets you create text (SMS) messages.

## Example data

This is an example of all the data available in an order message. You can get this data yourself by enabling the `commerce.debug` system setting, and using `{{ dump() }}` or `{{ dump(placeholder name) }}`.

````
array (size=9)
  'order' =>
    array (size=38)
      'id' => int 4072
      'class_key' => string 'comProcessingOrder' (length=18)
      'properties' =>
        array (size=1)
          'guest_checkout' => boolean true
      'secret' => string '3409....7157a20' (length=64)
      'test' => boolean true
      'status' => int 2
      'currency' => string 'EUR' (length=3)
      'subtotal' => int 5000
      'discount' => int 0
      'shipping' => int 250
      'transaction' => int 0
      'total_before_tax' => int 5250
      'total_ex_tax' => int 5250
      'tax' => int 1103
      'total' => int 6353
      'total_due' => int 0
      'total_quantity' => int 2
      'created_on' => int 1523970986
      'last_updated_on' => int 1523971054
      'status_updated_on' => int 1523971054
      'created_by' => int 1
      'last_updated_by' => int 1
      'status_updated_by' => int 1
      'shipping_method' => int 0
      'parent' => int 0
      'user' => int 1
      'subtotal_formatted' => string '€50.00' (length=8)
      'discount_formatted' => string '€0.00' (length=7)
      'shipping_formatted' => string '€2.50' (length=7)
      'transaction_formatted' => string '€0.00' (length=7)
      'total_before_tax_formatted' => string '€52.50' (length=8)
      'total_ex_tax_formatted' => string '€52.50' (length=8)
      'tax_formatted' => string '€11.03' (length=8)
      'total_formatted' => string '€63.53' (length=8)
      'total_due_formatted' => string '€0.00' (length=7)
      'created_on_formatted' => string '2018-04-17 at 15:16:26 CEST' (length=27)
      'last_updated_on_formatted' => string '2018-04-17 at 15:17:34 CEST' (length=27)
      'status_updated_on_formatted' => string '2018-04-17 at 15:17:34 CEST' (length=27)
  'taxes' =>
    array (size=1)
      27 =>
        array (size=15)
          'id' => int 27
          'class_key' => string 'comTaxRate' (length=10)
          'properties' => null
          'key' => string 'VAT-NL-standard' (length=15)
          'name' => string 'Netherlands Standard VAT' (length=24)
          'rate_provider' => string 'modmore\Commerce\Taxes\EUVat' (length=28)
          'percentage' => float 21
          'percentage_formatted' => string '21%' (length=3)
          'total_taxed_amount' => int 5250
          'total_tax_amount' => int 1103
          'total' => int 6353
          'is_inclusive' => boolean false
          'total_taxed_amount_formatted' => string '€52.50' (length=8)
          'total_tax_amount_formatted' => string '€11.03' (length=8)
          'total_formatted' => string '€63.53' (length=8)
  'items' =>
    array (size=1)
      0 =>
        array (size=34)
          'id' => int 4541
          'class_key' => string 'comOrderItem' (length=12)
          'properties' => null
          'order' => int 4072
          'product' =>
            array (size=23)
              'id' => int 78
              'class_key' => string 'comProduct' (length=10)
              'properties' => null
              'sku' => string 'REDACTOR-UNLIMITED' (length=18)
              'barcode' => string '0' (length=1)
              'name' => string 'Redactor Unlimited Subscription' (length=31)
              'description' => string '' (length=0)
              'price' => int 2500
              'stock' => int 4957
              'weight' => float 0
              'weight_unit' => string 'kg' (length=2)
              'image' => string '' (length=0)
              'tax_group' => int 1
              'delivery_type' => int 2
              'target' => int 0
              'removed' => boolean false
              'removed_on' => int 0
              'removed_by' => boolean false
              'price_formatted' => string '€25.00' (length=8)
              'removed_on_formatted' => string '' (length=0)
              'link' => boolean false
              'edit_link' => string '/manager/?namespace=commerce&a=index&ca=product/update&id=78' (length=60)
              'weight_formatted' => string '0 kg' (length=4)
          'idx' => int 10
          'currency' => string 'EUR' (length=3)
          'status' => int 0
          'allow_update' => boolean true
          'delivery_type' => int 2
          'shipment' => int 2166
          'sku' => string 'REDACTOR-UNLIMITED' (length=18)
          'name' => string 'Redactor Unlimited Subscription' (length=31)
          'link' => string '' (length=0)
          'description' => string '' (length=0)
          'price' => int 2500
          'image' => string '' (length=0)
          'quantity' => int 2
          'subtotal' => int 5000
          'discount' => int 0
          'shipping' => int 0
          'total_before_tax' => int 5000
          'total_ex_tax' => int 5000
          'tax' => int 1050
          'total' => int 6050
          'comment' => string '' (length=0)
          'price_formatted' => string '€25.00' (length=8)
          'subtotal_formatted' => string '€50.00' (length=8)
          'discount_formatted' => string '€0.00' (length=7)
          'shipping_formatted' => string '€0.00' (length=7)
          'total_before_tax_formatted' => string '€50.00' (length=8)
          'total_ex_tax_formatted' => string '€50.00' (length=8)
          'tax_formatted' => string '€10.50' (length=8)
          'total_formatted' => string '€60.50' (length=8)
  'billing_address' =>
    array (size=20)
      'id' => int 773
      'class_key' => string 'comAddress' (length=10)
      'properties' => null
      'user' => int 1
      'remember' => string '1' (length=1)
      'fullname' => string 'Mark Hamstra' (length=12)
      'firstname' => string '' (length=0)
      'lastname' => string '' (length=0)
      'company' => string 'Mark Hamstra Web Development' (length=28)
      'address1' => string 'Some Street 14' (length=14)
      'address2' => string '' (length=0)
      'address3' => string '' (length=0)
      'zip' => string '9876ZX' (length=6)
      'city' => string 'Leeuwarden' (length=10)
      'state' => string 'Friesland' (length=9)
      'country' => string 'NL' (length=2)
      'phone' => string '' (length=0)
      'mobile' => string '' (length=0)
      'email' => string 'email@example.com' (length=21)
      'notes' => string '' (length=0)
  'shipping_address' =>
    array (size=20)
      'id' => int 773
      'class_key' => string 'comAddress' (length=10)
      'properties' => null
      'user' => int 1
      'remember' => string '1' (length=1)
      'fullname' => string 'Mark Hamstra' (length=12)
      'firstname' => string '' (length=0)
      'lastname' => string '' (length=0)
      'company' => string 'Mark Hamstra Web Development' (length=28)
      'address1' => string 'Some Street 14' (length=14)
      'address2' => string '' (length=0)
      'address3' => string '' (length=0)
      'zip' => string '9876ZX' (length=6)
      'city' => string 'Leeuwarden' (length=10)
      'state' => string 'Friesland' (length=9)
      'country' => string 'NL' (length=2)
      'phone' => string '' (length=0)
      'mobile' => string '' (length=0)
      'email' => string 'email@example.com' (length=21)
      'notes' => string '' (length=0)
  'shipments' =>
    array (size=1)
      0 =>
        array (size=30)
          'id' => int 2166
          'class_key' => string 'comOrderShipment' (length=17)
          'properties' => null
          'test' => boolean true
          'order' => int 4072
          'delivery_type' => int 2
          'status' => int 0
          'method' =>
            array (size=22)
              'id' => int 56
              'class_key' => string 'comShippingMethodByWeight' (length=25)
              'properties' =>
                array (size=4)
                  ...
              'delivery_type' => int 2
              'enabled_in_test' => boolean true
              'enabled_in_live' => boolean false
              'name' => string 'Standard Shipping' (length=17)
              'description' => string '2 - 4 days' (length=10)
              'price' => int 250
              'price_percentage' => float 0
              'minimum_order_total' => int 0
              'maximum_order_total' => int 0
              'countries' => string '' (length=0)
              'sortorder' => int 1
              'removed' => boolean false
              'removed_on' => int 0
              'removed_by' => boolean false
              'price_formatted' => string '€2.50' (length=7)
              'price_percentage_formatted' => string '0%' (length=2)
              'minimum_order_total_formatted' => string '€0.00' (length=7)
              'maximum_order_total_formatted' => string '€0.00' (length=7)
              'removed_on_formatted' => string '' (length=0)
          'tracking_reference' => string '' (length=0)
          'currency' => string 'EUR' (length=3)
          'product_quantity' => int 2
          'product_value' => int 6050
          'product_value_ex_tax' => int 5000
          'weight' => float 0
          'weight_unit' => string 'kg' (length=2)
          'fee' => int 250
          'is_inclusive' => boolean false
          'tax_group' => int 1
          'tax_rate' => int 27
          'tax_percentage' => float 21
          'fee_ex_tax' => int 250
          'tax_amount' => int 53
          'fee_incl_tax' => int 303
          'product_value_formatted' => string '€60.50' (length=8)
          'product_value_ex_tax_formatted' => string '€50.00' (length=8)
          'fee_formatted' => string '€2.50' (length=7)
          'tax_percentage_formatted' => string '21%' (length=3)
          'fee_ex_tax_formatted' => string '€2.50' (length=7)
          'tax_amount_formatted' => string '€0.53' (length=7)
          'fee_incl_tax_formatted' => string '€3.03' (length=7)
  'transactions' =>
    array (size=1)
      0 =>
        array (size=17)
          'id' => int 716
          'class_key' => string 'comTransaction' (length=14)
          'properties' =>
            array (size=0)
              ...
          'test' => boolean true
          'order' => int 4072
          'status' => int 5
          'method' =>
            array (size=21)
              'id' => int 208
              'class_key' => string 'comPaymentMethod' (length=16)
              'properties' => null
              'enabled_in_test' => boolean true
              'enabled_in_live' => boolean false
              'gateway' => string 'modmore\Commerce\Gateways\Manual' (length=32)
              'name' => string 'Dummy Gateway' (length=13)
              'description' => string '' (length=0)
              'price' => int 0
              'price_percentage' => float 0
              'minimum_order_total' => int 0
              'maximum_order_total' => int 0
              'sortorder' => int 5
              'removed' => boolean false
              'removed_on' => int 0
              'removed_by' => boolean false
              'price_formatted' => string '€0.00' (length=7)
              'price_percentage_formatted' => string '0%' (length=2)
              'minimum_order_total_formatted' => string '€0.00' (length=7)
              'maximum_order_total_formatted' => string '€0.00' (length=7)
              'removed_on_formatted' => string '' (length=0)
          'reference' => null
          'currency' => string 'EUR' (length=3)
          'amount' => int 6353
          'fee' => int 0
          'created_on' => int 1523971053
          'completed_on' => int 1523971054
          'amount_formatted' => string '€63.53' (length=8)
          'fee_formatted' => string '€0.00' (length=7)
          'created_on_formatted' => string '2018-04-17 at 15:17:33 CEST' (length=27)
          'completed_on_formatted' => string '2018-04-17 at 15:17:34 CEST' (length=27)
  'config' =>
    array (size=4)
      'site_url' => string 'https://site.local/' (length=23)
      'site_name' => string 'My Webshop' (length=10)
      'email_header' => string 'https://site.local/assets/email-header.jpg' (length=46)
      'email_footer' => string 'My Webshop &bull; <em>Powered by Commerce</em>' (length=46)
  'message' =>
    array (size=15)
      'id' => int 189
      'class_key' => string 'comOrderEmailMessage' (length=20)
      'properties' =>
        array (size=3)
          'subject' => string 'Test' (length=4)
          'bcc' => string '' (length=0)
          'send_now' => string '1' (length=1)
      'order' => int 4072
      'content' => string '{{ dump() }}' (length=12)
      'recipient' => string 'email@example.com'
      'from' => string 'email@example.com'
      'created_on' => int 1524133740
      'created_by' => int 1
      'sent' => boolean true
      'sent_on' => int 1524133740
      'sent_by' => int 1
      'created_on_formatted' => string '2018-04-19 at 12:29:00 CEST' (length=27)
      'sent_on_formatted' => string '2018-04-19 at 12:29:00 CEST' (length=27)
      'from_name' => string 'My Webshop' (length=10)
````
