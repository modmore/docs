If you want to use the **Dynamic Shipping Prices** feature of SimpleCart, a different Resource/Template setup is needed!
The main reason for this is, that we need to know the country of the customers delivery address, before the delivery method is selected.

## Different Resources Structure 

Using **Dynamic Shipping Prices**, the recommended way to set up your checkout resources is:

- [**Cart**](Cart "Go to Cart template documentation") -- (the shopping cart + coupon form)
	- [**Delivery**](Delivery "Go to Delivery template documentation") -- (delivery and payment address form + delivery method selector)
		- [**Payment**](Payment "Go to Payment template documentation") -- (payment method selector)
			- [**Verify**](Verify "Go to Verify template documentation") -- (last check for your cart, addresses and methods)
				- [**Finished**](Finished "Go to Finished template documentation") -- (checkout finished successful or failed)

_Please note: the nesting of the resources is important as we can use the custom output modifier `[[*id:scFirstChild]]` (which comes preinstalled with SimpleCart) in the `&redirectTo` property of **FormIt**._

Except for the Cart you can place all other template parts into a chunk, or directly within the content of the nested resources. 

###The whole template set has some other vantages too:

- The whole checkout process is session based, so the customer wont loose the current step when he accidentially clicks a link outside the checkout process (e.g. in main menu).
- The checkout process works back and forth so the customer can always go back some steps to correct some entries without loosing information.
- This template set can also be used if you don't want to provide Dynamic Shipping Prices calculation!