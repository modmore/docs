The `financial` formatter takes in an integer number (e.g. `1850`) and turns it into a currency-formatted value (e.g. `€18,50`).

The currency that is used is typically based on the `currency` field on the same model. If that's not specified, the currency is taken from the current active currency based on the context or system configuration.