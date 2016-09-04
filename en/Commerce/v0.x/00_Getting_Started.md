Commerce is a full featured ecommerce solution for MODX, but you have to start somewhere! This document will guide you through the necessary steps on a fairly high level. If you get stuck on a certain step, click through to read more in depth documentation about the topic.

## Step 1: Install the Package

Without the package, none of the other steps will make sense! So purchase a license (or [use a free development license](https://www.modmore.com/free-development-licenses/)) and install the Commerce transport package in your MODX Revolution site. 

Keep an eye on the Server Requirements as Commerce demands slightly more than our other packages.

Once installed, you're ready to start building your webshop.

## Step 2: Choose your Modules

Many of the Commerce features are implemented as Modules. While they are tightly integrated, they are all optional so you can use as little or as many as you'd like.

Many modules ship with the core package. Others can be installed separately and may require an additional purchase. 

By default all modules are disabled. To enable the modules you wish to use, go to Extras > Commerce and navigate to Configuration > Modules.

You'll see a full list of all the available modules, and the option to enable them on test and live mode. Some modules also allow you to enter configuration options. At this point in time your shop is in test mode, so enable the modules you want to use for test mode. 

Some modules might require changes to your templates, so keep an eye out for additional instructions in the module description.

If you've enabled some modules, let's start on your front-end.

## Step 3: Create the Cart

The cart is very important in a webshop. To set it up, create a new resource in the site to hold your cart and give it the following content:

````
[[!commerce.cart]]
````

**Make sure the snippet call is uncached**. If you go to the cart resource, you should see a notice that your cart is empty. 

To make sure Commerce knows where your cart is, update the `commerce.cart_resource` setting with the ID of your Cart resource.

Let's now create some products to add to the cart.

## Step 4: Create your first Product

Commerce allows you to build and manage your catalog in various ways, but they all share one thing. This is the Product record. 

In some cases you might automatically create the Commerce Product records based on information in your catalog, and for simple shops you might use the provided Product and Category features for your catalog as well.

To get you started, we'll just create a product record directly. Go to Extras > Commerce and click the Add new Product button on the Products page. In the popup enter the product details, and hit save.

Add a form like this anywhere on your site, replacing 1 with the ID of the newly created product if needed.

````
<insert form here>
````

Visit that page in the front-end, hit the Add to Cart button and voila - you should have the product in your cart!

## Step 5: Checking out

While carts are useful, you will also need a checkout to allow people to pay. Create a new Checkout resource, and place the following uncached snippet call in it:

````
[[!commerce.checkout]]
````

Also update the `commerce.checkout_resource` setting with the ID of your checkout resource. This way Commerce knows where to point your users that wish to place their order.

At this point your checkout should be up and running, however you don't have any payment or shipping methods yet, so people wont be able of completing their checkout.
 
Visit Extras > Commerce and then Configuration > Payment Methods and Shipping Methods to set them up. You'll most likely need some API Keys for the payment methods, you can find more information on how to retrieve those in the documentation.

## Step 6: Make it your own!

At this point you should have a basic, but functional shop. You're not done though! You'll probably want to build up a larger catalog, tweak the design of the cart and checkout or explore the different modules you can use.

If you're unsure on how to approach certain features, or have any other questions about Commerce, please do reach out to our team. We have a community forum and email support and we would love to help you make the most out of Commerce in either of those venues.

