---
title: Tab Services 
---

This tab contains a paginated grid with all internal or third-party services,
that are able to collect personal data.

With ConsentFriend you can manage inline and external scripts as well as static
tracking elements like images or stylesheet links. New services can be added
with just a few lines of code.

![Tab Services](img/services.png)

You can create a new service with a click on the New Service button on the top
left above the services grid.

You can export the services to a YAML file with a click on the Export Services
button above the services grid.

You can import a YAML file with the services with a click on the Import Services
button above the services grid. In the import window you have to select a file to
import and the import mode. In the append mode the entries in the file are
appended to the existing services in the grid. In the replace mode the existing
services in the grid are replaced with the entries in the file. In the update
mode the existing services in the grid are updated with the entries in the file.

![Import Services](img/services-import.png)

The grid can be filtered by a search input on the top right above the services
grid.

Each service can be edited by a click on the edit icon in the row of the
service. And it can be deleted after a confirmation with a click on the trash
icon in the row of the service. The service name and the yes/no columns are
editable inline.

The row of each service shows the service name, the title, some options, and the
purposes. The service title will be shown in green, when it is retrieved from a
lexicon. It will be shown in red, when no lexicon entry exist.

## Create/Edit

The create/edit window allows the user to edit the service options in three
tabs.

### Service Tab

In the service tab you have to set the name, the title and the descriptions. You
can select the service purposes and the service options like Active, Default,
Required, Opt out and Only once.

<a id="service-name"></a>![Update Service](img/service-service.png)

**Name:** (Required) Each service must have a unique name. ConsentFriend will look
for HTML elements with a matching "data-name" attribute to identify elements
that belong to this service.

**Title:** The title of you service as listed in the consent modal. If the
description is left blank, the title is set by the lexicon entry
"consentfriend.services.&lt;name&gt;.title" with the consentfriend namespace.

**Purposes:** The purpose(s) of this service that will be listed on the consent
notice. Do not forget to add translations for all purposes you list here.

**Desciption:** The description of the service as listed in the consent modal. If
the description is left blank, the description is set by the lexicon entry
"consentfriend.services.&lt;name&gt;.description" with the consentfriend
namespace.

**Contexts:** The context(s) where this service is active in the frontend.
Available since ConsentFriend 1.5.0.

**Active:** If "active" is checked, the service is shown in the consent management window
window.

**Default:** If "default" is checked, the service will be enabled by default. This
overrides the global "default" setting.';

**Required:** If "required" is checked, ConsentFriend will not allow this service to
be disabled by the user. Use this for service s that are always required for
your website to function (e.g. shopping cart cookies).';

**Opt out:** If "Opt out" is checked, ConsentFriend will load this service even
before the user has given explicit consent. We strongly advise against this.

**Only once:** If "onlyOnce" is checked, the service will only be executed once
regardless how often the user toggles it on and off. This is relevant e.g. for
tracking scripts that would generate new page view events every time
ConsentFriend disables and re-enables them due to a consent change by the
user.

**Contextual Consent Only:** If "Contextual Consent Only" is checked, the
service cannot be directly activated globally with the 'Accept All' workflow in
the consent modal. The service is still hidden by a placeholder, but a second
button is displayed which allows the user to activate the service globally.

### Code Tab

In the code tab you can select the code section and enter the service code.

![Update Service Code](img/service-code.png)

**Code Section:** The section of the page code, where the service code is injected.

**Code:** The service code, thats injected automatically into the page code. The
service code will be automatically disabled for a direct execution before the
injection. MODX context/system settings tags can be used in the service code.

### Cookies Tab

In the cookies tab you can edit the cookies of that service in a grid. Adding
the cookies of a service allows ConsentFriend to delete the cookies of that
service, when the service is disabled.

Some example cookie settings can be found in the demo data, that are installed
during the ConsentFriend installation.

![Update Service Cookies](img/service-cookies.png)

You can create a new cookie setting with a click on the add button on the top
right above the cookies grid.

Each cookie setting can be edited inline in the grid. It can be deleted
after a confirmation with a click on the gear icon in the row of the service.

In the cookie column you can enter the cookie name or a regular expression
(regex), filling the path and domain column is optional. Providing a path and
domain is necessary, when you have apps that set cookies for a path that is not
"/" or a domain that is not the current domain. If you do not set these values
properly, the cookie can't be deleted by ConsentFriend, as there is no way to
access the path or domain of a cookie in JS. Notice that it is not possible to
delete cookies that were set on a third-party domain, or cookies that have the
HTTPOnly attribute. [See the documentation](https://developer.mozilla.org/en-US/docs/Web/API/Document/cookie#new-cookie_domain)

### Callbacks Tab

In the callbacks tab you can enter several service callback codes in the
textareas of the four callback tabs.

![Update Service Callbacks](img/service-callbacks.png)

**On Toggle:** This callback code is executed when the service consent is
changed. It must contain a javascript function with the two properties
`consent` and `service` or stay empty. `consent` contains the consent state
(true = consented) and `service` contains the service configuation.

The demo data of the googleRecaptcha service contains a code example that
disables all inputs with `data-name="googleRecaptcha"`. Please have a look at
the [reCAPTCHA usage example](../02_Functionality/Google_reCAPTCHA.md).

The `On Toggle` callback was named `Callback` before ConsentFriend 1.3.0. The next
callbacks are available since ConsentFriend 1.3.0.

**On Init:** This callback code is executed when the service is initialized
(once per page-load). It must contain a javascript function with the property
`opts` or stay empty. `opts` contains the configuration of the ConsentFriend
script in `opts.config`, the service configuation in `opts.service` and an
optional configuration in `opts.vars`. Here you can create additional variables
to be used later in the `On Accept` and `On Decline` callbacks.

**On Accept:** This callback code is executed when the service is accepted. 
It must contain a javascript function with the property `opts` (see
`On Init` callback) or stay empty.

**On Decline:** This callback code is executed when the service is declined.
It must contain a javascript function with the property `opts` (see
`On Init` callback) or stay empty.

The demo data of the googleTagManager service contains code examples for the
three callbacks above that use the new Google Tag Manager `Consent Mode`. It
will load the Google Analytics tag via Google Tag Manager, but only if you have
consented to use Google Analytics via ConsentFriend. Please have a look at the
[Google Tag Manager usage example](../02_Functionality/Google_Tag_Manager.md).
