
TableRates is a concept from Magento where you manage a database of shipping costs based on a combination of weight and destination with zipcode-level granularity. This database is managed outside of the ecommerce platform (with several generators available on the web), and then uploaded as a CSV file.

With the TableRates module for Commerce, **available as a separate package** and from [GitHub](https://github.com/modmore/Commerce_TableRates), you can use that same configuration with a special shipping method type in Commerce.

[TOC]

## Configuration

To use the TableRates shipping method, first install the TableRates package from the modmore package provider, and then enable the module in Commerce in Configuration > Modules.

Next, navigate to Configuration > Shipping Methods and create a new shipping method of type TableRates.

![Screenshot showing the edit panel for a TableRates shipping method](../../../images/modules/tablerates.jpg)

At time of writing, TableRates only supports the weight-to-destination condition. The other types of conditions available in the Magento module are not currently planned.

Where in Magento you upload the CSV file containing the shipping fees, for Commerce you'll need to paste the comma separated contents into the "Comma-separated data" field.

## CSV Data

The CSV data contains 5 values per line. These are:

- The country code. Commerce uses 2-character country codes, however for compatibility with Magento generators and data files, Commerce also supports the 3-character country codes here.
- The state/region.
- The zip code, see below for options
- The condition value to compare against, in this case the shipment weight in gram.
- The shipping fee as a decimal number.

The destination fields (country, state, zip) can set to an asterix (`*`) to accept any value. For example, to match shipping to Belgium no matter the province or zip code, for shipments that weigh 50 grams or more and cost €1,20 to ship, add a line `BE,*,*,50,1.20`.

The **zip code** also supports partial wildcards and multiple options per line. Wildcards can only be applied as a **suffix** (for example `442*` will match `4421` or `4429AA` or `4428-11234`). Multiple options can be separated with a pipe symbol: `|`, for example `4421|4422|4423`. You can also mix these. (Added in v1.2.)

Commerce will loop over the CSV data from top to bottom to find matching rules. If it finds multiple rules, it will use the **last applicable one** that appears in the data. You can use this to your advantage by putting more specific rules lower in the file. For example:

````
Country,State,Zip,Weight,Shipping
*, *, *, 0, 15.00
US, *, *, 0, 7.50
US, NJ, *, 0, 2.50
US, NJ, *, 2000, 5.00
US, NY, *, 0, 1.50
US, NY, *, 2000, 3.00
````

This will apply a $15 rate to all orders worldwide. The $7,50 rate to all orders in the US, except those to the states of New Jersey and New York. Shipping to NY and NJ have cheaper shipping, plus two different rates depending on the weight (under and over 2kg respectively).

If this CSV data were in the reverse order, all shipments would be charged the $15 rate.

## More about TableRates

- [Magento's user documentation about Table Rates](http://docs.magento.com/m2/ce/user_guide/shipping/shipping-table-rate.html)
- [Elgentos' Magento Table Rates Generator](https://www.elgentos.nl/tablerates/)
