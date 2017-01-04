Order Messages are communications from the shop specific to a certain order. This mostly includes email notifications to the customer, but could also include emails to the merchant about the new order, text  (SMS) messages sent via a third party integration, or other forms of communication.

To manage Order Messages, go to Commerce > Orders and when viewing an order navigate to the Messages tab. There you can see all previous messages, and create new ones. 

When creating messages, they are not automatically sent. To send them hover over _Actions_ in the grid and select _Send Messages_. This allows you to first draft a message before it is whisked away to the customer. To view a message contents, hover over _Actions_ and open _View Message Content_. For automated messages, such as those created through an [Email Status Change Action](../Statuses/Email_Action), messages are usually sent right away.

## Message Types

The Commerce core provides two message types: Email and Internal.

### Email Message Type

The email message type is the most common one. It sends, surprisingly, an email. 

Email sending is done through MODX using PhpMailer, so make sure that your email settings (in MODX under System > Settings > Email area) are configured properly to send email. It's strongly encouraged to use SMTP with an email delivery service like Mandrill, Postmark, Amazon SES, or others. Make sure that SPF and DKIM are configured properly for optimal delivery. 

### Internal Message Type

The internal message type creates an internal note. It is not currently sent to anyone, but remains available to be checked on the order. 

## Available Placeholders

For the Email Message Type, and possibly third party message types, you can use a whole bunch of placeholders in the Subject and Content fields. 

These are parsed as Twig templates, so you can use limited logic in the emails as well. 

Order fields are available with the `order` prefix, like `{{ order.id }}`, `{{ order.total_formatted }}` and `{{ order.total_quantity }}`.

An array of items is found in the `items` placeholder, which could be used like this:

```` twig
<ul>
{% for item in items %}
   <li>{{ item.quantity }}x {{ item.name }} - {{ item.total_formatted }}</li>
{% endfor %}
</ul>
````

Address fields are available with the `billing_address` and `shipping_address` prefixes. For example `{{ billing_address.fullname }}`, `{{ shipping_address.address1 }}` and `{{ shipping_address.email }}`. 

The chosen shipping method is available with the `shipping_method` prefix, for example `{{ shipping_method.name }}`. 