## Extended Event Fields

The extended event fields were introduced with Agenda 1.1.0.

Each event in Agenda can use predefined extended fields. The field values are
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
        "xtype": "numberfield",
        "name": "minimum",
        "renderer": "agenda-combo-example-resource",
        "label": "Minimum number of participants",
        "width": 0.5,
        "column_label": "min.",
        "column_width": 50
        "hidden": false
      },
      {
        "xtype": "numberfield",
        "name": "maximum",
        "renderer": "agenda-combo-example-resource",
        "label": "Maximum number of participants",
        "width": 0.5,
        "column_label": "max.",
        "column_width": 50,
        "hidden": false
      }
    ]
  }
]
```

It will add the fields price, and the fields minimum and maximum in two columns
to the event create/update window.

Each array will create one extended field. The `name` key is required. The
`label` key will be used, when it exists. Otherwise, a lexicon entry with the
field name prefixed by `agenda.extended.` is searched in the lexicon. An `xtype`
key will be used, when it exists. Otherwise, the xtype defaults to `textfield`.
A `renderer` key will be used, when it exists. The renderer has to be defined in
the file referenced in the `agenda.extended_xtypes_script` system setting.

If a nested `fields` key contains an array value, this value will be used for
subfields in columns. The `width` key inside is then used for the subfield
column width.

The extended fields can also generate columns in the events grid. The
`column_label` key is required to add a column in the grid. The `column_width`
key will define the width of the grid column. The column_width defaults to 100.
The column can be hidden in the grid with the `hidden` key.

Extended fields are available as placeholder with the prefix `extended` in the
event row template. The `price` field from the example will be available with
the `[[+extended.price]]` placeholder.

The setting can use `@FILE` or `@CHUNK` bindings. Path
placeholders like `{core_path}`, `{base_path}` and `{assets_path}` can be used.
All paths have to stay inside the MODX base path because of security reasons.

## Extended Repeat Fields

The extended repeat fields were introduced with Agenda 1.4.0.

They work the same as the extended event fields, can use `@FILE` or `@CHUNK`
bindings and are shown in the edit repeat window and the repeats grid.

## Extended Location Fields

The extended location fields were introduced with Agenda 1.4.0.

They work the same as the extended event fields, can use `@FILE` or `@CHUNK`
bindings and are shown in the edit location window and the locations grid.
