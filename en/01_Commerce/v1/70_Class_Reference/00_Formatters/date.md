The `date` formatter takes in a unix timestamp (e.g. `1584964242`) and returns a  date stamp without the time.

The `server_offset_time` setting is taken into account. You can use this if your server time is different from the current time.

The format used is set in the `commerce.date_format` system setting, uses [strftime](https://php.net/strftime), and defaults to `%Y-%m-%d`.