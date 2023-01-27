In Commerce 1.3, we upgraded the internal version of Omnipay from v2 to v3.

The previously named `modmore\Commerce\Gateways\Omnipay2\Omnipay2Gateway` class, used as a base for several core and third-party payment gateways, was renamed to `modmore\Commerce\Gateways\Omnipay\OmnipayGateway` for consistency.

To ensure backwards compatibility, class aliases were added for the `Omnipay2Gateway`, `Transaction`, and `RedirectTransaction` class. These class aliases will be removed in Commerce 2.0, so you should update your custom gateway classes that rely on the old naming.

In addition, the BaseGateway class is also deprecated and expected to be removed in 2.0.
