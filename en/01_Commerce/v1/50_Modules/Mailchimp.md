With the [Mailchimp Extension](https://modmore.com/commerce/extensions/mailchimp/) you can allow your customers to sign up to a Mailchimp mailing list (or audience) when placing an order. 

## Setup

First install the free extension from the modmore package provider. 

Navigate to Extras > Commerce > Modules and find Mailchimp in the list. Open its configuration and enter your API Key; you can find this in Mailchimp by clicking on your name in the top right > Account > Extras > API Keys. 

Save the api key on the module configuration, at which point you'll get some additional options on the module. 

- **Mailchimp List** allows you to select the list to subcribe customers to.
- **Address Type** lets you choose if you want to use the email address on the provided billing or shipping address. This will fallback to the other type if the preferred type is not set. 
- **Enable Double Opt-in** will instruct Mailchimp to send a double opt-in email to the user to confirm their subscription. 

Also very important: **add the opt-in markup to your template**. 

## Add the required markup

The module supports the cart, address, and payment method steps/templates, so you can choose which one you want to place the opt-in on:

- `frontend/checkout/cart.twig`
- `frontend/checkout/address.twig`
- `frontend/checkout/payment-method.twig`

(If you haven't used the templating in Commerce before, see [Front-end Theming for how to do that.](../Front-end_Theming))

The module expects a POST value with the name `mailchimp_opt_in` and a value of `on`. You could for example use this markup, which will only be shown if the module is properly configured and the customer is not already subscribed:

``` html
{% if mailchimp_enabled and not mailchimp_subscribed %}
    <label class="c-subscribe-newsletter">
        <input type="checkbox" name="mailchimp_opt_in" value="on">
        {{ lex('commerce_mailchimp.subscribe_to_newsletter') }}
    </label>
{% endif %}
```
