This output filter calculates a date with the given input and the options. The
output filter was introduced with Agenda 1.4.0.

## Output Filter Properties

The output filter uses the following properties:

| Property | Description                                                                                                                                                     | Default |
|----------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------|---------|
| input    | A date that can be [parsed](https://www.php.net/manual/en/datetime.formats.php) by php DateTime.                                                                | -       |
| options  | The modifier string that alters the DateTime object. If the option is invalid, the result is empty and the modified placeholder is reset to the original value. | -       |
