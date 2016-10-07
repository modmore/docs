Since announcing Commerce in 2015, the question we received most was if people should wait for Commerce, or use [SimpleCart](../../SimpleCart) (the other ecommerce plugin we have available)for their projects. 

Until we released Commerce that was easy to answer: use SimpleCart, as Commerce isn't ready to go, and there is no release date just yet.

But now that both options are available, there are different considerations. We'll go over a few in this document to see how the two products differ, and when which one would make sense.

[TOC]

## Already using SimpleCart?

Just stick with it. If your webshop is humming along nicely, and there's no immediate reason to change how it works, SimpleCart should do just fine. 

We're continuing to maintain SimpleCart, even now that Commerce is available, so as long as you keep that up to date you'll enjoy a stable experience. 

If your shop has grown beyond what SimpleCart can offer, moving it over to Commerce may make sense. There's a few options you could consider. 

1. First, you could leave your [catalog](Product_Catalog) in place, using SimpleCart. Combined with a few changes to your templates, cart, checkout and customer section this option will save you a lot of content migrations, while benefiting from the more advanced and flexible Commerce features. It's possible to move along your order history as well if needed. 
2. The second option is to move your products into a new catalog as well. Look into the [different ways of managing your catalog in Commerce](Product_Catalog) for comparisons to find what best suits your shop. By moving the catalog, you might get additional benefits or features available that your shop needs. 
3. The most radical option is to start with a clean slate. Perhaps the shop could use a redesign or rebuild? You get to pick the best tool for the job, which is probably Commerce. 

## High-level Requirements

There's a few high level requirements that will lead you to either products. 

### Dynamic shipping costs

If you need to calculate shipping costs based on an integration with a postal service, or based on custom business logic involving product weight, size, or quantity, then you'll need to use Commerce.

SimpleCart is rather restricted in how it allows shipping methods to be priced. In the past we have researched adding more flexible shipping pricing to SimpleCart, however that turned out to be not as straightforward to do as we hoped due to the structure of the checkout, and the legacy users to consider. 

The flexibility of Commerce will allow you to manage shipping costs in various ways.

1. For each shipping method you can provide a fixed or percentage price out of the box. Each method also has restrictions on the order total you can set, making sure shipping methods are only available as an option until, between, or after a certain order total. Simple business rules like "€5 shipping under €25, €3 from €25-50, free from €50+" can be implemented with these options. 
2. You can use an existing [Module](Modules) to integrate with a third party postal service. These modules can be configured on a module and shipping method level with various options to automatically offer the right rates to your customers. 
3. If no existing module is available for your use case, you can build one or contract a developer to build it for you. When building a custom shipping method module, you have full control over the calculation, making it possible to implement any business rule. 

### Payment Service Providers

When accepting payments online you need to work with one or more payment providers. This can be an important factor in deciding which shopping solution fits your needs. 

SimpleCart supports the following payment providers:

- Authorize.net SIM
- Mollie
- PayPal Express
- Stripe

For a current list of the supported payment methods in Commerce see [Modules](Modules). At time of writing, the following are supported in Commerce:

- Braintree
- Mollie
- PayPal Express
- PaymentSense
- Stripe

If the payment provider you need is not on either lists, Commerce is the better option. Implementing gateways is a lot easier in Commerce thanks to the use of the OmniPay library. If a _driver_ exists for the Payment Provider you need, we'll be able of integrating it with Commerce much quicker. 

Let us know which payment provider you need, and we might try to squeeze an integration into our normal release cycle. 

To commission a payment provider because you need it right now, please contact Mark via support@modmore.com for an estimate. 


