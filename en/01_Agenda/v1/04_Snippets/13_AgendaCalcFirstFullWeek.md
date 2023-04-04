This output filter calculates the startdate of the first full week with the
given input. This snippet can be used to set the start date of the
[AgendaCalender](02_AgendaCalendar.md) snippet. The output filter was introduced
with Agenda 1.4.0.

## Output Filter Properties

The output filter uses the following properties:

| Property | Description                                                                                                                                                     | Default |
|----------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------|---------|
| input    | A date that can be [parsed](https://www.php.net/manual/en/datetime.formats.php) by php DateTime.                                                                | -       |
