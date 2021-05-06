---
title: Thank You page & Email template
---

To integrate digital product download links into your thank you page or emails sent to customers, the module provides you with the `digitalProducts` placeholder.

Override the default Commerce `thank-you.twig` template by copying it to your `customtheme/frontend/checkout/` directory. If you haven't created a custom theme or overridden template files before, you can [learn how in the theming documentation](https://docs.modmore.com/en/Commerce/v1/Front-end_Theming.html).

> To implement the download links in emails to the customer, you can follow the instructions below, but instead apply it to a custom `emails/order-received.twig` template.

Edit this custom template to display the digital products or pages the customer now has access to. A basic example of rendering download links would be the following:

```HTML
<div class="c-digital-products">
    {% for digitalProduct in digitalProducts %}
        {% if digitalProduct.resources|length > 0 %}
            <h4>{{ digitalProduct.product.name }} {{ lex('commerce_digitalproduct.pages') }}</h4>
            {% for resource in digitalProduct.resources %}
                <p><a href="[[~[[++commerce_digitalproduct.download_resource]]? &scheme=`full` &secret=`{{ resource.secret }}`]]">{{ resource.name }}</a></p>
            {% endfor %}
        {% endif %}

        {% if digitalProduct.files|length > 0 %}
            <h4>{{ digitalProduct.product.name }} {{ lex('commerce_digitalproduct.files') }}</h4>
            {% for file in digitalProduct.files %}
                <p><a href="[[~[[++commerce_digitalproduct.download_resource]]? &scheme=`full` &secret=`{{ file.secret }}`]]">{{ file.name }}</a></p>
            {% endfor %}
        {% endif %}
    {% endfor %}
</div>
```

> As you can see in the example, within this twig file the `digitalProducts` variable is available when there are digital products on the order. There are three accessible sub-arrays you can access: resources, files, and all (containing resources and files).
>
> You also have access to all fields within DigitalproductFile object: `id`, `class_key`, `properties`, `digitalproduct_id`, `secret`, `name`, `resource`, `file`, `download_count`, `download_limit`, and `download_expiry`.


Here's an example of what the data is structured like containing all the information relevant to digital products. Note the outer structure is an array of each digital product that was purchased, which contains the "all", "resources" and "files" keys for each file/resource that's part of that product. Plus a "product" key with the product information.

```
[
    {
        "all": [
            {
                "id": 3,
                "class_key": "DigitalproductFile",
                "properties": null,
                "digitalproduct_id": 2,
                "secret": "946cfffd7...",
                "name": "Awesome ebook",
                "file": "121",
                "download_count": 0,
                "download_limit": 0,
                "download_method": "redirect",
                "download_expiry": 0
            },
            {
                "id": 4,
                "class_key": "DigitalproductFile",
                "properties": null,
                "digitalproduct_id": 2,
                "secret": "d6777f882339...",
                "name": "ebook",
                "file": "assets\/ebook.pdf",
                "download_count": 0,
                "download_limit": 0,
                "download_method": "redirect",
                "download_expiry": 0
            }
        ],
        "resources": [],
        "files": [
            {
                "id": 3,
                "class_key": "DigitalproductFile",
                "properties": null,
                "digitalproduct_id": 2,
                "secret": "946cfffd7...",
                "name": "Awesome ebook",
                "file": "121",
                "download_count": 0,
                "download_limit": 0,
                "download_method": "redirect",
                "download_expiry": 0
            },
            {
                "id": 4,
                "class_key": "DigitalproductFile",
                "properties": null,
                "digitalproduct_id": 2,
                "secret": "d6777f882339...",
                "name": "ebook",
                "file": "assets\/ebook.pdf",
                "download_count": 0,
                "download_limit": 0,
                "download_method": "redirect",
                "download_expiry": 0
            }
        ],
        "product": {
            "id": 24578,
            "class_key": "DigitalproductProduct",
            "properties": {
                "download_limit": "",
                "download_expiry": "",
                "download_method": "redirect",
                "usergroup": "",
                "resources": [
                    "121"
                ],
                "files": {
                    "1": {
                        "display_name": "ebook",
                        "url": "assets\/ebook.pdf"
                    }
                }
            },
            "sku": "Digital Product",
            "barcode": "0",
            "name": "Access to file",
            "description": "",
            "price": 1500,
            "pricing": "{\"EUR\":{\"regular_price\":1500,\"price_types\":[]}}",
            "stock": -2,
            "stock_infinite": true,
            "weight": 0,
            "weight_unit": "kg",
            "image": "",
            "tax_group": 5,
            "delivery_type": 2,
            "target": 0,
            "removed": false,
            "removed_on": 0,
            "removed_by": false,
            "matrix": "0",
            "column": "0",
            "row": "0",
            "price_formatted": "\u20ac15.00",
            "removed_on_formatted": "",
            "link": false,
            "edit_link": "\/manager\/?namespace=commerce&a=index&ca=product\/update&id=24578",
            "weight_formatted": "0 kg",
            "price_legacy": 0,
            "price_legacy_formatted": "\u20ac0.00",
            "regular_price": 1500,
            "regular_price_formatted": "\u20ac15.00",
            "price_rendered": "<span class=\"product-price__container \" itemscope itemtype=\"https:\/\/schema.org\/Offer\">\n    <meta itemprop=\"priceCurrency\" content=\"EUR\" \/>\n\n    \n    \n    <span class=\"product-price\" itemprop=\"price\" content=\"15.00\">\u20ac15.00<\/span>\n<\/span>"
        }
    }
]
```
