**This page has been completely rewritten into a full Getting Started series! [Get started with Commerce here &raquo;](Getting_Started/index)**

<hr>

Commerce is a full featured ecommerce solution for MODX, but you have to start somewhere! This document will guide you through the necessary steps on a fairly high level. If you get stuck on a certain step, click through to read more in depth documentation about the topic.

[TOC]

## Install the Package

First of all you'll need to install Commerce. It's available from the modmore.com [package provider](https://modmore.com/about/package-provider/), so you'll need to create an [api key](https://modmore.com/account/api-keys/) and add that to your MODX site to get started.
 
Next, you'll need a license. [Free development licenses](https://modmore.com/free-development-licenses/) are available if you're on a development domain (`localhost`, `site.dev`, `dev.site.com` etc.), otherwise you'll need to buy a license. [See the Commerce Pricing](https://modmore.com/commerce/pricing/) for information on licenses and prices.

Go to Extras > Installer in your MODX manager and open the modmore.com package provider by clicking the arrow on the _Download Extras_ button, choosing _Select a Provider_ in the menu, and choosing modmore.com in the window. 

Find Commerce in the provider under Premium Extras > Commerce and choose Download.

**Note:** Commerce is a rather big package which takes some time to be packaged on our server and then downloaded. It may take up to 30 seconds. 

Once downloaded you can install Commerce. During the installation you can choose to automatically create a bunch of things for you, including currencies, a default shipping method, and cart/checkout resources. You can change all of these things after installation if needed, so it's recommended that you keep all boxes ticked unless you have a good reason not to.

The installation will also check if your server meets the most important [Requirements](Requirements). This includes the MODX version and PHP version. If your site/server doesn't meet those requirements, the installation will not complete. Other requirements (such as serving the site over HTTPS) are only enforced when you want to set the shop to live mode.

Once installed, you're ready to start building your webshop.

## Choose your Modules

Many of the Commerce features are implemented as [Modules](Modules). While they are tightly integrated, they are all optional, so you can use as little or as many as you'd like. At the moment almost all modules are shipped with the Commerce package.

By default all modules are disabled. To enable the modules you wish to use, go to Extras > Commerce and navigate to Configuration > Modules.

You'll see a full list of all the available modules. Click on their name to see the module configuration and to enable them in test and/or live mode. At this point in time your shop is in test mode, so enable the modules you want to use for test mode. 

It's recommended to enable these modules:

- [Basic Address Validation](Modules/Address_Validation/Basic): to make sure the customer address is filled in during the checkout. Without an address validation module, the customer could checkout without providing an address.
- [Coupons](Modules/Cart/Coupons): enables the coupons functionality, including a new Coupons tab in the dashboard where they can be managed.
- [Combine Products](Modules/Cart/CombineProducts): combines multiple order rows with the same product into a single order row. 

For dealing with [Taxes](Taxes) you can choose to enable the [EU VAT module](Modules/Taxes/EUVat) to automatically load current EU VAT rates as a Rate provider, or [TaxJar](Modules/Taxes/TaxJar) for an integration with the [TaxJar SmartCalcs API](https://www.taxjar.com/smartcalcs/) to get automated US Sales Tax calculations (requires a subscription).

Some modules might require changes to your templates to work, so keep an eye out for additional instructions in the module description, shown when you edit the module. 

If you've enabled some modules, let's create some products.

## Creating Products

In Commerce, the [Products and the Catalog](Product_Catalog) are two different things. Simply put:

- The **Products** are simple objects that provide Commerce only with the information it needs to handle an order: a name, SKU, price, weight, stock etc. 
- The **Catalog** is the front-end presentation of those products, which may include additional features like reviews, product variations, photos and videos etc.

Commerce is mostly concerned with the **Products**. How you build your **Catalog** is up to you. There's a few common options:


- Starting with v0.8, it's recommended to use the [Commerce Products TV](Product_Catalog/Products_TV). This adds a sort of list template variable type where you can search for existing products or create new products, directly from the resource page. Combine this with Collections and Tagger (available from MODX.com) for large catalogs with powerful filtering. Displaying the product information (SKU, price, etc) is then done with the [commerce.get_products snippet](Snippets/get_products). 
- For shops with only a few products, you can build a [Minimal Catalog](Product_Catalog/Minimal) based on the products in Commerce. The benefit is that you only have a single place where products are managed (the Commerce dashboard), but it doesn't allow for many advanced features.
- The [Resource Catalog](Product_Catalog/Resource) is an option where each resource is seen as a single product. Commerce retrieves the product information from template variables that you set up.

Note that Commerce does not currently offer product options/variations out of the box. The idea behind that is that each unique product you have in stock is a unique Product record in Commerce. By using the Products TV, you can have multiple product variations shown on a single page.  

For a quick test run, you can create a product via Extras > Commerce, on the Products tab. Create a standard product record, and use the cart form below on a resource somewhere.

````
<form method="post" action="[[~[[++commerce.cart_resource]]]]">
    <input type="hidden" name="add_to_cart" value="1">
    
    <label for="add-quantity">Quantity</label>
    <input id="add-quantity" type="number" name="products[1][quantity]" value="1">
    
    <input type="submit" value="Add to Cart">
</form>
````

Note the hidden input with name `add_to_cart`, and replace the number "1" in the quantity field with the ID of the product record. 

## Create the Cart Page

_If you chose to create a cart resource during the installation, you can skip this step._

To set up a cart, create a new resource and give it the following content:

```` html
[[!commerce.cart]]
````

**Make sure the snippet call is uncached**. If you go to the cart resource, you should see a notice that your cart is empty. 

To make sure Commerce knows where your cart is, update the `commerce.cart_resource` system setting with the ID of your Cart resource. As of v0.12, you can also set the `commerce.shop_resource` system setting to tell Commerce where the root of your shop is.

## Create the Checkout Page

_If you chose to create a checkout resource during the installation, you can skip this step._

While carts are useful, you will also need a checkout to allow people to place their order. Create a new Checkout resource, and place the following uncached snippet call in it:

````
[[!commerce.checkout]]
````

Also, update the `commerce.checkout_resource` system setting with the ID of your checkout resource. This way Commerce knows where to point your users that wish to place their order.

## Create Shipping & Payment Methods

To make sure your checkout works from start to finish, you'll need to have at least one shipping and payment method available. If you didn't create these during the installation, head to Extras > Commerce and Configuration > Payment Methods and Shipping Methods to set them up.

For the payment gateways you'll often need API credentials and (test) merchant accounts. If you don't have any yet, you can use the _Manual_ Gateway for testing.

## Ready to go!

At this point you should have a basic, but functional shop. 

You're not done though! You'll probably want to build up a larger [catalog](Product_Catalog), tweak the [design of the cart and checkout](Front-end_Theming) or explore all the different [modules](Modules) that are available.

If you're unsure on how to approach certain features, or have any other questions about Commerce, please reach out to our team. We have a [community forum](https://forum.modmore.com/c/commerce), [FAQs](https://support.modmore.com/faq/13-commerce), as well as email support if you've purchased a license, and we would love to help you make the most out of Commerce.
