The `time` formatter takes in a unix timestamp (e.g. `1584964242`) and returns a timestamp, without a date.

The `server_offset_time` setting is taken into account. You can use this if your server time is different from the current time.

The format used is set in the `commerce.time_format` system setting, uses [strftime](https://php.net/strftime), and defaults to `%H:%M:%S %Z`.