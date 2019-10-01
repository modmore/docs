The MODX installer should install the package automatically from the modmore
repository.

A custom manager page called _Agenda_ is installed within the _Extras_ menu.
Also some [snippets](04_Snippets/index.md) in the element category named
_Agenda_ are created.

There are some system settings available in the namespace _agenda_. These could
also be edited in the [settings](02_Custom_Manager_Page/07_Settings.md) (cog
icon) tab of the _Agenda_ custom manager page.

If you want to connect events, categories, calendars or locations to MODX
resources, you have to enter the parents of those resources in the system
settings.

To use the map and the geolocation option in the location address tab, you have
to enter a [Google Maps API
Key](https://developers.google.com/maps/documentation/javascript/get-api-key) in
the Agenda [system setting](02_Custom_Manager_Page/07_Settings.md)
`agenda.google_maps_api_key`. You have to activate the Maps JavaScript API and
the Geocoding API in the created Google Cloud Platform project.

After the installation you have to setup a cronjob, if you want to use more than
100 repeats of a recurring event or if you want to setup feeds.
