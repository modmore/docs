This retrieves and format a date from a GET parameter. The snippet was
introduced with Agenda 1.4.0.

## Properties

It uses the following snippet properties:

| Property   | Description                                                                                                                                                                 | Default     |
|------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------|
| format     | The output format for the date that is retrieved with a GET parameter. Must contain a [supported date and time format](https://www.php.net/manual/de/datetime.formats.php). | Y-m-d H:i:s |
| requestKey | The GET parameter key that is used to retrieve a date.                                                                                                                      | date        |
