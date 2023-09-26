The MyParcel integration for Commerce offers powerful fulfillment solutions for merchants in the Netherlands and Belgium. The integration supports all 3 MyParcel platforms from one integration:

    MyParcel.nl, for merchants shipping from the Netherlands with PostNL and DHL For You
    Flespakket.nl, for shipping of fragile bottles from the Netherlands with PostNL
    SendMyParcel.be, for merchants shipping from Belgium with bpost, DPD and PostNL

[TOC]

## Installation

The MyParcel integration is available [as an official extension](https://modmore.com/commerce/extensions/myparcel/. To offer support and continued maintenance, we charge a one-time license fee for it. It's free to use on development.

## Configuration

Visit [this page](https://modmore.com/commerce/extensions/myparcel/) for setup instructions.

## Checkout

To show the currently selected date/time in the checkout, use something like this in your templates:

```html
{% if shipment.properties.delivery_date %}
    <br>
    <span style="font-weight: normal; text-transform: uppercase; font-size: 0.8em">
        {{ shipment.properties.delivery_date }},
        {{ shipment.properties.delivery_from|slice(0,5) }}&ndash;{{ shipment.properties.delivery_until|slice(0,5) }}
    </span>
{% endif %}
```

You can also check `shipment.properties.delivery_type` to see if it is a delivery (values 1-3) or pickup (values 4 or 5).
