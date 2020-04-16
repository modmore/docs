The [SnippetStatusAction](https://modmore.com/commerce/extensions/snippetstatusaction/) extension, separately installable via the modmore package provider, lets you crete a status change action using a snippet.

If you're planning to create a status change action suitable for reuse/distribution, please [create a proper status change action yourself](../Developer/Status_Change_Actions). But, if you're just building something for a single project and are not quite up to building your own module, this extension is useful.

## Setup

First, install the extension from the modmore package provider.

Next, go to Configuration > Modules in the Commerce dashboard, and find the Snippet Status Change Action module - typically towards the end of the list. Enable it, and save.

(Before you do the next step, it's useful to create the snippet, as its existence will be verified.)

Go to Configuration > Statuses and click on the name of the status change you want to run the snippet on. On the _Add Status Change Action_ button dropdown, choose _Run a Snippet_. Enter a name and the name of the snippet where prompted. Save.

Now you're all set to run your snippet during the status change! Just need to write that snippet now ;)

## The Snippet

Inside the snippet you have access to the following parameters:

- `$order`, a comOrder instance
- `$oldStatus`, the old comStatus the order is moving away from
- `$newStatus`, the new comStatus the order will be in momentarily
- `$statusChange`, the comStatusChange responsible for running this particular action
- `$commerce`, the Commerce instance, for convenience.
- `$adapter`, the [MODX Adapter](../Developer/MODX_Adapter), for convenience.

As you're in a snippet, you also have `$modx` in this context.

There's no need to return anything from the snippet; any output is silently discarded. If you want to send information somewhere, log it to the order (see `$order->log()`) or the MODX error log.

So now it's up to you to write some magic.

Here's an example of iterating over items in the order:

````php 
$items = $order->getItems();
foreach ($items as $item) {
    // not all items will have a product, but you may find one useful
    if ($product = $item->getProduct()) {
        $modx->log(modX::LOG_LEVEL_ERROR, 'Found product ' . $product->get('sku') . ' in the order!');
        if ($target = $product->getTarget()) {
            // In a resource product, the target is the resource object
            // It's not present when using a product list or matrix tv
        }
   }
}
````
