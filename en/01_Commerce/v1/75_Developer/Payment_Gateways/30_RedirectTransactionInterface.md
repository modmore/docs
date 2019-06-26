If your transaction may require an off-site redirect to complete, implement the `\modmore\Commerce\Gateways\Interfaces\RedirectTransactionInterface` interface to indicate how. This interface extends from the [TransactionInterface](TransactionInterface).

[TOC]

## The interface

```php
<?php

namespace modmore\Commerce\Gateways\Interfaces;

interface RedirectTransactionInterface extends TransactionInterface
{
    /**
     * Indicate if the transaction requires the customer to be redirected off-site.
     *
     * @return bool
     */
    public function isRedirect();

    /**
     * @return string Either GET or POST
     */
    public function getRedirectMethod();

    /**
     * Return the fully qualified URL to redirect the customer to.
     *
     * @return string
     */
    public function getRedirectUrl();

    /**
     * Return the redirect data as a key => value array, when the redirectMethod is POST.
     *
     * @return array
     */
    public function getRedirectData();
}
```

