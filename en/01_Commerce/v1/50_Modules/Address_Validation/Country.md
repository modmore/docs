Allows you to restrict orders to specific countries, or to blacklist some countries. This also validates the country, providing a field-specific error message if it does not exist. If the customer enters a country that is not allowed (it is either not on the list of allowed countries, or it is in the list of disallowed countries), then a message is shown at the top of the checkout.

## Properties

- Allowed Countries (`allowed_countries`): a comma separated list of country codes that you accept orders from.
- Disallowed Countries (`disallowed_countries`): Only used when Allowed Countries is not set. Specify a comma separated list of countries to not accept orders from.
