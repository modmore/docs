[Avalara](https://www.avalara.com/us/en/index.html) is a tax automation platform. With our Commerce integration, you can make use of the following Avalara features with Commerce:

- Automated Sales Tax calculation (US) with support for AvaTax Tax Codes in tax groups. 
- Real address verification and normalisation to postal format (including 4-to-9-zip expansion)
- Automating tax reporting by creating transactions within AvaTax when an order is completed in Commerce.
- Support for tax exemption certificates and creating CertExpress invitations to invite exempted organisations to provide their certificates in CertCapture. 

Avalara is a complex integration aimed primarily at the enterprise market. It's largely plug and play, but we strongly recommend reaching out to us via support@modmore.com when you're looking to implement it for guidance.

[TOC]

## High-level implementation summary

After installing the Avalara for Commerce package from modmore, navigate to Commerce > Configuration > Modules, and enable the Avalara module.

The module will ask you for an **Account Number** and **License Key**. You'll typically get these from your account manager at Avalara.

After entering valid credentials and _saving the module_, the form will update to show you your account information/status. 

**Select the appropriate company** from the now-available dropdown, and save the module again.

On the module you can also enable the **Address Validation** functionality which can be used to replace the _Basic Address Validation_ module that comes with Commerce, and enable **Request Logging** to keep detailed request/response logs for all API interactions with Avalara. Especially in development and after having just launched, it's encouraged to keep request logging enabled which will keep 2 weeks worth of logs that are extremely helpful should there be any issues.

At this point, you will need to set up the following things to make full use of what our Avalara integration has to offer. 

1. To calculate Sales Tax, you'll need to set up the _Tax Group/Rule_ with the Avalara Rate Provider.
2. To automate your reporting with AvaTax, you'll need to set up the _Status Change Action_ within your statuses workflow.
3. To support the full exemption certificates flow, you'll need to make some tweaks to your checkout templates. It's also strongly advisable to look at how our integration determines the current customer code, as those are instrumental in exemptions to be applied.

Please refer to the sections below.

## Setting up Tax Groups/Rules

In Commerce, a Tax _Group_ is a collection of _Rules_. Each product can only be assigned to a single _Tax Group_, but each group may have a number of _Rules_.

Go to Commerce > Configuration > Tax Groups to set these up. You can either edit an existing tax group you have, or create a new one. Important: **for each product requiring a different Tax Code, you need a separate Tax Group.**

Navigate to Actions > Manage Tax Rules.

Create a Tax Rule with the conditions limiting the country to the country supported by Avalara (typically US - we have not tested the integration with other countries), and select Avalara AvaTax as the Rate Provider.

If you already know you will only ever have to charge tax in (a) certain state(s), you can improve the performance of your tax calculation by restricting your AvaTax tax rule to the specific state as well. Provide a fallback "Manual" rule with a higher priority number (= lower in the table) for a 0% rate for customers out of that state. 

Save the tax rule. Next you'll see 2 new fields where you can set the Tax Code for **Products** and for **Shipping**. [Use Avalara's Tax Codes Search](https://taxcode.avatax.avalara.com/) to identify the correct code for the products you're selling. 

The **Shipping** tax code is only used if you edit your Delivery Type(s) and select the appropriate Tax Group there.

## Creating AvaTax transactions from Commerce

In Configuration > Statuses you'll need to set up a status change action that tells Commerce when to send information to AvaTax. Avalara calls this Transactions. 

During the checkout process, draft transactions are created which AvaTax does not persist - they only exist to identify the correct tax rate. To incorporate them into AvaTax reporting, they need to be created through the status workflow. 

This can be configured in a few different ways depending on your use case and business processes. It's important to note that **only committed transactions are used by Avalara**, but Commerce can create them as **uncommitted** as well. Here are some ways you can set things up:

1. In the Payment Received status change, create an _uncommitted_ transaction in AvaTax. Manually check and commit the transaction through the AvaTax dashboard.
2. In the Payment Received status change, create an _uncommitted_ transaction in AvaTax. In another status change after you've processed the order (eg "Shipped" or "Completed"), commit the transaction automatically. Note: if you use this approach, changes made to the transaction in AvaTax **will be overwritten** by Commerce when it is committed. 
3. In the Payment Received status change, create a _committed_ transaction right away. 
4. In the status change after you've processed the order (eg "Shipped" or "Completed"), create a _committed_ transaction.

Regardless which approach fits best with your processes, you add them the same way. Click on the name of the status change to add the action to (eg Payment Received) and add the status change action of type "Create AvaTax Transaction". The only configuration you have here (after saving for the first time) is wether or not to automatically commit transactions. Repeat as needed.

**When the status change is repeated for a single order**, it will **update** the **same transaction** (or document) and overwrite changes potentially made in the AvaTax dashboard. When looking at an order, you can see the _AvaTax Transaction Code_ in the list of custom order fields. You can take advantage of this to create the drafts as soon as the order is placed, while committing that when the order is final and shipped. 

## Supporting Tax Exemptions with CertExpress/CertCapture

CertExpress/CertCapture is not a standard Avalara feature; ask your account manager. 

For organisations that sell to exempted organisations, CertExpress/CertCapture allow the customer to self-manage certificates that proves their exemption statuses. The Commerce integration supports this as well. 

Important: exemptions are checked by Avalara based on the **Customer Code**. See the section that below to learn how a customer code is determined. Address matches alone are **not** sufficient to trigger a tax exemption on an order.

For the full exemption flow, there's a few things you'll need to do in your checkout templates. The basic premise is to show, based on order context, what the current orders' exemption status is. There are a few distinct states to consider. 

Here's the recommended sample code to start from, add it to your `frontend/checkout/partial/summary.twig` template

````html
{% if order.properties.avalara_has_exemptions %}
    {# Exemptions have been applied to the order #}
    <div style="border: 1px solid #ccc; padding: 1em; margin: 2em 0;">
        &check; Tax exemption(s) for your organization have been applied to your cart.
        <a href="https://app.certexpress.com/" target="_blank" rel="noopener">Manage exemptions in CertExpress</a>
    </div>
{% elseif order.properties.avalara_exemption_invite > 0 %}
    {# Customer has requested an invite #}
    <form method="post" action="{{ current_url }}" class="c-tax-exempt-form" style="border: 1px solid #ccc; padding: 1em; margin: 2em 0;">
        <p style="margin-top: 0;">Please check your email for instructions from our partner CertCapture on certifying your tax exemption status. Once you've completed the process, use the button below to recalculate.</p>
        <button type="submit" class="c-button" name="refresh_calculation" value="1">Re-calculate taxes</button>

        <p><small>If you haven't received instructions via email after a few minutes, you can request a new invitation.</small></p>
        <input type="hidden" name="create_tax_exemption_invite" value="1">
        <button type="submit" class="c-button">Create or upload certificate</button>
    </form>
{% elseif billing_address.id > 0 %}
    <form method="post" action="{{ current_url }}" class="c-tax-exempt-form" style="border: 1px solid #ccc; padding: 1em; margin: 2em 0;">
        <input type="hidden" name="create_tax_exemption_invite" value="1">
        <p style="margin-top: 0;">Are you making a purchase on behalf of a tax-exempt organisation?</p>
        <button type="submit" class="c-button">Create or upload certificate</button>
        <p style="margin-bottom: 0;"><small>Have you provided exemption certificates before? Login with your company account, or provide the exact same company name and billing address to automatically match your exemption.</small></p>
        <p style="margin-bottom: 0;"><small>If you've just provided an exemption certificate, it may take a few minutes for your cart to be reflected.</small></p>
    </form>
{% endif %}
````

You can tweak that any way you'd like (styling, text, etc), so long the form structure and input names remain the same. The block above will:

1. Show a success message if exemptions are applied.
2. If not, show a pending message if the customer has requested a CertExpress invitation to provide their exemption information. The "refresh calculation" button will force a recalculation of the order to ensure recently-added information is incorporated. The "Create or upload certificate" button will send a new invitation.  
3. If not, show information about how your organisation handles exemptions along with a button to create or upload their certificate. This sends an invitation for CertExpress via email.

Additionally, you may find yourself looking to change the way the tax details are shown in the cart. By default, tax information is only shown when the total tax is more than 0, but it may be useful to show "Exempt" instead. One way to do so is by tweaking the same template as before (`frontend/checkout/partial/summary.twig`). 

- Remove/comment out the `{% if order.tax != 0 %}` and `{% endif %}` around line 81 and line 100 respectively.
- Replace `{{ order.tax_formatted }}` around line 91 with the following: 

````html
{% if order.tax > 0 %}
    {{ order.tax_formatted }}
{% elseif order.properties.avalara_has_exemptions %}
    <em>exempt</em>
{% else %}
    <em>not yet calculated</em>
{% endif %}
````

You may also do something similar in the `{% for rate in tax_rates %}` loop, starting around line 94.

## How the Customer Code is determined

The customer code is instrumental for exemptions. Avalara matches on that, not address.

Commerce will go through the following options to identify the customer code for a given order until it finds one. 

1. If an `avalara_customer` custom order field is set, it will read that code and check it is still correct, based on the following scenarios:
    1. If the customer was set based on the user profile (extended field), make sure the username at the time of identifying the code is the same as the current user. Still the same? Then this customer code is used.
    2. If the code was identified based on a (shipping) address match, the current address is compared against what was used to identify the customer code. Still the same? Then this customer code is used.
    3. If the code was set based on the username or email address, it will always fall through to re-evaluate where to find the customer code per the steps below.
2. If the user is logged in and has an `avalara_customer` extended field on its profile, the value of that is used for the customer code and set to the `avalara_customer` order field.
3. If a (shipping) address has been provided, it is used to query your Avalara account for an exact match based on the address. A loaded customer code is used if the name, zip, address line, and country is an exact match. If found the `avalara_customer` order field is set. If the user is also logged in, the extended `avalara_customer` user field (see #2) is also stored on the users profile. 
4. If the user is logged in, a fallback is used based on the users' username in the form of `WEB:{username}` and set to the `avalara_customer` order field. 
5. For anonymous users who have provided an address, their email is used in the format `WEB:GUEST:{email}` and set to the `avalara_customer` order field.
6. Finally, as a generic fallback, customer code `WEB:GUEST` is used.

The order log (found on the order detail > log tab) will also show how Commerce determined the customer code for a specific customer. You'll find messages like `Identified Avalara Customer Code "WEB:username" from user profile username` there. 
