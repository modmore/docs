Commerce doesn't have the concept of product variations. Instead, different variations of a product are simply unique product records with their own name, SKU, description, price, stock etc. 

In your catalog, you can still present different products as variations. For example if you're using resources to build your catalog, you could use a multi-select dropdown template variable to select the products that should be shown on that page. In your template you can then use the [commerce.get_products](../Snippets/get_products) snippet to show them on the frontend as radio buttons, or a `<select>` element. 

