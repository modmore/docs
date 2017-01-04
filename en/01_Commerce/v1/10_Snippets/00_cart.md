The `commerce.cart` snippet acts as gateway to the Commerce Cart. It has no notable properties. 

In Commerce, the Cart is actually part of the [Checkout](checkout), so it's not necessary to create a separate Cart resource with the `commerce.cart` snippet. 

[TOC]

## Usage

Call uncached on a page with otherwise empty content. 

```` html
[[!commerce.cart]]
````

Set the `commerce.cart_resource` system/context setting to the ID of the created resource so Commerce knows where to find it. 

## Properties

None.

## Used Templates

- `frontend/checkout/cart.twig`, which includes:
    - `frontend/response-messages.twig`
    - `frontend/checkout/cart/aside.twig`
    - `frontend/checkout/cart/items.twig`
    - `frontend/checkout/cart/twig.twig`
