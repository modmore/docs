Commerce 2.0 is a major update. Updating an existing store, especially stores that may have been running for years, may require some additional effort compared to a standard upgrade.

**We strongly recommend making the upgrade to Commerce 2.0 on a separate staging environment before updating production.**

> Commerce 2.0 is not yet in active development. In this section of the documentation, we are making note of deprecations that are happening in earlier releases which will cause (breaking) changes in 2.0.

Not all extensions may support Commerce 2.0. Before upgrading, check which extensions you use and check if they support 2.0.

Commerce 1.x will continue to be supported and receive stability and security fixes for two years after the 2.0.0-pl release. If you need help with the upgrade or would like to purchase a support extension, please get in touch.

[TOC]

## Noteworthy changes for end-users

- TBA

## Noteworthy changes for developers

1. Since v1.3, modules can type-hint against the native `\modmore\Commerce\Dispatcher\EventDispatcher` class (in the `initialize` method of the module class). In v2.0, it is **mandatory** to do so, as the internal classes have been changed and updated. [Learn more about the EventDispatcher changes](EventDispatcher)
