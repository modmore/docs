As of SimpleAB 1.1.0, integrating with Google Analytics is super easy. When a test is run, the `[[!+simpleab.ga_custom_var]]` placeholder (as well as a more specific `[[!+simpleab.ga_custom_var.test_5]]` placeholder where 5 is the ID of the test) is set, which you can throw in your code, like so:

````
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39365923-2']);
  [[!+simpleab.ga_custom_var]]
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
````

The inserted javascript looks like the following:

````
_gaq.push(['_setCustomVar', 1, 'SAB-1','cta_v3', 2 ]);
````

This is what the values mean:

- **_setCustomVar** means it will assign the user a certain custom value, as defined in the rest of the properties
- **1** is the "index" where Google Analytics stores the data, in this case the data is assigned to custom var 1. This number is pretty arbitrary, and can be changed with the `simpleab.ga_custom_var_index` setting if you have a good reason to do so.
- **SAB-1** obviously stands for SimpleAB test with ID 1. The prefix ("SAB") can be adjusted with the `simpleab.ga_custom_var_name` setting.
- **cta_v3** is, in this case, the name of the active variation. We strongly suggest not changing the variation name after starting the test.
- **2** is the "scope" for the custom variable. The possible values, defined with the `simpleab.ga_custom_var_scope` setting, are 1 (assign variable to user), 2 (assign variable to session) or 3 (assign variable to page).

For more information about custom variables, please see the official [Google Analytics Documentation](https://developers.google.com/analytics/devguides/collection/gajs/gaTrackingCustomVariables).

Please note that the custom variable **will not** be set when using the Admin Preview functionality.

## Viewing test data in Google Analytics

To view the data in Google Analytics, browse to Audience > Custom > Custom Variables. The data will show up there. You can add secondary dimensions to get more insight into the users.