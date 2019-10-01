This tab contains a paginated grid with all feeds.

[![](img/feeds.png)](img/feeds.png)

You could create a new feed with a click on the create feed button on the top
left above the feeds grid.

The grid could be filtered by a search input on the top right above the
feeds grid.

Each feed could be edited by a click on the edit icon in the row of the
feed. And it could be deleted after a confirmation with a click on the trash
icon in the row of the feed.

The row of each feed shows the feed url, date/time of the last update and the
next update by the cronjob, the feed type the calendar, the categories and the
active state of an entry. The feed url and the feed type could be edited inline
with a double click on the text.

## Create/Edit

The create/edit window for one feed has a some of options, that could be set.

[![](img/feed-edit.png)](img/feed-edit.png)

You could set the feed URL the events are retrieved from. You could select the
calendar, where the feed events are imported into. You could set the categories,
the feed events will get. You could set the update interval and frequency for
the cronjob update of the feed. You could set the feed type (iCal or XML) and
you could toggle the feed to inactive.

The cronjob URL can't use the webcal protocol. Please try to change the url from
`webcal://calendar.domain/url.path` to `https://calendar.domain/url.path` in
that case.
