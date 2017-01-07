SimpleCart optionally supports the calculation of **Dynamic Shipping Prices** based on products weight and country/zone of the delivery destination.

**To enable dynamic shipping prices caluclation, you need to**:

1. setup the different carrier price lists within the **Carrier prices** tab in SimpleCart **Adminitration** section
2. enter a **volume weight** in **product settings** for each physical product
3. use a different template set for your checkout process (as you need the zone/country information from your customers address)

##Managing Carrier Price Lists

Each [Delivery Method](Delivery Merhods "Go to Delivery Merhods documentation") has it's own carrier price list based on different package weight limits and destination.

### Creating a New Carrier Price

[ ![The Carrier price create window](https://assets.modmore.com/uploads/carrier_price_create_win.png)](https://assets.modmore.com/uploads/carrier_price_create_win.png "The Carrier price create window")

- **Delivery Method**: Select the delivery method this carrier price belongs to
- **Country (zone)**: Select the country this carrier price belongs to
- **Weight Limit**: Enter the weight limit for this entry (The weight limit field is unit less but needs to match the unit used in **Volume Weight** field in product settings. You should always use the smallest default weight unit for your country as numbers are limited to 3 decimal places! e.g. Grams for European countries, Ounces for US)
- **Price**: Enter the price for this weight limit (always use "." as decimal seperator!)
- **Description**: Internal description/notes (optional)

## Volume Weight for your Product

In **Settings** tab on product edit page under (vertical) **Product** tab you will find the **Volume weight** field.
Enter a number to define the weight of the product including it's outer packaging (allowed are numbers with up to 3 decimal places). If the product is very light compared to it's size, vary this value to meet the real shipping costs (see the shiping costs table of you carrier).
This field is generally unit less but you need to use the same unit as in your carrier prices table (always use "." as decimal seperator)!

## Special Template Set for your Checkout Process

As the calculation of dynamic shipping prices needs the zone/country information from the customers address early in checkout process, the default templates for SimpleCart wont work. Read more about the needed template set under [Checkout with Dynamic Shipping Prices](../Checkout with Dynamic Shipping Prices/index "Go to Checkout with Dynamic Shipping Prices documentation").
