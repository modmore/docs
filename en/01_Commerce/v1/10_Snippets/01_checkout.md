The `commerce.checkout` snippet acts as gateway to the Commerce checkout handling. It has no notable properties. 

[TOC]

## Usage

Call uncached on a page with otherwise empty content. 

```` html
[[!commerce.checkout]]
````

Set the `commerce.checkout_resource` system/context setting to the ID of the created resource so Commerce knows where to find it.

## Properties

None. 

## Used Templates

Which templates are used depends on the checkout configuration. Some themes may use different or additional templates from the defaults. 

In all cases the outer wrapper that the checkout is contained within is `frontend/checkout/wrapper.twig`. 

- `frontend/checkout/cart.twig`, which includes:
    - `frontend/response-messages.twig`
    - `frontend/checkout/cart/aside.twig`
    - `frontend/checkout/cart/items.twig`
    - `frontend/checkout/cart/twig.twig`
- `frontend/checkout/address.twig`, which includes:
    - `frontend/checkout/partial/summary.twig`
    - `frontend/response-messages.twig`
- `frontend/checkout/account.twig`, which includes:
    - `frontend/response-messages.twig`
- `frontend/checkout/shipping-method.twig`, which includes:
    - `frontend/checkout/partial/summary.twig`
    - `frontend/response-messages.twig`
- `frontend/checkout/payment-method.twig`, which includes:
    - `frontend/checkout/partial/summary.twig`
    - `frontend/response-messages.twig`
- `frontend/checkout/pending-transaction.twig`, which includes:
    - `frontend/checkout/partial/summary.twig`
    - `frontend/response-messages.twig`
- `frontend/checkout/thank-you.twig`, which includes:
    - `frontend/checkout/partial/summary.twig`
    - `frontend/response-messages.twig`
