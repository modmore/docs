The scNumberFormat snippet can be used to format a number. It's typically used as an output modifier on a placeholder. 

**Note**: in most cases, especially when it comes to prices and percentages, there will already be a formatted placeholder available. For example when `[[+price]]` is available, `[[+price_formatted]]` is most likely available with a fully formatted number. 

[TOC]

## Standard Usage

````
[[+some_number:scNumberFormat=`options`]]
````

## Options

The following options can be provided. Each option is separated with a `&`. 

- `d`: number of decimals (default 2)
- `ds`: decimal separator (default `,`)
- `ts`: thousands separator (default `.`)
- `s`: symbol to prefix to the output. 

