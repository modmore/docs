If you'd like to do some kind of processing after an order is placed, you can use a finished order hook. This hook is added to the [scFinishOrder snippet](../../Snippets/scFinishOrder) on the [Thank You page](Thank_You). 

## What's a hook?

A hook is a snippet in MODX that is executed after a certain action. The concept is also heavily used with FormIt. 

Some possible use cases for finished order hooks in SimpleCart include...

- Add the customer to a newsletter list like MailChimp
- Creating custom user records or add the user to a new usergroup to access protected content
- Schedule a marketing/survey email to be sent in the future
- Create a (PDF) invoice 
- Create a license key 
- Synchronise data with a CRM

To create your own hooks, you'll need to know a bit about working with PHP and the MODX APIs, in particular on retrieving data with the xPDO methods. 

## Configure Snippets as hooks (basics)

There are three types of hooks: preHooks, postHooks and failHooks. You can configure them on the snippet call like this:

```` html   
[[!scFinishOrder?
    ...
    &preHooks=`yourSnippet1,yourSnippet2`
    &postHooks=`yourSnippet1,yourSnippet2`
    &failHooks=`yourSnippet1,yourSnippet2`
    ...
]]
````

No matter which type of hook you use, you'll need to load the SimpleCart service at the start of your snippet with the following code:

```` php
/**
 * @var scHooks $hook
 * @var SimpleCart $sc
 */
$corePath = $modx->getOption('simplecart.core_path', null, $modx->getOption('core_path').'components/simplecart/') . 'model/simplecart/';
$sc = $modx->getService('simplecart','SimpleCart', $corePath, $scriptProperties);
if (!($sc instanceof SimpleCart)) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[CartHookFinished] Cannot load SimpleCart classes...');
    return false;
}
return true;
````

To load the order, you can call `$hook->getValue('order')`:

```` php
// Get order from the the hook
$order =& $hook->getValue('order');
if ($order instanceof simpleCartOrder) {
    // Do what you need to do
}
return true;
````

Note that it's important to end the snippet with `return true;` if it was successful; that will tell SimpleCart it is okay to process other hooks. With `return false;` it will stop processing hooks.

## Pre Hooks

Pre hooks are fired **after** the payment is verified, but **before** the order is marked as finished and emails are sent. If you make any changes to the order here, those will be available in the email.

## Post Hooks

In most cases, you'll use a Post Hook. These are fired when the order has been paid and is marked as finished. 

Here's an example on how to get the users' email address to add it to a newsletter list. 

```` php
/**
 * @var scHooks $hook
 * @var SimpleCart $sc
 */
$corePath = $modx->getOption('simplecart.core_path', null, $modx->getOption('core_path').'components/simplecart/') . 'model/simplecart/';
$sc = $modx->getService('simplecart','SimpleCart', $corePath, $scriptProperties);
if (!($sc instanceof SimpleCart)) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[CartHookFinished] Cannot load SimpleCart classes...');
    return false;
}

// Get order from the the hook
$order =& $hook->getValue('order');
if ($order instanceof simpleCartOrder) {

    // Grab the order address record
    $c = $modx->newQuery('simpleCartOrderAddress');
    $c->where(array(
        'order_id' => $order->get('id'),
        'type' => 'order',
    ));
    
    /** @var simpleCartOrderAddress $address */
    $address = $modx->getObject('simpleCartOrderAddress', $c);
    
    if ($address instanceof simpleCartOrderAddress) {
        
        $customersEmail = $address->get('email');
        
        // now doing your mailing application stuff here
    }
}
// Always end with return true if the hook was successful
return true;
````

To retrieve the purchased products, use something like this:

```` php   
/**
 * @var scHooks $hook
 * @var SimpleCart $sc
 */
$corePath = $modx->getOption('simplecart.core_path', null, $modx->getOption('core_path').'components/simplecart/') . 'model/simplecart/';
$sc = $modx->getService('simplecart','SimpleCart', $corePath, $scriptProperties);
if (!($sc instanceof SimpleCart)) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[CartHookFinished] Cannot load SimpleCart classes...');
    return false;
}

// Get order from the the hook
$order =& $hook->getValue('order');
if ($order instanceof simpleCartOrder) { 
    $products = $order->getMany('Product');
    if (!empty($products) && is_array($products)) {
        foreach ($products as $product) {
            // do something with $product here
        }
    }
}
// Always end with return true if the hook was successful
return true;
````   

## Fail Hooks

To execute some code when an order failed, usually because the payment failed, you can use a fail hook. 

## Creating additional placeholders

To set additional placeholders for on the Thank You page, call the `$hook->addPlaceholder` method with the placeholder key and its value. 

```` php   
$hook->addPlaceholder('the_name', 'This is the value');   
````   

SimpleCart automatically adds the `order.` prefix, so in the above example the value would be available in `[[+order.the_name]]`. 
