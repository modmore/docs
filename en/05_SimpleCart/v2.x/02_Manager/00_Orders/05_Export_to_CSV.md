If you want, you can export either selected or all orders to a CSV file. This export will include the basic order fields, as well as the order address if you tick that box. 

[ ![Exporting selected orders or export all to CSV format](https://assets.modmore.com/uploads/2015/12/orders_export_csv_1.png)](https://assets.modmore.com/uploads/2015/12/orders_export_csv_1.png "Exporting selected orders or export all to CSV format")

## Export CSV options

Once you have clicked on one of the options in the _Actions_ menu, you will get a window where you can set and choose a couple of options before the CSV is generated for you.

[ ![Export orders options window](https://assets.modmore.com/uploads/2015/12/orders_export_csv_options_window.png)](https://assets.modmore.com/uploads/2015/12/orders_export_csv_options_window.png "Export orders options window")

**Column separator**

This is the character used between each column in the CSV. Set to a semicolon by default.

**Column enclosure**

This is the character used to enclose the column values. Used by string values only.

**Include column names**

Check or uncheck this whether or not you want to have the column names in the first line in the CSV.

**Include order address**

Check or uncheck this whether or not you want to include order address fields too.

## Download CSV after it's exported

[ ![Download is ready window](https://assets.modmore.com/uploads/2015/12/orders_export_csv_download.png)](https://assets.modmore.com/uploads/2015/12/orders_export_csv_download.png "Download is ready window")

Once your export is created, you will be notified about it and then you can download the file by clicking on the download button.

Here is an example of the structure for the CSV with the address included:

```` csv
id;ordernr;user;name;address;zip;city;state;country;delivery;payment;coupon;total;status;created
1;10001;;"Mark Hamstra";"Longstreet 123";1234AB;Amsterdam;;Netherlands;"Default delivery";"Bank Transfer";0;12,95;"Completed order";"2016-09-29 20:29:44"
````

And without the address:

```` csv
id;ordernr;user;delivery;payment;coupon;total;status;created
1;10001;;"Default delivery";"Bank Transfer";0;12,95;"Completed order";"2016-09-29 20:29:44"
````