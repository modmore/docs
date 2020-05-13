[TOC]

## Introduction

With the [separately-installed TemplatedMessage extension](https://modmore.com/commerce/extensions/templated-message/), you can more easily send professional-looking emails from within the Commerce dashboard to your customers.

While [standard order messages](../Orders/Messages) are usually sent automatically through the [status workflow](../Statuses) and use an inline twig template include to make them pretty, emails you send manually through the "Messages" tab on an order detail page are rather... blank.

The Templated Message extension adds a new message type that automatically wraps the entered content with a Twig template. It also processes the content you enter through a markdown parser, allowing basic formatting and clickable links. 

## Setup

First install the "Templated Message for Commerce" package, available from the modmore.com package provider.

In Extras > Commerce > Configuration > Modules, find the module (typically on the last page), and enable it both test and live mode. 

Navigate to an order detail page under Orders > [View Details] on a listed order > Messages tab. On the Create Message button dropdown, choose to create a templated message. 

## Make templated messages the default

In Commerce v1.1.5 you can make the templated message the default, so the "Create Message" button on the order overview will immediately use the right type. 

To do that, go to System > System Settings, find the `commerce.default_message_type` setting and change it to `TemplatedOrderMessage`.

## Customising the email template

The extension comes with a new template for the emails sent manually. This default is located in `core/components/commerce_templatedmessage/templates/emails/manual_message.twig` and extends the Commerce-core default `emails/wrapper.twig` template, so it should already match your default branding somewhat out of the box.

The default email template also includes an order summary, so the customer knows what the email is in relation to. 

**To customise the email template, do not edit the file directly**. Instead, [following the standard theming approach in Commerce](../03_Front-end_Theming) and create a new file in your own theme directory with the path `emails/manual_message.twig`. That will automatically be used instead of the default that ships with the extension that will be overwritten on upgrade 

[All standard order message values are available](../Orders/Messages), with the addition of a new block `{% block message_content %}{% endblock %}` which will contain the (HTML-formatted) message that was entered in the dashboard.
