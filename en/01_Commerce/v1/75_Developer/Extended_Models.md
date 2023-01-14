By extending xPDO models, and creating new objects with your specified `class_key`, you can override some specific behaviour.

For example you may [extend the shipping method object](Custom_Shipping_Methods) to implement dynamic pricing through a shipping partners' API, or [add a new page to the merchant dashboard](Modules/Examples/Add_Backend_Page).

> Within Commerce, all classes must extend the comSimpleObject base class, instead of the typical xPDOSimpleObject class. Some features, like form handling, will not work if custom objects do not use comSimpleObject.

Examples of building custom models:

- [Creating custom shipping methods](Custom_Shipping_Methods)
- [Creating custom products](Guides/Making_Custom_Products)

