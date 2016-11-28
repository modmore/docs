Now that you have tests and variations in place, you'll need to set up conversion points as well so the script can calculate conversion rates. Luckily, this is super simple.

There are several ways of logging a conversions. The first is a standalone snippet that you reference on a page (for example on a thank you page) or in a template. The second is used as a FormIt hook to trigger the conversion right after a form gets processed. Thirdly there is an API endpoint available which you can hit up with AJAX to trigger a conversion. Finally, if you are a developer, you could interface with the SimpleAB API directly to register the conversion.

[TOC]

### Standalone Snippet

The standalone snippet is called `sabConversion`. The easiest valid call is uncached without any properties, like so:

````
[[!sabConversion]]
````

In this usage it will mark a visit to that page as a conversion for any tests the user has seen. If you only have one active test, that "catch-all" functionality might be appropriate, however if you run multiple tests at the same time, you probably want to register conversions a bit more precise. You can use the &tests=`1,2,3` property with a comma seperated list of Test IDs to achieve that.

````
[[!sabConversion? 
  &tests=`1,2,3`
]]
````

By default the user history of seen variations (which is stored in the user session) is removed when a conversion gets logged. This means that for each variation pick, there is only ever one conversion, and the user might be shown a different variation next time they land on your testing page. If you want variations to continue receiving conversions when for example a user refreshes the "Thank You" page, you can specify `&resetPick` on the snippet call. It will preserve the pick history for the user.

````
[[!sabConversion? 
  &tests=`1,2,3`
  &resetPick=`0`
]]
````

### FormIt Hook

When a conversion needs to be logged on submitting a form that uses FormIt for processing, you can use the FormIt hook to do that. The hook is called sabConversionHook and you would use it like this to log a conversion for all seen tests:

````
[[!FormIt?
  &hooks=`sabConversionHook`
]]

<form method="post" action="[[~[[*id]]]]">
  <input type="text" name="foo" value="bar" >
  <button type="submit">Add Conversion!</button>
</form>
````

If you want to specify specific tests to mark the conversions for, you can do so with the &sabTests=`1,2,3` property on the FormIt call, like in the example below.

````
[[!FormIt?
  &hooks=`sabConversionHook`
  &sabTests=`1,2,3`
  ]]

<form method="post" action="[[~[[*id]]]]">
  <input type="text" name="foo" value="bar" >
  <button type="submit">Add Conversion!</button>
</form>
````

By default the user history of seen variations (which is stored in the user session) is removed when a conversion gets logged. This means that for each variation pick, there is only ever one conversion, and the user might be shown a different variation next time they land on your testing page. If you want to preserve the variation history when a user submits a FormIt form with sabConversionHook in it, you can specify &sabResetPick=`0` on the FormIt snippet call.

````
[[!FormIt?
  &hooks=`sabConversionHook`
  &sabTests=`1,2,3`
  &sabResetPick=`0`
  ]]

<form method="post" action="[[~[[*id]]]]">
  <input type="text" name="foo" value="bar" >
  <button type="submit">Add Conversion!</button>
</form>
````

### AJAX Conversion Endpoint

The AJAX Conversion Endpoint is a specific URL you can hit with an AJAX call to register a conversion. You may want to use this if:

- You want to trigger a conversion when submitting a form that does not use FormIt, or is not processed by MODX, but does expose a "submit" javascript event.
- You want to trigger a conversion when a user scrolls past a certain threshold on a page.
- You want to trigger a conversion when a user has spent a minimum amount of time on a page.

The endpoint is the SimpleAB connector, but for convenience you can use the `sabConversionUrl` snippet to generate the complete URL including all parameters it needs.

The `sabConversionUrl` snippet is very familiar to the standalone snippet, except that it returns the URL to log a conversion at, instead of logging the conversion right away. It can be used without any parameters, with the `&tests` parameter to specify specific test IDs as a comma separated list, and the `&resetPick` property can be used to reset the pick history for the user or not.

````
[[!sabConversionUrl]]
[[!sabConversionUrl? 
    &tests=`1,2,3`
]]
[[!sabConversionUrl? 
    &tests=`1,2,3`
    &resetPick=`0`
]]
````

A full working example might look something like this (note, this example uses jQuery), which intercepts the submit on a form until a conversion has been logged.

````
<form id="conversion-form" method="post" action="[[~[[*id]]]]">
  <input type="text" name="foo" value="bar" >
  <button type="submit">Add Conversion!</button>
</form>

<script>
    $(document).ready(function() {
        var form = $('#conversion-form');
        var loggedConversion = false;
        form.on('submit', function(event) {
            if (!loggedConversion) {
                event.preventDefault();
                $.getJSON('[[!sabConversionUrl? &tests=`1,2,3`]]', function(data) {
                    if (data.success) {
                        loggedConversion = true;
                        form.submit();
                    }
                    else {
                        // Uh oh, something went wrong logging the conversion.
                        // We can either show the user an error (optionally using the data.message value) like this:
                        alert('Sorry, something went wrong logging your submit: ' + data.message);
                        
                        // Or we can simply pretend nothing happened and continue submitting the form. After all,
                        // this is just statistics and the user completing its action is more important.
                        loggedConversion = true;
                        form.submit();
                    }
                });
            }
            else {
                return true;
            }
        });
    });
</script>
````

The following example works similar to the one above, but triggers on clicking a link.

````
<a id="logConversion" href="[[~15]]" title="View our Services">
    Services
</a>

<script>
    $(document).ready(function() {
        var link = $('#logConversion');
        link.on('click', function(event) {
            var targetHref = $(this).attr('href');
            event.preventDefault();
            $.getJSON('[[!sabConversionUrl? &tests=`1,2,3`]]', function(data) {
                if (data.success) {
                    // Send the user to where we wanted to go
                    location.href = targetHref;
                }
                else {
                    // Uh oh, something went wrong logging the conversion.
                    // We can either show the user an error (optionally using the data.message value) like this:
                    alert('Sorry, something went wrong logging your click: ' + data.message);
                    
                    // Or we can simply pretend nothing happened and continue submitting the form. After all,
                    // this is just statistics and the user completing its action is more important.
                    location.href = targetHref;
                }
            });
        });
    });
</script>
````

### PHP SimpleAB API

If you're a developer and want to trigger a conversion from your own code, you can use something along these lines:

````
<?php
/**
 * @var modX $modx
 * @var SimpleAB $simpleAB
 */
$corePath = $modx->getOption('simpleab.core_path',null,$modx->getOption('core_path').'components/simpleab/');
if (!$simpleAB = $modx->getService('simpleab', 'SimpleAB', $corePath.'model/simpleab/')) {
    return 'SimpleAB not found in ' . $corePath;
}

$tests = '1,2,3'; // Or pass '*' for all tests
$resetPick = true; // Set to false to not empty the user history for $tests

$simpleAB->registerConversion($tests, $resetPick);
````