## Extended Event Fields

Each event in Agenda could use predefined extended fields. The field values are
stored as JSON encoded array in a text field. So sorting and filtering by
extended fields is not possible.

To define the extended fields the system setting `agenda.extended_event_fields`
has to be filled with a nested JSON encoded array. The following value gives an
example:

```
[
  {
    "name": "price",
    "label": "Price"
  },
  {
    "fields": [
      {
        "name": "minimum",
        "label": "Minimum number of participants",
        "width": 0.5,
        "column_label": "min.",
        "column_width": 50
      },
      {
        "name": "maximum",
        "label": "Maximum number of participants",
        "width": 0.5,
        "column_label": "max.",
        "column_width": 50
      }
    ]
  }
]
```

It will add the fields price, and the fields minimum and maximum in two columns
to the event create/update window.

Each array will create one extended field. The `name` key is required. The
`label` key will be used, when it exist. Otherwise a lexicon entry with the
field name prefixed by `agenda.extended.` is searched in the lexicon.

If a nested `fields` key contains an array value, this value will be used for
subfields in columns. The `width` key inside is then used for the subfield
column width.

The extended fields could also generate columns in the events grid. The
`column_label` key is required to add a column in the grid. The `column_width`
key will define the width of the grid column. The column_width defaults to 100.

Extended fields are available as placeholder with the prefix `extended` in the
event row template. The `price` field from the example will be available with
the `[[+extended.price]]` placeholder.
