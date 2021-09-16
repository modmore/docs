---
title: Standalone usage
---

If you use custom form-handling snippets in MODX that you want to protect against spam with Akismet, you can re-use our work (v1.1+). 

[TOC]

## Grab the Akismet class

Akismet is not automatically loaded as a service, we recommend the following code to check if it is installed/available:

```php 
<?php
$path = $modx->getOption('akismet.core_path', null, MODX_CORE_PATH . 'components/akismet/');
$path .= 'vendor/autoload.php';
if (!file_exists($path)) {
    // Handle the case where akismet is not available
    return "Unable to check for spam";
}
require_once $path;
```

## Check for spam

Next, create an instance of the `modmore\Akismet\Akismet` class, and call the checkSpam method. Because both the instantiation and checkSpam can cause an exception, wrap the whole thing in a `try {} catch () {}` block.

```php
try {
    $akismet = new Akismet($modx);
    $values = ...; // see below
    $config = ...; // see below
    $isSpam = $akismet->checkSpam($values, $config);
    if ($isSpam) {
        // Handle spammy form submissions
    }
}
catch (InvalidAPIKeyException $e) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Akismet API key not found. Please add it in the MODX system settings. Form is submitting without a spam check...');
}
catch (GuzzleException $e) {
    $modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage() . ': ' . $e->getTraceAsString());
}
catch (xPDOException $e) {
    $modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage() . ': ' . $e->getTraceAsString());
}
```

## Passing $values and $config options

There are two ways to provide configuration to the class. 

1. Provide an array of submitted values in `$values`, and an array of `$config` that matches the [snippet properties](../Akismet_Snippet).
2. Provide only an array of values, already using the Akismet keys.

An example of option 1:

```php
// could just be $values = $_POST, but in this case we want to show the structure of the array
$values = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'message' => $_POST['message'],
]; 

// could just be $config = $scriptProperties, but in this case we want to show the structure of the array
$config = [
    'akismetType' => 'signup'
    'akismetAuthor' => 'name',
    'akismetAuthorEmail' => 'email',
    'akismetContent' => 'message'  
];

$isSpam = $akismet->checkSpam($values, $config);
// or:
$isSpam = $akismet->checkSpam($_POST, $scriptProperties);
```

An example of option 2:

```php
// Note the key names must now match the Akismet api @ https://akismet.com/development/api/#comment-check
$values = [
    'comment_type' => 'signup',
    'comment_author' => $_POST['name'],
    'comment_author_email' => $_POST['email'],
    'comment_content' => $_POST['message'],
];

$isSpam = $akismet->checkSpam($values);
```

These are functionally identical. Option 1 is easier to implement in a snippet (just pass `$_POST` and `$scriptProperties` and configure it like you would FormIt or Register), while option 2 gives you a bit more control.

